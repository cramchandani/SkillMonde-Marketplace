<div class="container" x-data="window.TJPlQeqplTFcTQC" x-init="initialize()">

    {{-- Loading indicator --}}
    <div class="fixed top-10 right-10 z-[99]" wire:loading>
        <div role="status"> <svg aria-hidden="true" class="mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-primary-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/> <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/> </svg> <span class="sr-only">Loading...</span> </div>
    </div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow overflow-hidden">
            <div class="divide-y divide-gray-200 dark:divide-zinc-700 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x rtl:divide-x-reverse">

                {{-- Section content --}}
                <div class="divide-y divide-gray-200 dark:divide-zinc-700 lg:col-span-12">

<div class="container">
  <div class="row">
    <div class="col-md-10 col-sm-12 col-lg-10 mx-auto">
      <div class="card my-5">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
@php
$step1Active = auth()->user()->country?->name == '';
$step2Active = (!empty(auth()->user()->country) || !empty(auth()->user()->headline) || count($skills) > 0 || count($languages) > 0);
$step3Active = (!empty(auth()->user()->headline) && count($skills) > 0 && count($languages) > 0 && !empty(auth()->user()->country));
if ($step3Active) {
    $step2Active = false;
}
@endphp
<!--              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link {{ $step1Active ? 'active' : 'hide' }}" data-toggle="tab" href="#step1" >1. {{ __('messages.t_account_settings') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $step2Active ? 'active' : 'hide' }}" data-toggle="tab" href="#step2" >2. {{ __('messages.t_update_profile') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ $step3Active ? 'active' : 'hide' }}" data-toggle="tab" href="#step3" >3. Verification Center</a>
                </li>
              </ul>
-->


<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $step1Active ? 'active' : 'hide' }} {{ $step1Active ? '': 'disabled' }}" data-toggle="{{ $step1Active ? 'tab' : '' }}" href="#step1">1. {{ __('messages.t_account_settings') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $step2Active ? 'active' : 'hide' }} {{ $step2Active ? '': 'disabled' }}" data-toggle="{{ $step2Active ? 'tab' : '' }}" href="#step2">2. {{ __('messages.t_update_profile') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $step3Active ? 'active' : 'hide' }} {{ $step3Active ? '': 'disabled' }}" data-toggle="{{ $step3Active ? 'tab' : '' }}" href="#step3">3. Verification Center</a>
    </li>
