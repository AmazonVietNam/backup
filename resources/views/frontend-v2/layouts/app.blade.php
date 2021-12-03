<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
<head>
    <!-- Title -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">
	<meta property="fb:pages" content="266621780158777" />
	<meta property="fb:pages" content="311916006152639" />
    <title>@yield('title', get_setting('website_name').' | '.get_setting('site_motto'))</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">

    @yield('meta')

    @if(isset($detailedProduct))
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description" content="@yield('meta_description', get_setting('meta_description') )">
    <meta itemprop="image" content="@yield('meta_image', uploaded_asset(get_setting('meta_image')) )">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    {{-- <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}"> --}}
    <meta name="twitter:description" content="@yield('meta_description', get_setting('meta_description') )">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="@yield('meta_image', uploaded_asset(get_setting('meta_image')) )">

    <!-- Open Graph data -->
    <meta property="og:title" content="@yield('title', get_setting('website_name').' | '.get_setting('site_motto'))" />
    <meta property="og:type" content="website" />
    {{-- <meta property="og:url" content="{{ route('home') }}" /> --}}
    <meta property="og:image" content="@yield('meta_image', uploaded_asset(get_setting('meta_image')) )" />
    <meta property="og:image:alt" content="@yield('title', get_setting('website_name') )" />
    <meta property="og:description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
    @endif

    @if(!isset($detailedProduct) && !isset($shop) && !isset($page))
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description" content="{{ get_setting('meta_description') }}">
    <meta itemprop="image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="{{ get_setting('meta_description') }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset(get_setting('meta_image')) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ uploaded_asset(get_setting('meta_image')) }}" />
    <meta property="og:description" content="{{ get_setting('meta_description') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
    @endif
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
        rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ static_asset('clever/vendor/font-awesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('clever/css/font-electro.css') }}">

    <link rel="stylesheet" href="{{ static_asset('clever/vendor/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('clever/vendor/hs-megamenu/src/hs.megamenu.css') }}">
    <link rel="stylesheet"
        href="{{ static_asset('clever/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ static_asset('clever/vendor/fancybox/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ static_asset('clever/vendor/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ static_asset('clever/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="{{ static_asset('clever/css/theme.css') }}">
    @if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>

        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ env('TRACKING_ID') }}');
        </script>
    @endif

    @if (\App\BusinessSetting::where('type', 'facebook_pixel')->first()->value == 1)
        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ env('FACEBOOK_PIXEL_ID') }}');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}/&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
    @endif

    @yield('css')
</head>

