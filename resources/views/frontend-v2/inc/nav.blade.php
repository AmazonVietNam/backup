<!-- ========== HEADER ========== -->
<header id="header" class="u-header u-header-left-aligned-nav">
    <div class="u-header__section">
        <!-- Topbar -->
        <div class="u-header-topbar py-2 d-none d-xl-block">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="topbar-left">
                        <a href="https://amazonvietnam.com.vn"
                            class="text-gray-110 font-size-13 hover-on-dark">AMAZONVIETNAM.COM.VN</a>
                    </div>
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">
                            <li
                                class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{ route('contact-us') }}" class="u-header-topbar__nav-link"><i
                                        class="ec ec-support mr-1"></i> {{ translate('Support') }}</a>
                            </li>
                            <li
                                class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="{{ route('orders.track') }}" class="u-header-topbar__nav-link"><i
                                        class="ec ec-transport mr-1"></i> {{ translate('Track Order') }}</a>
                            </li>
                            @if (get_setting('show_language_switcher') == 'on')
                                <li
                                    class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border u-header-topbar__nav-item-no-border u-header-topbar__nav-item-border-single">
                                    <div class="d-flex align-items-center">
                                        <!-- Language -->
                                        <div class="position-relative">
                                            @php
                                                if (Session::has('locale')) {
                                                    $locale = Session::get('locale', Config::get('app.locale'));
                                                } else {
                                                    $locale = 'en';
                                                }
                                            @endphp
                                            <a id="languageDropdownInvoker"
                                                class="dropdown-nav-link dropdown-toggle d-flex align-items-center u-header-topbar__nav-link font-weight-normal"
                                                href="javascript:;" role="button" aria-controls="languageDropdown"
                                                aria-haspopup="true" aria-expanded="false" data-unfold-event="hover"
                                                data-unfold-target="#languageDropdown" data-unfold-type="css-animation"
                                                data-unfold-duration="300" data-unfold-delay="300"
                                                data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                                                data-unfold-animation-out="fadeOut">
                                                {{-- <span class="d-inline-block d-sm-none">US</span> --}}
                                                <span class="d-none d-sm-inline-flex align-items-center"><img
                                                        class="mr-2" style="height: 11px;"
                                                        src="{{ static_asset('assets/img/flags/' . $locale . '.png') }}"
                                                        alt="{{ \App\Language::where('code', $locale)->first()->name }}">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                                            </a>

                                            <div id="languageDropdown" class="dropdown-menu dropdown-unfold"
                                                aria-labelledby="languageDropdownInvoker">
                                                @foreach (\App\Language::all() as $key => $language)
                                                    <a class="dropdown-item @if ($locale==$language) active @endif"
                                                        data-flag="{{ $language->code }}" href="javascript:;"><img
                                                            class="mr-2" style="height: 11px;"
                                                            src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                                            alt="{{ $language->name }}">{{ $language->name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- End Language -->
                                    </div>
                                </li>
                            @endif

                            @guest
                                <li
                                    class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                    <!-- Account Sidebar Toggle Button -->
                                    {{-- <a id="sidebarNavToggler" href="javascript:;" role="button"
                                        class="u-header-topbar__nav-link" aria-controls="sidebarContent"
                                        aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                        data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent"
                                        data-unfold-type="css-animation" data-unfold-animation-in="fadeInRight"
                                        data-unfold-animation-out="fadeOutRight" data-unfold-duration="500">
                                        <i class="ec ec-user mr-1"></i> {{ translate('Registration') }} <span
                                            class="text-gray-50">{{ translate('/') }}</span> {{ translate('Login') }}
                                    </a> --}}

                                    <i class="ec ec-user mr-1"></i> <a href="{{route('user.registration')}}">{{ translate('Registration') }}</a> <span
                                            class="text-gray-50">{{ translate('/') }}</span> <a href="{{route('user.login')}}">{{ translate('Login') }}</a>
                                    <!-- End Account Sidebar Toggle Button -->
                                </li>
                            @else
                                @if (isAdmin())
                                    <li
                                        class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="u-header-topbar__nav-link">{{ translate('My Panel') }}</a>
                                    </li>
                                @else
                                    <li
                                        class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                        <a href="{{ route('dashboard') }}"
                                            class="u-header-topbar__nav-link">{{ translate('My Panel') }}</a>
                                    </li>
                                @endif
                                <li
                                    class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                    <a href="{{ route('logout') }}"
                                        class="u-header-topbar__nav-link">{{ translate('Logout') }}</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Logo-Search-header-icons -->
        <div class="py-2 py-xl-1 bg-primary">
            <div class="container my-0dot5 my-xl-0">
                <div class="row align-items-center">
                    <!-- Logo-offcanvas-menu -->
                    <div class="col-auto">
                        <!-- Nav -->
                        <nav
                            class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                            <!-- Logo -->
                            <a class="order-1 order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center"
                                href="{{ route('home') }}" aria-label="{{ env('APP_NAME') }}">
                                @php
                                    $header_logo = get_setting('header_logo');
                                @endphp
                                @if ($header_logo != null)
                                    <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"
                                        class="img-fluid py-2" height="40">
                                @else
                                    <img src="{{ static_asset('assets/img/logo.png') }}"
                                        alt="{{ env('APP_NAME') }}" class="img-fluid py-2" height="40">
                                @endif
                            </a>
                            <!-- End Logo -->

                            <!-- Fullscreen Toggle Button -->
                            <button id="sidebarHeaderInvokerMenu" type="button"
                                class="navbar-toggler d-block btn u-hamburger--white mr-3 mr-xl-0"
                                aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false"
                                data-unfold-event="click" data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                                data-unfold-duration="500">
                                <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                    <span class="u-hamburger__inner"></span>
                                </span>
                            </button>
                            <!-- End Fullscreen Toggle Button -->
                        </nav>
                        <!-- End Nav -->

                        <!-- ========== HEADER SIDEBAR ========== -->
                        <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left"
                            aria-labelledby="sidebarHeaderInvoker">
                            <div class="u-sidebar__scroller">
                                <div class="u-sidebar__container">
                                    <div class="u-header-sidebar__footer-offset">
                                        <!-- Toggle Button -->
                                        <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-4 bg-white">
                                            <button type="button" class="close ml-auto" aria-controls="sidebarHeader"
                                                aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                                data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarHeader1"
                                                data-unfold-type="css-animation" data-unfold-animation-in="fadeInLeft"
                                                data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
                                                <span aria-hidden="true"><i
                                                        class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                            </button>
                                        </div>
                                        <!-- End Toggle Button -->

                                        <!-- Content -->
                                        <div class="js-scrollbar u-sidebar__body">
                                            <div id="headerSidebarContent"
                                                class="u-sidebar__content u-header-sidebar__content">
                                                <!-- Logo -->
                                                <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center mb-3"
                                                    href="{{ route('home') }}" aria-label="{{ env('APP_NAME') }}">
                                                    @if ($header_logo != null)
                                                        <img src="{{ uploaded_asset($header_logo) }}"
                                                            alt="{{ env('APP_NAME') }}" class="img-fluid py-2"
                                                            height="20">
                                                    @else
                                                        <img src="{{ static_asset('assets/img/logo.png') }}"
                                                            alt="{{ env('APP_NAME') }}" class="img-fluid py-2"
                                                            height="20">
                                                    @endif
                                                </a>
                                                <!-- End Logo -->

                                                <!-- List -->
                                                <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                    @foreach (\App\Category::where('level', 0)->get() as $category)
                                                        <li class="u-has-submenu u-header-collapse__submenu">
                                                            <a class="u-header-collapse__nav-link u-header-collapse__nav-pointer"
                                                                aria-controls="category_{{ $category->id }}"
                                                                data-target="#category_{{ $category->id }}" role="button"
                                                                data-toggle="collapse" aria-expanded="false"
                                                                style="cursor: pointer;">
                                                                {{ $category->getTranslation('name') }}
                                                            </a>

                                                            <div id="category_{{ $category->id }}" class="collapse"
                                                                data-parent="#headerSidebarContent">
                                                                <ul id="category-{{$category->id}}" class="u-header-collapse__nav-list">
                                                                    <li><span
                                                                            class="u-header-sidebar__sub-menu-title">{{ $category->getTranslation('name') }}</span>
                                                                    </li>
                                                                    @if (count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id)) > 0)
                                                                        @foreach ($category->childrenCategories as $children)
                                                                            <li class="">
                                                                                <a class="u-header-collapse__submenu-nav-link"
                                                                                    href="{{ route('products.category', $children->slug) }}">{{ $children->getTranslation('name') }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                    <!-- End Computers & Accessories -->


                                                </ul>
                                                <!-- End List -->
                                            </div>
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                    <!-- Footer -->
                                    <footer id="SVGwaveWithDots" class="svg-preloader u-header-sidebar__footer">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item pr-3">
                                                <a class="u-header-sidebar__footer-link text-gray-90"
                                                    href="#">Privacy</a>
                                            </li>
                                            <li class="list-inline-item pr-3">
                                                <a class="u-header-sidebar__footer-link text-gray-90" href="#">Terms</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="u-header-sidebar__footer-link text-gray-90" href="#">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- SVG Background Shape -->
                                        <div class="position-absolute right-0 bottom-0 left-0 z-index-n1">
                                            <img class="js-svg-injector"
                                                src="https://transvelo.github.io/electro-html/2.0/assets/svg/components/wave-bottom-with-dots.svg"
                                                alt="Image Description" data-parent="#SVGwaveWithDots">
                                        </div>
                                        <!-- End SVG Background Shape -->
                                    </footer>
                                    <!-- End Footer -->
                                </div>
                            </div>
                        </aside>
                        <!-- ========== END HEADER SIDEBAR ========== -->
                    </div>
                    <!-- End Logo-offcanvas-menu -->
                    <!-- Search Bar -->
                    <div class="col d-none d-xl-block">
                        <form class="" action="{{ route('search') }}">
                            <label class="sr-only" for="searchproduct">Search</label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control py-2 pl-5 font-size-15 border-right-0 height-40 border-width-2 rounded-left-pill border-warning"
                                    name="q" id="searchproduct-item"
                                    placeholder="{{ translate('I am shopping for...') }}"
                                    aria-label="{{ translate('I am shopping for...') }}"
                                    aria-describedby="searchProduct1" required onfocus="inputFocus(this)" onblur="inputBlur(this)" autocomplete="off">
                                <div class="input-group-append">
                                    <!-- Select -->
                                    <select
                                        class="js-select selectpicker dropdown-select custom-search-categories-select"
                                        data-style="btn btn-white height-40 text-gray-60 font-weight-normal border-top border-bottom border-left-0 rounded-0 border-warning border-width-2 pl-0 pr-5 py-2">
                                        <option value="all" selected>Tất cả</option>
                                        @foreach (\App\Category::where('level', 0)->orderBy('name', 'asc')->get() as $category)
                                            <option value="{{ $category->getTranslation('id') }}">
                                                {{ $category->getTranslation('name') }}</option>
                                        @endforeach
                                    </select>
                                    <!-- End Select -->
                                    <button class="btn btn-warning height-40 py-2 px-3 rounded-right-pill" type="submit"
                                        id="searchProduct1">
                                        <span class="ec ec-search font-size-24"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px; z-index: 999;">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader"><div></div><div></div><div></div></div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">

                            </div>
                            <div id="search-content" class="text-left">

                            </div>
                        </div>
                    </div>
                    <!-- End Search Bar -->
                    <!-- Header Icons -->
                    <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">
                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static">
                                    <a id="searchClassicInvoker"
                                        class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary"
                                        href="javascript:;" role="button" data-toggle="tooltip" data-placement="top"
                                        title="Search" aria-controls="searchClassic" aria-haspopup="true"
                                        aria-expanded="false" data-unfold-target="#searchClassic"
                                        data-unfold-type="css-animation" data-unfold-duration="300"
                                        data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                        <span class="ec ec-search text-white"></span>
                                    </a>

                                    <!-- Input -->
                                    <div id="searchClassic"
                                        class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2"
                                        aria-labelledby="searchClassicInvoker">
                                        <form class="js-focus-state input-group px-3">
                                            <input class="form-control" type="search" placeholder="Search Product">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary px-3" type="button"><i
                                                        class="font-size-18 ec ec-search text-white"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Input -->
                                </li>
                                <!-- End Search -->
                                <li class="col d-none d-xl-block"><a href="{{ route('compare') }}"
                                        class="text-gray-90" data-toggle="tooltip" data-placement="top"
                                        title="{{ translate('Compare') }}"><i
                                            class="font-size-22 ec ec-compare text-white"></i>

                                        @auth
                                        <span style="left: 1.6rem;"
                                            class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">
                                            @if (Session::has('compare'))
                                                {{ count(Session::get('compare')) }}
                                            @else
                                                0
                                            @endif
                                        </span>
                                        @endauth
                                    </a>
                                </li>
                                <li class="col d-none d-xl-block"><a href="{{ route('wishlists.index') }}"
                                        class="text-gray-90" data-toggle="tooltip" data-placement="top"
                                        title="{{ translate('Wishlist') }}"><i
                                            class="font-size-22 ec ec-favorites text-white"></i>
                                        
                                        @auth
                                        <span style="left: 1.6rem;"
                                            class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle top-8 font-weight-bold font-size-12 text-white">
                                            {{ Auth::user()->wishlists->count()}}
                                        </span>
                                        @endauth
                                    </a>
                                </li>
                                <li class="col d-xl-none px-2 px-sm-3"><a href="{{ route('dashboard') }}"
                                        class="text-gray-90" data-toggle="tooltip" data-placement="top"
                                        title="My Account"><i class="font-size-22 ec ec-user text-white"></i></a></li>
                                <li class="col pr-xl-0 px-2 px-sm-3 d-xl-none">
                                    <a href="{{ route('cart') }}" class="text-gray-90 position-relative d-flex "
                                        data-toggle="tooltip" data-placement="top" title="{{ translate('Cart') }}">
                                        <i class="font-size-22 ec ec-shopping-bag text-white"></i>

                                        <span 
                                            class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">
                                            @if (Session::has('cart'))
                                                {{ count(Session::get('cart')) }}
                                            @else
                                                0
                                            @endif
                                        </span>
                                        {{-- <span
                                            class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3 text-white">$1785.00</span> --}}
                                    </a>
                                </li>
                                <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">
                                    <div id="cartDropdownHoverInvoker" class="text-gray-90 position-relative d-flex "
                                        data-toggle="tooltip" data-placement="top" title="{{ translate('Cart') }}"
                                        aria-controls="cartDropdownHover" aria-haspopup="true" aria-expanded="false"
                                        data-unfold-event="click" data-unfold-target="#cartDropdownHover"
                                        data-unfold-type="css-animation" data-unfold-duration="300"
                                        data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                                        data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                                        <i class="font-size-22 ec ec-shopping-bag text-white"></i>
                                        <span
                                            class="bg-lg-down-black width-22 height-22 bg-primary position-absolute d-flex align-items-center justify-content-center rounded-circle left-12 top-8 font-weight-bold font-size-12 text-white">
                                            @if (Session::has('cart'))
                                                {{ count(Session::get('cart')) }}
                                            @else
                                                0
                                            @endif
                                        </span>
                                        {{-- <span
                                            class="d-none d-xl-block font-weight-bold font-size-16 text-gray-90 ml-3 text-white">$1785.00</span> --}}
                                    </div>

                                    <div id="cartDropdownHover"
                                        class="cart-dropdown dropdown-menu dropdown-unfold border-top border-top-primary mt-3 border-width-2 border-left-0 border-right-0 border-bottom-0 left-auto right-0 stop-propagation"
                                        aria-labelledby="cartDropdownHoverInvoker">
                                        {{-- <ul class="px-3 pt-3 cart-items-dropdown overflow-auto list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="">
                                                    <ul class="list-unstyled row mx-n2">
                                                        <li class="px-2 col-auto">
                                                            <img class="img-fluid" src="../../assets/img/75X75/img2.jpg"
                                                                alt="Image Description">
                                                        </li>
                                                        <li class="px-2 col">
                                                            <h5 class="text-blue font-size-14 font-weight-bold">
                                                                Widescreen NX Mini F1 SMART NX</h5>
                                                            <span class="font-size-14">1 × $685.00</span>
                                                        </li>
                                                        <li class="px-2 col-auto">
                                                            <a href="#" class="text-gray-90"><i
                                                                    class="ec ec-close-remove"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="">
                                                    <ul class="list-unstyled row mx-n2">
                                                        <li class="px-2 col-auto">
                                                            <img class="img-fluid" src="../../assets/img/75X75/img2.jpg"
                                                                alt="Image Description">
                                                        </li>
                                                        <li class="px-2 col">
                                                            <h5 class="text-blue font-size-14 font-weight-bold">
                                                                Widescreen NX Mini F1 SMART NX</h5>
                                                            <span class="font-size-14">1 × $685.00</span>
                                                        </li>
                                                        <li class="px-2 col-auto">
                                                            <a href="#" class="text-gray-90"><i
                                                                    class="ec ec-close-remove"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="">
                                                    <ul class="list-unstyled row mx-n2">
                                                        <li class="px-2 col-auto">
                                                            <img class="img-fluid" src="../../assets/img/75X75/img2.jpg"
                                                                alt="Image Description">
                                                        </li>
                                                        <li class="px-2 col">
                                                            <h5 class="text-blue font-size-14 font-weight-bold">
                                                                Widescreen NX Mini F1 SMART NX</h5>
                                                            <span class="font-size-14">1 × $685.00</span>
                                                        </li>
                                                        <li class="px-2 col-auto">
                                                            <a href="#" class="text-gray-90"><i
                                                                    class="ec ec-close-remove"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="">
                                                    <ul class="list-unstyled row mx-n2">
                                                        <li class="px-2 col-auto">
                                                            <img class="img-fluid" src="../../assets/img/75X75/img2.jpg"
                                                                alt="Image Description">
                                                        </li>
                                                        <li class="px-2 col">
                                                            <h5 class="text-blue font-size-14 font-weight-bold">
                                                                Widescreen NX Mini F1 SMART NX</h5>
                                                            <span class="font-size-14">1 × $685.00</span>
                                                        </li>
                                                        <li class="px-2 col-auto">
                                                            <a href="#" class="text-gray-90"><i
                                                                    class="ec ec-close-remove"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="">
                                                    <ul class="list-unstyled row mx-n2">
                                                        <li class="px-2 col-auto">
                                                            <img class="img-fluid" src="../../assets/img/75X75/img2.jpg"
                                                                alt="Image Description">
                                                        </li>
                                                        <li class="px-2 col">
                                                            <h5 class="text-blue font-size-14 font-weight-bold">
                                                                Widescreen NX Mini F1 SMART NX</h5>
                                                            <span class="font-size-14">1 × $685.00</span>
                                                        </li>
                                                        <li class="px-2 col-auto">
                                                            <a href="#" class="text-gray-90"><i
                                                                    class="ec ec-close-remove"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="">
                                                    <ul class="list-unstyled row mx-n2">
                                                        <li class="px-2 col-auto">
                                                            <img class="img-fluid" src="../../assets/img/75X75/img2.jpg"
                                                                alt="Image Description">
                                                        </li>
                                                        <li class="px-2 col">
                                                            <h5 class="text-blue font-size-14 font-weight-bold">
                                                                Widescreen NX Mini F1 SMART NX</h5>
                                                            <span class="font-size-14">1 × $685.00</span>
                                                        </li>
                                                        <li class="px-2 col-auto">
                                                            <a href="#" class="text-gray-90"><i
                                                                    class="ec ec-close-remove"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            
                                        </ul>
                                        <div class="flex-center-between px-4 pt-2">
                                            <a href="../shop/cart.html"
                                                class="btn btn-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">View
                                                cart</a>
                                            <a href="../shop/checkout.html"
                                                class="btn btn-primary-dark ml-md-2 px-5 px-md-4 px-lg-5">Checkout</a>
                                        </div> --}}
                                        @if (Session::has('cart'))
                                            @if (count($cart = Session::get('cart')) > 0)
                                                <ul
                                                    class="cart-items-dropdown overflow-auto list-group list-group-flush">
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($cart as $key => $cartItem)
                                                        @php
                                                            $product = \App\Product::find($cartItem['id']);
                                                            $total = $total + $cartItem['price'] * $cartItem['quantity'];
                                                        @endphp
                                                        @if ($product != null)
                                                            @if ($loop->index < 5)
                                                                <li class="list-group-item py-3 px-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <ul class="list-unstyled row mx-n2">
                                                                            <li class="px-2 col-auto">
                                                                                <img style="width: 60px;"
                                                                                    class="img-fluid"
                                                                                    src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                                    alt="{{ $product->getTranslation('name') }}">
                                                                            </li>
                                                                            <li class="px-2 col">
                                                                                <a
                                                                                    href="{{ route('product', $product->slug) }}">
                                                                                    <h5
                                                                                        class="text-blue font-size-14 font-weight-bold">
                                                                                        {{ $product->getTranslation('name') }}
                                                                                    </h5>
                                                                                </a>
                                                                                <span
                                                                                    class="font-size-14">{{ $cartItem['quantity'] }}
                                                                                    ×
                                                                                    {{ single_price($cartItem['price']) }}</span>
                                                                            </li>
                                                                            <li class="px-2 col-auto">
                                                                                <form action="{{ route('cart.removeFromCart') }}" method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="key" value="{{ $key }}">
                                                                                    <button type="submit" class="btn text-gray-90"><i
                                                                                            class="ec ec-close-remove"></i></button>
                                                                                </form>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                            @else
                                                                @if ($loop->last)
                                                                    <li class="list-group-item">
                                                                        <div class="my-2">
                                                                            <h6 class="text-center">Bạn có thể xem chi
                                                                                tiết tại giỏ hàng</h6>
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between">
                                                    <span class="opacity-60">{{ translate('Subtotal') }}</span>
                                                    <span class="font-weight-bold">{{ single_price($total) }}</span>
                                                </div>
                                                <div class="flex-center-between px-4 pt-2">
                                                    <a href="{{ route('cart') }}"
                                                        class="btn btn-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5">{{ translate('View cart') }}</a>
                                                    @if (Auth::check())
                                                        <a href="{{ route('checkout.shipping_info') }}"
                                                            class="btn btn-primary-dark ml-md-2 px-5 px-md-4 px-lg-5">{{ translate('Checkout') }}</a>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="text-center p-3">
                                                    <i class="fa fa-shopping-cart mb-3"></i>
                                                    <h3 class="h6">{{ translate('Your Cart is empty') }}</h3>
                                                </div>
                                            @endif
                                        @else
                                            <div class="text-center p-3">
                                                <i class="fa fa-shopping-cart mb-3"></i>
                                                <h3 class="h6">{{ translate('Your Cart is empty') }}</h3>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo-Search-header-icons -->

        <!-- Vertical-and-secondary-menu -->
        <div class="d-none d-xl-block bg-secondary">
            <div class="container">
                <div class="row">
                    <!-- Secondary Menu -->
                    <div class="col">
                        <!-- Nav -->
                        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                            <!-- Navigation -->
                            <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                                <ul class="navbar-nav u-header__navbar-nav">
                                    <!-- Featured Brands -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="https://news.amazonvietnam.com.vn" aria-haspopup="true"
                                            aria-expanded="false" aria-labelledby="pagesSubMenu">Tin Tức</a>
                                    </li>
                                    <!-- End Featured Brands -->

                                    <!-- Trending Styles -->
                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{ route('brands.all') }}" aria-haspopup="true"
                                            aria-expanded="false" aria-labelledby="blogSubMenu">Thương Hiệu</a>
                                    </li>
                                    <!-- End Trending Styles -->

                                    <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="{{route('minigame')}}" aria-haspopup="true"
                                            aria-expanded="false" aria-labelledby="blogSubMenu">Minigame</a>
                                    </li>

                                    {{-- <li class="nav-item u-header__nav-item">
                                        <a class="nav-link u-header__nav-link" href="#" aria-haspopup="true"
                                            aria-expanded="false" aria-labelledby="blogSubMenu">Affiliate</a>
                                    </li> --}}

                                    <!-- Button -->
                                    {{-- <li class="nav-item u-header__nav-last-item">
                                        <a class="text-gray-90" href="#" target="_blank">
                                            Affiliate
                                        </a>
                                    </li> --}}
                                    <!-- End Button -->
                                </ul>
                            </div>
                            <!-- End Navigation -->
                        </nav>
                        <!-- End Nav -->
                    </div>
                    <!-- End Secondary Menu -->
                </div>
            </div>
        </div>
        <!-- End Vertical-and-secondary-menu -->
    </div>
</header>
<!-- ========== END HEADER ========== -->