</ul>

              <div class="tab-content">
                <div class="tab-pane {{ $step1Active ? 'active' : 'hide' }}" id="step1" style="display: {{ $step1Active ? 'block;' : 'none;' }}">
                    {{-- Form --}}
                    <div class="py-6 px-4 sm:p-6 lg:pb-8 h-[calc(100%-80px)]">

                        {{-- Section header --}}
                        <div class="mb-14">
                            <h2 class="text-base leading-6 font-bold text-gray-900 dark:text-gray-100">{{ __('messages.t_account_settings') }}</h2>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('messages.t_account_settings_subtitle') }}</p>
                        </div>
                        
                        {{-- Section content --}}
                        <div class="grid grid-cols-12 md:gap-x-8 gap-y-8 mb-6">

                            {{-- Username --}}
                            <div class="col-span-12 md:col-span-6">
                                <x-forms.text-input 
                                    label="{{ __('messages.t_username') }}" 
                                    placeholder="{{ __('messages.t_enter_username') }}" 
                                    model="username"
                                    icon="account" 
                                    readonly />
                            </div>

                            {{-- E-mail address --}}
                            <div class="col-span-12 md:col-span-6">
                                <x-forms.text-input 
                                    label="{{ __('messages.t_email_address') }}" 
                                    placeholder="{{ __('messages.t_enter_email_address') }}" 
                                    model="email"
                                    type="email"
                                    icon="at" 
                                    readonly />
                            </div>

                            {{-- Fullname --}}
                            <div class="col-span-12 md:col-span-6">
                                <x-forms.text-input 
                                    label="{{ __('messages.t_fullname') }}" 
                                    placeholder="{{ __('messages.t_enter_fullname') }}" 
                                    model="fullname"
                                    icon="account" />
                            </div>

                            {{-- Country --}}
                            <div class="col-span-12 md:col-span-6">
                                <div class="w-full" wire:ignore>
                                    <x-forms.select2
                                        :label="__('messages.t_country')"
                                        :placeholder="__('messages.t_choose_country')"
                                        model="country"
                                        :options="$countries"
                                        :isDefer="true"
                                        :isAssociative="false"
                                        :componentId="$this->id"
                                        value="id"
                                        text="name" />
                                </div>
                            </div>

                        </div>

                    </div>
                    {{-- Actions --}}
                    <div class="py-2 px-4 flex justify-end sm:px-6 bg-gray-50 dark:bg-zinc-700" id="update-button">
                        <x-forms.button action="update" text="{{ __('messages.t_update_and_next') }}" wire:click="handleFormSubmission"  />
                    </div> 
                </div>
                <div class="tab-pane {{ $step2Active ? 'active' : 'hide' }}" id="step2" style="display:{{ $step2Active ? 'block;' : 'none;' }}">
                  {{-- Section header --}}
                        <div class="mb-6 mt-6">
                            <h2 class="text-base leading-6 font-bold text-gray-900 dark:text-gray-100">Update User Profile</h2>
                           {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('messages.t_account_settings_subtitle') }}</p>--}}
                        </div>
                  
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <tbody>
                              <tr>
                                <th class="">Profile Image</th>
                                <td>
                                  
                                {{-- Avatar --}}
                                
                                            <div class="relative rounded-full overflow-hidden flex-shrink-0 mx-auto" wire:ignore>
                                                <img id="profile-avatar-preview " class="relative rounded-full w-28 h-28 object-cover lazy border-2 border-gray" src="{{ placeholder_img() }}" data-src="{{ src(auth()->user()->avatar) }}" alt="{{ auth()->user()->username }}">
                                                <label for="profile-avatar-container" class="absolute inset-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center text-sm font-medium text-white opacity-25 hover:opacity-100" style="pointer-events: auto; max-width:112px;border-radius: 50%;">
                                                    <span><i class="fas fa-plus-circle"></i></span>
                                                    <input type="file" id="profile-avatar-container" wire:model="avatar" @change="avatar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md">
                                                </label>
                                            </div>
                                            
                                            
                                  <p>
                                      {{-- Username --}}
                                            <div class="mt-4 text-gray-900 dark:text-gray-200 text-sm font-medium flex"> <i class="fa-regular fa-copyright" style="padding-right:5px;"></i> 
                                                <span class="text-[15px] font-extrabold text-gray-700 dark:text-gray-100">{{ auth()->user()->username }}</span>  
                                                @if (auth()->user()->status === 'verified')
                                                    @php
                                                        $uuid = uid();
                                                    @endphp
                                                    <img data-tooltip-target="tooltip-account-verified-{{ $uuid }}" class="ltr:ml-0.5 rtl:mr-0.5 h-4 w-4 -mt-0.5" src="{{ url('public/img/auth/verified-badge.svg') }}" alt="{{ __('messages.t_account_verified') }}">
                                                    <div id="tooltip-account-verified-{{ $uuid }}" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                        {{ __('messages.t_account_verified') }}
                                                    </div>
                                                @endif  
                                            </div></p>
                                  <p>
                                      {{-- Fullname --}}
                                      <div class="mt-2 text-xs text-gray-500 dark:text-gray-300"><i class="fa-solid fa-user-tie" style="padding-right:5px;"></i> 
                                        {{ auth()->user()->fullname }}
                                      </div>
                                 </p>
                                </td>
                              </tr>
                              <tr>
                                <th class="">Profile Headline<span style="color:red;">*</span></th>
                                <td>
                                            {{-- Headline --}}
                                            <div class="my-4">
                        
                                                {{-- Edit headline (Preview) --}}
                                                <div class="flex items-center cursor-pointer" @click="toggleEditingHeadline" x-show="!isHeadlineEditing" x-cloak>
                        
                                                    {{-- Headline --}}
                                                    <p class="text-gray-500 dark:text-gray-300 text-sm text-center">{{ auth()->user()->headline }}</p>
                        
                                                    {{-- Edit icon --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] ltr:ml-2 rtl:mr-2 text-gray-400 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        
                                                </div>
                        
                                                {{-- Edit headline (Form) --}}
                                                <div x-show="isHeadlineEditing" x-cloak>
                        
                                                    <input type="text" wire:model.defer="headline" @keydown.enter="disableEditing" @keydown.window.escape="disableEditing" class="w-full bg-white dark:bg-zinc-800 focus:outline-none focus:shadow-outline border border-gray-200 dark:border-zinc-600 dark:text-gray-100 rounded-sm py-1 px-2 appearance-none leading-normal text-xs font-medium" x-ref="edit_headline" maxlength="100">
                        
                                                    <div class="ltr:text-right rtl:text-left space-x-2 rtl:space-x-reverse flex items-center justify-end pt-1">
                        
                                                        {{-- Approve editing --}}
                                                        <button wire:click="setHeadline" wire:loading.attr="disabled" wire:target="setHeadline" class="text-xs font-medium text-green-600 hover:text-green-800 flex items-center">
                        
                                                            {{-- Loading indicator --}}
                                                            <div wire:loading wire:target="setHeadline">
                                                                <svg role="status" class="inline w-3 h-3 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                                </svg>
                                                            </div>
                        
                                                            {{-- Icon --}}
                                                            <div wire:loading.remove wire:target="setHeadline">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                            </div>
                        
                                                            <span class="text-[10px] font-medium ltr:ml-1 rtl:mr-1">{{ __('messages.t_approve') }}</span>
                                                        </button>
                        
                                                        {{-- Cancel editing --}}
                                                        <button @click="disableEditing" class="text-xs font-medium text-red-600 hover:text-red-800 flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                                            <span class="text-[10px] font-medium ltr:ml-1 rtl:mr-1">{{ __('messages.t_cancel') }}</span>
                                                        </button>
                        
                                                    </div>
                                                    <small>Click on <span style="color:green;">Approve</span> to update headline.</small>
                        
                                                </div>
                                                
                                            </div>       
                                </td>
                              </tr>
                              <tr>
                                <th>
                                    {{ __('messages.t_description') }} 
                                </th>
                                    
                                <td>
                                    <p class="text-xs font-normal text-gray-400 dark:text-gray-300">{{ __('messages.t_tell_us_more_about_ur_self') }}</p>
                        
                                                <div class="ltr:ml-4 rtl:mr-4 flex-shrink-0 mt-4">
                                                    <button @click="isDescriptionEditing = !isDescriptionEditing" class="inline-flex items-center py-2 px-3 border border-transparent rounded-full bg-transparent hover:bg-transparent focus:outline-none focus:ring-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-600 hover:text-primary-700 ltr:mr-2 rtl:ml-2" viewBox="0 0 20 20" fill="currentColor"> <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                                        <span class="text-xs font-medium text-primary-600 hover:text-primary-700"> 
                                                            {{ __('messages.t_edit') }}
                                                        </span>
                                                    </button>
                                                </div>
                        
                                        {{-- Section content --}}
                                        <div class="px-5 py-6" x-cloak>
                        
                                            {{-- Edit form --}}
                                            <div x-show="isDescriptionEditing" class="w-full">
                                                <div class="mb-4">
                                                    <x-forms.textarea
                                                        :label="__('messages.t_description')"
                                                        :placeholder="__('messages.t_pls_tell_us_about_ur_hobbies_etc')"
                                                        model="description"
                                                        icon="clipboard-text-outline" />
                                                </div>
                                                <div class="flex items-center justify-end">
                                                    <div></div>
                                                    <div class="flex items-center">
                                                        <span @click="isDescriptionEditing = false" class="ltr:mr-4 rtl:ml-4 font-medium text-sm text-gray-500 hover:text-gray-600 cursor-pointer">{{ __('messages.t_cancel') }}</span>
                                                        <x-forms.button action="updateDescription" :text="__('messages.t_update')" :block="false" />
                                                    </div>
                                                </div>
                                            </div>
                        
                                            {{-- User description --}}
                                            <div class="italic text-sm font-medium text-gray-400" x-show="!isDescriptionEditing">
                                                {{ $description }}
                                            </div>
                        
                                        </div>                        
                                </td>
                              </tr>
                              <tr>
                                <th>
                                    {{ __('messages.t_linked_accounts') }}
                                </th>
                                <td>
                                    <p class="text-xs font-normal text-gray-400 dark:text-gray-300">{{ __('messages.t_connect_ur_social_media_accounts') }}</p>
                        
                                        <div class="col-span-12 px-5">
                                                <x-forms.text-input 
                                                    :label="__('messages.t_stackoverflow')"
                                                    :placeholder="__('messages.t_enter_stackoverflow_profile')"
                                                    model="stackoverflow_profile"
                                                    icon="link-variant" />
                                            </div>
                        
                                            {{-- Github --}}
                                            <div class="col-span-12 px-5">
                                                <x-forms.text-input 
                                                    :label="__('messages.t_github')"
                                                    :placeholder="__('messages.t_enter_github_profile')"
                                                    model="github_profile"
                                                    icon="link-variant" />
                                            </div>
                        
                                            {{-- Youtube --}}
                                            <div class="col-span-12 px-5">
                                                <x-forms.text-input 
                                                    :label="__('messages.t_youtube')"
                                                    :placeholder="__('messages.t_enter_youtube_profile')"
                                                    model="youtube_profile"
                                                    icon="link-variant" />
                                            </div>
                        
                                            {{-- Vimeo --}}
                                            <div class="col-span-12 px-5">
                                                <x-forms.text-input 
                                                    :label="__('messages.t_vimeo')"
                                                    :placeholder="__('messages.t_enter_vimeo_profile')"
                                                    model="vimeo_profile"
                                                    icon="link-variant" />
                                            </div>
                        
                                            {{-- Update --}}
                                            <div class="col-span-12 px-5 mt-5">
                                                <x-forms.button action="updateSocial" :text="__('messages.t_update')" :block="true" />
                                            </div>
                        
                                </td>
                              </tr>
                              <tr>
                                <th>
                                       <h3 class="text-sm leading-6 font-semibold tracking-wide text-gray-600 dark:text-gray-100"> {{ __('messages.t_skills') }} <span style="color:red;">*</span></h3>
                                        
                                </th>
                                <td>         
                                    <div class="flex space-x-4 text-center">
                                        <div class="flex-1 ">
                                            <p class="text-xs font-normal text-gray-400 dark:text-gray-300">{{ __('messages.t_let_ur_buyers_know_ur_skills') }}</p>
                                        </div>
                                        <div class="ltr:ml-4 rtl:mr-4 flex-shrink-0 flex-1">
                                            <button @click="isAddSkill = !isAddSkill" class="inline-flex items-center py-2 px-3 border border-transparent rounded-full bg-transparent hover:bg-transparent focus:outline-none focus:ring-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-200 rtl:mr-2 ltr:ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                        
                                        
                                        {{-- Section content --}}
                                        <div class="py-6" x-cloak>
                        
                                            {{-- Create/Update new skill --}}  
                                            <div class="px-5" x-show="isAddSkill">
                        
                                                {{-- Skill name 
                                                <x-forms.text-input
                                                    :label="__('messages.t_add_skill')"
                                                    :placeholder="__('messages.t_eg_voice_talent')"
                                                    model="add_skill.name"
                                                    icon="bookmark-multiple" />
                                                --}}
                                                
                                                {{-- Skill name --}}
                                                <div class="col-span-12 md:col-span-6">
                                                    <label for="skill" class="block text-sm font-medium text-gray-700">Skill name</label>
                                                    <select wire:model="add_skill.name" id="skill" class="form-select mt-1 block w-full">
                                                        <option value="">{{ __('messages.t_choose_skill') }}</option>
                                                        @foreach($projects_skills as $skill)
                                                            <option value="{{ $skill->name }}">{{ $skill->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('add_skill.name')
                                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                        
                                                {{-- Experience --}}
                                                <div class="mt-6">
                                                    <label class="text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('messages.t_experience') }}</label>
                                                    <fieldset class="mt-4">
                                                        <div class="space-y-4">
                                                        
                                                            {{-- Beginner --}}
                                                            <div class="flex items-center">
                                                                <input id="skill-experience-beginner" wire:model.defer="add_skill.experience" value="beginner" name="skill_experience" type="radio" class="focus:ring-primary-600 h-4 w-4 text-primary-600 border-gray-300 dark:border-zinc-600 dark:bg-transparent">
                                                                <label for="skill-experience-beginner" class="ltr:ml-3 rtl:mr-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                    {{ __('messages.t_beginner') }}
                                                                </label>
                                                            </div>
                        
                                                            {{-- Intermediate --}}
                                                            <div class="flex items-center">
                                                                <input id="skill-experience-intermediate" wire:model.defer="add_skill.experience" value="intermediate" name="skill_experience" type="radio" class="focus:ring-primary-600 h-4 w-4 text-primary-600 border-gray-300 dark:border-zinc-600 dark:bg-transparent">
                                                                <label for="skill-experience-intermediate" class="ltr:ml-3 rtl:mr-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                    {{ __('messages.t_intermediate') }}
                                                                </label>
                                                            </div>
                        
                                                            {{-- Expert --}}
                                                            <div class="flex items-center">
                                                                <input id="skill-experience-expert" wire:model.defer="add_skill.experience" value="pro" name="skill_experience" type="radio" class="focus:ring-primary-600 h-4 w-4 text-primary-600 border-gray-300 dark:border-zinc-600 dark:bg-transparent">
                                                                <label for="skill-experience-expert" class="ltr:ml-3 rtl:mr-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                    {{ __('messages.t_expert') }}
                                                                </label>
                                                            </div>
                                                        
                                                        </div>
                                                    </fieldset>
                                                </div>
                        
                                                {{-- Add/Update skill button --}}
                                                <div class="mt-6">
                                                    @if (isset($add_skill['id']))
                                                        <x-forms.button action="updateSkill" :text="__('messages.t_update_skill')" :block="true" />
                                                    @else
                                                        <x-forms.button action="addSkill" :text="__('messages.t_add_skill')" :block="true" />
                                                    @endif
                                                </div>
                        
                                            </div>
                        
                                            {{-- List of skills --}}
                                            @if (count($skills))
                                                <div class="px-5" x-show="!isAddSkill" wire:key="list-of-skills">
                                                    <ul role="list" class="border border-gray-200 dark:border-zinc-600 rounded-md divide-y divide-gray-200 dark:divide-zinc-600">
                                                        @foreach ($skills as $skill)
                                                            <li class="ltr:pl-3 rtl:pr-3 ltr:pr-4 rtl:pl-4 py-3 flex items-center justify-between text-sm" wire:key="skill-id-{{ $skill->id }}">
                        
                                                                {{-- Skill --}}
                                                                <div class="w-0 flex-1 flex items-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd"/> <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"/></svg>
                                                                    <span class="ltr:ml-2 rtl:mr-2 flex-1 w-0 truncate font-medium text-xs dark:text-gray-200">
                                                                        {{ $skill->name }}
                                                                    </span>
                                                                </div>
                        
                                                                {{-- Actions --}}
                                                                <div class="ltr:ml-4 rtl:mr-4 flex-shrink-0 flex items-center justify-center">
                        
                                                                    {{-- Delete --}}
                                                                    <button wire:click="deleteSkill({{ $skill->id }})" wire:loading.attr="disabled" wire:target="deleteSkill({{ $skill->id }})" data-tooltip-target="skill-tooltip-delete-{{ $skill->id }}" type="button" class="font-medium text-primary-600 hover:text-primary-600 ltr:mr-2 rtl:ml-2">
                        
                                                                        {{-- Loading idicator --}}
                                                                        <div wire:loading wire:target="deleteSkill({{ $skill->id }})">
                                                                            <svg role="status" class="inline w-4 h-4 text-primary-600 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                                            </svg>
                                                                        </div>
                        
                                                                        {{-- Icon --}}
                                                                        <div wire:loading.remove wire:target="deleteSkill({{ $skill->id }})">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                                                        </div>
                        
                                                                    </button>
                                                                    <div id="skill-tooltip-delete-{{ $skill->id }}" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                        {{ __('messages.t_delete_skill') }}
                                                                    </div>
                        
                                                                    {{-- Edit --}}
                                                                    <button wire:click="editSkill({{ $skill->id }})" wire:loading.attr="disabled" wire:target="editSkill({{ $skill->id }})" data-tooltip-target="skill-tooltip-edit-{{ $skill->id }}" type="button" class="font-medium text-primary-600 hover:text-primary-600 ltr:mr-2 rtl:ml-2">
                        
                                                                        {{-- Loading idicator --}}
                                                                        <div wire:loading wire:target="editSkill({{ $skill->id }})">
                                                                            <svg role="status" class="inline w-4 h-4 text-primary-600 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                                            </svg>
                                                                        </div>
                        
                                                                        {{-- Icon --}}
                                                                        <div wire:loading.remove wire:target="editSkill({{ $skill->id }})">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"> <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                                                        </div>
                        
                                                                    </button>
                                                                    <div id="skill-tooltip-edit-{{ $skill->id }}" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                        {{ __('messages.t_edit_skill') }}
                                                                    </div>
                        
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                        
                                            {{-- No skills yet --}}
                                            @if (count($skills) === 0)
                                                <div wire:key="no-skills-yet" x-show="!isAddSkill" class="text-center text-xs font-medium text-gray-400">{{ __('messages.t_u_dont_have_any_skills') }}</div>
                                            @endif
                        
                                        </div>            
                                </td>
                              </tr>
                              <tr>
                                <th>
                                    <h3 class="text-sm leading-6 font-semibold tracking-wide text-gray-600 dark:text-gray-100">{{ __('messages.t_languages') }} <span style="color:red;">*</span></h3>
                                    
                                    
                                </th>
                                <td>
                                    <div class="flex space-x-4 text-center">
                                        <div class="flex-1">
                                            <p class="text-xs font-normal text-gray-400 dark:text-gray-300">{{ __('messages.t_add_languages_u_speak') }}</p>
                                        </div> 
                                        <div class="flex-1">
                                            <button @click="isAddLanguage = !isAddLanguage" class="inline-flex items-center py-2 px-3 border border-transparent rounded-full bg-transparent hover:bg-transparent focus:outline-none focus:ring-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 dark:text-gray-300 hover:text-gray-600 dark:hover:text-gray-200 rtl:mr-2 ltr:ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="ltr:ml-4 rtl:mr-4 flex-shrink-0 mt-4">
                        
                                        {{-- Section content --}}
                                        <div class="py-6" x-cloak>
                        
                                            {{-- Create/Update new language --}}  
                                            <div class="px-5" x-show="isAddLanguage">
                        
                                                {{-- Language name --}}
                                                <div class="relative {{ $errors->first('add_language.name') ? 'select2-custom-has-error' : '' }}">
                                                    <label class="text-xs font-medium block mb-2 {{ $errors->first('add_language.name') ? 'text-red-600 dark:text-red-500' : 'text-gray-700' }}">{{ __('messages.t_language') }}</label>
                                                
                                                    <select data-pharaonic="select2" data-component-id="{{ $this->id }}" wire:model.defer="add_language.name" id="select2-id-add_language.name" data-placeholder="{{ __('messages.t_choose_language') }}" data-search-off class="select2" data-dir="{{ config()->get('direction') }}" wire:ignore>
                                                        <option value=""></option>
                                                        @foreach (config('languages') as $code => $name)
                                                            <option value="{{ $name }}">{{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('add_language.name')
                                                        <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $errors->first('add_language.name') }}</p>
                                                    @enderror
                                                
                                                </div>
                        
                                                {{-- Level --}}
                                                <div class="mt-6">
                                                    <fieldset class="mt-4">
                                                        <div class="space-y-4">
                                                        
                                                            {{-- Basic --}}
                                                            <div class="flex items-center">
                                                                <input id="languages-level-basic" wire:model.defer="add_language.level" value="basic" name="languages_level" type="radio" class="focus:ring-primary-600 h-4 w-4 text-primary-600 border-gray-300 dark:border-zinc-600 dark:bg-transparent">
                                                                <label for="languages-level-basic" class="ltr:ml-3 rtl:mr-3 block text-xs font-medium text-gray-700 dark:text-gray-400">
                                                                    {{ __('messages.t_basic') }}
                                                                </label>
                                                            </div>
                                                            
                                                            {{-- Conversational --}}
                                                            <div class="flex items-center">
                                                                <input id="languages-level-conversational" wire:model.defer="add_language.level" value="conversational" name="languages_level" type="radio" class="focus:ring-primary-600 h-4 w-4 text-primary-600 border-gray-300 dark:border-zinc-600 dark:bg-transparent">
                                                                <label for="languages-level-conversational" class="ltr:ml-3 rtl:mr-3 block text-xs font-medium text-gray-700 dark:text-gray-400">
                                                                    {{ __('messages.t_conversational') }}
                                                                </label>
                                                            </div>
                        
                                                            {{-- Fluent --}}
                                                            <div class="flex items-center">
                                                                <input id="languages-level-fluent" wire:model.defer="add_language.level" value="fluent" name="languages_level" type="radio" class="focus:ring-primary-600 h-4 w-4 text-primary-600 border-gray-300 dark:border-zinc-600 dark:bg-transparent">
                                                                <label for="languages-level-fluent" class="ltr:ml-3 rtl:mr-3 block text-xs font-medium text-gray-700 dark:text-gray-400">
                                                                    {{ __('messages.t_fluent') }}
                                                                </label>
                                                            </div>
                        
                                                            {{-- Native --}}
                                                            <div class="flex items-center">
                                                                <input id="languages-level-native" wire:model.defer="add_language.level" value="native" name="languages_level" type="radio" class="focus:ring-primary-600 h-4 w-4 text-primary-600 border-gray-300 dark:border-zinc-600 dark:bg-transparent">
                                                                <label for="languages-level-native" class="ltr:ml-3 rtl:mr-3 block text-xs font-medium text-gray-700 dark:text-gray-400">
                                                                    {{ __('messages.t_native') }}
                                                                </label>
                                                            </div>
                                                        
                                                        </div>
                                                    </fieldset>
                                                </div>
                        
                                                {{-- Add/Update language button --}}
                                                <div class="mt-6">
                                                    @if (isset($add_language['id']))
                                                        <x-forms.button action="updateLanguage" :text="__('messages.t_update_language')" :block="true" />
                                                    @else
                                                        <x-forms.button action="addLanguage" :text="__('messages.t_add_language')" :block="true" />
                                                    @endif
                                                </div>
                        
                                            </div>
                        
                                            {{-- List of languages --}}
                                            @if (count($languages))
                                                <div class="px-5" x-show="!isAddLanguage" wire:key="list-of-languages">
                                                    <ul role="list" class="border border-gray-200 dark:border-zinc-600 rounded-md divide-y divide-gray-200 dark:divide-zinc-600">
                                                        @foreach ($languages as $language)
                                                            <li class="ltr:pl-3 rtl:pr-3 ltr:pr-4 rtl:pl-4 py-3 flex items-center justify-between text-sm" wire:key="language-id-{{ $language->id }}">
                        
                                                                {{-- Language --}}
                                                                <div class="w-0 flex-1 flex items-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-5 w-5 text-gray-400 dark:text-gray-300" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M7 2a1 1 0 011 1v1h3a1 1 0 110 2H9.578a18.87 18.87 0 01-1.724 4.78c.29.354.596.696.914 1.026a1 1 0 11-1.44 1.389c-.188-.196-.373-.396-.554-.6a19.098 19.098 0 01-3.107 3.567 1 1 0 01-1.334-1.49 17.087 17.087 0 003.13-3.733 18.992 18.992 0 01-1.487-2.494 1 1 0 111.79-.89c.234.47.489.928.764 1.372.417-.934.752-1.913.997-2.927H3a1 1 0 110-2h3V3a1 1 0 011-1zm6 6a1 1 0 01.894.553l2.991 5.982a.869.869 0 01.02.037l.99 1.98a1 1 0 11-1.79.895L15.383 16h-4.764l-.724 1.447a1 1 0 11-1.788-.894l.99-1.98.019-.038 2.99-5.982A1 1 0 0113 8zm-1.382 6h2.764L13 11.236 11.618 14z" clip-rule="evenodd"/></svg>
                                                                    <span class="ltr:ml-2 rtl:mr-2 flex-1 w-0 truncate font-medium text-xs dark:text-gray-100">
                                                                        {{ $language->name }} ⚊ <span class="font-normal text-gray-400 dark:text-gray-300">{{ __('messages.t_' . $language->level) }}</span>
                                                                    </span>
                                                                </div>
                        
                                                                {{-- Actions --}}
                                                                <div class="ltr:ml-4 rtl:mr-4 flex-shrink-0 flex items-center justify-center">
                        
                                                                    {{-- Delete --}}
                                                                    <button wire:click="deleteLanguage({{ $language->id }})" wire:loading.attr="disabled" wire:target="deleteLanguage({{ $language->id }})" data-tooltip-target="language-tooltip-delete-{{ $language->id }}" type="button" class="font-medium text-primary-600 hover:text-primary-600 ltr:mr-2 rtl:ml-2">
                        
                                                                        {{-- Loading idicator --}}
                                                                        <div wire:loading wire:target="deleteLanguage({{ $language->id }})">
                                                                            <svg role="status" class="inline w-4 h-4 text-primary-600 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                                            </svg>
                                                                        </div>
                        
                                                                        {{-- Icon --}}
                                                                        <div wire:loading.remove wire:target="deleteLanguage({{ $language->id }})">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                                                        </div>
                        
                                                                    </button>
                                                                    <div id="language-tooltip-delete-{{ $language->id }}" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                        {{ __('messages.t_delete_language') }}
                                                                    </div>
                        
                                                                    {{-- Edit --}}
                                                                    <button wire:click="editLanguage({{ $language->id }})" wire:loading.attr="disabled" wire:target="editLanguage({{ $language->id }})" data-tooltip-target="language-tooltip-edit-{{ $language->id }}" type="button" class="font-medium text-primary-600 hover:text-primary-600 ltr:mr-2 rtl:ml-2">
                        
                                                                        {{-- Loading idicator --}}
                                                                        <div wire:loading wire:target="editLanguage({{ $language->id }})">
                                                                            <svg role="status" class="inline w-4 h-4 text-primary-600 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                                                            </svg>
                                                                        </div>
                        
                                                                        {{-- Icon --}}
                                                                        <div wire:loading.remove wire:target="editLanguage({{ $language->id }})">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"> <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/></svg>
                                                                        </div>
                        
                                                                    </button>
                                                                    <div id="language-tooltip-edit-{{ $language->id }}" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                        {{ __('messages.t_edit_language') }}
                                                                    </div>
                        
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                        
                                            {{-- No languages yet --}}
                                            @if (count($languages) === 0)
                                                <div wire:key="no-languages-yet" x-show="!isAddLanguage" class="text-center text-xs font-medium text-gray-400">{{ __('messages.t_u_dont_have_any_languages') }}</div>
                                            @endif
                        
                                        </div>
                                        
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                  <td><strong>NOTE</stong>:</td>
                                  <td><p>To ensure a better user experience, please fill in all the required fields marked with a red asterisk (<span style="color:red;">*</span>). You will only be able to proceed once all the mandatory fields are filled.</p></td>
                                  
                              </tr>
                            </tbody>
                          </table>
                        </div>

                </div>
                <div class="tab-pane {{ $step3Active ? 'active' : 'hide' }}" id="step3" style="display: {{ $step3Active ? 'block;' : 'none;' }}">
                    
                  
                    {{-- Section content --}}
                    <div class="divide-y divide-gray-200 dark:divide-zinc-700 lg:col-span-9" x-data="window.nYpPIEgUauhEVLt">
    
                        {{-- Form --}}
                        <div class="py-6 px-4 sm:p-6 lg:pb-8 h-[calc(100%-80px)]">
    
                            {{-- Section header --}}
                            <div class="mb-14">
                                <h2 class="text-base leading-6 font-bold text-gray-900 dark:text-gray-100">{{ __('messages.t_verification_center') }}</h2>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">{{ __('messages.t_verification_center_subtitle') }}</p>
                            </div>
                            
                            {{-- Check if user has a verification before or not --}}
                            @if ($verification)
                                
                                {{-- Verification status --}} 
                                <div class="py-5">
                                    <dl class="grid grid-cols-1 gap-y-8 sm:grid-cols-2">
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-medium text-gray-500">{{ __('messages.t_verification_status') }}</dt>
                                            @if ($verification->status === 'pending')
                                                <dd class="mt-1 text-xs font-semibold text-amber-600">{{ __('messages.t_verification_pending') }}</dd>
                                            @elseif ($verification->status === 'verified')
                                                <dd class="mt-1 text-xs font-semibold text-green-400">{{ __('messages.t_account_verified') }}</dd>
                                            @elseif ($verification->status === 'declined')
                                                <dd class="mt-1 text-xs font-semibold text-red-400">{{ __('messages.t_verification_declined') }}</dd>
                                            @endif
                                        </div>
                                        <div class="sm:col-span-1">
                                            
                                            {{-- Verified --}}
                                            @if ($verification->status === 'verified')
                                                <dt class="text-sm font-medium text-gray-500">{{ __('messages.t_verified_at') }}</dt>
                                                <dd class="mt-1 text-xs text-gray-500">{{ format_date($verification->verified_at, config('carbon-formats.F_j,_Y_h_:_i_A')) }}</dd>
                                            @endif
    
                                            {{-- Pending --}}
                                            @if ($verification->status === 'pending')
                                                <dt class="text-sm font-medium text-gray-500">{{ __('messages.t_verification_date') }}</dt>
                                                <dd class="mt-1 text-xs text-gray-500">{{ format_date($verification->created_at, config('carbon-formats.F_j,_Y_h_:_i_A')) }}</dd>
                                            @endif
    
                                            {{-- Declined --}}
                                            @if ($verification->status === 'declined')
                                                <dt class="text-sm font-medium text-gray-500">{{ __('messages.t_declined_at') }}</dt>
                                                <dd class="mt-1 text-xs text-gray-500">{{ format_date($verification->declined_at, config('carbon-formats.F_j,_Y_h_:_i_A')) }}</dd>
                                            @endif
                                            
                                        </div>
                                    </dl>
                                </div>  
                                
                                {{-- Verification files --}}
                                <div class="sm:col-span-2 mt-6">
                                    <dt class="text-xs font-medium text-gray-500">{{ __('messages.t_verification_documents') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
    
                                            {{-- Selfie photo --}}
                                            <li class="ltr:pl-3 rtl:pr-3 ltr:pr-4 rtl:pl-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="ltr:ml-2 rtl:mr-2 flex-1 w-0 truncate text-xs"> <span class="font-semibold">{{ __('messages.t_selfie_photo') }}</span> - {{ format_bytes($verification->selfie->file_size) }} </span>
                                                </div>
                                                <div class="ltr:ml-4 rtl:mr-4 flex-shrink-0">
                                                    <a href="{{ url( 'uploads/verifications/' . $verification->uid . '/selfie/' . $verification->file_selfie ) }}" target="_blank" class="font-medium text-primary-600 hover:text-primary-600 text-xs"> {{ __('messages.t_download') }} </a>
                                                </div>
                                            </li>
    
                                            {{-- Frontside --}}
                                            <li class="ltr:pl-3 rtl:pr-3 ltr:pr-4 rtl:pl-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="ltr:ml-2 rtl:mr-2 flex-1 w-0 truncate text-xs"> 
                                                        @if ($verification->document_type === 'id')
                                                            <span class="font-semibold">{{ __('messages.t_government_issued_id_frontside') }}</span>
                                                        @elseif ($verification->document_type === 'driver_license')
                                                            <span class="font-semibold">{{ __('messages.t_driver_license_frontside') }}</span>
                                                        @elseif ($verification->document_type === 'passport')
                                                            <span class="font-semibold">{{ __('messages.t_passport') }}</span>
                                                        @endif
                                                        - {{ format_bytes($verification->frontside->file_size) }} </span>
                                                </div>
                                                <div class="ltr:ml-4 rtl:mr-4 flex-shrink-0">
                                                    <a href="{{ url( 'uploads/verifications/' . $verification->uid . '/front/' . $verification->file_front_side ) }}" target="_blank" class="font-medium text-primary-600 hover:text-primary-600 text-xs"> {{ __('messages.t_download') }} </a>
                                                </div>
                                            </li>
    
                                            {{-- Backside --}}
                                            @if ($verification->document_type !== 'passport')
                                                <li class="ltr:pl-3 rtl:pr-3 ltr:pr-4 rtl:pl-4 py-3 flex items-center justify-between text-sm">
                                                    <div class="w-0 flex-1 flex items-center">
                                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="ltr:ml-2 rtl:mr-2 flex-1 w-0 truncate text-xs"> 
                                                            @if ($verification->document_type === 'id')
                                                                <span class="font-semibold">{{ __('messages.t_government_issued_id_backside') }}</span>
                                                            @elseif ($verification->document_type === 'driver_license')
                                                                <span class="font-semibold">{{ __('messages.t_driver_license_backside') }}</span>
                                                            @endif
                                                            - {{ format_bytes($verification->backside->file_size) }} </span>
                                                    </div>
                                                    <div class="ltr:ml-4 rtl:mr-4 flex-shrink-0">
                                                        <a href="{{ url( 'uploads/verifications/' . $verification->uid . '/back/' . $verification->file_back_side ) }}" target="_blank" class="font-medium text-primary-600 hover:text-primary-600 text-xs"> {{ __('messages.t_download') }} </a>
                                                    </div>
                                                </li>
                                            @endif
                                            
                                        </ul>
                                    </dd>
                                </div>
    
                            @else
    
                                {{-- Choose verification document type --}}
                                @if ($currentStep === 1)
                                    
                                    <fieldset>
                                        <legend class="text-xs font-medium text-gray-900 dark:text-gray-100 mb-2">{{ __('messages.t_choose_document_type') }}</legend>
                                
                                        <div class="mt-1 bg-white dark:bg-zinc-700 rounded-md shadow-sm -space-y-px">
    
                                            {{-- Identify card --}}
                                            <label class="rounded-tl-md rounded-tr-md relative border-2 dark:border-zinc-600 p-4 flex cursor-pointer focus:outline-none ">
                                                <input type="radio" name="document_type" value="id" wire:model.defer="document_type" class="h-4 w-4 cursor-pointer text-primary-600 border-gray-300 dark:border-zinc-600 focus:ring-primary-600" aria-labelledby="document_type_id">
                                                <div class="ltr:ml-3 rtl:mr-3 flex flex-col">
                                                    <span id="document_type_id" class="block text-xs font-medium text-gray-900 dark:text-gray-300">
                                                        {{ __('messages.t_government_issued_id') }}
                                                    </span>
                                                </div>
                                            </label>
    
                                            {{-- Driver license --}}
                                            <label class="relative border-2 dark:border-zinc-600 border-t-0 p-4 flex cursor-pointer focus:outline-none ">
                                                <input type="radio" name="document_type" value="driver_license" wire:model.defer="document_type" class="h-4 w-4 cursor-pointer text-primary-600 border-gray-300 dark:border-zinc-600 focus:ring-primary-600" aria-labelledby="document_type_driver_license">
                                                <div class="ltr:ml-3 rtl:mr-3 flex flex-col">
                                                    <span id="document_type_driver_license" class="block text-xs font-medium text-gray-900 dark:text-gray-300">
                                                        {{ __('messages.t_driver_license') }}
                                                    </span>
                                                </div>
                                            </label>
    
                                            {{-- Passport --}}
                                            <label class="rounded-bl-md rounded-br-md relative border-2 dark:border-zinc-600 border-t-0 p-4 flex cursor-pointer focus:outline-none ">
                                                <input type="radio" name="document_type" value="passport" wire:model.defer="document_type" class="h-4 w-4 cursor-pointer text-primary-600 border-gray-300 dark:border-zinc-600 focus:ring-primary-600" aria-labelledby="document_type_passport">
                                                <div class="ltr:ml-3 rtl:mr-3 flex flex-col">
                                                    <span id="document_type_passport" class="block text-xs font-medium text-gray-900 dark:text-gray-300">
                                                        {{ __('messages.t_passport') }}
                                                    </span>
                                                </div>
                                            </label>
                                            
                                        </div>
                                    </fieldset>
    
                                {{-- Upload files --}}
                                @elseif ($currentStep === 2)
    
                                    {{-- Upload ID files --}}
                                    @if ($document_type === 'id')
                                        <div class="grid grid-cols-2 gap-4">
    
                                            {{-- Front side --}}
                                            <div>
                                                <div class="flex justify-center items-center w-full">
                                                    <label for="doc_id_frontside" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-zinc-700 hover:bg-gray-100 dark:border-zinc-600 dark:hover:border-zinc-500 dark:hover:bg-zinc-600">
                                                            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                                </svg>
        
                                                                {{-- Choose file text --}}
                                                                <template x-if="!preview.front">
                                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">{{ __('messages.t_upload_doc_front_side') }}</span></p>
                                                                </template>
        
                                                                {{-- Choosen file name --}}
                                                                <template x-if="preview.front">
                                                                    <p class="mb-2 text-sm text-gray-900 dark:text-gray-400 truncate">
                                                                        <span class="font-semibold" x-text="preview.front"></span></p>
                                                                </template>
        
                                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                    {{ __('messages.t_verification_allowed_mimes_size') }}
                                                                </p>
                                                            </div>
        
                                                        <input id="doc_id_frontside" type="file" accept="image/jpg,image/jpeg,image/png"  class="hidden" @change="setFrontSide" wire:model="doc_id.front">
                                                    </label>
                                                </div> 
                                                @error('front')
                                                    <div class="text-xs font-medium text-red-500 pt-1">
                                                        {{ $errors->first('front') }}
                                                    </div>
                                                @enderror
                                            </div>
    
                                            {{-- Back side --}}
                                            <div>
                                                <div class="flex justify-center items-center w-full">
                                                    <label for="doc_id_backside" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-zinc-700 hover:bg-gray-100 dark:border-zinc-600 dark:hover:border-zinc-500 dark:hover:bg-zinc-600">
                                                            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                                </svg>
        
                                                                {{-- Choose file text --}}
                                                                <template x-if="!preview.back">
                                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">{{ __('messages.t_upload_doc_back_side') }}</span></p>
                                                                </template>
        
                                                                {{-- Choosen file name --}}
                                                                <template x-if="preview.back">
                                                                    <p class="mb-2 text-sm text-gray-900 dark:text-gray-400 truncate">
                                                                        <span class="font-semibold" x-text="preview.back"></span></p>
                                                                </template>
        
                                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                    {{ __('messages.t_verification_allowed_mimes_size') }}
                                                                </p>
                                                            </div>
        
                                                        <input id="doc_id_backside" type="file" accept="image/jpg,image/jpeg,image/png" class="hidden" @change="setBackSide" wire:model="doc_id.back">
                                                    </label>
                                                </div>  
                                                @error('back')
                                                    <div class="text-xs font-medium text-red-500 pt-1">
                                                        {{ $errors->first('back') }}
                                                    </div>
                                                @enderror
                                            </div>
    
                                        </div>
                                    @elseif ($document_type === 'driver_license')
                                        <div class="grid grid-cols-2 gap-4">
    
                                            {{-- Front side --}}
                                            <div>
                                                <div class="flex justify-center items-center w-full">
                                                    <label for="doc_driver_license_frontside" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-zinc-700 hover:bg-gray-100 dark:border-zinc-600 dark:hover:border-zinc-500 dark:hover:bg-zinc-600">
                                                            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                                </svg>
    
                                                                {{-- Choose file text --}}
                                                                <template x-if="!preview.front">
                                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">{{ __('messages.t_upload_doc_front_side') }}</span></p>
                                                                </template>
    
                                                                {{-- Choosen file name --}}
                                                                <template x-if="preview.front">
                                                                    <p class="mb-2 text-sm text-gray-900 dark:text-gray-400 truncate">
                                                                        <span class="font-semibold" x-text="preview.front"></span></p>
                                                                </template>
    
                                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                    {{ __('messages.t_verification_allowed_mimes_size') }}
                                                                </p>
                                                            </div>
    
                                                        <input id="doc_driver_license_frontside" type="file" accept="image/jpg,image/jpeg,image/png"  class="hidden" @change="setFrontSide" wire:model="doc_driver_license.front">
                                                    </label>
                                                </div> 
                                                @error('front')
                                                    <div class="text-xs font-medium text-red-500 pt-1">
                                                        {{ $errors->first('front') }}
                                                    </div>
                                                @enderror
                                            </div>
    
                                            {{-- Back side --}}
                                            <div>
                                                <div class="flex justify-center items-center w-full">
                                                    <label for="doc_driver_license_backside" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-zinc-700 hover:bg-gray-100 dark:border-zinc-600 dark:hover:border-zinc-500 dark:hover:bg-zinc-600">
                                                            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                                </svg>
    
                                                                {{-- Choose file text --}}
                                                                <template x-if="!preview.back">
                                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">{{ __('messages.t_upload_doc_back_side') }}</span></p>
                                                                </template>
    
                                                                {{-- Choosen file name --}}
                                                                <template x-if="preview.back">
                                                                    <p class="mb-2 text-sm text-gray-900 dark:text-gray-400 truncate">
                                                                        <span class="font-semibold" x-text="preview.back"></span></p>
                                                                </template>
    
                                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                    {{ __('messages.t_verification_allowed_mimes_size') }}
                                                                </p>
                                                            </div>
    
                                                        <input id="doc_driver_license_backside" type="file" accept="image/jpg,image/jpeg,image/png" class="hidden" @change="setBackSide" wire:model="doc_driver_license.back">
                                                    </label>
                                                </div>  
                                                @error('back')
                                                    <div class="text-xs font-medium text-red-500 pt-1">
                                                        {{ $errors->first('back') }}
                                                    </div>
                                                @enderror
                                            </div>
    
                                        </div>
                                    @elseif ($document_type === 'passport')
                                        <div class="grid grid-cols-1 gap-4">
    
                                            {{-- Front side --}}
                                            <div>
                                                <div class="flex justify-center items-center w-full">
                                                    <label for="doc_passport_frontside" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-zinc-700 hover:bg-gray-100 dark:border-zinc-600 dark:hover:border-zinc-500 dark:hover:bg-zinc-600">
                                                            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="mb-3 w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                                </svg>
    
                                                                {{-- Choose file text --}}
                                                                <template x-if="!preview.front">
                                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">{{ __('messages.t_upload_doc_front_side') }}</span></p>
                                                                </template>
    
                                                                {{-- Choosen file name --}}
                                                                <template x-if="preview.front">
                                                                    <p class="mb-2 text-sm text-gray-900 dark:text-gray-400 truncate">
                                                                        <span class="font-semibold" x-text="preview.front"></span></p>
                                                                </template>
    
                                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                                    {{ __('messages.t_verification_allowed_mimes_size') }}
                                                                </p>
                                                            </div>
    
                                                        <input id="doc_passport_frontside" type="file" accept="image/jpg,image/jpeg,image/png" class="hidden" @change="setFrontSide" wire:model="doc_passport.front">
                                                    </label>
                                                </div> 
                                                @error('front')
                                                    <div class="text-xs font-medium text-red-500 pt-1">
                                                        {{ $errors->first('front') }}
                                                    </div>
                                                @enderror
                                            </div>
    
                                        </div>
                                    @endif
    
                                {{-- Selfie --}}
                                @elseif ($currentStep === 3)
    
                                    {{-- Message --}}
                                    <div class="bg-yellow-50 ltr:border-l-4 rtl:border-r-4 border-yellow-400 p-4">
                                        <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ltr:ml-3 rtl:mr-3">
                                            <p class="text-sm text-yellow-700">{{ __('messages.t_verification_selfie_page_msg') }}</p>
                                        </div>
                                        </div>
                                    </div>
    
                                    {{-- Container/Results --}}
                                    <div class="grid grid-cols-2 gap-4" wire:ignore>
    
                                        {{-- Camera container --}}
                                        <div class="flex items-center justify-center border-dashed border-2 border-gray-200 dark:border-zinc-700 mt-8 mb-4">
                                            <div id="webcamjs-container"></div>
                                        </div>
    
                                        {{-- Image taken --}}
                                        <div class="flex items-center justify-center border-dashed border-2 border-gray-200 dark:border-zinc-700 mt-8 mb-4">
                                            <div id="webcamjs-results"></div>
                                        </div>
    
                                    </div>
    
                                    {{-- Take Snapshot --}}
                                    <div>
                                        <button type="button" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded text-sm px-5 py-2.5 text-center inline-flex items-center ltr:mr-2 rtl:ml-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" x-on:click="snapshot">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ltr:mr-2 rtl:ml-2 ltr:-ml-1 rtl:-mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span class="text-xs font-semibold">{{ __('messages.t_take_a_snapshot') }}</span>
                                        </button>
                                    </div>
    
                                    {{-- Initialize WebCamJS --}}
                                    <script>
                                        Webcam.set({
                                            width       : 490,
                                            height      : 350,
                                            image_format: 'jpeg',
                                            jpeg_quality: 100
                                        });
                                        Webcam.attach('#webcamjs-container');
                                    </script>
    
                                @endif
                                
    
                            @endif
    
                        </div>
    
                        {{-- Actions --}}
                        @if (!$verification)
                            <div class="bg-gray-50 dark:bg-zinc-700 h-20 flex justify-between">
    
                                {{-- Back --}}
                                <div>
                                    @if ($currentStep !== 1)
                                        <div class="py-4 px-4 flex justify-end sm:px-6">
                                            <x-forms.button 
                                                action="back" 
                                                text="{{ __('messages.t_back') }}" 
                                                block="0" 
                                                active="text-gray-900 bg-gray-100 hover:bg-gray-200" />
                                        </div>
                                    @endif
                                </div>
    
                                {{-- Next --}}
                                <div>
                                    {{-- Set document type --}}
                                    @if ($currentStep === 1)
                                        <div class="py-4 px-4 flex justify-end sm:px-6">
                                            <x-forms.button action="setDocumentType" text="{{ __('messages.t_next_step') }}" block="0" />
                                        </div>
                                        
                                    {{-- Set document files --}}    
                                    @elseif($currentStep === 2)
                                        <div class="py-4 px-4 flex justify-end sm:px-6" id="verification-button">
                                            <x-forms.button action="setDocumentFiles" text="{{ __('messages.t_next_step') }}" block="0" />
                                        </div>
                                        
                                    {{-- Finish --}}
                                    @elseif($currentStep === 3)
                                        <div class="py-4 px-4 flex justify-end sm:px-6" id="finish-snapshot">
                                            <x-forms.button action="finish" text="{{ __('messages.t_finish') }}" block="0" />
                                        </div>
                                    @endif
                                </div>
    
                            </div>
                            
                        @elseif ($verification && $verification->status === 'pending')
                        
                        <div class="pt-6 text-center">
                            @if (auth()->user()->account_type === 'seller')
                            <a class="inline-flex items-center rounded-sm border border-transparent bg-primary-600 px-4 py-2 text-[13px] font-semibold text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 dark:focus:ring-zinc-800 whitespace-nowrap" href="https://skillmonde.com/seller/home">Go to Freelancer dashboard & Create a Gig</a>
                             @else
                            <a class="inline-flex items-center rounded-sm border border-transparent bg-primary-600 px-4 py-2 text-[13px] font-semibold text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800 dark:focus:ring-zinc-800 whitespace-nowrap" href="https://skillmonde.com/account/orders">Check Orders</a>
                             @endif
                        </div> 
                        
                        @elseif ($verification && $verification->status === 'declined')
                            <div class="py-4 px-4 flex justify-end sm:px-6 bg-gray-50 dark:bg-zinc-700">
                                <x-forms.button action="sendFilesAgain" text="{{ __('messages.t_send_files_again') }}" block="0" />
                            </div>
                        @endif                
    
                    </div>
                    </div>
                    <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


                    
    {{-- Set availability modal --}}
    @if (auth()->user()->account_type === 'seller' && !$availability)
        <x-forms.modal id="modal-set-availability-container" target="modal-set-availability-button" uid="modal_{{ uid() }}" placement="center-center" size="max-w-md">

            {{-- Header --}}
            <x-slot name="title">{{ __('messages.t_change_availability') }}</x-slot>

            {{-- Content --}}
            <x-slot name="content">
                <div class="grid grid-cols-12 md:gap-x-6 gap-y-6">

                    {{-- Expected available date --}}
                    <div class="col-span-12">
                        <x-forms.text-input 
                            :label="__('messages.t_when_do_u_expect_tobe_ready_for_new_work')"
                            :placeholder="__('messages.t_mm_dd_yyyy_example', ['example' => now()->addDay()->format('m/d/Y')])"
                            model="availability_date"
                            icon="calendar" />
                    </div>

                    {{-- Message --}}
                    <div class="col-span-12">
                        <x-forms.textarea
                            :label="__('messages.t_add_a_message')"
                            :placeholder="__('messages.t_buyers_will_see_ur_message_when_visiting_ur_gigs')"
                            model="availability_message"
                            icon="message-reply-text" />
                    </div>

                </div>
            </x-slot>

            {{-- Footer --}}
            <x-slot name="footer">
                <x-forms.button action="setAvailability" text="{{ __('messages.t_set_availability') }}" :block="0"  />
            </x-slot>

        </x-forms.modal>
    @endif



                   

                </div>

            </div>
        </div>
    </div>
</div>
{{-- Include in Header --}}
@push('styles')
    
    {{-- Include WebcamJS Plugin --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

@endpush

{{-- Include in Footer --}}
@push('scripts')

    {{-- AlpineJS --}}
    <script>
        function nYpPIEgUauhEVLt() {
            return {

                counter: 0,

                preview: {
                    front: null,
                    back : null
                },

                setFrontSide(e) {
                    const source       = e.target.files[0];
                    this.preview.front = source.name
                },

                setBackSide(e) {
                    const source       = e.target.files[0];
                    this.preview.back = source.name
                },

                dataURLtoFile(dataurl, filename) {
 
                    var arr = dataurl.split(','),
                        mime = arr[0].match(/:(.*?);/)[1],
                        bstr = atob(arr[1]), 
                        n = bstr.length, 
                        u8arr = new Uint8Array(n);
                        
                    while(n--){
                        u8arr[n] = bstr.charCodeAt(n);
                    }
                    
                    return new File([u8arr], filename, {type:mime});
                },

                snapshot() {
                    if (this.counter > 5) {
                        window.$wireui.notify({
                            title      : "{{ __('messages.t_error') }}",
                            description: "{{ __('messages.t_unable_to_take_more_selfies') }}",
                            icon       : 'error'
                        });
                        return;
                    }
                    const _this = this;
                    Webcam.snap( function(data_uri) {
                        const file = _this.dataURLtoFile(data_uri, 'selfie.jpg');

                        // Upload a file:
                        @this.upload('selfie', file)

                        document.getElementById('webcamjs-results').innerHTML = '<img src="'+data_uri+'"/>';
                    } );

                    this.counter += 1;
                }

            }
        }
        window.nYpPIEgUauhEVLt = nYpPIEgUauhEVLt()
    </script>

@endpush
    {{-- AlpineJs --}}
    <script>
        function TJPlQeqplTFcTQC() {
            return {

                isHeadlineEditing   : false,
                isAddSkill          : false,
                isAddLanguage       : false,
                isDescriptionEditing: false,

                // Edit headline
                toggleEditingHeadline() {
                    this.isHeadlineEditing = !this.isHeadlineEditing;

                    if (this.isHeadlineEditing) {
                        this.$nextTick(() => {
                            this.$refs.edit_headline.focus();
                        });
                    }
                },
                
                // Disable headline editing
                disableEditing() {
                    this.isHeadlineEditing = false;
                },

                // Avatar changed
                avatar(event) {
                    var output    = document.getElementById('profile-avatar-preview');
                    output.src    = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                    }
                },

                // Init
                initialize() {

                    // Headline updated
                    window.addEventListener('profile-headline-updated',() => {
                        this.disableEditing();
                    });

                    // Edit skill form
                    window.addEventListener('open-skills-edit-form',() => {
                        this.isAddSkill = true;
                    });

                    // Close edit skill form
                    window.addEventListener('close-edit-skill-form',() => {
                        this.isAddSkill = false;
                    });

                    // Edit language form
                    window.addEventListener('open-languages-edit-form',() => {
                        this.isAddLanguage = true;
                    });

                    // Close edit language form
                    window.addEventListener('close-edit-language-form',() => {
                        this.isAddLanguage = false;
                    });

                    // Close description edit form
                    window.addEventListener('close-description-edit-form',() => {
                        this.isDescriptionEditing = false;
                    });

                }

            }
        }
        window.TJPlQeqplTFcTQC = TJPlQeqplTFcTQC();
    </script>
@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('formSubmitted', function () {
            window.location.reload();
        });
    });
</script>
@endpush
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('.nav-link').on('click', function() {
      $('.nav-link').removeClass('active');
      $(this).addClass('active');
      
      // Get the ID of the corresponding tab-pane
      var targetPane = $(this).attr('href');
      
      // Hide all tab-panes
      $('.tab-pane').removeClass('show active');
      
      // Show the corresponding tab-pane
      $(targetPane).addClass('show active');
    });
  });
</script>
<script>
    $(document).ready(function() {
        // Disable clicking on tabs with the class 'hide'
        $('.nav-link.hide').click(function(e) {
            e.preventDefault(); // Prevent the default behavior of the link
        });
    });
</script>
