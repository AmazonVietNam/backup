
@extends('frontend-v2.layouts.app')

@section('title', $detailedProduct->getTranslation('name'))

@section('meta_image', uploaded_asset($detailedProduct->thumbnail_img))
@section('meta_title', $detailedProduct->meta_title)
@section('meta_description') {{ strip_tags($detailedProduct->meta_description) }} @endsection
@section('meta_keywords', $detailedProduct->tags)

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
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('home') }}">{{translate('Home')}}</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ route('products.category', $detailedProduct->category->slug) }}">{{$detailedProduct->category->getTranslation('name')}}</a></li>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ $detailedProduct->getTranslation('name') }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->
            <div class="container">
                <!-- Single Product Body -->
                <div class="mb-xl-14 mb-6">
                    <div class="row">
                        <div class="col-md-5 mb-4 mb-md-0">
                            @php
                                $photos = explode(',',$detailedProduct->photos);
                            @endphp
                            <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"
                                data-infinite="true"
                                data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                                data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                                data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                                data-nav-for="#sliderSyncingThumb">
                                @foreach ($photos as $key => $photo)
                                <div class="js-slide">
                                    <img class="img-fluid" src="{{ uploaded_asset($photo) }}" alt="Image Description">
                                </div>
                                @endforeach
                            </div>

                            <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                                data-infinite="true"
                                data-slides-show="5"
                                data-is-thumbs="true"
                                data-nav-for="#sliderSyncingNav">
                                @foreach ($photos as $key => $photo)
                                <div class="js-slide">
                                    <img class="img-fluid" src="{{ uploaded_asset($photo) }}" alt="Image Description">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-7 mb-md-6 mb-lg-0">
                            <div class="mb-2">
                                <form id="formDetails" action="{{ route('cart.addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value={{ $detailedProduct->id }} >

                                    <div class="border-bottom mb-3 pb-md-1 pb-3">
                                        <a href="{{ route('products.category', $detailedProduct->category->slug) }}" class="font-size-12 text-gray-5 mb-2 d-inline-block">{{$detailedProduct->category->getTranslation('name')}}</a>
                                        <h2 class="font-size-25 text-lh-1dot2">{{$detailedProduct->getTranslation('name')}}</h2>
                                        <div class="mb-2">
                                            <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                            
                                                <div class="text-warning mr-2">
                                                    {{ renderStarRatingv2($detailedProduct->rating) }}
                                                </div>
                                                <span class="text-secondary font-size-13">({{ $detailedProduct->reviews->count() }} {{ translate('reviews')}})</span>
                                            </a>
                                        </div>
                                        <div class="d-md-flex align-items-center">
                                            @if(!empty($detailedProduct->user->shop->slug))
                                            <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="max-width-150 mb-2 mb-md-0 d-block">{{ $detailedProduct->user->shop->name }}</a>
                                            @endif
                                            
                                            @php
                                            $qty = 0;
                                            if($detailedProduct->variant_product){
                                                foreach ($detailedProduct->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                }
                                            }
                                            else{
                                                $qty = $detailedProduct->current_stock;
                                            }
                                        @endphp
                                            <div class="ml-md-3 text-gray-9 font-size-14">Hàng Còn: <span class="text-green font-weight-bold">{{$qty}} trong kho</span></div>
                                            @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                                                <div class="btn-sm btn-group-sm">
                                                    <a class="btn btn-secondary" style="cursor: pointer;" onclick="showMessageModal()"><i
                                                        class="ec ec-mail mr-1"></i>{{ translate('Message Seller')}}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-horizontal-center flex-wrap mb-4">
                                        <a href="{{route('wishlists.add', $detailedProduct->id )}}" class="text-gray-6 font-size-13 mr-2"><i class="ec ec-favorites mr-1 font-size-15"></i> {{ translate('Wishlist') }}</a>
                                        <a href="{{route('compare.add', $detailedProduct->id )}}" class="text-gray-6 font-size-13 ml-2"><i class="ec ec-compare mr-1 font-size-15"></i> {{ translate('Compare') }}</a>
                                    </div>
                                    {{-- <div class="mb-2">
                                        <ul class="font-size-14 pl-3 ml-1 text-gray-110">
                                            <li>4.5 inch HD Touch Screen (1280 x 720)</li>
                                            <li>Android 4.4 KitKat OS</li>
                                            <li>1.4 GHz Quad Core™ Processor</li>
                                            <li>20 MP Electro and 28 megapixel CMOS rear camera</li>
                                        </ul>
                                    </div> --}}
                                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p> --}}
                                    {{-- <p><strong>SKU</strong>: FW511948218</p> --}}
                                    <div class="mb-4">
                                        <div class="d-flex align-items-baseline">
                                            @if (home_discounted_base_price($detailedProduct->id) == '0đ')
                                            <ins class="font-size-36 text-decoration-none">Liên hệ</ins>
                                            @else
                                            <ins class="font-size-36 text-decoration-none">{{ home_discounted_base_price($detailedProduct->id) }}</ins>
                                            @endif
                                            @if (home_base_price($detailedProduct->id) != home_discounted_base_price($detailedProduct->id))
                                            <del class="font-size-20 ml-2 text-sale">{{ home_base_price($detailedProduct->id) }}</del>
                                            @endif
                                        </div>
                                    </div>
                                    @if ($detailedProduct->choice_options != null)
                                        @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                        <div class="border-top border-bottom py-3 mb-4">
                                            <div class="d-flex align-items-center">
                                                <h6 class="font-size-14 mb-0 mr-5">Size</h6>
                                                <!-- Select -->
                                                @foreach ($choice->values as $key => $value)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="{{ $choice->attribute_id }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}">
                                                    <label class="form-check-label" for="{{ $choice->attribute_id }}">{{ $value }}</label>
                                                </div>
                                                @endforeach
                                                <!-- End Select -->
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                    @if (count(json_decode($detailedProduct->colors)) > 0)
                                    <div class="border-top border-bottom py-3 mb-4">
                                        <div class="d-flex align-items-center">
                                            <h6 class="font-size-14 mb-0">Color</h6>
                                            <!-- Select -->
                                            <select class="js-select selectpicker dropdown-select ml-3"
                                                data-style="btn-sm bg-white font-weight-normal py-2 border">
                                                @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                <option data-content="<i style='border-radius: 2px;border:1px solid black;color: {{ $color }};' class='fa fa-square'></i> {{ \App\Color::where('code', $color)->first()->name }}" value="{{ $color }}"
                                                @if($key == 0) checked @endif
                                                ></option>
                                                @endforeach
                                            </select>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    @endif
                                    <div class="d-md-flex align-items-end mb-3">
                                        <div class="max-width-150 mb-4 mb-md-0">
                                            <h6 class="font-size-14">{{ translate('Quantity')}}</h6>
                                            <!-- Quantity -->
                                            <div class="border rounded-pill py-2 px-3 border-color-1">
                                                <div class="js-quantity row align-items-center">
                                                    <div class="col">
                                                        <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none" name="quantity" type="text" value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}" max="{{ $qty }}">
                                                    </div>
                                                    <div class="col-auto pr-1">
                                                        <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                            <small class="fas fa-minus btn-icon__inner"></small>
                                                        </a>
                                                        <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                            <small class="fas fa-plus btn-icon__inner"></small>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Quantity -->
                                        </div>
                                        <div class="ml-md-3">
                                            @if (home_discounted_base_price($detailedProduct->id) != '0đ')
                                            <button type="submit" class="btn px-5 btn-primary-dark transition-3d-hover"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> {{ translate('Add to cart')}}</button>
                                            @endif
                                        </div>
                                    </div>
                                    @if (home_discounted_base_price($detailedProduct->id) != '0đ')
                                    <a href="javascript:;" onclick="onBuyNow()" class="btn px-5 btn-warning btn-block w-50 transition-3d-hover">{{ translate('Buy now')}}</a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Product Body -->
                <!-- Single Product Tab -->
                <div class="mb-8">
                    <div class="position-relative position-md-static px-md-6">
                        <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                            {{-- <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">Phụ Kiện</a>
                            </li> --}}
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">Mô Tả</a>
                            </li>
                            {{-- <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Thông Số</a>
                            </li> --}}
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">Đánh Giá</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab Content -->
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">
                            {{-- <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                                <div class="row no-gutters">
                                    <div class="col mb-6 mb-md-0">
                                        <ul class="row list-unstyled products-group no-gutters border-bottom border-md-bottom-0">
                                            <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down border-0">
                                                <div class="product-item__outer h-100">
                                                    <div class="remove-prodcut-hover product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2 d-none d-md-block"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>
                                                            <div class="mb-2">
                                                                <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ static_asset('clever/img/212X200/img1.jpg') }}" alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1 d-none d-md-block">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down">
                                                <div class="product-item__outer h-100">
                                                    <div class="remove-prodcut-hover add-accessories product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2 d-none d-md-block"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>
                                                            <div class="mb-2">
                                                                <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ static_asset('clever/img/212X200/img2.jpg') }}" alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1 d-none d-md-block">
                                                                <div class="prodcut-price d-flex align-items-center position-relative">
                                                                    <ins class="font-size-20 text-red text-decoration-none">$1999,00</ins>
                                                                    <del class="font-size-12 tex-gray-6 position-absolute bottom-100">$2 299,00</del>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down remove-divider">
                                                <div class="product-item__outer h-100">
                                                    <div class="remove-prodcut-hover add-accessories product-item__inner px-xl-4 p-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            <div class="mb-2 d-none d-md-block"><a href="../shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>
                                                            <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Purple Solo 2 Wireless</a></h5>
                                                            <div class="mb-2">
                                                                <a href="../shop/single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{ static_asset('clever/img/212X200/img3.jpg') }}" alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1 d-none d-md-block">
                                                                <div class="prodcut-price">
                                                                    <div class="text-gray-100">$685,00</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                            <input class="form-check-input" type="checkbox" value="" id="inlineCheckbox1" checked disabled>
                                            <label class="form-check-label mb-1" for="inlineCheckbox1">
                                                <strong>This product: </strong> Ultra Wireless S50 Headphones S50 with Bluetooth - <span class="text-red font-size-16">$35.00</span>
                                            </label>
                                        </div>
                                        <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option1" checked>
                                            <label class="form-check-label mb-1 text-blue" for="inlineCheckbox2">
                                                <span class="text-decoration-on cursor-pointer-on">Universal Headphones Case in Black</span> - <span class="text-red font-size-16">$159.00</span>
                                            </label>
                                        </div>
                                        <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option2" checked>
                                            <label class="form-check-label mb-1 text-blue" for="inlineCheckbox3">
                                                <span class="text-decoration-on cursor-pointer-on">Headphones USB Wires</span> - <span class="text-red font-size-16">$50.00</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <div class="mr-xl-15">
                                            <div class="mb-3">
                                                <div class="text-red font-size-26 text-lh-1dot2">10,000,000đ</div>
                                                <div class="text-gray-6">cho 3 sản phẩm</div>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-block btn-primary-dark btn-wide transition-3d-hover">{{ translate('Add to cart')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="tab-pane fade active show" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                                
                                @php echo $detailedProduct->getTranslation('description'); @endphp

                                <ul class="nav flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1"><strong>SKU:</strong> <span class="sku">FW511948218</span></li>
                                    <li class="nav-item text-gray-111 mx-3 flex-shrink-0 flex-xl-shrink-1">/</li>
                                    <li class="nav-item text-gray-111 flex-shrink-0 flex-xl-shrink-1"><strong>Danh mục:</strong> <a href="{{ route('products.category', $detailedProduct->category->slug) }}" class="text-blue">{{ $detailedProduct->category->getTranslation('name') }}</a></li>
                                </ul>
                            </div>
                            {{-- <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">
                                <div class="mx-md-5 pt-1">
                                    <div class="table-responsive mb-4">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="px-4 px-xl-5 border-top-0">Weight</th>
                                                    <td class="border-top-0">7.25kg</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Dimensions</th>
                                                    <td>90 x 60 x 90 cm</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Size</th>
                                                    <td>One Size Fits all</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">color</th>
                                                    <td>Black with Red, White with Gold</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Guarantee</th>
                                                    <td>5 years</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h3 class="font-size-18 mb-4">Technical Specifications</h3>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="px-4 px-xl-5 border-top-0">Brand</th>
                                                    <td class="border-top-0">Apple</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Item Height</th>
                                                    <td>18 Millimeters</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Item Width</th>
                                                    <td>31.4 Centimeters</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Screen Size</th>
                                                    <td>13 Inches</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Item Weight</th>
                                                    <td>1.6 Kg</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Product Dimensions</th>
                                                    <td>21.9 x 31.4 x 1.8 cm</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Item model number</th>
                                                    <td>MF841HN/A</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Processor Brand</th>
                                                    <td>Intel</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Processor Type</th>
                                                    <td>Core i5</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Processor Speed</th>
                                                    <td>2.9 GHz</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">RAM Size</th>
                                                    <td>8 GB</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Hard Drive Size</th>
                                                    <td>512 GB</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Hard Disk Technology</th>
                                                    <td>Solid State Drive</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Graphics Coprocessor</th>
                                                    <td>Intel Integrated Graphics</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Graphics Card Description</th>
                                                    <td>Integrated Graphics Card</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Hardware Platform</th>
                                                    <td>Mac</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Operating System</th>
                                                    <td>Mac OS</td>
                                                </tr>
                                                <tr>
                                                    <th class="px-4 px-xl-5">Average Battery Life (in hours)</th>
                                                    <td>9</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                                <div class="row mb-8">
                                    @if($detailedProduct->reviews->count() > 0)

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h3 class="font-size-18 mb-6">{{ $detailedProduct->reviews->count() }} {{ translate('reviews')}}</h3>
                                            <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">{{ $ratingAvg }}</h2>
                                            <div class="text-lh-1">tổng</div>
                                        </div>

                                        <!-- Ratings -->
                                        <ul class="list-unstyled">
                                            @foreach($overallRatings as $rate)
                                            <li class="py-1">
                                                <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                            @for($i = 0, $j = $rate->rating; $i < 5; $i++)
                                                                @if($i < $j)
                                                                <small class="fas fa-star"></small>
                                                                @else
                                                                <small class="far fa-star text-muted"></small>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="col-auto mb-2 mb-md-0">
                                                        <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                            <div class="progress-bar" role="progressbar" style="width: {{ ($rate->amount / $detailedProduct->reviews->count()) * 100 }}%;" aria-valuenow="{{ ($rate->amount / $detailedProduct->reviews->count()) * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-auto text-right">
                                                        <span class="text-gray-90">{{ $rate->amount }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <!-- End Ratings -->
                                    </div>
                                    @endif
                                    
                                    <div class="col-md-6">
                                        @auth
                                        @php
                                            $commentable = false;
                                        @endphp
                                        @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                            @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                                @php
                                                    $commentable = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if ($commentable)
                                        <h3 class="font-size-18 mb-5">{{ translate('Write a review')}}</h3>
                                        <!-- Form -->
                                        <form class="js-validate" action="{{ route('reviews.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                            <div class="row align-items-center mb-4">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="rating" class="form-label mb-0">{{ translate('Rating')}}</label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <div class="d-block">
                                                        <div class="text-warning text-ls-n2 font-size-16 rating rating-input">
                                                            <label>
                                                                <input type="radio" name="rating" value="1" checked>
                                                                <small class="far fa-star"></small>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="2">
                                                                <small class="far fa-star"></small>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="3">
                                                                <small class="far fa-star"></small>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="4">
                                                                <small class="far fa-star"></small>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="5">
                                                                <small class="far fa-star"></small>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="js-form-message form-group mb-3 row">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="descriptionTextarea" class="form-label">{{ translate('Comment')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <textarea name="comment" class="form-control" rows="3" id="descriptionTextarea"
                                                    data-msg="Please enter your message."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success" reqired></textarea>
                                                </div>
                                            </div>
                                            <div class="js-form-message form-group mb-3 row">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="inputName" class="form-label">{{ translate('Your name')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" id="inputName" aria-label="Alex Hecker" disabled required
                                                    data-msg="Please enter your name."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                            <div class="js-form-message form-group mb-3 row">
                                                <div class="col-md-4 col-lg-3">
                                                    <label for="emailAddress" class="form-label">{{ translate('Email')}} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="email" class="form-control" name="email" id="emailAddress" value="{{ Auth::user()->email }}" disabled required
                                                    data-msg="Please enter a valid email address."
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="offset-md-4 offset-lg-3 col-auto">
                                                    <button type="submit" class="btn btn-primary-dark btn-wide transition-3d-hover">Thêm</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End Form -->
                                        @endif
                                        @else
                                            <a href="{{ route('user.login') }}" class="btn px-5 btn-primary-dark btn-block w-50 transition-3d-hover">{{ translate('Please login first') }}</a>
                                        @endauth
                                    </div>
                                </div>
                                <!-- Review -->
                                @if(count($detailedProduct->reviews) <= 0)
                                        <div class="text-center fs-18 opacity-70">
                                            {{  translate('There have been no reviews for this product yet.') }}
                                        </div>
                                @else
                                    @foreach ($reviews as $key => $review)
                                
                                    <div class="border-bottom border-color-1 pb-4 mb-4">
                                        <!-- Review Rating -->
                                        <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                                            <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                {{ renderStarRatingv2($review->rating) }}
                                            </div>
                                        </div>
                                        <!-- End Review Rating -->

                                        <p class="text-gray-90">{{ $review->comment }}</p>

                                        <!-- Reviewer -->
                                        <div class="mb-2">
                                            <strong>{{ $review->user->name }}</strong>
                                            <span class="font-size-13 text-gray-23"> - {{ date('d-m-Y', strtotime($review->created_at)) }}</span>
                                        </div>
                                        <!-- End Reviewer -->
                                    </div>
                                    @endforeach

                                    {{ $reviews->links('vendor.pagination.list_product')}}
                                @endif
                                <!-- End Review -->
                            </div>
                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Single Product Tab -->
                <!-- Related products -->
                <div class="mb-6">
                    <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                        <h3 class="section-title mb-0 pb-2 font-size-22">{{translate('Related Products')}}</h3>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters">
                        @foreach (filter_products(\App\Product::where('category_id', $detailedProduct->category_id)->where('id', '!=', $detailedProduct->id))->limit(6)->get() as $key => $related_product)
                        <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">
                                        <div class="mb-2"><a href="{{route('products.category', $related_product->category->slug) }}" class="font-size-12 text-gray-5">{{ $related_product->category->getTranslation('name') }}</a></div>
                                        <h5 class="mb-1 product-item__title"><a href="{{route('product', $related_product->slug) }}" class="text-blue font-weight-bold">{{ $related_product->getTranslation('name') }}</a></h5>
                                        <div class="mb-2">
                                            <a href="{{route('product', $related_product->slug) }}" class="d-block text-center"><img class="prdt-img" src="{{ uploaded_asset($related_product->thumbnail_img) }}" alt="Image Description"></a>
                                        </div>
                                        <div class="flex-center-between mb-1">
                                            <div class="prodcut-price">
                                                {{-- <div class="text-gray-100">$685,00</div> --}}
                                                @if (home_base_price($related_product->id) != home_discounted_base_price($related_product->id))
                                                    <div
                                                        class="text-gray-100">{{ home_base_price($related_product->id) }}</div><br />
                                                @endif
                                                @if (home_discounted_base_price($related_product->id) == '0đ')
                                                    <div class="text-gray-100">Liên hệ</div>
                                                @else
                                                    <div
                                                        class="text-gray-100">{{ home_discounted_base_price($related_product->id) }}</span>
                                                @endif
                                            </div>
                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                <a href="../shop/single-product-fullwidth.html" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <a href="{{route('compare.add', $related_product->id )}}" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> {{ translate('Compare') }}</a>
                                            <a href="javascript:;" onclick="addToWishList({{ $related_product->id }})" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> {{ translate('Wishlist') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                <!-- End Related products -->
                
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
        <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
                <div class="modal-content position-relative">
                    <div class="modal-header">
                        <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                        <div class="modal-body gry-bg px-3 pt-3">
                            <div class="form-group">
                                <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary fw-600" data-dismiss="modal">{{ translate('Cancel')}}</button>
                            <button type="submit" class="btn btn-primary fw-600">{{ translate('Send')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('extended_scripts')
    <script src="{{ static_asset('clever/js/components/hs.quantity-counter.js') }}"></script>

    <script defer>
        $(document).on('ready', function() {
            $.HSCore.components.HSQantityCounter.init('.js-quantity');

            $(".rating-input").each(function () {
                $(this)
                    .find("label")
                    .on({
                        mouseover: function (event) {
                            $(this).find("small").addClass("hover");
                            $(this).prevAll().find("small").addClass("hover");
                        },
                        mouseleave: function (event) {
                            $(this).find("small").removeClass("hover");
                            $(this).prevAll().find("small").removeClass("hover");
                        },
                        click: function (event) {
                            $(this).siblings().find("small").removeClass("fas").addClass("far");
                            $(this).find("small").removeClass("far").addClass("fas");
                            $(this).prevAll().find("small").removeClass("far").addClass("fas");
                        },
                    });
                
            });
        })

        function onBuyNow() {
            // $("#formDetails").submit()

            $('#formDetails').attr('action', "{{ route('cart.buyNow') }}").submit();
            
        }

        function showMessageModal(){
            $('#chat_modal').modal('show');
        }
    </script>
@endsection