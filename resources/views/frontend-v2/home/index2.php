@extends('frontend-v2.layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <style type="text/css">
        body{
            background-color: #EAEDED;
        }
    </style>
    <main id="content" role="main">
        <!-- Slider & Banner Section -->
        <div class="mb-4">
            <div class="container overflow-hidden">
                <div class="row">
                    <!-- Slider -->
                   

                    <div class="col-xl pr-xl-2 mb-4 mb-xl-0">
                        <div class="bg-img-hero mr-xl-1 height-410-xl max-width-1060-wd max-width-830-xl overflow-hidden"
                            style="background-image: url(https://transvelo.github.io/electro-html/2.0/assets/img/1920X422/img1.jpg);">
                            <div class="js-slick-carousel u-slick" data-autoplay="true" data-speed="7000"
                                data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start ml-9 mb-3 mb-md-5">

                                @if (get_setting('home_slider_images') != null)
                                    @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                                    @foreach ($slider_images as $key => $value)
                                        <div class="js-slide bg-img-hero-center">

                                            <div class="row height-410-xl py-7 py-md-0 mx-0">
                                                <div class="d-none d-wd-block offset-1"></div>
                                                <div class="col-xl col-6 col-md-6 mt-md-8 text-black">
                                                    <!--
                                                    {{-- <h1 class="font-size-64 text-lh-57 font-weight-light"
                                                        data-scs-animation-in="fadeInUp">
                                                        Samsung <span class="d-block font-size-55">Gear 360</span>
                                                    </h1> --}}-->
                                                    <h6 class="font-size-15 mb-3 text-uppercase"
                                                        data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">
                                                        {!! json_decode(get_setting('home_slider_contents'), true)[$key] !!}
                                                    </h6>
                                                    <!--{{-- <div class="mb-4" data-scs-animation-in="fadeInUp"
                                                        data-scs-animation-delay="300">
                                                        <span class="font-size-13 text-uppercase">Chỉ từ</span>
                                                        <div class="font-size-50 font-weight-bold text-lh-45">
                                                            2,000,000đ
                                                        </div>
                                                    </div> --}}-->
                                                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}"
                                                        class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                        data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                                        {{ translate('buy now') }}
                                                    </a>
                                                </div>
                                                <div class="col-xl-7 col-6 d-flex align-items-center ml-auto ml-md-0"
                                                    data-scs-animation-in="zoomIn" data-scs-animation-delay="500">
                                                    <img class="img-fluid"
                                                        src="{{ uploaded_asset(json_decode(get_setting('home_slider_images'), true)[$key]) }}"
                                                        alt="Image Description">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                {{-- <div class="js-slide bg-img-hero-center">
                                    <div class="row height-410-xl py-7 py-md-0 mx-0">
                                        <div class="d-none d-wd-block offset-1"></div>
                                        <div class="col-xl col-6 col-md-6 mt-md-8">
                                            <h1 class="font-size-64 text-lh-57 font-weight-light"
                                                data-scs-animation-in="slideInLeft">
                                                Laptop <span class="d-block font-size-55">HP</span>
                                            </h1>
                                            <h6 class="font-size-15 font-weight-bold mb-3 text-uppercase"
                                                data-scs-animation-in="slideInLeft" data-scs-animation-delay="200">Làm việc không giới hạn
                                            </h6>
                                            <div class="mb-4" data-scs-animation-in="slideInLeft"
                                                data-scs-animation-delay="400">
                                                <span class="font-size-13 text-uppercase">Chỉ từ</span>
                                                <div class="font-size-50 font-weight-bold text-lh-45">
                                                    9,499,000đ
                                                </div>
                                            </div>
                                            <a href="../shop/single-product-fullwidth.html"
                                                class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                                {{ translate('buy now') }}
                                            </a>
                                        </div>
                                        <div class="col-xl-7 col-6 d-flex align-items-center ml-auto ml-md-0"
                                            data-scs-animation-in="slideInRight" data-scs-animation-delay="800">
                                            <img class="img-fluid" src="https://transvelo.github.io/electro-html/2.0/assets/img/500X380/img2.png"
                                                alt="Image Description">
                                        </div>
                                    </div>
                                </div>
                                <div class="js-slide bg-img-hero-center">
                                    <div class="row height-410-xl py-7 py-md-0 mx-0">
                                        <div class="d-none d-wd-block offset-1"></div>
                                        <div class="col-xl col-6 col-md-6 mt-md-8">
                                            <h1 class="font-size-64 text-lh-57 font-weight-light"
                                                data-scs-animation-in="fadeInUp">
                                                SAMSUNG <span class="d-block font-size-55">Gear VR</span>
                                            </h1>
                                            <h6 class="font-size-15 font-weight-bold mb-3 text-uppercase" data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="200">Trải nghiệm khó quên
                                            </h6>
                                            <div class="mb-4" data-scs-animation-in="fadeInUp"
                                                data-scs-animation-delay="300">
                                                <span class="font-size-13 text-uppercase">Chỉ từ</span>
                                                <div class="font-size-50 font-weight-bold text-lh-45">
                                                    18,500,000đ
                                                </div>
                                            </div>
                                            <a href="../shop/single-product-fullwidth.html"
                                                class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-7 px-3 font-size-16"
                                                data-scs-animation-in="fadeInUp" data-scs-animation-delay="400">
                                                {{ translate('buy now') }}
                                            </a>
                                        </div>
                                        <div class="col-xl-7 col-6 d-flex align-items-center ml-auto ml-md-0"
                                            data-scs-animation-in="zoomIn" data-scs-animation-delay="500">
                                            <img class="img-fluid" src="https://transvelo.github.io/electro-html/2.0/assets/img/500X380/img3.png"
                                                alt="Image Description">
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- End Slider -->
                    <!-- Banner -->
                    <div class="col-xl-auto pl-xl-2 ">
                        <div class="overflow-hidden">
                            <ul class="list-unstyled row flex-nowrap flex-xl-wrap overflow-auto overflow-lg-visble mx-n2 mx-xl-0 d-xl-block mb-0">
                                @if (isset(get_setting('home_banner1_images')))
                                    @php $banner_image = json_decode(get_setting('home_banner1_images'), true);  @endphp
                                    @foreach ($banner_image as $key => $value)
                                        <li class="px-2 px-xl-0 flex-shrink-0 flex-xl-shrink-1 mb-3">
                                            <div
                                                class="min-height-126 max-width-320 py-1 py-xl-2 py-wd-1 banner-bg d-flex align-items-center text-gray-90">
                                                <div class="col col-lg-6 col-xl-5 col-wd-6 mb-3 mb-lg-0 pr-lg-0">
                                                    <img class="img-fluid"
                                                        src="{{ uploaded_asset(json_decode(get_setting('home_banner1_images'), true)[$key]) }}">
                                                </div>
                                                <div class="col col-lg-6 col-xl-7 col-wd-6 pr-xl-4 pr-wd-3">
                                                    <div
                                                        class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23 text-uppercase">
                                                        Trải nghiệm hay <strong>sắm liền tay</strong>
                                                    </div>
                                                    {{-- <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                                                        Shop now
                                                        <span class="link__icon ml-1">
                                                            <span class="link__icon-inner"><i
                                                                    class="ec ec-arrow-right-categproes"></i></span>
                                                        </span>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- End Banner -->
                </div>
            </div>
        </div>
        <!-- End Slider & Banner Section -->
        <!-- Top Categories this Week -->
        @if ($featuredCategories->count() > 0)
                <div class="container">
            <div class="mb-5 bg-gray-7 p-3">
                    <div
                        class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Danh Mục Nổi Bật</h3>
                    </div>
                    <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                        @foreach ($featuredCategories as $key => $category)
                            <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                                <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                                    <a href="{{ route('products.category', $category->slug) }}"
                                        class="d-block pr-2 pr-wd-6 p-1">
                                        <div class="media align-items-center">
                                            <div class="pt-2">
                                                <img class="img-fluid max-width-100"
                                                    src="{{ uploaded_asset($category->banner) }}"
                                                    alt="Image Description">
                                            </div>
                                            <div class="ml-3 media-body">
                                                <h6 class="mb-0 text-gray-90">{{ $category->getTranslation('name') }}
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>


                </div>
            </div>
        @endif
        <div class="container">
            <div class="mb-5  p-4 bg-white">
                <div class="position-relative">
                    <div class="border-bottom border-color-1 mb-2">
                        <h3 class="d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">{{ translate('Featured Products')}}</h3>
                    </div>
                    <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pt-2 px-1"
                            data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                            data-slides-show="5"
                            data-slides-scroll="4"
                            data-autoplay="true"
                            data-pause-hover="true"
                            data-infinite="true"
                            data-speed="3000"
                            data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                            data-arrow-left-classes="fa fa-angle-left right-1"
                            data-arrow-right-classes="fa fa-angle-right right-0"
                            data-responsive='[{
                              "breakpoint": 1400,
                              "settings": {
                                "slidesToShow": 5
                              }
                            }, {
                                "breakpoint": 1200,
                                "settings": {
                                  "slidesToShow": 4
                                }
                            }, {
                              "breakpoint": 992,
                              "settings": {
                                "slidesToShow": 3
                              }
                            }, {
                              "breakpoint": 768,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }, {
                              "breakpoint": 554,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }]'>
                            @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->take(20)->get() as $key => $product)
                            <div class="js-slide products-group">
                                <div class="product-item mx-1 remove-divider">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white px-wd-4 p-2 p-md-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="{{ route('products.category', $product->category->slug) }}"
                                                        class="font-size-12 text-gray">{{ $product->category->getTranslation('name') }}</a>
                                                </div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="{{ route('product', $product->slug) }}"
                                                        class="text-black font-weight-bold">{{ $product->getTranslation('name') }}</a>
                                                </h5>
                                                <div class="mb-2">
                                                    <a href="{{ route('product', $product->slug) }}"
                                                        class="d-block text-center"><img
                                                            style="height: 200px; width: 212px; 
                                                            object-fit: cover;"
                                                            class="img-fluid"
                                                            src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            alt="{{ $product->getTranslation('name') }}"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del
                                                                class="text-sale">{{ home_base_price($product->id) }}</del><br />
                                                        @endif
                                                        @if (home_discounted_base_price($product->id) == '0đ')
                                                            <span class="text-gray-100">Liên hệ</span>
                                                        @else
                                                            <span
                                                                class="text-gray-100">{{ home_discounted_base_price($product->id) }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="{{ route('product', $product->slug) }}"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="{{ route('compare.add', $product->id) }}"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i>
                                                        {{ translate('Compare') }}</a>
                                                    <a href="{{ route('wishlists.add', $product->id) }}"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        {{ translate('Wishlist') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mb-5 bg-white p-5">
                <div class="position-relative">
                    <div class="border-bottom border-color-1 mb-2">
                        <h3 class="d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">{{ translate('Đang Giảm Giá')}}</h3>
                    </div>
                    <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble  pt-2 px-1"
                            data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                            data-slides-show="5"
                            data-slides-scroll="4"
                            data-autoplay="true"
                            data-speed="3000"
                            data-pause-hover="true"
                            data-infinite="true"
                            data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                            data-arrow-left-classes="fa fa-angle-left right-1"
                            data-arrow-right-classes="fa fa-angle-right right-0"
                            data-responsive='[{
                              "breakpoint": 1400,
                              "settings": {
                                "slidesToShow": 5
                              }
                            }, {
                                "breakpoint": 1200,
                                "settings": {
                                  "slidesToShow": 4
                                }
                            }, {
                              "breakpoint": 992,
                              "settings": {
                                "slidesToShow": 3
                              }
                            }, {
                              "breakpoint": 768,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }, {
                              "breakpoint": 554,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }]'>
                            @foreach (filter_products(\App\Product::where('published', 1)->where('todays_deal', 1))->get() as $key => $product)
                            <div class="js-slide products-group">
                                <div class="product-item mx-1 remove-divider">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white px-wd-4 p-2 p-md-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="{{ route('products.category', $product->category->slug) }}"
                                                        class="font-size-12 text-gray">{{ $product->category->getTranslation('name') }}</a>
                                                </div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="{{ route('product', $product->slug) }}"
                                                        class="text-black font-weight-bold">{{ $product->getTranslation('name') }}</a>
                                                </h5>
                                                <div class="mb-2">
                                                    <a href="{{ route('product', $product->slug) }}"
                                                        class="d-block text-center"><img
                                                            style="height: 200px; width: 212px; 
                                                            object-fit: cover;"
                                                            class="img-fluid"
                                                            src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            alt="{{ $product->getTranslation('name') }}"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del
                                                                class="text-sale">{{ home_base_price($product->id) }}</del><br />
                                                        @endif
                                                        @if (home_discounted_base_price($product->id) == '0đ')
                                                            <span class="text-gray-100">Liên hệ</span>
                                                        @else
                                                            <span
                                                                class="text-gray-100">{{ home_discounted_base_price($product->id) }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="{{ route('product', $product->slug) }}"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="{{ route('compare.add', $product->id) }}"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i>
                                                        {{ translate('Compare') }}</a>
                                                    <a href="{{ route('wishlists.add', $product->id) }}"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        {{ translate('Wishlist') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="mb-5 bg-white p-5">
                <div class="position-relative">
                    <div class="border-bottom border-color-1 mb-2">
                        <h3 class="d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">{{ translate('Được Đánh Giá Cao')}}</h3>
                    </div>
                    <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble  pt-2 px-1"
                            data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                            data-slides-show="5"
                            data-slides-scroll="4"
                            data-autoplay="true"
                            data-speed="3000"
                            data-pause-hover="true"
                            data-infinite="true"
                            data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                            data-arrow-left-classes="fa fa-angle-left right-1"
                            data-arrow-right-classes="fa fa-angle-right right-0"
                            data-responsive='[{
                              "breakpoint": 1400,
                              "settings": {
                                "slidesToShow": 5
                              }
                            }, {
                                "breakpoint": 1200,
                                "settings": {
                                  "slidesToShow": 4
                                }
                            }, {
                              "breakpoint": 992,
                              "settings": {
                                "slidesToShow": 3
                              }
                            }, {
                              "breakpoint": 768,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }, {
                              "breakpoint": 554,
                              "settings": {
                                "slidesToShow": 2
                              }
                            }]'>
                            @foreach (\App\Product::where('published', 1)->orderBy('rating', 'desc')->take(10)->get() as $key => $product)
                            <div class="js-slide products-group">
                                <div class="product-item mx-1 remove-divider">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner bg-white px-wd-4 p-2 p-md-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="{{ route('products.category', $product->category->slug) }}"
                                                        class="font-size-12 text-gray">{{ $product->category->getTranslation('name') }}</a>
                                                </div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="{{ route('product', $product->slug) }}"
                                                        class="text-black font-weight-bold">{{ $product->getTranslation('name') }}</a>
                                                </h5>
                                                <div class="mb-2">
                                                    <a href="{{ route('product', $product->slug) }}"
                                                        class="d-block text-center"><img
                                                            style="height: 200px; width: 212px; 
                                                            object-fit: cover;"
                                                            class="img-fluid"
                                                            src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            alt="{{ $product->getTranslation('name') }}"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del
                                                                class="text-sale">{{ home_base_price($product->id) }}</del><br />
                                                        @endif
                                                        @if (home_discounted_base_price($product->id) == '0đ')
                                                            <span class="text-gray-100">Liên hệ</span>
                                                        @else
                                                            <span
                                                                class="text-gray-100">{{ home_discounted_base_price($product->id) }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="{{ route('product', $product->slug) }}"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer">
                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                    <a href="{{ route('compare.add', $product->id) }}"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i>
                                                        {{ translate('Compare') }}</a>
                                                    <a href="{{ route('wishlists.add', $product->id) }}"
                                                        class="text-gray-6 font-size-13"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                        {{ translate('Wishlist') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            </div>

            <!-- Full banner -->
            <div class="container mb-8">
                @if (get_setting('home_banner2_images') != null)
                    <div class="bg-img-hero pt-3">
                        @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
                        @if (count($banner_2_imags) > 0)
                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[0] }}"
                                class="d-block text-reset">
                                <img style="width: 100%; height: auto;" src="{{ uploaded_asset($banner_2_imags[0]) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="responsive">
                            </a>
                        @endif
                    </div>
                @endif

                <!--
                 <a href="../shop/shop.html" class="d-block text-gray-90">
                    <div class="bg-img-hero pt-3"
                        style="background-image: url(https://transvelo.github.io/electro-html/2.0/assets/img/1400X143/img1.png);">
                        <div class="space-top-2-md p-4 pt-4 pt-md-5 pt-lg-6 pt-xl-5 pb-lg-4 px-xl-14 px-lg-6">
                            <div class="flex-horizontal-center overflow-auto overflow-md-visble">
                                <h1 class="text-lh-38 font-size-30 font-weight-light mb-0 flex-shrink-0 flex-md-shrink-1">
                                    MUA SẮM <strong>GIÁ PHẢI CHĂNG</strong> RẤT NHIỀU SẢN PHẨM HOT</h1>
                                <div class="flex-content-center ml-4 flex-shrink-0">
                                    <div class="bg-primary rounded-lg px-6 py-2">
                                        <em class="font-size-14 font-weight-light text-white">CHỈ VỚI</em>
                                        <div class="font-size-25 font-weight-bold text-lh-1 text-white">
                                            100,000đ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a> --}}
            -->
            <!-- End Full banner -->
        </div>

        <!-- Week Deals limited -->
        @php
            $flash_deal = \App\FlashDeal::where('status', 1)
                ->where('featured', 1)
                ->first();
        @endphp
        @if ($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
            
        <div class="container">
                <div class="bg-gray-7 mb-6 py-7 p-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-3 col-wd-2">
                            <div class="max-width-244">
                                <div class="d-flex border-bottom border-color-1 mb-3">
                                    <h3 class="section-title mb-0 pb-2 font-size-22 text-uppercase font-weight-bold">Flash
                                        Sale</h3>
                                </div>
                                <div class="mb-3 mb-md-2 text-center text-md-left">
                                    {{-- <h1 class="font-size-130 font-weight-light mb-2 text-lh-1">99%</h1> --}}
                                    {{-- <h6 class="text-gray-2 mb-2">Hurry Up! Offer ends in:</h6> --}}
                                    <div class="js-countdown d-flex mx-n2 justify-content-center justify-content-md-start"
                                        data-end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"
                                        data-days-format="%D" data-hours-format="%H" data-minutes-format="%M"
                                        data-seconds-format="%S">
                                        <div class="text-lh-1 px-2 text-center">
                                            <div
                                                class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-20 mb-2">
                                                    <span class="js-cd-days"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-8 text-center">NGÀY</div>
                                            </div>
                                        </div>
                                        <div class="text-lh-1 px-2 text-center">
                                            <div
                                                class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-20 mb-2">
                                                    <span class="js-cd-hours"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-8 text-center">GIỜ</div>
                                            </div>
                                        </div>
                                        <div class="text-lh-1 px-2 text-center">
                                            <div
                                                class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-20 mb-2">
                                                    <span class="js-cd-minutes"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-8 text-center">PHÚT</div>
                                            </div>
                                        </div>
                                        <div class="text-lh-1 px-2 text-center">
                                            <div
                                                class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-20 mb-2">
                                                    <span class="js-cd-seconds"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-8 text-center">GIÂY</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-9 col-wd-10">
                            <div class="">
                                <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-5 pt-2 px-1"
                                    data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 pt-1"
                                    data-slides-show="5"
                                    data-slides-scroll="4"
                                    data-autoplay="true"
                                    data-speed="3000"
                                    data-pause-hover="true"
                                    data-infinite="true"
                                    data-responsive='[{
                                                  "breakpoint": 1400,
                                                  "settings": {
                                                    "slidesToShow": 4
                                                  }
                                                }, {
                                                    "breakpoint": 1200,
                                                    "settings": {
                                                      "slidesToShow": 3
                                                    }
                                                }, {
                                                  "breakpoint": 992,
                                                  "settings": {
                                                    "slidesToShow": 2
                                                  }
                                                }, {
                                                  "breakpoint": 768,
                                                  "settings": {
                                                    "slidesToShow": 2
                                                  }
                                                }, {
                                                  "breakpoint": 554,
                                                  "settings": {
                                                    "slidesToShow": 2
                                                  }
                                                }]'>
                                    @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                                        @php
                                            $product = \App\Product::find($flash_deal_product->product_id);
                                        @endphp
                                        @if ($product != null && $product->published != 0)
                                            <div class="js-slide products-group">
                                                <div class="product-item mx-1 remove-divider">
                                                    <div class="product-item__outer h-100">
                                                        <div class="product-item__inner bg-white px-wd-4 p-2 p-md-3">
                                                            <div class="product-item__body pb-xl-2">
                                                                <div class="mb-2"><a
                                                                        href="{{ route('products.category', $product->category->slug) }}"
                                                                        class="font-size-12 text-gray-5">{{ $product->category->getTranslation('name') }}</a>
                                                                </div>
                                                                <h5 class="mb-1 product-item__title"><a
                                                                        href="{{ route('product', $product->slug) }}"
                                                                        class="text-blue font-weight-bold">{{ $product->getTranslation('name') }}</a>
                                                                </h5>
                                                                <div class="mb-2">
                                                                    <a href="{{ route('product', $product->slug) }}"
                                                                        class="d-block text-center"><img
                                                            style="height: 200px; width: 212px; 
                                                            object-fit: cover;"
                                                                            class="img-fluid"
                                                                            src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                            alt="{{ $product->getTranslation('name') }}"></a>
                                                                </div>
                                                                <div class="flex-center-between mb-1">
                                                                    <div class="prodcut-price">
                                                                        @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                                            <del
                                                                                class="text-sale">{{ home_base_price($product->id) }}</del><br />
                                                                        @endif
                                                                        @if (home_discounted_base_price($product->id) == '0đ')
                                                                            <span class="text-gray-100">Liên hệ</span>
                                                                        @else
                                                                            <span
                                                                                class="text-gray-100">{{ home_discounted_base_price($product->id) }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                                        <a href="{{ route('product', $product->slug) }}"
                                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                                class="ec ec-add-to-cart"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-item__footer">
                                                                <div class="border-top pt-2 flex-center-between flex-wrap">
                                                                    <a href="{{ route('compare.add', $product->id) }}"
                                                                        class="text-gray-6 font-size-13"><i
                                                                            class="ec ec-compare mr-1 font-size-15"></i>
                                                                        {{ translate('Compare') }}</a>
                                                                    <a href="{{ route('wishlists.add', $product->id) }}"
                                                                        class="text-gray-6 font-size-13"><i
                                                                            class="ec ec-favorites mr-1 font-size-15"></i>
                                                                        {{ translate('Wishlist') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <!--{{-- <div class="js-slide products-group">
                                    <div class="product-item mx-1 remove-divider">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner bg-white px-wd-4 p-2 p-md-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <div class="mb-2"><a
                                                            href="../shop/product-categories-7-column-full-width.html"
                                                            class="font-size-12 text-gray-5">Speakers</a></div>
                                                    <h5 class="mb-1 product-item__title"><a
                                                            href="../shop/single-product-fullwidth.html"
                                                            class="text-blue font-weight-bold">Wireless Audio System
                                                            Multiroom 360 degree Full base audio</a></h5>
                                                    <div class="mb-2">
                                                        <a href="../shop/single-product-fullwidth.html"
                                                            class="d-block text-center"><img class="img-fluid"
                                                                src="{{ static_asset('clever/img/212X200/img2.jpg') }}"
                                                                alt="Image Description"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            <div class="text-gray-100">$685,00</div>
                                                        </div>
                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                            <a href="../shop/single-product-fullwidth.html"
                                                                class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                    class="ec ec-add-to-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-item__footer">
                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                                class="ec ec-compare mr-1 font-size-15"></i> {{ translate('Compare') }}</a>
                                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                                class="ec ec-favorites mr-1 font-size-15"></i> {{ translate('Wishlist') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- End Week Deals limited -->


        <!-- Categories Card -->
        <!--
        @php $home_categories = json_decode(get_setting('home_categories')); @endphp
        @if ($home_categories != null && count($home_categories) > 0)
        <!--
            <div class="mb-6">
                <div class="container">
                    <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                        @foreach ($home_categories as $key => $value)
                            @php $cat = \App\Category::find($value); @endphp
                            <div class="col-md-6 col-xl-4 mb-5 flex-shrink-0 flex-md-shrink-1">
                                <div class="bg-gray-1 overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                                    <a href="{{ route('products.category', $cat->slug) }}" class="d-block  pr-2 pr-wd-6">
                                        <div class="media align-items-center">
                                            <div class="max-width-148">
                                                <img class="img-fluid"
                                                    src="{{ uploaded_asset($cat->banner) }}" alt="Image Description">
                                            </div>
                                            <div class="ml-4 media-body">
                                                <h4 class="mb-0 text-gray-90">{{ $cat->getTranslation('name') }}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        -->
    <!--    @endif
    -->
        <!-- End Categories Card -->
        <!-- Banners -->

                <!--
        @if (get_setting('home_banner2_images') != null)
        @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
        @if (count($banner_2_imags) > 1)
        <div class="mb-6">
            <div class="container">
                
                    <div class="bg-img-hero pt-3">
                        
                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[1] }}"
                                class="d-block text-reset">
                                <img style="width: 100%;height: auto ;object-fit: contain;" src="{{ uploaded_asset($banner_2_imags[1]) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid">
                            {{ uploaded_asset($banner_2_imags[1]) }}</a>
                        
                    </div>
                {{-- <div class="row">
                    <div class="col-lg-8 mb-5 bg">
                        <div class="bg-gray-17">
                            <a href="../shop/shop.html" class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="ml-md-7 mt-6 mt-md-0 ml-4 text-gray-90">
                                        <h2 class="font-size-28 font-size-20-lg max-width-270 text-lh-1dot2">G9 Laptops with Ultra 4K HD Display</h2>
                                        <p class="font-size-18 font-size-14-lg text-gray-90 font-weight-light">and the fastest Intel Core i7 processor ever</p>
                                        <div class="text-lh-28">
                                            <span class="font-size-18 font-size-14-lg font-weight-light">from</span>
                                            <span class="font-size-46 font-size-30-lg font-weight-semi-bold"><sup class="">$</sup>399</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img class="img-fluid" src="https://transvelo.github.io/electro-html/2.0/assets/img/446X262/img1.jpg" alt="Image Description">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="h-100">
                            <a href="../shop/shop.html" class="d-block"><img class="img-fluid" src="https://transvelo.github.io/electro-html/2.0/assets/img/446X262/img3.jpg" alt="Image Description"></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <a href="../shop/shop.html" class=""><img class="img-fluid" src="https://transvelo.github.io/electro-html/2.0/assets/img/446X262/img4.jpg" alt="Image Description"></a>
                    </div>
                    <div class="col-lg-8 mb-5">
                        <div class="bg-gray-1">
                            <a href="../shop/shop.html" class="row align-items-center">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <img class="img-fluid" src="https://transvelo.github.io/electro-html/2.0/assets/img/446X262/img2.jpg" alt="Image Description">
                                </div>
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <div class="ml-4 ml-md-0 ml-wd-4 text-gray-90">
                                        <h2 class="font-size-28 font-size-20-lg font-size-14-lg text-lh-1dot2"><strong class="font-size-36 font-size-24-lg font-weight-semi-bold">Fresh Honor 9</strong><br> 32GB Unlocked quadcore</h2>
                                        <ul class="list-unstyled d-flex u-header__navbar-nav-divider">
                                            <li class="u-header__nav-item"><span class="mr-1">4GB RAM</span></li>
                                            <li class="u-header__nav-item"><span class="mx-1">64GB ROM</span></li>
                                            <li class="u-header__nav-item"><span class="ml-1">20MP + 12MP Dual Camera</span></li>
                                        </ul>
                                        <div class="text-lh-28">
                                            <span class="font-size-18 font-size-14-lg font-weight-light">from</span>
                                            <span class="font-size-46 font-size-30-lg font-weight-semi-bold"><sup class="">$</sup>279</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        @endif
        @endif
            -->
        <!-- End Banners -->


        
            <div class="container">
        <div class="mb-2 bg-white pt-5 pl-5 pr-5">
                <div class="row">
                    <div class="col-lg-8 mb-5">
                        <div class="bg-gray-17">
                            <a href="" class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="ml-md-7 mt-6 mt-md-0 ml-4 text-gray-90">
                                        <h2 class="font-size-28 font-size-20-lg max-width-270 text-lh-1dot2">G9 Laptops
                                            Ultra 4K HD Display</h2>
                                        <p class="font-size-18 font-size-14-lg text-gray-90 font-weight-light">Intel Core i7 processor ever</p>
                                        <div class="text-lh-28">
                                            <span class="font-size-18 font-size-14-lg font-weight-light">chỉ từ</span>
                                            <span class="font-size-46 font-size-30-lg font-weight-semi-bold">9,000,000<sup
                                                class="">đ</sup></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img class="img-fluid"
                                        src="https://transvelo.github.io/electro-html/2.0/assets/img/446X262/img1.jpg"
                                        alt="Image Description">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="h-100">
                            <a href="" class="d-block"><img class="img-fluid"
                                    src="{{static_asset('assets/img/img3.jpg')}}"
                                    alt="Image Description"></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <a href="" class=""><img class="img-fluid"
                                src="{{static_asset('assets/img/img4.jpg')}}"
                                alt="Image Description"></a>
                    </div>
                    <div class="col-lg-8 mb-5">
                        <div class="bg-gray-1">
                            <a href="" class="row align-items-center">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <img class="img-fluid"
                                        src="https://transvelo.github.io/electro-html/2.0/assets/img/446X262/img2.jpg"
                                        alt="Image Description">
                                </div>
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <div class="ml-4 ml-md-0 ml-wd-4 text-gray-90">
                                        <h2 class="font-size-28 font-size-20-lg font-size-14-lg text-lh-1dot2"><strong
                                                class="font-size-36 font-size-24-lg font-weight-semi-bold">Fresh Honor
                                                9</strong><br> 32GB Unlocked quadcore</h2>
                                        <ul class="list-unstyled d-flex u-header__navbar-nav-divider">
                                            <li class="u-header__nav-item"><span class="mr-1">4GB RAM</span></li>
                                            <li class="u-header__nav-item"><span class="mx-1">64GB ROM</span></li>
                                            <li class="u-header__nav-item"><span class="ml-1">20MP + 12MP Dual Camera</span>
                                            </li>
                                        </ul>
                                        <div class="text-lh-28">
                                            <span class="font-size-18 font-size-14-lg font-weight-light">chỉ từ</span>
                                            <span class="font-size-46 font-size-30-lg font-weight-semi-bold">6,300,000<sup
                                                class="">đ</sup></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
