<?php

namespace App\Http\Livewire\Main\Account\Landing;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Country;
use Livewire\Component;
use App\Models\UserSkill;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\UserLanguage;
use Livewire\WithFileUploads;
use App\Models\UserAvailability;
use App\Models\UserLinkedAccount;
use App\Utils\Uploader\ImageUploader;
use App\Models\VerificationCenter;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Http\Validators\Main\Account\Settings\EditValidator;
use App\Http\Validators\Main\Account\Profile\AvatarValidator;
use App\Http\Validators\Main\Account\Profile\SocialValidator;
use App\Http\Validators\Main\Account\Profile\AddSkillValidator;
use App\Http\Validators\Main\Account\Profile\HeadlineValidator;
use App\Http\Validators\Main\Account\Profile\AddLanguageValidator;
use App\Http\Validators\Main\Account\Profile\DescriptionValidator;
use App\Http\Validators\Main\Account\Profile\AvailabilityValidator;
use App\Http\Validators\Main\Account\Verification\DocIDValidator;
use App\Http\Validators\Main\Account\Verification\SelfieValidator;
use App\Http\Validators\Main\Account\Verification\DocDriverValidator;
use App\Http\Validators\Main\Account\Verification\DocPassportValidator;
use App\Models\ProjectSkill;
use App\Rules\UsernameRule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class LandingComponent extends Component
{
    use SEOToolsTrait, WithFileUploads, Actions;
    
    public $username;
    public $email;
    public $fullname;
    public $country;
    public $password;
    
    // Description
    public $avatar;
    public $headline;
    public $description;

    // Linked accounts
    public $facebook_profile;
    public $twitter_profile;
    public $dribbble_profile;
    public $stackoverflow_profile;
    public $github_profile;
    public $youtube_profile;
    public $vimeo_profile;

    // Skills
    public $projects_skills;
    public $skills;
    public $add_skill;

    // Languages
    public $languages;
    public $add_language;

    // Availability
    public $availability;
    public $availability_date;
    public $availability_message;
    
    // Verification
    
    public $verification;
    public $document_type;
    public $selfie;
    public $currentStep        = 1;
    public $doc_id             = [];
    public $doc_driver_license = [];
    public $doc_passport       = [];

    /**
     * Init component
     *
     * @return void
     */
    public function mount()
    {
        // Get user
        $user = auth()->user();

        // Fill form
        $this->fill([
            'username'    => $user->username,
            'email'       => $user->email,
            'fullname'    => $user->fullname,
            'country'     => $user->country_id
        ]);
        
        
        // Get linked accounts
        $linked_accounts    = UserLinkedAccount::firstOrCreate(['user_id' => auth()->id()]);

        // Initialize the projects_skills property
        $this->projects_skills = ProjectSkill::orderBy('name', 'asc')->get();
        
        // Set user skills
        $this->skills       = auth()->user()->skills()->orderBy('id', 'desc')->get();

        // Set user languages
        $this->languages    = auth()->user()->languages()->orderBy('id', 'desc')->get();

        // Set user availability
        $this->availability = auth()->user()->availability()->first();

        // Set linked accounts
        $this->fill([
            'headline'              => $user->headline,
            'description'           => $user->description,
            'facebook_profile'      => $linked_accounts->facebook_profile,
            'twitter_profile'       => $linked_accounts->twitter_profile,
            'dribbble_profile'      => $linked_accounts->dribbble_profile,
            'stackoverflow_profile' => $linked_accounts->stackoverflow_profile,
            'github_profile'        => $linked_accounts->github_profile,
            'youtube_profile'       => $linked_accounts->youtube_profile,
            'vimeo_profile'         => $linked_accounts->vimeo_profile,
        ]);
        
        // Get user verification
        $verification = auth()->user()->verification;

        // Set verification
        $this->verification = $verification ? $verification : false;
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
        $title       = __('messages.t_account_landing') . " $separator " . settings('general')->title;
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

        return view('livewire.main.account.landing.landing', [
            'countries' => $this->countries,
            'skills' => $this->skills,
        ])->extends('livewire.main.layout.app')->section('content');
    }


    /**
     * Get list of countries
     *
     * @return object
     */
    public function getCountriesProperty()
    {
        return Country::where('is_active', true)->orderBy('name', 'asc')->get();
    }
    
    public function getSkillsProperty()
    {
        return ProjectSkill::orderBy('name', 'asc')->get();
    }    


    /**
     * Update user account settings
     *
     * @return void
     */
    public function update()
    {
        try {

            // Validate form
            EditValidator::validate($this);

            // Set current user
            $user = auth()->user();

            // Update user data
            User::where('id', auth()->id())->update([
                'username'    => clean($this->username),
                'email'       => clean($this->email),
                'fullname'    => $this->fullname ? clean($this->fullname) : null,
                'country_id'  => $this->country ? $this->country : null
            ]);

            // Refresh user
            $user->refresh();

            // Reset password input
            $this->reset('password');

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_ur_account_settings_updated'),
                'icon'        => 'success'
            ]);
            
            $this->emit('formSubmitted');


        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            throw $th;

        }
    }
    
        /**
     * Update avatar
     *
     * @return void
     */
    public function updatedAvatar()
    {
        try {

            // Validate form
            AvatarValidator::validate($this);

            // Upload avatar
            $avatar_id = ImageUploader::make($this->avatar)
                                      ->deleteById(auth()->user()->avatar_id)
                                      ->resize(100)
                                      ->folder('avatars')
                                      ->handle();

            // Update user avatar
            auth()->user()->update([
                'avatar_id' => $avatar_id
            ]);

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_avatar_updated_successfully'),
                'icon'        => 'success'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            throw $th;

        }
    }
    
    /**
     * Update headline
     *
     * @return void
    */
    public function setHeadline()
    {
        try {

            // Validate form
            HeadlineValidator::validate($this);

            // Update user headline
            auth()->user()->update([
                'headline' => clean($this->headline)
            ]);

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_headline_updated_successfully'),
                'icon'        => 'success'
            ]);

            // Profile updated
            $this->dispatchBrowserEvent('profile-headline-updated');
            
            $this->emit('formSubmitted');

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            throw $th;

        }
    }


    /**
     * Update socila media account
     *
     * @return void
     */
    public function updateSocial()
    {
        try {

            // Validate form
            SocialValidator::validate($this);

            // Update user headline
            UserLinkedAccount::where('user_id', auth()->id())->update([
                'facebook_profile'      => clean($this->facebook_profile),
                'twitter_profile'       => clean($this->twitter_profile),
                'dribbble_profile'      => clean($this->dribbble_profile),
                'stackoverflow_profile' => clean($this->stackoverflow_profile),
                'github_profile'        => clean($this->github_profile),
                'youtube_profile'       => clean($this->youtube_profile),
                'vimeo_profile'         => clean($this->vimeo_profile)
            ]);

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_linked_accounts_has_been_updated'),
                'icon'        => 'success'
            ]);
            
            $this->emit('formSubmitted');

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            throw $th;

        } 
    }


    /**
     * Add new skill
     *
     * @return void
     */
    public function addSkill()
    {
        try {

            // Validate form
            AddSkillValidator::validate($this);

            // Check if skill already exists
            $is_exists = UserSkill::where('user_id', auth()->id())->where('name', $this->add_skill['name'])->first();

            if ($is_exists) {
                
                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_add_skill_already_exists'),
                    'icon'        => 'error'
                ]);
                
                // Return
                return;

            }

            // Add skill
            UserSkill::create([
                'user_id'    => auth()->id(),
                'name'       => $this->add_skill['name'],
                'slug'       => Str::slug($this->add_skill['name']),
                'experience' => $this->add_skill['experience']
            ]);

            // Refresh list of skills
            $this->skills = auth()->user()->skills()->orderBy('id', 'desc')->get();

            // Reset form
            $this->reset('add_skill');

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_skill_added_to_ur_profile'),
                'icon'        => 'success'
            ]);
            
            $this->emit('formSubmitted');

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            throw $th;

        }
    }


    /**
     * Delete a skill
     *
     * @param integer $id
     * @return void
     */
    public function deleteSkill($id)
    {
        // Get skill
        UserSkill::where('user_id', auth()->id())->where('id', $id)->delete();

        // Refresh list of skills
        $this->skills = auth()->user()->skills()->orderBy('id', 'desc')->get();

        // Success
        $this->notification([
            'title'       => __('messages.t_success'),
            'description' => __('messages.t_skill_has_been_deleted_from_profile'),
            'icon'        => 'success'
        ]);
        
        $this->emit('formSubmitted');
    }


    /**
     * Edit skill
     *
     * @param integer $id
     * @return void
    */
    public function editSkill($id)
    {
        // Get skill
        $skill = UserSkill::where('user_id', auth()->id())->where('id', $id)->firstOrFail();

        // Set skill in edit form
        $this->add_skill['name']       = $skill->name;
        $this->add_skill['experience'] = $skill->experience;
        $this->add_skill['id']         = $skill->id;

        // Open edit form
        $this->dispatchBrowserEvent('open-skills-edit-form');
    }


    /**
     * Update skill
     *
     * @return void
    */
    public function updateSkill()
    {
        try {

            // Validate form
            AddSkillValidator::validate($this);

            // Check if skill already exists
            $is_exists = UserSkill::where('user_id', auth()->id())
                                  ->where('name', $this->add_skill['name'])
                                  ->where('id', '!=', $this->add_skill['id'])
                                  ->first();

            if ($is_exists) {
                
                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_add_skill_already_exists'),
                    'icon'        => 'error'
                ]);
                
                // Return
                return;

            }

            // Update skill
            UserSkill::where('id', $this->add_skill['id'])->where('user_id', auth()->id())->update([
                'user_id'    => auth()->id(),
                'name'       => $this->add_skill['name'],
                'slug'       => Str::slug($this->add_skill['name']),
                'experience' => $this->add_skill['experience']
            ]);

            // Refresh list of skills
            $this->skills = auth()->user()->skills()->orderBy('id', 'desc')->get();

            // Reset form
            $this->reset('add_skill');

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_skill_updated'),
                'icon'        => 'success'
            ]);

            // Close form
            $this->dispatchBrowserEvent('close-edit-skill-form');
            
            $this->emit('formSubmitted');

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            throw $th;

        }
    }


    /**
     * Add new language
     *
     * @return void
    */
    public function addLanguage()
    {
        try {

            // Validate form
            AddLanguageValidator::validate($this);

            // Check if language already exists
            $is_exists = UserLanguage::where('user_id', auth()->id())->where('name', $this->add_language['name'])->first();

            if ($is_exists) {
                
                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_add_language_already_exists'),
                    'icon'        => 'error'
                ]);

                // Reload select2
                $this->reloadSelect2();
                
                // Return
                return;

            }

            // Add language
            UserLanguage::create([
                'user_id' => auth()->id(),
                'name'    => $this->add_language['name'],
                'level'   => $this->add_language['level']
            ]);

            // Refresh list of languages
            $this->languages = auth()->user()->languages()->orderBy('id', 'desc')->get();

            // Reset form
            $this->reset('add_language');

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_language_added_to_ur_profile'),
                'icon'        => 'success'
            ]);

            // Reload select2
            $this->reloadSelect2();

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            // Reload select2
            $this->reloadSelect2();

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            // Reload select2
            $this->reloadSelect2();

            throw $th;

        }
    }


    /**
     * Delete a language
     *
     * @param integer $id
     * @return void
    */
    public function deleteLanguage($id)
    {
        // Get language
        UserLanguage::where('user_id', auth()->id())->where('id', $id)->delete();

        // Refresh list of languages
        $this->languages = auth()->user()->languages()->orderBy('id', 'desc')->get();

        // Success
        $this->notification([
            'title'       => __('messages.t_success'),
            'description' => __('messages.t_language_has_been_deleted_from_profile'),
            'icon'        => 'success'
        ]);

        // Reload select2
        $this->reloadSelect2();
    }


    /**
     * Edit language
     *
     * @param integer $id
     * @return void
    */
    public function editLanguage($id)
    {
        // Get language
        $language = UserLanguage::where('user_id', auth()->id())->where('id', $id)->firstOrFail();

        // Set language in edit form
        $this->add_language['name']  = $language->name;
        $this->add_language['level'] = $language->level;
        $this->add_language['id']    = $language->id;

        // Open edit form
        $this->dispatchBrowserEvent('open-languages-edit-form');

        // Reload select2
        $this->reloadSelect2();
    }


    /**
     * Update language
     *
     * @return void
    */
    public function updateLanguage()
    {
        try {

            // Validate form
            AddLanguageValidator::validate($this);

            // Check if language already exists
            $is_exists = UserLanguage::where('user_id', auth()->id())
                                  ->where('name', $this->add_language['name'])
                                  ->where('id', '!=', $this->add_language['id'])
                                  ->first();

            if ($is_exists) {
                
                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_add_language_already_exists'),
                    'icon'        => 'error'
                ]);

                // Reload select2
                $this->reloadSelect2();
                
                // Return
                return;

            }

            // Update language
            UserLanguage::where('id', $this->add_language['id'])->where('user_id', auth()->id())->update([
                'user_id' => auth()->id(),
                'name'    => $this->add_language['name'],
                'level'   => $this->add_language['level']
            ]);

            // Refresh list of languages
            $this->languages = auth()->user()->languages()->orderBy('id', 'desc')->get();

            // Reset form
            $this->reset('add_language');

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_language_updated'),
                'icon'        => 'success'
            ]);

            // Close form
            $this->dispatchBrowserEvent('close-edit-language-form');

            // Reload select2
            $this->reloadSelect2();

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            // Reload select2
            $this->reloadSelect2();

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            // Reload select2
            $this->reloadSelect2();

            throw $th;

        }
    }


    /**
     * Reload select2
     *
     * @return void
     */
    public function reloadSelect2()
    {
        // Reload select2
        $this->dispatchBrowserEvent('pharaonic.select2.load', [
            'target'    => '.select2',
            'component' => $this->id
        ]);
    }


    /**
     * Update user description
     *
     * @return void
     */
    public function updateDescription()
    {
        try {

            // Validate form
            DescriptionValidator::validate($this);

            // Update description
            auth()->user()->update([
                'description' => clean($this->description)
            ]);

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_profile_description_updated'),
                'icon'        => 'success'
            ]);

            // Close form
            $this->dispatchBrowserEvent('close-description-edit-form');
            
            $this->emit('formSubmitted');

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            throw $th;

        }
    }


    /**
     * Set Availability
     *
     * @return void
     */
    public function setAvailability()
    {
        try {

            // Only for sellers
            if (auth()->user()->account_type !== 'seller') {
                return;
            }

            // Validate form
            AvailabilityValidator::validate($this);

            // Set end date
            $availability_date = Carbon::create($this->availability_date);

            // Check if date in future
            if (!$availability_date->isFuture()) {
                
                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_pls_select_availability_date_in_future'),
                    'icon'        => 'error'
                ]);

                return;

            }

            // Delete old availability
            auth()->user()->availability()->delete();

            // Update availability
            $availability = UserAvailability::create([
                'user_id'                 => auth()->id(),
                'message'                 => $this->availability_message ? clean($this->availability_message) : null,
                'expected_available_date' => $availability_date->toDateTimeString()
            ]);

            // Set user availability
            $this->availability = $availability;

            // Close modal
            $this->dispatchBrowserEvent('close-modal', 'modal-set-availability-container');

            // Success
            $this->notification([
                'title'       => __('messages.t_success'),
                'description' => __('messages.t_ur_availability_settings_updated'),
                'icon'        => 'success'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Carbon\Exceptions\InvalidFormatException $e) {

            // Invalid date format
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_invalid_carbon_date_format'),
                'icon'        => 'error'
            ]);

            return;

        } catch (\Throwable $th) {

            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_something_went_wrong'),
                'icon'        => 'error'
            ]);

            throw $th;

        }
    }


    /**
     * Delete user availability
     *
     * @return void
     */
    public function removeAvailability()
    {
        // Check if user has availability
        if ($this->availability) {
            $this->availability->delete();
            $this->availability = null;
            $this->dispatchBrowserEvent('refresh');
        }
    }
    
    
    /**
     * Set document type
     *
     * @return void
     */
    public function setDocumentType()
    {
        // Document type must be id, driver license or passport
        if (!in_array($this->document_type, ['id', 'driver_license', 'passport'])) {
            
            // Error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_please_select_a_valid_document_type'),
                'icon'        => 'error'
            ]);

            return;

        }

        // Go to next step
        $this->currentStep = 2;
    }


    /**
     * Set document files
     *
     * @return void
     */
    public function setDocumentFiles()
    {
        try {
            
            // Validate files
            switch ($this->document_type) {
                case 'id':
                    DocIDValidator::validate($this);
                    break;
                case 'driver_license':
                    DocDriverValidator::validate($this);
                    break;
                case 'passport':
                    DocPassportValidator::validate($this);
                    break;
            }

            // Go to next step
            $this->currentStep = 3;

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Finish verification
     *
     * @return void
     */
    public function finish()
    {
        try {
            
            // Validate selfie photo
            SelfieValidator::validate($this);

            // Get user id
            $user_id = auth()->id();

            // Check if document (id)
            if ($this->document_type === 'id') {
                
                // Upload front side
                $front_side_id = ImageUploader::make($this->doc_id['front'])
                                              ->folder('verifications')
                                              ->handle();

                // Upload back side
                $back_side_id  = ImageUploader::make($this->doc_id['back'])
                                              ->folder('verifications')
                                              ->handle();

            } elseif ($this->document_type === 'driver_license') {
                
                // Upload front side
                $front_side_id = ImageUploader::make($this->doc_driver_license['front'])
                                              ->folder('verifications')
                                              ->handle();

                // Upload back side
                $back_side_id  = ImageUploader::make($this->doc_driver_license['back'])
                                              ->folder('verifications')
                                              ->handle();

            } elseif ($this->document_type === 'passport') {
                
                // Upload front side
                $front_side_id = ImageUploader::make($this->doc_passport['front'])
                                              ->folder('verifications')
                                              ->handle();

                // No back side for passport
                $back_side_id  = null;

            }

            // Save selfie
            $selfie                        = ImageUploader::make($this->selfie)
                                                            ->folder('verifications')
                                                            ->handle();

            // Save verification
            $verification                  = new VerificationCenter();
            $verification->uid             = uid();
            $verification->user_id         = $user_id;
            $verification->document_type   = $this->document_type;
            $verification->file_front_side = $front_side_id;
            $verification->file_back_side  = $back_side_id;
            $verification->file_selfie     = $selfie;
            $verification->save();

            // Success, now refresh page
            $this->dispatchBrowserEvent('refresh');

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_toast_form_validation_error'),
                'icon'        => 'error'
            ]);

            throw $e;

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Go back
     *
     * @return void
     */
    public function back()
    {
        // Check if not first step
        if ($this->currentStep !== 1) {
            $this->currentStep -= 1;
        }
    }


    /**
     * Start again and send files
     *
     * @return void
     */
    public function sendFilesAgain()
    {
        // Check if verification already declined
        if ($this->verification && $this->verification->status === 'declined') {
            
            // Delete verification
            $this->verification->delete();

            // Success, now refresh page
            $this->dispatchBrowserEvent('refresh');

        }

    }
    
}