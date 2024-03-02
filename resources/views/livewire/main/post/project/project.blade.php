@extends('livewire.main.layout.app')

@section('content')
	<div class="w-full block">
		<div id="app">

			@php
				
				// Set translations
				$translations = [
					't_post_new_project'                  => __('messages.t_post_new_project'),
					't_post_new_project_subtitle'         => __('messages.t_post_new_project_subtitle'),
					't_project_title'                     => __('messages.t_project_title'),
					't_project_description'               => __('messages.t_project_description'),
					't_post_project_description_hint'     => __('messages.t_post_project_description_hint'),
					't_choose_category'                   => __('messages.t_choose_category'),
					't_post_project_category_hint'        => __('messages.t_post_project_category_hint'),
					't_post_project_skills_hint'          => __('messages.t_post_project_skills_hint'),
					't_what_skills_are_required'          => __('messages.t_what_skills_are_required'),
					't_how_do_u_want_to_pay'              => __('messages.t_how_do_u_want_to_pay'),
					't_price_placeholder_0_00'            => __('messages.t_price_placeholder_0_00'),
					't_min'                               => __('messages.t_min'),
					't_max'                               => __('messages.t_max'),
					't_budget'                            => __('messages.t_budget'),
					't_fixed_price'                       => __('messages.t_fixed_price'),
					't_hourly_price'                      => __('messages.t_hourly_price'),
					't_days'                              => strtolower(__('messages.t_days')),
					't_selected'                          => __('messages.t_selected'),
					't_select'                            => __('messages.t_select'),
					't_save_and_continue'                 => __('messages.t_save_and_continue'),
					't_no_results_found'                  => __('messages.t_no_results_found'),
					't_max_5_skills_allowed'              => __('messages.t_max_5_skills_allowed'),
					't_validator_required'                => __('messages.t_validator_required'),
					't_validator_required_title'          => __('messages.t_validator_max', ['max' => 100]),
					't_toast_something_went_wrong'        => __('messages.t_toast_something_went_wrong'),
					't_toast_select_at_least_5_skills'    => __('messages.t_toast_select_at_least_5_skills'),
					't_back'                              => __('messages.t_back'),
					't_invalid_price_format'              => __('messages.t_invalid_price_format'),
					't_promotion'                         => __('messages.t_promotion'),
					't_make_ur_project_premium'           => $settings->is_free ? __('messages.t_make_ur_project_premium_optional') : __('messages.t_make_ur_project_premium'),
					't_home'                              => __('messages.t_home'),
					't_my_projects'                       => __('messages.t_my_projects'),
					't_post_new_project'                  => __('messages.t_post_new_project'),
					't_addon_total'                       => __('messages.t_addon_total'),
					't_post_project'                      => __('messages.t_post_project'),
					't_toast_select_plan_to_post_project' => __('messages.t_toast_select_plan_to_post_project'),
					't_max_project_price_must_be_greater' => __('messages.t_max_project_price_must_be_greater'),
					't_toast_operation_success'           => __('messages.t_toast_operation_success'),
					't_recaptcha_error_message'           => __('messages.t_recaptcha_error_message'),
					't_per_word'                 => __('messages.t_per_word'),
                    't_per_minute'               => __('messages.t_per_minute'),
                    't_per_unit'                 => __('messages.t_per_unit'),
                    't_per_question'             => __('messages.t_per_question'),
                    't_per_art_image'            => __('messages.t_per_art_image'),
                    't_per_second'               => __('messages.t_per_second'),
                    't_per_book'                 => __('messages.t_per_book'),
                    't_per_cover'                => __('messages.t_per_cover'),
                    't_per_course'               => __('messages.t_per_course'),
                    't_per_video'                => __('messages.t_per_video'),
                    't_per_animation'            => __('messages.t_per_animation'),
                    't_per_chapter'              => __('messages.t_per_chapter'),
                    't_per_page'               => __('messages.t_per_page'),
                    't_per_others'             => __('messages.t_per_others'),
                    "t_per_minute_price"       => __('messages.t_per_minute_price'),
                   "t_per_second_price"        => __('messages.t_per_second_price'),
                   "t_per_word_price"          => __('messages.t_per_word_price'),
                   "t_per_unit_price"          => __('messages.t_per_unit_price'),
                   "t_per_chapter_price"       => __('messages.t_per_chapter_price'),
                   "t_per_book_price"          => __('messages.t_per_book_price'),
                   "t_per_cover_price"         => __('messages.t_per_cover_price'),
                   "t_per_question_price"       => __('messages.t_per_question_price'),
                   "t_per_course_price"         => __('messages.t_per_course_price'),
                   "t_per_art_image_price"      => __('messages.t_per_art_image_price'),
                   "t_per_video_price"          => __('messages.t_per_video_price'),
                   "t_per_animation_price"      => __('messages.t_per_animation_price'),
                   "t_per_page_price"           => __('messages.t_per_page_price'),
                   "t_per_others_price"         => __('messages.t_per_others_price'),
                   "t_final_min_price"          => __('messages.t_final_min_price'),
                   "t_final_max_price"          => __('messages.t_final_max_price'),
                   "t_enter_the_post_number"    => __('messages.t_enter_the_post_number'),
					
				]

			@endphp
			
			<post-project 
				categories="{{ json_encode($categories) }}"
				translations="{{ json_encode($translations) }}"
				plans="{{ json_encode($plans) }}"
				_settings="{{ $settings }}"
				currency_symbol="{{ $currency_symbol }}"
				is_recaptcha="{{ settings('security')->is_recaptcha }}"
				recaptcha_site_key="{{ config('recaptcha.site_key') }}" />
		</div>
	</div>
@endsection

@push('styles')

	{{-- Select2.css --}}
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush