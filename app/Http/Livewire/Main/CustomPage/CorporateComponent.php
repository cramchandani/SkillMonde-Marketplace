<?php

namespace App\Http\Livewire\Main\CustomPage;

use App\Models\User;
use Livewire\Component;
use App\Models\Category;
use WireUi\Traits\Actions;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class CorporateComponent extends Component
{
    use SEOToolsTrait;
    
   // public $features = [];

    /**
     * Init component
     *
     * @return void
     */
    public function mount()
    {
        /*
        // User account type must be buyer
        if (auth()->check() && auth()->user()->account_type !== 'buyer') {
            return redirect('seller/home');
        }

        */
    }


    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    public function render()
    {
        // SEO
        $separator   = settings('general')->separator;
        $title       = 'Corporate' . " $separator " . settings('general')->title;
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
        
        return view('livewire.main.custompage.corporate', [
            'categories' => $this->categories,
         //   'sellers'    => $this->sellers,
         //   'gigs'       => $this->gigs,
          //  'projects'   => $this->projects,
          //  'articles' => $this->articles 
        ])->extends('livewire.main.layout.app')->section('content');
    }
    
    public function getCategoriesProperty()
    {
        return Category::where('is_visible', true)->orderBy('id')->get();
    }

    
}