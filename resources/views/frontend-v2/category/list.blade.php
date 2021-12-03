@extends('frontend-v2.layouts.app')

@if (isset($category_id))
    @php
        $meta_title = \App\Category::find($category_id)->meta_title;
        $meta_description = \App\Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = \App\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">{{translate('Home')}}</a></li>
                        @if($category != null)
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$category->getTranslation('name')}}</li>
                        @else
                        @isset($q)<li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$q}}</li>@endisset
                        @endif
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="row mb-8">
            <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                <div class="mb-8 border border-width-2 border-color-3 borders-radius-6">
                    <!-- List -->
                    <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar">
                        <li>
                            <a class="dropdown-toggle dropdown-toggle-collapse dropdown-title" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav1Collapse" data-target="#sidebarNav1Collapse">
                                {{translate('Show All Categories')}}
                            </a>

                            <div id="sidebarNav1Collapse" class="collapse" data-parent="#sidebarNav">
                                <ul id="sidebarNav1" class="list-unstyled dropdown-list">
                                    <!-- Menu List -->
                                    @foreach($categories as $x)
                                        <li><a class="dropdown-item" href="{{ route('products.category', $x->slug) }}">{{ \Illuminate\Support\Str::limit($x->getTranslation('name'), 20, $end='...') }}<span class="text-gray-25 font-size-12 font-weight-normal"> ({{$x->products->count()}})</span></a></li>
                                    @endforeach
                                    
                                    <!-- End Menu List -->
                                </ul>
                            </div>
                        </li>
                        @if($category != null)
                        <li>
                            <a class="dropdown-current active" href="#">{{\Illuminate\Support\Str::limit($category->getTranslation('name'), 20, $end='...')}}</a>

                            <ul class="list-unstyled dropdown-list">
                                <!-- Menu List -->
                                @foreach($category->childrenCategories as $ch)
                                <li><a class="dropdown-item" href="{{ route('products.category', $ch->slug) }}">{{\Illuminate\Support\Str::limit($ch->getTranslation('name'), 22, $end='...')}}</a></li>
                                @endforeach
                                <!-- End Menu List -->
                            </ul>
                        </li>
                        @endif
                    </ul>
                    <!-- End List -->
                </div>
                <div class="mb-6">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">{{translate('Filters')}}</h3>
                    </div>
                    @isset($category)
                    <form id="filter-form" method="get" action="{{ route('products.category', $category->slug) }}"> 
                    @endisset
                    @empty($category)
                    <form id="filter-form" method="get" action="{{ route('search') }}">
                    @isset($category_id)
                    <input type="hidden" value="{{$category_id}}" name="category_id" >
                    @endisset
                    @endempty
                    

                    @isset($q)
                    <input type="hidden" value="{{$q}}" name="q" >
                    @endisset
                    
                    @if($categoryBrands->count() > 0)
                    <div class="border-bottom pb-4 mb-4">
                        <h4 class="font-size-14 mb-3 font-weight-bold">{{translate('Brands')}}</h4>

                        <!-- Checkboxes -->
                        @foreach ($categoryBrands as $brand)
                        @if($loop->iteration < 6)
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input name="brands" type="checkbox" class="custom-control-input" id="{{$brand->slug}}">
                                <label class="custom-control-label" for="{{$brand->slug}}">{{$brand->getTranslation('name')}}
                                </label>
                            </div>
                        </div>
                        @endif
                        @if($loop->iteration == 5)
                        <div class="collapse" id="collapseBrand">
                        @endif
                        @if($loop->iteration > 5)
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input name="brands" type="checkbox" class="custom-control-input" id="{{$brand->slug}}">
                                <label class="custom-control-label" for="{{$brand->slug}}">{{$brand->getTranslation('name')}}
                                </label>
                            </div>
                        </div>
                        @endif
                        @if($loop->last && $loop->iteration > 5)
                        </div>

                        <!-- Link -->
                        <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse" href="#collapseBrand" role="button" aria-expanded="false" aria-controls="collapseBrand">
                            <span class="link__icon text-gray-27 bg-white">
                                <span class="link__icon-inner">+</span>
                            </span>
                            <span class="link-collapse__default">Show more</span>
                            <span class="link-collapse__active">Show less</span>
                        </a>
                        <!-- End Link -->
                        @endif
                        @endforeach
                        <!-- End Checkboxes -->
                    </div>
                    @endif
                    @if(count($all_colors) > 0)
                    <div class="border-bottom pb-4 mb-4">
                        <h4 class="font-size-14 mb-3 font-weight-bold">{{translate('color')}}</h4>

                        <!-- Checkboxes -->
                        @foreach ($all_colors as $key => $color)
                        @if($loop->iteration < 6)
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="color" value="{{ $color }}" class="custom-control-input" id="{{$color}}" @if(isset($selected_color) && $selected_color == $color) checked @endif>
                                <label class="custom-control-label" for="{{$color}}"><i style='border-radius: 2px;border:1px solid black;color: {{ $color }};' class='fa fa-square mr-2'></i>{{ \App\Color::where('code', $color)->first()->name }}</label>
                            </div>
                        </div>
                        @endif
                        @if($loop->iteration == 5)
                        <div class="collapse" id="collapseColor">
                        @endif
                        @if($loop->iteration > 5)
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="color" value="{{ $color }}" class="custom-control-input" id="{{$color}}" @if(isset($selected_color) && $selected_color == $color) checked @endif>
                                <label class="custom-control-label" for="{{$color}}"><i style='border-radius: 2px;border:1px solid black;color: {{ $color }};' class='fa fa-square mr-2'></i>{{ \App\Color::where('code', $color)->first()->name }}</label>
                            </div>
                        </div>
                        @endif
                        @if($loop->last && $loop->iteration >= 5)
                        </div>
                        <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse" href="#collapseColor" role="button" aria-expanded="false" aria-controls="collapseColor">
                            <span class="link__icon text-gray-27 bg-white">
                                <span class="link__icon-inner">+</span>
                            </span>
                            <span class="link-collapse__default">Show more</span>
                            <span class="link-collapse__active">Show less</span>
                        </a>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    <div class="range-slider">
                        <h4 class="font-size-14 mb-3 font-weight-bold">{{translate('Price')}}</h4>
                        <!-- Range Slider -->
                        <input id="price-slider" class="js-range-slider" type="text"
                        data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                        data-type="double"
                        data-grid="false"
                        data-hide-from-to="true"
                        data-prefix="đ"
                        data-min="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->min('unit_price') }} @endif"
                        data-max="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->max('unit_price') }} @endif"
                        @if (isset($min_price))
                        data-from="{{ $min_price }}"
                        @elseif($products->min('unit_price') > 0)
                        data-from="{{ $products->min('unit_price') }}"
                        @else
                        data-from="0"
                        @endif
                        @if (isset($max_price))
                        data-to="{{ $max_price }}"
                        @elseif($products->max('unit_price') > 0)
                        data-to="{{ $products->max('unit_price') }}"
                        @else
                        data-to="0"
                        @endif
                        data-result-min="#rangeMinResult"
                        data-result-max="#rangeMaxResult">
                        <!-- End Range Slider -->
                        <div class="mt-1 text-gray-111 d-flex mb-4">
                            <span class="mr-0dot5">{{translate('Price')}}: </span>
                            <span id="rangeMinResult" class=""></span>
                            <span>đ</span>
                            <span class="mx-0dot5"> — </span>
                            <span id="rangeMaxResult" class=""></span>
                            <span>đ</span>
                        </div>
                        <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white">{{translate('Filter')}}</button>
                    </div>
                    </form>
                </div>
                {{-- <div class="mb-8">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Latest Products</h3>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-4">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">
                                        <img class="img-fluid" src="../../assets/img/300X300/img1.jpg" alt="Image Description">
                                    </a>
                                </div>
                                <div class="col">
                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Notebook Black Spire V Nitro VN7-591G</a></h3>
                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <div class="font-weight-bold">
                                        <del class="font-size-11 text-gray-9 d-block">$2299.00</del>
                                        <ins class="font-size-15 text-red text-decoration-none d-block">$1999.00</ins>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-4">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">
                                        <img class="img-fluid" src="../../assets/img/300X300/img3.jpg" alt="Image Description">
                                    </a>
                                </div>
                                <div class="col">
                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Notebook Black Spire V Nitro VN7-591G</a></h3>
                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <div class="font-weight-bold font-size-15">
                                        $499.00
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-4">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">
                                        <img class="img-fluid" src="../../assets/img/300X300/img5.jpg" alt="Image Description">
                                    </a>
                                </div>
                                <div class="col">
                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Tablet Thin EliteBook Revolve 810 G6</a></h3>
                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <div class="font-weight-bold font-size-15">
                                        $100.00
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-4">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">
                                        <img class="img-fluid" src="../../assets/img/300X300/img6.jpg" alt="Image Description">
                                    </a>
                                </div>
                                <div class="col">
                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Notebook Purple G952VX-T7008T</a></h3>
                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <div class="font-weight-bold">
                                        <del class="font-size-11 text-gray-9 d-block">$2299.00</del>
                                        <ins class="font-size-15 text-red text-decoration-none d-block">$1999.00</ins>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="mb-4">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="../shop/single-product-fullwidth.html" class="d-block width-75">
                                        <img class="img-fluid" src="../../assets/img/300X300/img10.png" alt="Image Description">
                                    </a>
                                </div>
                                <div class="col">
                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="../shop/single-product-fullwidth.html">Laptop Yoga 21 80JH0035GE W8.1</a></h3>
                                    <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <div class="font-weight-bold font-size-15">
                                        $1200.00
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> --}}
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                <!-- Shop-control-bar Title -->
                <div class="d-block d-md-flex flex-center-between mb-3">
                    @if($category != null)<h3 class="font-size-25 mb-2 mb-md-0">{{$category->getTranslation('name')}}</h3>@endif
                    
                    {{--
                    <p class="font-size-14 text-gray-90 mb-0">{{translate('Showing')}} {{$products->firstItem()}}-{{$products->lastItem()}} {{translate('of')}} {{$products->total()}} {{translate('results')}}</p>
                    --}}
                </div>
                <!-- End shop-control-bar Title -->
                <!-- Shop-control-bar -->
                <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                    <div class="d-xl-none">
                        <!-- Account Sidebar Toggle Button -->
                        <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                            aria-controls="sidebarContent1"
                            aria-haspopup="true"
                            aria-expanded="false"
                            data-unfold-event="click"
                            data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent1"
                            data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInLeft"
                            data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="500">
                            <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                        </a>
                        <!-- End Account Sidebar Toggle Button -->
                    </div>
                    <div class="px-3 d-none d-xl-block">
                        <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th-list"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex">
                        @isset($category)
                        <form id="sort_by" method="get" action="{{ route('products.category', $category->slug) }}"> 
                        @endisset
                        @empty($category)
                        <form id="sort_by" method="get" action="{{ route('search') }}">
                        @isset($category_id)
                        <input type="hidden" value="{{$category_id}}" name="category_id" >
                        @endisset
                        @endempty
                            <!-- Select -->

                            @isset($q)
                            <input type="hidden" value="{{$q}}" name="q" >
                            @endisset

                            <select name="sort_by" onchange="getSortBy()" class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"
                                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option value="" @empty($sort_by) selected @endempty>{{ translate('Default sorting')}}</option>
                                <option value="newest" @isset($sort_by) @if ($sort_by == 'newest') selected @endif @endisset>{{ translate('Newest')}}</option>
                                <option value="oldest" @isset($sort_by) @if ($sort_by == 'oldest') selected @endif @endisset>{{ translate('Oldest')}}</option>
                                <option value="price-asc" @isset($sort_by) @if ($sort_by == 'price-asc') selected @endif @endisset>{{ translate('Price low to high')}}</option>
                                <option value="price-desc" @isset($sort_by) @if ($sort_by == 'price-desc') selected @endif @endisset>{{ translate('Price high to low')}}</option>
                            </select>
                            <!-- End Select -->
                        </form>
                    </div>
                    {{--
                    <nav class="px-3 flex-horizontal-center text-gray-20 d-none d-xl-flex">
                        <form method="post" class="min-width-50 mr-1">
                            <input size="2" min="1" max="3" step="1" type="number" class="form-control text-center px-2 height-35" value="1">
                        </form> of 3
                        <a class="text-gray-30 font-size-20 ml-2" href="#">→</a>
                    </nav>
                    --}}
                </div>
                <!-- End Shop-control-bar -->
                <!-- Shop Body -->
                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters">
                            @foreach($products->items() as $product)
                            <li class="col-6 col-md-3 product-item" style="margin: 20px 0px;">
                                <div class="product-item__outer h-100 w-100">
                                    <div class="product-item__inner px-xl-4 p-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a href="{{ route('products.category', $product->category->slug) }}" class="font-size-12 text-gray-5">{{ \Illuminate\Support\Str::limit($product->category->getTranslation('name'), 20, $end='...') }}</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{ route('product', $product->slug) }}" class="text-blue font-weight-bold">{{ \Illuminate\Support\Str::limit($product->getTranslation('name'), 60, $end = '...') }}</a></h5>
                                            <div class="mb-2" >
                                                <a href="{{ route('product', $product->slug) }}" class="d-block text-center"><img class="prdt-img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="Image Description"></a>
                                            </div>
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <del class="text-gray-50">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                    @if (home_discounted_base_price($product->id) == '0đ')
                                                    <div class="text-gray-100">Liên Hệ</div>
                                                    @else
                                                    <div class="text-gray-100">{{ home_discounted_base_price($product->id) }}</div>
                                                    @endif
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{ route('product', $product->slug) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="{{route('compare.add', $product->id )}}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> {{translate('Compare')}}</a>
                                                <a href="{{route('wishlists.add', $product->id )}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> {{translate('Wishlist')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            {{-- <li class="product-item remove-divider">
                                <div class="product-item__outer w-100">
                                    <div class="product-item__inner remove-prodcut-hover py-4 row">
                                        <div class="product-item__header col-6 col-md-2">
                                            <div class="mb-2">
                                                <a href="{{ route('product', $product->slug) }}" class="d-block text-center"><img class="prdt-img" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="Image Description"></a>
                                            </div>
                                        </div>
                                        <div class="product-item__body col-6 col-md-7">
                                            <div class="pr-lg-10">
                                                <div class="mb-2"><a href="{{ route('products.category', $product->category->slug) }}" class="font-size-12 text-gray-5">{{ $product->category->getTranslation('name') }}</a></div>
                                                <h5 class="mb-2 product-item__title"><a href="{{ route('product', $product->slug) }}" class="text-blue font-weight-bold">{{$product->getTranslation('name')}}</a></h5>
                                                <div class="prodcut-price d-md-none">
                                                    @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <del class="text-gray-50">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                    @if (home_discounted_base_price($product->id) == '0đ')
                                                    <div class="text-gray-100">Liên Hệ</div>
                                                    @else
                                                    <div class="text-gray-100">{{ home_discounted_base_price($product->id) }}</div>
                                                    @endif
                                                    
                                                </div>
                                                
                                                <div class="mb-3 d-none d-md-block">
                                                    <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="{{ route('product', $product->slug) }}">
                                                        @php
                                                            $total = 0;
                                                            $total += $product->reviews->count();
                                                        @endphp
                                                        <div class="text-warning mr-2">
                                                            {{ renderStarRatingv2($product->rating) }}
                                                        </div>
                                                        <span class="text-secondary font-size-13">({{ $total }} {{ translate('reviews')}})</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer col-md-3 d-md-block">
                                            <div class="mb-2 flex-center-between">
                                                <div class="prodcut-price">
                                                    @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                    <del class="text-gray-50">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                    @if (home_discounted_base_price($product->id) == '0đ')
                                                    <div class="text-gray-100">Liên Hệ</div>
                                                    @else
                                                    <div class="text-gray-100">{{ home_discounted_base_price($product->id) }}</div>
                                                    @endif
                                                </div>
                                                <div class="prodcut-add-cart">
                                                    <a href="{{ route('product', $product->slug) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                            <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                                <a href="{{route('compare.add', $product->id )}}" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="{{route('wishlists.add', $product->id )}}" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- End Tab Content -->
                <!-- End Shop Body -->
                <!-- Shop Pagination -->
                {{ $products->links('vendor.pagination.list_product')}}
            </div>
        </div>
    </div>

    @if ($featuredCategories->count() > 0)
            <div class="mb-6 bg-gray-7 py-6">
                <div class="container">
                    <div
                        class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Danh Mục Nổi Bật</h3>
                    </div>
                    <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                        @foreach ($featuredCategories as $key => $category)

                            <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                                <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                                    <a href="{{ route('products.category', $category->slug) }}"
                                        class="d-block pr-2 pr-wd-6">
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
</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- Sidebar Navigation -->
<aside id="sidebarContent1" class="u-sidebar u-sidebar--left" aria-labelledby="sidebarNavToggler1">
    <div class="u-sidebar__scroller">
        <div class="u-sidebar__container">
            <div class="">
                <!-- Toggle Button -->
                <div class="d-flex align-items-center pt-3 px-4 bg-white">
                    <button type="button" class="close ml-auto"
                        aria-controls="sidebarContent1"
                        aria-haspopup="true"
                        aria-expanded="false"
                        data-unfold-event="click"
                        data-unfold-hide-on-scroll="false"
                        data-unfold-target="#sidebarContent1"
                        data-unfold-type="css-animation"
                        data-unfold-animation-in="fadeInLeft"
                        data-unfold-animation-out="fadeOutLeft"
                        data-unfold-duration="500">
                        <span aria-hidden="true"><i class="ec ec-close-remove"></i></span>
                    </button>
                </div>
                <!-- End Toggle Button -->

                <!-- Content -->
                <div class="js-scrollbar u-sidebar__body">
                    <div class="u-sidebar__content u-header-sidebar__content px-4">
                        <div class="mb-6 border border-width-2 border-color-3 borders-radius-6">
                            <!-- List -->
                            <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar">
                                <li>
                                    <a class="dropdown-toggle dropdown-toggle-collapse dropdown-title" href="javascript:;" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarNav1Collapse" data-target="#sidebarNav1Collapse">
                                        {{translate('Show All Categories')}}
                                    </a>

                                    <div id="sidebarNav1Collapse" class="collapse" data-parent="#sidebarNav">
                                        <ul id="sidebarNav1" class="list-unstyled dropdown-list">
                                            <!-- Menu List -->
                                            @foreach($categories as $c)
                                            <li><a class="dropdown-item" href="{{ route('products.category', $c->slug) }}">{{ \Illuminate\Support\Str::limit($c->getTranslation('name'), 22, $end='...') }}</a></li>
                                            @endforeach
                                            
                                            <!-- End Menu List -->
                                        </ul>
                                    </div>
                                </li>
                                @if($category)
                                <li>
                                    <a class="dropdown-current active">{{\Illuminate\Support\Str::limit($category->getTranslation('name'), 20, $end='...')}}</a>

                                    <ul class="list-unstyled dropdown-list">
                                        <!-- Menu List -->
                                        @foreach($category->childrenCategories as $children)
                                        <li><a class="dropdown-item" href="{{ route('products.category', $children->slug) }}">{{\Illuminate\Support\Str::limit($children->getTranslation('name'), 22, $end='...')}}</a></li>
                                        @endforeach
                                        <!-- End Menu List -->
                                    </ul>
                                </li>
                                @endif
                            </ul>
                            <!-- End List -->
                        </div>
                        <div class="mb-6">
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Filters</h3>
                            </div>
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Brands</h4>

                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="brandAdidas">
                                        <label class="custom-control-label" for="brandAdidas">Adidas
                                            <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="brandNewBalance">
                                        <label class="custom-control-label" for="brandNewBalance">New Balance
                                            <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="brandNike">
                                        <label class="custom-control-label" for="brandNike">Nike
                                            <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="brandFredPerry">
                                        <label class="custom-control-label" for="brandFredPerry">Fred Perry
                                            <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="brandTnf">
                                        <label class="custom-control-label" for="brandTnf">The North Face
                                            <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                        </label>
                                    </div>
                                </div>
                                <!-- End Checkboxes -->

                                <!-- View More - Collapse -->
                                <div class="collapse" id="collapseBrand">
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brandGucci">
                                            <label class="custom-control-label" for="brandGucci">Gucci
                                                <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brandMango">
                                            <label class="custom-control-label" for="brandMango">Mango
                                                <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- End View More - Collapse -->

                                <!-- Link -->
                                <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse" href="#collapseBrand" role="button" aria-expanded="false" aria-controls="collapseBrand">
                                    <span class="link__icon text-gray-27 bg-white">
                                        <span class="link__icon-inner">+</span>
                                    </span>
                                    <span class="link-collapse__default">Show more</span>
                                    <span class="link-collapse__active">Show less</span>
                                </a>
                                <!-- End Link -->
                            </div>
                            <div class="border-bottom pb-4 mb-4">
                                <h4 class="font-size-14 mb-3 font-weight-bold">Color</h4>

                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="categoryTshirt">
                                        <label class="custom-control-label" for="categoryTshirt">Black <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="categoryShoes">
                                        <label class="custom-control-label" for="categoryShoes">Black Leather <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="categoryAccessories">
                                        <label class="custom-control-label" for="categoryAccessories">Black with Red <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="categoryTops">
                                        <label class="custom-control-label" for="categoryTops">Gold <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                    </div>
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="categoryBottom">
                                        <label class="custom-control-label" for="categoryBottom">Spacegrey <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                    </div>
                                </div>
                                <!-- End Checkboxes -->

                                <!-- View More - Collapse -->
                                <div class="collapse" id="collapseColor">
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="categoryShorts">
                                            <label class="custom-control-label" for="categoryShorts">Turquoise <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="categoryHats">
                                            <label class="custom-control-label" for="categoryHats">White <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="categorySocks">
                                            <label class="custom-control-label" for="categorySocks">White with Gold <span class="text-gray-25 font-size-12 font-weight-normal"> (56)</span></label>
                                        </div>
                                    </div>
                                </div>
                                <!-- End View More - Collapse -->

                                <!-- Link -->
                                <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse" href="#collapseColor" role="button" aria-expanded="false" aria-controls="collapseColor">
                                    <span class="link__icon text-gray-27 bg-white">
                                        <span class="link__icon-inner">+</span>
                                    </span>
                                    <span class="link-collapse__default">Show more</span>
                                    <span class="link-collapse__active">Show less</span>
                                </a>
                                <!-- End Link -->
                            </div>
                            <div class="range-slider">
                                <h4 class="font-size-14 mb-3 font-weight-bold">{{translate('Price')}}</h4>
                                <!-- Range Slider -->
                                <input class="js-range-slider" type="text"
                                data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                                data-type="double"
                                data-grid="false"
                                data-hide-from-to="true"
                                data-prefix="đ"
                                data-min="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->min('unit_price') }} @endif"
                                data-max="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->max('unit_price') }} @endif"
                                @if (isset($min_price))
                                data-from="{{ $min_price }}"
                                @elseif($products->min('unit_price') > 0)
                                data-from="{{ $products->min('unit_price') }}"
                                @else
                                data-from="0"
                                @endif
                                @if (isset($max_price))
                                data-to="{{ $max_price }}"
                                @elseif($products->max('unit_price') > 0)
                                data-to="{{ $products->max('unit_price') }}"
                                @else
                                data-to="0"
                                @endif
                                data-result-min="#rangeMinResult"
                                data-result-max="#rangeMaxResult">
                                <!-- End Range Slider -->
                                <div class="mt-1 text-gray-111 d-flex mb-4">
                                    <span class="mr-0dot5">Price: </span>
                                    <span id="rangeMinResult" class=""></span>
                                    <span>đ</span>
                                    <span class="mx-0dot5"> — </span>
                                    <span id="rangeMaxResult" class=""></span>
                                    <span>đ</span>
                                </div>
                                <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg text-white">{{translate('Filter')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
    
    
</aside>
<!-- End Sidebar Navigation -->
@endsection

@section('css')
<link rel="stylesheet" href="{{static_asset('clever/vendor/ion-rangeslider/css/ion.rangeSlider.css') }}">
@endsection

@section('script')

<script>
    function getSortBy() {
        $('#sort_by').submit()
    }

    function sendFilter() {
        console.log($('#price-slider').attr('to'));
        console.log($('#price-slider').attr('from'));
    }

</script>