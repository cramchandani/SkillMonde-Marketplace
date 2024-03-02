<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config()->get('direction') }}" @class(['dark' => current_theme() === 'dark'])>
<head>

	{{-- Meta tags --}}
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="id" content="{{ $id }}">
	<meta name="uid" content="{{ $uid }}">
	<meta name="type" content="{{ $type }}">
	<meta name="messenger-color" content="{{ $messengerColor }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="authenticated-user" data-user-uid="{{ auth()->user()->uid }}" />
	<meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ auth()->id() }}">
	<meta name="time-locale" content="{{ config()->get('frontend_timing_locale') }}" />
	<meta name="time-timezone" content="{{ config('app.timezone') }}" />

	{{-- Generate seo tags --}}
	{!! SEO::generate() !!}

	{{-- Custom fonts --}}
	{!! settings('appearance')->font_link !!}

	{{-- Favicon --}}
	<link rel="icon" type="image/png" href="{{ src( settings('general')->favicon ) }}"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
	{{-- Styles --}}
	<link rel="stylesheet" href="{{ mix('css/app.css') }}" />
	<link rel="stylesheet" href="{{ url('public/js/plugins/emojipanel/dist/emojipanel.css') }}" />
	<link rel="stylesheet" href="{{ url('public/js/plugins/file-icon-vectors/file-icon-vectors.min.css') }}" />
	<link rel='stylesheet' href="{{ url('public/js/plugins/nprogress/nprogress.css') }}" />
	<link rel="stylesheet" href="{{ url('public/css/chatify/style.css') }}" />
	<link rel="stylesheet" href="{{ url('public/css/chatify/'.$dark_mode.'.mode.css') }}" />
	
	<script src="https://meet.jit.si/external_api.js"></script>
	

	{{-- Messenger Color Style--}}
	@include('Chatify::layouts.messengerColor')

	{{-- Custom css --}}
	<style>
		:root {
			--color-primary-h: {{ hex2hsl( settings('appearance')->colors['primary'] )[0] }};
			--color-primary-s: {{ hex2hsl( settings('appearance')->colors['primary'] )[1] }}%;
			--color-primary-l: {{ hex2hsl( settings('appearance')->colors['primary'] )[2] }}%;
		}
		html {
			font-family: @php echo settings('appearance')->font_family @endphp, sans-serif !important;
		}
		img.twemoji, img.emoji {
			height: 1.5em;
			width: 1.5em;
			margin: 5px;
			display: inline-block;
		}
		
	.modal.modal-fullscreen .modal-dialog,
    .modal.modal-fullscreen .modal-content {
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
    }
    .modal.modal-fullscreen .modal-dialog {
      margin: 0;
      width: 100%;
      animation-duration:0.6s;
    }
    .modal.modal-fullscreen .modal-content {
      border: none;
      -moz-border-radius: 0;
      border-radius: 0;
      -webkit-box-shadow: inherit;
      -moz-box-shadow: inherit;
      -o-box-shadow: inherit;
      box-shadow: inherit;
    }
    .modal.modal-fullscreen.force-fullscreen .modal-body {
      padding: 0;
    }
    .modal.modal-fullscreen.force-fullscreen .modal-header,
    .modal.modal-fullscreen.force-fullscreen .modal-footer {
      left: 0;
      position: absolute;
      right: 0;
    }
    .modal.modal-fullscreen.force-fullscreen .modal-header {
      top: 0;
    }
    .modal.modal-fullscreen.force-fullscreen .modal-footer {
      bottom: 0;
    }	
	</style>

	{{-- JavaScript variables --}}
	<script>
		__var_app_url        = "{{ url('/') }}";
		__var_app_locale     = "{{ app()->getLocale() }}";
		__var_rtl            = @js(config()->get('direction') === 'ltr' ? false : true);
		__var_primary_color  = "{{ settings('appearance')->colors['primary'] }}";
		__var_axios_base_url = "{{ url('/') }}/";
		__var_currency_code  = "{{ settings('currency')->code }}";
	</script>

	{{-- Scripts --}}
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{ url('public/js/chatify/autosize.js') }}"></script>
	<script defer src="{{ url('public/js/app.js') }}"></script>
	<script src="{{ url('node_modules/@webcomponents/webcomponentsjs/webcomponents-bundle.js') }}"></script>
	<script src="{{ url('public/js/plugins/twemoji/twemoji.min.js') }}"></script>
	<script src="{{ url('public/js/plugins/nprogress/nprogress.js') }}"></script>
	<script src="{{ url('public/js/plugins/emoji-mart/dist/browser.js') }}"></script>
	<script src="{{ url('public/js/plugins/momentjs/moment-with-locales.js') }}"></script>
	<script src="{{ url('public/js/plugins/momentjs/moment-timezone.min.js') }}"></script>
	<script src="{{ url('public/js/plugins/momentjs/moment-timezone-with-data-1970-2030.min.js') }}"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  

</head>