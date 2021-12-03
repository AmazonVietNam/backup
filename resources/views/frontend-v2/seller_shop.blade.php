@extends('frontend-v2.layouts.app')

@section('meta_title'){{ $shop->meta_title }}@stop

@section('meta_description'){{ $shop->meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $shop->meta_title }}">
    <meta itemprop="description" content="{{ $shop->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($shop->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="website">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $shop->meta_title }}">
    <meta name="twitter:description" content="{{ $shop->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($shop->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $shop->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('shop.visit', $shop->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($shop->logo) }}" />
    <meta property="og:description" content="{{ $shop->meta_description }}" />
    <meta property="og:site_name" content="{{ $shop->name }}" />
@endsection

@section('content')
    <!-- <section>
                <img loading="lazy"  src="https://via.placeholder.com/2000x300.jpg" alt="" class="img-fluid">
            </section> -->

    @php
    $total = 0;
    $rating = 0;
    foreach ($shop->user->products as $key => $seller_product) {
        $total += $seller_product->reviews->count();
        $rating += $seller_product->reviews->sum('rating');
    }
    @endphp

    <section class="pt-5 mb-4 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="d-flex justify-content-center">
                    <img height="70" src="@if ($shop->logo !== null) {{ uploaded_asset($shop->logo) }} @else
                        {{ static_asset('assets/img/placeholder.jpg') }} @endif"
                        alt="{{ $shop->name }}"
                        >
                        <div class="pl-4 text-left">
                            <h1 class="font-weight-semi-bold h4 mb-0">{{ $shop->name }}
                                @if ($shop->user->seller->verification_status == 1)
                                    <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                @else
                                    <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                                @endif
                            </h1>
                            <div class="rating rating-sm mb-1">
                                @if ($total > 0)
                                    {{ renderStarRatingv2($rating / $total) }}
                                @else
                                    {{ renderStarRatingv2(0) }}
                                @endif
                            </div>
                            <div class="location opacity-60">{{ $shop->address }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-bottom mt-5"></div>
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-0">
                    <ul class="list-inline mb-0 text-center text-lg-left">
                        <li class="list-inline-item ">
                            <a class="text-reset d-inline-block font-weight-semi-bold fs-15 p-3 @if (!isset($type)) border-bottom border-primary border-width-2 @endif" href="{{ route('shop.visit', $shop->slug) }}">{{ translate('Store Home') }}</a>
                        </li>
                        <li class="list-inline-item ">
                            <a class="text-reset d-inline-block font-weight-semi-bold fs-15 p-3 @if (isset($type) && $type=='top_selling' ) border-bottom border-primary border-width-2 @endif"
                                href="{{ route('shop.visit.type', ['slug' => $shop->slug, 'type' => 'top_selling']) }}">{{ translate('Top Selling') }}</a>
                        </li>
                        <li class="list-inline-item ">
                            <a class="text-reset d-inline-block font-weight-semi-bold fs-15 p-3 @if (isset($type) && $type=='all_products' ) border-bottom border-primary border-width-2 @endif"
                                href="{{ route('shop.visit.type', ['slug' => $shop->slug, 'type' => 'all_products']) }}">{{ translate('All Products') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 order-1 order-lg-0">
                    <ul class="text-center text-lg-right mt-4 mt-lg-0 social colored list-inline mb-0">
                        @if ($shop->facebook != null)
                            <li class="list-inline-item">
                                <a href="{{ $shop->facebook }}" class="facebook" target="_blank">
                                    <i class="lab la-facebook-f"></i>
                                </a>
                            </li>
                        @endif
                        @if ($shop->twitter != null)
                            <li class="list-inline-item">
                                <a href="{{ $shop->twitter }}" class="twitter" target="_blank">
                                    <i class="lab la-twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if ($shop->google != null)
                            <li class="list-inline-item">
                                <a href="{{ $shop->google }}" class="google-plus" target="_blank">
                                    <i class="lab la-google"></i>
                                </a>
                            </li>
                        @endif
                        @if ($shop->youtube != null)
                            <li class="list-inline-item">
                                <a href="{{ $shop->youtube }}" class="youtube" target="_blank">
                                    <i class="lab la-youtube"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @if (!isset($type))
        <section class="mb-5">
            <div class="container">
                <div class="aiz-carousel dots-inside-bottom" data-arrows="true" data-dots="true" data-autoplay="true">
                    @if ($shop->sliders != null)
                        @foreach (explode(',', $shop->sliders) as $key => $slide)
                            <div class="carousel-box">
                                <img class="d-block w-100 rounded h-200px h-lg-380px img-fit"
                                src="{{ uploaded_asset($slide) }}" alt="{{ $key }} offer">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <div class="container">
            <div class="mb-8">
                <div class="mb-6 d-none d-xl-block">
                    <div class="position-relative">
                        <div class="border-bottom border-color-1 mb-2">
                            <h3 class="d-inline-block section-title section-title__full mb-0 pb-2 font-size-22">{{ translate('Featured Products')}}</h3>
                        </div>
                        <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
                                data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                                data-slides-show="5"
                                data-slides-scroll="1"
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
                            @foreach ($shop->user->products->where('published', 1)->where('featured', 1) as $key => $product)
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
                                                                style="height: 200px; object-fit: cover; width: 100%;"
                                                                class="img-fluid"
                                                                src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                alt="{{ $product->getTranslation('name') }}"></a>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="prodcut-price">
                                                            @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                                <del
                                                                    class="text-gray-100">{{ home_base_price($product->id) }}</del><br />
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
        </div>
    @endif

    <section class="mb-4">
        <div class="container">
            <div class="mb-4">
                <h3 class="h3 font-weight-semi-bold border-bottom">
                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">
                        @if (!isset($type))
                            {{ translate('New Arrival Products') }}
                        @elseif ($type == 'top_selling')
                            {{ translate('Top Selling') }}
                        @elseif ($type == 'all_products')
                            {{ translate('All Products') }}
                        @endif
                    </span>
                </h3>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters">
                        @php
                            if (!isset($type)) {
                                $products = \App\Product::where('user_id', $shop->user->id)
                                    ->where('published', 1)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(24);
                            } elseif ($type == 'top_selling') {
                                $products = \App\Product::where('user_id', $shop->user->id)
                                    ->where('published', 1)
                                    ->orderBy('num_of_sale', 'desc')
                                    ->paginate(24);
                            } elseif ($type == 'all_products') {
                                $products = \App\Product::where('user_id', $shop->user->id)
                                    ->where('published', 1)
                                    ->paginate(24);
                            }
                        @endphp
                        @foreach ($products as $key => $product)
                        <li class="col-6 col-md-3 col-xl-2 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2"><a href="{{ route('products.category', $product->category->slug) }}" class="font-size-12 text-gray-5">{{ \Illuminate\Support\Str::limit($product->category->getTranslation('name'), 20, $end='...') }}</a></div>
                                        <h5 class="mb-1 product-item__title"><a href="{{ route('product', $product->slug) }}" class="text-blue font-weight-bold">{{ \Illuminate\Support\Str::limit($product->getTranslation('name'), 60, $end = '...') }}</a></h5>
                                        <div class="mb-2">
                                            <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="prdt-img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="Image Description"></a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                {{-- <div class="text-gray-100">$685,00</div> --}}
                                                @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <del class="text-sale">{{ home_base_price($product->id) }}</del>
                                                @endif
                                                @if (home_discounted_base_price($product->id) == '0đ')
                                                    <div class="text-gray-100">Liên hệ</div>
                                                @else
                                                    <div class="text-gray-100">
                                                        {{ home_discounted_base_price($product->id) }}</span>
                                                @endif
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                <a href="{{ route('product', $product->slug) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <a href="{{ route('compare.add', $product->id) }}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> {{ translate('Compare') }}</a>
                                            <a href="{{ route('wishlists.add', $product->id) }}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> {{ translate('Wishlist') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{ $products->links('vendor.pagination.list_product')}}
        </div>
    </section>


@endsection