<body>
    @include('frontend-v2.inc.nav')

    <div class="container my-4">
        @include('frontend-v2.inc.message')
    </div>
    @yield('content')

    @include('frontend-v2.inc.footer')

    @yield('modal')

    <!-- Go to Top -->
    <a class="js-go-to u-go-to" href="#" data-position='{"bottom": 15, "right": 15 }' data-type="fixed"
        data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp" data-hide-effect="slideOutDown">
        <span class="fas fa-arrow-up u-go-to__inner"></span>
    </a>
    <!-- End Go to Top -->

    <!-- JS Global Compulsory -->
    <script src="{{ static_asset('clever/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/bootstrap/bootstrap.min.js') }}"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{ static_asset('clever/vendor/appear.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/hs-megamenu/src/hs.megamenu.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/svg-injector/dist/svg-injector.min.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/slick-carousel/slick/slick.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ static_asset('clever/vendor/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

    <!-- JS Electro -->
    <script src="{{ static_asset('clever/js/hs.core.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.countdown.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.header.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.hamburgers.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.unfold.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.focus-state.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.malihu-scrollbar.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.validation.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.fancybox.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.onscroll-animation.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.slick-carousel.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.show-animation.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.svg-injector.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.go-to.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.selectpicker.js') }}"></script>
    <script src="{{ static_asset('clever/js/components/hs.range-slider.js') }}"></script>

    <!-- JS Plugins Init. -->

    <script>
        $(window).on('load', function() {
            // initialization of HSMegaMenu component
            $('.js-mega-menu').HSMegaMenu({
                event: 'hover',
                direction: 'horizontal',
                pageContainer: $('.container'),
                breakpoint: 767.98,
                hideTimeOut: 0
            });

            $.HSCore.components.HSSVGIngector.init('.js-svg-injector');

            // $('.toast').toast({
            //     delay: 5000
            // })
            // $('.toast').toast('show')
        });

        $(document).on('click', '.stop-propagation', function(e) {
            e.stopPropagation();
        });

        $(document).on('click', function (e) {
            $('.document-click-d-none').addClass('d-none');
        });

        $(document).on('ready', function() {

            if ($('#languageDropdown').length > 0) {
                $('#languageDropdown a').each(function() {
                    $(this).on('click', function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        console.log($this);
                        var locale = $this.data('flag');
                        $.post('{{ route('language.change') }}', {
                            _token: '{{ csrf_token() }}',
                            locale: locale
                        }, function(data) {
                            location.reload();
                        });

                    });
                });
            }

            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of animation
            $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                afterOpen: function() {
                    $(this).find('input[type="search"]').focus();
                }
            });

            // initialization of popups
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of countdowns
            var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                yearsElSelector: '.js-cd-years',
                monthsElSelector: '.js-cd-months',
                daysElSelector: '.js-cd-days',
                hoursElSelector: '.js-cd-hours',
                minutesElSelector: '.js-cd-minutes',
                secondsElSelector: '.js-cd-seconds'
            });

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of forms
            $.HSCore.components.HSFocusState.init();

            // initialization of form validation
            $.HSCore.components.HSValidation.init('.js-validate', {
                rules: {
                    confirmPassword: {
                        equalTo: '#signupPassword'
                    }
                }
            });

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // initialization of fancybox
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

            // initialization of go to
            $.HSCore.components.HSGoTo.init('.js-go-to');

            // initialization of hamburgers
            $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

            $.HSCore.components.HSRangeSlider.init('.js-range-slider');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                beforeClose: function() {
                    $('#hamburgerTrigger').removeClass('is-active');
                },
                afterClose: function() {
                    $('#headerSidebarList .collapse.show').collapse('hide');
                }
            });

            $('#headerSidebarList [data-toggle="collapse"]').on('click', function(e) {
                e.preventDefault();

                var target = $(this).data('target');

                if ($(this).attr('aria-expanded') === "true") {
                    $(target).collapse('hide');
                } else {
                    $(target).collapse('show');
                }
            });

            $('#searchproduct-item').on('keyup', function(){
                search();
            });

            $('#searchproduct-item').on('focus', function(){
                search();
            });

            function search(){
                var searchKey = $('#searchproduct-item').val();
                if(searchKey.length > 0){
                    var _tokenD = $('meta[name="csrf-token"]').attr("content");
                    $('body').addClass("typed-search-box-shown");

                    $('.typed-search-box').removeClass('d-none');
                    $('.search-preloader').removeClass('d-none');
                    $.post('{{ route('search.ajax') }}', { _token: _tokenD, search:searchKey}, function(data){
                        if(data == '0'){
                            // $('.typed-search-box').addClass('d-none');
                            $('#search-content').html(null);
                            $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+searchKey+'"</strong>');
                            $('.search-preloader').addClass('d-none');

                        }
                        else{
                            $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                            $('#search-content').html(data);
                            $('.search-preloader').addClass('d-none');
                        }
                    });
                }
                else {
                    $('.typed-search-box').addClass('d-none');
                    $('body').removeClass("typed-search-box-shown");
                }
            }

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of select picker
            $.HSCore.components.HSSelectPicker.init('.js-select');
        });

        function addToWishList(id){
            let _token = $('meta[name="_token"]').attr('content')
            @if (Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller'))
                $.post('{{ route('wishlists.store') }}', {_token: _token, id:id}, function(data){

                });
            @else
                console.log('check')
            @endif
        }
    </script>
    <script>
        function inputFocus(i) {
            if (i.value == i.defaultValue) { i.value = ""; i.style.color = "#000"; }
        }
        function inputBlur(i) {
            if (i.value == "") { i.value = i.defaultValue; i.style.color = "#888"; }
        }
    </script>
    @yield('extended_scripts')
    @yield('script')
    {{-- @include('frontend-v2.inc.message') --}}
</body>

</html>
