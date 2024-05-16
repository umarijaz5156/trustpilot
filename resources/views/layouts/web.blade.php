<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $settings = App\Models\Setting::get();
        $siteTitle = $settings->where('key', 'site_title')->whereNotNull('value')->first()?->value;
        $favicon = $settings->where('key', 'app_favicon')->whereNotNull('value')->first()?->value;

        $currentUrlSegments = request()->segments();
        $currentUrl = implode('/', $currentUrlSegments);
        $currentUrl = end($currentUrlSegments);
        $currentUrl = ucfirst($currentUrl);

      

        // Append the current URL to the site title
        $pageTitle = $siteTitle ?? config('app.name');
        if($currentUrl){
            $pageTitle .= ' - ' . $currentUrl;

        }
    @endphp

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{!! $pageTitle ?? config('app.name') !!}</title>
    <link rel="shortcut icon" href="{{ asset($favicon ? 'storage/' . $favicon : 'images/LOGO.png') }}" type="image/x-icon" />

    @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/css/output.css', 'resources/js/app.js', 'resources/js/custom.js'])

    <!-- CSS -->

    <!-- /* Font Awsome Cdn */ -->
    <link href="https://cdn.jsdelivr.net/gh/duyplus/fontawesome-pro/css/all.min.css" rel="stylesheet" type="text/css" />
    <!-- Swipper Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- UIkit CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" /> --}}


    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet"
        media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>



    <!-- Scripts -->
    <!-- jQuery -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        crossorigin="anonymous" />

    {{-- CKEditor --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <!-- Styles -->
    @livewireStyles
    @stack('styles')
</head>

<style>
    /* Custom scrollbar style */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .description_section p {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -webkit-line-clamp: 2;
        font-weight: 300;
        /* Light font weight */
        font-size: 0.75rem;
        color: white;
    }
</style>

<body class="relative" x-data="{ scrolled: false }" x-init="() => {
    window.addEventListener('scroll', () => {
        scrolled = window.scrollY > 50;
    });
}">



    @include('includes.nav')

    {{ $slot }}

    @include('includes.footer')

</body>



@stack('modals')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<!-- UIkit JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script> --}}



<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Fancybox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>



@livewireScriptConfig

@stack('scripts')



<script>
    $(document).ready(function() {
        $('[data-fancybox]').fancybox({
            // Options will go here
            buttons: [
                'close'
            ],
            wheel: false,
            transitionEffect: "slide",
            loop: true,
            toolbar: false,
            clickContent: false
        });
    });
</script>

</html>
