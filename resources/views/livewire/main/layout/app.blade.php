<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config()->get('direction') }}" @class(['dark' => current_theme() === 'dark'])>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Generate seo tags --}}
        {!! SEO::generate() !!}
        {!! JsonLd::generate() !!}

        {{-- Custom fonts --}}
		{!! settings('appearance')->font_link !!}

        {{-- Favicon --}}
        <link rel="icon" type="image/png" href="{{ src( settings('general')->favicon ) }}"/>

        {{-- Preload hero section image --}}
		@if (settings('hero')->enable_bg_img)

            {{-- Small background --}}
            @if (settings('hero')->background_small)
                <link rel="preload prefetch" as="image" href="{{ src(settings('hero')->background_small) }}" type="image/webp" />
            @endif

            {{-- Medium background --}}
            @if (settings('hero')->background_medium)
                <link rel="preload prefetch" as="image" href="{{ src(settings('hero')->background_medium) }}" type="image/webp" />
            @endif

            {{-- Large background --}}
            @if (settings('hero')->background_large)
                <link rel="preload prefetch" as="image" href="{{ src(settings('hero')->background_large) }}" type="image/webp" />
            @endif

        @endif

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        {{-- Livewire styles --}}
        @livewireStyles

        {{-- Styles --}}
        <link rel="preload" href="{{ mix('css/app.css') }}" as="style">
        
                {{-- New Theme --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        
        <link href="{{ asset('public/css/newtheme/styles.css') }}" type="text/css" rel="stylesheet">
        {{-- Preload Livewire --}}
        <link rel="preload" href="{{ livewire_asset_path() }}" as="script">

		{{-- Custom css --}}
        <style>
            :root {
                --color-primary  : {{ settings('appearance')->colors['primary'] }};
                --color-primary-h: {{ hex2hsl( settings('appearance')->colors['primary'] )[0] }};
                --color-primary-s: {{ hex2hsl( settings('appearance')->colors['primary'] )[1] }}%;
                --color-primary-l: {{ hex2hsl( settings('appearance')->colors['primary'] )[2] }}%;
            }
            html {
                font-family: @php echo settings('appearance')->font_family @endphp, sans-serif !important;
            }
            .home-hero-section {
                background-color: {{ settings('hero')->bg_color }};
                background-repeat: no-repeat;
                background-position: center center;
                background-size: cover;
                height: {{ settings('hero')->bg_large_height }}px;
            }
            
            {{-- Check if background image enabled --}}
            @if (settings('hero')->enable_bg_img)
                
                {{-- Background image for small devices --}}
                @if (settings('hero')->background_small)
                
                    @media only screen and (max-width: 600px) {
                        .home-hero-section {
                            background-image: url('{{ src(settings('hero')->background_small) }}');
                            height: {{ settings('hero')->bg_small_height }}px;
                        }
                    }

                @endif

                {{-- Background image for medium devices --}}
                @if (settings('hero')->background_medium)
                
                    @media only screen and (min-width: 600px) {
                        .home-hero-section {
                            background-image: url('{{ src(settings('hero')->background_medium) }}')
                        }
                    }

                @endif

                {{-- Background image for large devices --}}
                @if (settings('hero')->background_large)
                
                    @media only screen and (min-width: 768px) {
                        .home-hero-section {
                            background-image: url('{{ src(settings('hero')->background_large) }}');
                        }
                    }

                @endif

                {{-- Background image for large devices --}}
                @if (settings('hero')->background_large)
                
                    @media only screen and (min-width: 992px) {
                        .home-hero-section {
                            background-image: url('{{ src(settings('hero')->background_large) }}');
                        }
                    }

                @endif

                {{-- Background image for large devices --}}
                @if (settings('hero')->background_large)
                
                    @media only screen and (min-width: 1200px) {
                        .home-hero-section {
                            background-image: url('{{ src(settings('hero')->background_large) }}');
                        }
                    }

                @endif

            @endif
            
        </style>
        
        <?php /* ?>
        {{-- Vegas slideshow plugin --}}
		@if (request()->is('/'))
			<link rel="stylesheet" href="{{ url('node_modules/vegas/dist/vegas.min.css') }}">
		@endif
        <?php */ ?>
        
        {{-- Styles --}}
        @stack('styles')

        {{-- JavaScript variables --}}
        <script>
            __var_app_url        = "{{ url('/') }}";
            __var_app_locale     = "{{ app()->getLocale() }}";
            __var_rtl            = @js(config()->get('direction') === 'ltr' ? false : true);
            __var_primary_color  = "{{ settings('appearance')->colors['primary'] }}";
            __var_axios_base_url = "{{ url('/') }}/";
            __var_currency_code  = "{{ settings('currency')->code }}";
        </script>

        {{-- Ads header code --}}
        @if (advertisements('header_code'))
            {!! advertisements('header_code') !!}
        @endif

        {{-- Custom head code --}}
        @if (settings('appearance')->custom_code_head_main_layout)
            {!! settings('appearance')->custom_code_head_main_layout !!}
        @endif
        

    </head>

    <body class="antialiased bg-gray-50 dark:bg-[#161616] text-gray-600 min-h-full flex flex-col application application-ltr overflow-x-hidden overflow-y-scroll {{ app()->getLocale() === 'ar' ? 'application-ar' : '' }}" style="overflow-y: scroll">
        
        {{-- Notification --}}
        <x-notifications position="top-center" z-index="z-[65]" />

        {{-- Dialog --}}
        <x-dialog z-index="z-[65]" blur="sm" />

		{{-- Header --}}
        @livewire('main.includes.header')

        {{-- Hero section --}}
        @if (request()->is('/'))

            {{-- Hero section content --}}
<div class="max-w-screen-2xl dark:bg-zinc-800 d-flex flex-column justify-content-sm-center home justify-content-end px-sm-5 sm:px-sm-5 px-3 sm:px-1 md:px-2 lg:px-3" style="">
  
    <div id="carouselExampleCaptions" class="carousel slide vh-100" data-bs-ride="carousel">
        <div class="carousel-inner h-100">
            <div class="carousel-item h-100 active">
                {{--<img src="{{ asset('public/img/home/skill-cara-1optimized.jpg') }}" class="d-block w-100 h-100 img image-shift-left" alt="@lang('messages.t_slide1_headline')" style="image-orientation: ;">--}}
                <div class="background-image-container-1"></div>
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-start top-50 start-50 translate-middle">
                    <h1 class="text-start text-2xl lg:text-6xl sm:text-xl text-capitalize">@lang('messages.t_slide1_headline')</h1>
                    <div class="d-flex flex-sm-row flex-column align-items-sm-center justify-content-between w-100 mt-4">
                        <a href="https://skillmonde.com/start_selling" class="btn primary-btn text-white rounded-pill">@lang('messages.t_slide1_button_1')</a>
                        <a href="https://www.skillmonde.com/explore/projects" class="btn secondary-btn text-white rounded-pill mt-sm-0 mt-3">@lang('messages.t_slide1_button_2')</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item h-100">
                {{--<img src="{{ asset('public/img/home/skill-cara-2optimized.jpg') }}" class="d-block w-100 h-100 img" alt="@lang('messages.t_slide2_headline')">--}}
                <div class="background-image-container-2"></div>
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-start top-50 start-50 translate-middle">
                    <h1 class="text-start text-2xl lg:text-6xl sm:text-xl text-capitalize">@lang('messages.t_slide2_headline')</h1>
                    <div class="d-flex flex-sm-row flex-column align-items-sm-center justify-content-between w-100 mt-4">
                        <a href="https://skillmonde.com/sellers" class="btn primary-btn text-white rounded-pill">@lang('messages.t_slide2_button_1')</a>
                        <a href="https://skillmonde.com/post-project" class="btn secondary-btn text-white rounded-pill mt-sm-0 mt-3">@lang('messages.t_slide2_button_2')</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

</div>

        @endif

        {{-- Content --}}
        <main class="flex-grow"> 
            <div class="container max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-16 pb-24 space-y-8 min-h-screen">
                @yield('content')
            </div>
            <div>
                <a href="https://api.whatsapp.com/send?phone=919650023642&text=I%20am%20a%20new%20user%20and%20I%20am%20looking%20for%20some%20help" target="_blank" class="whatsapp-button">
                  <img src="{{ asset('public/img/assets/whatsapp-small.png') }}" alt="WhatsApp" />
                </a>

            </div>
        </main>

        {{-- Footer --}}
        @livewire('main.includes.footer')

        {{-- Livewire scripts --}}
        @livewireScripts

        {{-- Wire UI --}}
        <wireui:scripts />

        {{-- Core --}}
        <script defer src="{{ mix('js/app.js') }}"></script>

        {{-- Helpers --}}
        <script defer src="{{ url('public/js/utils.js?v=1.3.1') }}"></script>
        <script src="{{ url('public/js/components.js?v=1.3.1') }}"></script>
        
        {{-- New Theme --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        {{-- jQuery --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        {{-- Custom JS codes --}}
        <script defer>
            
            document.addEventListener("DOMContentLoaded", function(){

                jQuery.event.special.touchstart = {
                    setup: function( _, ns, handle ) {
                        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
                    }
                };
                jQuery.event.special.touchmove = {
                    setup: function( _, ns, handle ) {
                        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
                    }
                };
                jQuery.event.special.wheel = {
                    setup: function( _, ns, handle ){
                        this.addEventListener("wheel", handle, { passive: true });
                    }
                };
                jQuery.event.special.mousewheel = {
                    setup: function( _, ns, handle ){
                        this.addEventListener("mousewheel", handle, { passive: true });
                    }
                };

                // Refresh
                window.addEventListener('refresh',() => {
                    location.reload();
                });

                // Scroll to specific div
                window.addEventListener('scrollTo', (event) => {

                    // Get id to scroll
                    const id = event.detail;

                    // Scroll
                    $('html, body').animate({
                        scrollTop: $("#" + id).offset().top
                    }, 500);

                });

                // Scroll to up page
                window.addEventListener('scrollUp', () => {

                    // Scroll
                    $('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, 500);

                });

            });

            function jwUBiFxmwbrUwww() {
                return {

                    scroll: false,

                    init() {
                        var _this = this;
                        $(document).scroll(function () {
                            $(this).scrollTop() > 70 ? _this.scroll = true : _this.scroll = false;
                        });

                    }

                }
            }
            window.jwUBiFxmwbrUwww = jwUBiFxmwbrUwww();

            document.ontouchmove = function(event){
                event.preventDefault();
            }
            
        </script>

        {{-- Custom scripts --}}
        @stack('scripts')

        {{-- Custom footer code --}}
        @if (settings('appearance')->custom_code_footer_main_layout)
            {!! settings('appearance')->custom_code_footer_main_layout !!}
        @endif


@if (request()->is('/'))

<script>
$(document).ready(function() {
  var carousel = $('#carouselExampleCaptions');
  carousel.carousel({
    interval: 3000
  });
});
</script>

<script defer src="{{ url('public/js/newtheme/home.js') }}"></script>
@endif
        {{-- Custom scripts --}}
        @stack('scripts')

<script>
function smoothScroll(target) {
  var targetElement = document.querySelector(target);
  var targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
  var startPosition = window.pageYOffset;
  var distance = targetPosition - startPosition;
  var duration = 800;
  var start = null;

  function animate(currentTime) {
    if (start === null) start = currentTime;
    var timeElapsed = currentTime - start;
    var scrollPosition = ease(timeElapsed, startPosition, distance, duration);
    window.scrollTo(0, scrollPosition);
    if (timeElapsed < duration) requestAnimationFrame(animate);
  }

  function ease(t, b, c, d) {
    t /= d / 2;
    if (t < 1) return c / 2 * t * t + b;
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
  }

  requestAnimationFrame(animate);
}
</script>

    </body>

</html>