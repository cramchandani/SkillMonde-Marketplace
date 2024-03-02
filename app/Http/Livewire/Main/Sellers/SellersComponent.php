<?php

namespace App\Http\Livewire\Main\Sellers;

use App\Models\User;
use App\Models\Country;
use App\Models\UserSkill;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Arr;
use App\Models\Language;
use Illuminate\Pagination\LengthAwarePaginator;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use App\Models\ProjectSkill;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SellersComponent extends Component
{
    use WithPagination, SEOToolsTrait;

    // filters
    public $sort_by;
    public $budget_min;
    public $budget_max;

    public $countries;
    public $skills;
    public $languages;
    public $country;
    public $projectskills;
    public $projectcategories;
    public $countriesCount = [];
    
    public $selectedSkills = [];
    public $selectedCountries = [];
   // public $showAllCountries = false;
    public $maxSelectedCountries;
    public $country_id;


    

    /**
     * Init component
     *
     * @return void
     */
    public function mount()
    {
        $this->countries = Country::get();
        
        $this->projectcategories = ProjectCategory::with('skills')
        ->orderBy('name') // Add this line to order by name
        ->get();
        $this->projectskills = ProjectSkill::get();
    }
    
    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    public function render()
    {
        // Fetch and filter sellers based on selected criteria
        $sellers = $this->filterSellers();
        
        // SEO
        $separator   = settings('general')->separator;
        $title       = __('messages.t_sellers') . " $separator " . settings('general')->title;
        $description = settings('seo')->description;
        $ogimage     = src( settings('seo')->ogimage );

        $this->seo()->setTitle( $title );
        $this->seo()->setDescription( $description );
        $this->seo()->setCanonical( url()->current() );
        $this->seo()->opengraph()->setTitle( $title );
        $this->seo()->opengraph()->setDescription( $description );
        $this->seo()->opengraph()->setUrl( url()->current() );
        $this->seo()->opengraph()->setType('website');
        $this->seo()->opengraph()->addImage( $ogimage );
        $this->seo()->twitter()->setImage( $ogimage );
        $this->seo()->twitter()->setUrl( url()->current() );
        $this->seo()->twitter()->setSite( "@" . settings('seo')->twitter_username );
        $this->seo()->twitter()->addValue('card', 'summary_large_image');
        $this->seo()->metatags()->addMeta('fb:page_id', settings('seo')->facebook_page_id, 'property');
        $this->seo()->metatags()->addMeta('fb:app_id', settings('seo')->facebook_app_id, 'property');
        $this->seo()->metatags()->addMeta('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1', 'name');
        $this->seo()->jsonLd()->setTitle( $title );
        $this->seo()->jsonLd()->setDescription( $description );
        $this->seo()->jsonLd()->setUrl( url()->current() );
        $this->seo()->jsonLd()->setType('WebSite');
        
        return view('livewire.main.sellers.sellers', [
            'sellers' => $sellers,
            'countries' => $this->countries,
            'skills' => $this->skills,
            'languages' => $this->languages,
            'budget_min' => $this->budget_min,
            'budget_max' => $this->budget_max,
            'country_id' => $this->country_id,
        ])->extends('livewire.main.layout.app')->section('content');
    
    }


    /**
     * Get sellers
     *
     * @return object
     */
    public function getSellersProperty()
    {
        $perPage = 20;
        $currentPage = request()->input('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
    
        $sellers = User::with('country', 'skills', 'languages')
            ->where('account_type', 'seller')
            ->whereIn('status', ['verified', 'active'])
            ->orderByRaw("FIELD(status, 'verified') DESC, RAND()")
            ->whereHas('country')
            ->whereHas('languages')
            ->whereHas('skills')
            ->skip($offset)
            ->take($perPage)
            ->get();
    
        return new LengthAwarePaginator(
            $sellers,
            User::where('account_type', 'seller')
                ->whereIn('status', ['verified', 'active'])
                ->whereHas('country')
                ->whereHas('languages')
                ->whereHas('skills')
                ->count(),
            $perPage,
            $currentPage,
            ['path' => route('sellers')] // Adjust the route name as needed
        );
    }

    public function languages()
    {
        return $this->hasMany(UserLanguage::class);
    }
    
 
    //Countries
    public function calculateCountryUserCounts()
    {
        $countries = Country::all();
    
        $countriesCount = [];
    
        foreach ($countries as $country) {
            $usersCount = User::where('country_id', $country->id)
                ->whereIn('status', ['status', 'verified'])
                ->where('account_type', 'seller')
                ->count();
    
            $countriesCount[$country->id] = $usersCount;
        }
    
        arsort($countriesCount);
    
        return $countriesCount;
    }
       
     /**
     * Apply filters and fetch sellers based on selected skills.
     */
     
    // Method to filter sellers based on selected criteria
    private function filterSellers()
    {
        $query = User::with('country', 'languages', 'skills')
            ->where('account_type', 'seller')
            ->whereIn('status', ['verified', 'active'])
            ->orderByRaw("FIELD(status, 'verified') DESC, RAND()")
            ->whereHas('country')
            ->whereHas('languages')
            ->whereHas('skills', function ($subQuery) {
                // Filter by selected skills
                if (!empty($this->selectedSkills)) {
                    $subQuery->whereIn('slug', $this->selectedSkills);
                }
            });

        // Filter by selected skills
        if (!empty($this->selectedSkills)) {
            $query->whereHas('skills', function ($subQuery) {
                $subQuery->whereIn('slug', $this->selectedSkills);
            });
        }
        
        //  \Log::info('Selected Skills: ' . implode(', ', $this->selectedSkills));

        // Filter by selected countries
        if (!empty($this->selectedCountries)) {
            $query->whereIn('country_id', $this->selectedCountries);
        }

        // Filter by budget range
        if (!empty($this->budget_min)) {
            $query->where(function ($subQuery) {
                $subQuery->where('budget_min', '>=', $this->budget_min)
                         ->orWhere('budget_max', '>=', $this->budget_min);
            });
        }
    
        if (!empty($this->budget_max)) {
            $query->where(function ($subQuery) {
                $subQuery->where('budget_max', '<=', $this->budget_max)
                         ->orWhere('budget_min', '<=', $this->budget_max);
            });
        }

        return $query->paginate(30);
    }

    // Methods for handling filter form submissions
    public function applyFilters()
    {
        return $this->render();
    }

    public function applyCountriesFilter()
    {
        return $this->render();
    }

    public function applyBudget()
    {
        return $this->render();
    }
    
    public function clearSkills()
    {
        $this->selectedSkills = [];
    }
    
    public function clearCountries()
    {
        $this->selectedCountries = [];
    }
    
    public function clearBudget()
    {
        $this->budget_min = null;
        $this->budget_max = null;
    }




    

}