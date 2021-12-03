<!-- ========== FOOTER ========== -->
<footer>
    
    <!-- Footer-top-widget -->
    <div class="container d-none d-lg-block p-5">

        <div class="row bg-white pt-5 pl-3 pr-3">
            <div class="col-wd-4 col-lg-4">
                <div class="widget-column">
                    <div class="border-bottom border-color-1 mb-5 d-flex justify-content-between">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Liên Kết Doanh Nghiệp</h3>
                        {{-- <h5 class="font-size-14 mb-0"><a>Xem thêm</a></h5> --}}
                    </div>
                    <ul class="list-unstyled products-group">
                    @foreach(\App\Brand::where('category', 'Thương hiệu')->orderBy('top', 'asc')->take(3)->get() as $brand)
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="{{ $brand->link }}" target="_blank" class="d-block width-75 text-center"><img class="img-fluid" src="{{uploaded_asset($brand->logo)}}" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex align-items-center">
                            <h5 class="product-item__title mb-0"><a href="{{ $brand->link }}" target="_blank" class="text-blue font-weight-bold">{{ $brand->name }}</a></h5>
                       
                        </div>
                    </li>
                    @endforeach
                </ul>
                 <!--   
                    <ul class="list-unstyled products-group">
                        @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(3)->get() as $key => $product)
                        <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                            <div class="col-auto">
                                <a href="{{ route('product', $product->slug) }}" class="d-block width-75 text-center"><img class="img-fluid" src="{{ uploaded_asset($product->thumbnail_img) }}" alt="Image Description"></a>
                            </div>
                            <div class="col pl-4 d-flex flex-column">
                                <h5 class="product-item__title mb-0"><a href="{{ route('product', $product->slug) }}" class="text-blue font-weight-bold">{{ $product->getTranslation('name') }}</a></h5>
                                <div class="prodcut-price mt-auto">
                                    {{-- <div class="font-size-15">$1149.00</div> --}}
                                    @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                        <del
                                            class="font-size-15">{{ home_base_price($product->id) }}</del><br />
                                    @endif
                                    @if (home_discounted_base_price($product->id) == '0đ')
                                        <span class="font-size-15">Liên hệ</span>
                                    @else
                                        <span
                                            class="font-size-15">{{ home_discounted_base_price($product->id) }}</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                        
                    </ul>
                -->
                </div>
            </div>
            <div class="col-wd-4 col-lg-4">
                <div class="border-bottom border-color-1 mb-5 d-flex justify-content-between">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Liên Kết Bộ - Ban - Ngành</h3>
                    {{-- <h5 class="font-size-14 mb-0"><a>Xem thêm</a></h5> --}}
                </div>
                <ul class="list-unstyled products-group">
                    @foreach(\App\Brand::where('category', 'Bộ ban ngành')->orderBy('top', 'asc')->take(3)->get() as $brand)
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="{{ $brand->link }}" target="_blank" class="d-block width-75 text-center"><img class="img-fluid" src="{{uploaded_asset($brand->logo)}}" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex align-items-center">
                            <h5 class="product-item__title mb-0"><a href="{{ $brand->link }}" target="_blank" class="text-blue font-weight-bold">{{ $brand->name }}</a></h5>
                       
                        </div>
                    </li>
                    @endforeach
                </ul>
                    <!--{{-- <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="../shop/single-product-fullwidth.html" class="d-block width-75 text-center"><img class="img-fluid" src="https://transvelo.github.io/electro-html/2.0/assets/img/75X75/img5.jpg" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Camera C430W 4k Waterproof</a></h5>
                            <div class="prodcut-price mt-auto flex-horizontal-center">
                                <ins class="font-size-15 text-decoration-none">$899.00</ins>
                                <del class="font-size-12 text-gray-9 ml-2">$1200.00</del>
                            </div>
                        </div>
                    </li>
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="../shop/single-product-fullwidth.html" class="d-block width-75 text-center"><img class="img-fluid" src="https://transvelo.github.io/electro-html/2.0/assets/img/75X75/img6.jpg" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex flex-column">
                            <h5 class="product-item__title mb-0"><a href="../shop/single-product-fullwidth.html" class="text-blue font-weight-bold">Smartphone 6S 32GB LTE</a></h5>
                            <div class="prodcut-price mt-auto flex-horizontal-center">
                                <ins class="font-size-15 text-decoration-none">$2100.00</ins>
                                <del class="font-size-12 text-gray-9 ml-2">$3299.00</del>
                            </div>
                        </div>
                    </li> --}}
                -->
                </ul>
            </div>
            <div class="col-wd-4 col-lg-4">
                <div class="border-bottom border-color-1 mb-5 d-flex justify-content-between">
                    <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Liên Kết Viện Và Trường</h3>
                    {{-- <h5 class="font-size-14 mb-0"><a>Xem thêm</a></h5> --}}
                </div>
                <ul class="list-unstyled products-group">
                    @foreach(\App\Brand::where('category', 'Viện & Trường')->orderBy('top', 'asc')->take(3)->get() as $brand)
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="{{ $brand->link }}" target="_blank" class="d-block width-75 text-center"><img class="img-fluid" src="{{uploaded_asset($brand->logo)}}" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex align-items-center">
                            <h5 class="product-item__title mb-0"><a href="{{ $brand->link }}" target="_blank" class="text-blue font-weight-bold">{{ $brand->name }}</a></h5>
                       
                        </div>
                    </li>
                    @endforeach
                </ul>
                <!--
                <ul class="list-unstyled products-group">
                    @foreach(\App\Shop::join('sellers','sellers.user_id', '=', 'shops.user_id')->where('sellers.verification_status', 1)->take(3)->get() as $shop)
                    <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                        <div class="col-auto">
                            <a href="{{ route('shop.visit', $shop->slug) }}" class="d-block width-75 text-center"><img class="img-fluid" src="{{uploaded_asset($shop->logo)}}" alt="Image Description"></a>
                        </div>
                        <div class="col pl-4 d-flex align-items-center">
                            <h5 class="product-item__title mb-0"><a href="{{ route('shop.visit', $shop->slug) }}" class="text-blue font-weight-bold">{{ $shop->name }}</a></h5>
                       
                        </div>
                    </li>
                    @endforeach
                </ul>
                -->
            </div>
            {{-- <div class="col-wd-3 d-none d-wd-block">
                <a href="../shop/shop.html" class="d-block"><img class="img-fluid" src="{{ static_asset('clever/img/330X360/img1.jpg') }}" alt="Image Description"></a>
            </div> --}}
        </div>
    </div>
    <!-- End Footer-top-widget -->

    <!-- Brand Carousel -->
    @if (get_setting('top10_brands') != null)
    <div class="container mb-5">
        <div class="py-2 border-top border-bottom bg-white p-3">
            <div class="js-slick-carousel u-slick my-1" data-autoplay="true" data-speed="3000" data-slides-show="5" data-slides-scroll="4"
                data-pause-hover="true"
                data-infinite="true"
                data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"
                data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"
                data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right" data-responsive='[{
                        "breakpoint": 992,
                        "settings": {
                            "slidesToShow": 2
                        }
                    }, {
                        "breakpoint": 768,
                        "settings": {
                            "slidesToShow": 1
                        }
                    }, {
                        "breakpoint": 554,
                        "settings": {
                            "slidesToShow": 1
                        }
                    }]'>
                @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
                @foreach ($top10_brands as $key => $value)
                    @php $brand = \App\Brand::find($value); @endphp
                    @if ($brand != null)
                        <div class="js-slide">
                            <a href="{{ route('products.brand', $brand->slug) }}" class="link-hover__brand">
                                <img class="img-fluid m-auto max-height-50"
                                    src="{{ uploaded_asset($brand->logo) }}" alt="Image Description">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Brand Carousel -->
    @endif

        
    </div>
    <!-- Footer-newsletter -->
    <div class="bg-primary py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center text-white">
                        <div class="col-auto flex-horizontal-center">
                            <i class="ec ec-newsletter font-size-40"></i>
                            <h2 class="font-size-20 mb-0 ml-3">Đăng ký nhận thông tin</h2>
                        </div>
                        {{-- <div class="col my-4 my-md-0">
                            <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$20 coupon for first shopping.</strong></h5>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form class="js-validate js-form-message" method="post" action="{{ route('subscribers.store') }}">
                        @csrf
                        <label class="sr-only" for="subscribeSrEmail">{{ translate('Your Email Address') }}</label>
                        <div class="input-group input-group-pill">
                            <input type="email" class="form-control border-0 height-40" name="email" id="subscribeSrEmail" placeholder="{{ translate('Your Email Address') }}" aria-label="{{ translate('Your Email Address') }}" aria-describedby="subscribeButton" required
                            data-msg="Vui lòng nhập đúng địa chỉ email.">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2" id="subscribeButton">{{ translate('Subscribe') }}</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-newsletter -->
    <!-- Footer-bottom-widgets -->
    <div class="pt-8 pb-4 text-white" style="background-color: #232F3E;">
        <div class="container mt-1">
            <div class="row">
                <div class="col-lg-5">
                    <div class="mb-6 d-none d-md-block">
                        <a href="{{ route('home') }}" class="d-inline-block">
                            @if(get_setting('footer_logo') != null)
                                <img style="max-width: 300px;" class="img-fluid" src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="44">
                            @else
                                <img  style="max-width: 300px;" class="img-fluid" src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="44">
                            @endif
                        </a>
                    </div>
                    <div class="mb-4">
                        <div class="row no-gutters">
                            @php
                                echo get_setting('about_us_description');
                            @endphp
                        </div>
                    </div>

                    <div class="my-4 my-md-4">
                        <ul class="list-inline mb-0">
                            @if ( get_setting('facebook_link') !=  null )
                            <li class="list-inline-item mr-0">
                                <a style="background-color: #EAEDED" class="btn font-size-20 btn-icon btn-soft-facebook rounded-circle" target="_blank" href="{{ get_setting('facebook_link') }}">
                                    <span class="fab fa-facebook-f btn-icon__inner"></span>
                                </a>
                            </li>
                            @endif
                            @if ( get_setting('tiktok_link') !=  null )
                            <li class="list-inline-item mr-0">
                                <a style="background-color: #EAEDED" class="btn font-size-20 btn-icon btn-soft-facebook rounded-circle contain-img" target="_blank" href="{{ get_setting('tiktok_link') }}">
                                <img src="/amazonvn/public/assets/img/Tiktok.png">
                                </a>
                            </li>
                            @endif
                            @if ( get_setting('youtube_link') !=  null )
                            <li class="list-inline-item mr-0">
                                <a style="background-color: #EAEDED" class="btn font-size-20 btn-icon btn-soft-red btn-bg-transparent" href="{{ get_setting('youtube_link') }}">
                                    <span class="fab fa-youtube btn-icon__inner"></span>
                                </a>
                            </li>
                            @endif
                            @if ( get_setting('lotus_link') !=  null )
                            <li class="list-inline-item mr-0">
                                <a style="background-color: #EAEDED" class="btn font-size-20 btn-icon btn-soft-red btn-bg-transparent contain-img" href="{{ get_setting('lotus_link') }}">
                                    <img src="/amazonvn/public/assets/img/Lotus.png">
                                </a>
                            </li>
                            @endif
                            @if ( get_setting('zalo_link') !=  null )
                            <li class="list-inline-item mr-0">
                                <a style="background-color: #EAEDED" class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle contain-img" href="{{ get_setting('zalo_link') }}">
                                    <img src="/amazonvn/public/assets/img/Zalo.png">
                                </a>
                            </li>
                            @endif
                            @if ( get_setting('messenger_link') !=  null )
                            <li class="list-inline-item mr-0">
                                <a style="background-color: #EAEDED" class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle contain-img" href="{{ get_setting('messenger_link') }}">
                                    <img src="/amazonvn/public/assets/img/Mes.png">
                                </a>
                            </li>
                            @endif
                            @if ( get_setting('twitter_link') !=  null )
                            <li class="list-inline-item mr-0">
                                <a style="background-color: #EAEDED" class="btn font-size-20 btn-icon btn-soft-twitter btn-bg-transparent rounded-circle" href="{{ get_setting('twitter_link') }}">
                                    <span class="fab fa-twitter btn-icon__inner"></span>
                                </a>
                            </li>
                            @endif
                            @if ( get_setting('telegram_link') !=  null )
                            <li class="list-inline-item mr-0">
                                <a style="background-color: #EAEDED" class="btn font-size-20 btn-icon btn-soft-facebook btn-bg-transparent rounded-circle contain-img" href="{{ get_setting('telegram_link') }}">
                                    <img src="/amazonvn/public/assets/img/Tele.png">
                                </a>
                            </li>
                            @endif
                            <!-- @if ( get_setting('linkedin_link') !=  null )
                            <li class="list-inline-item mr-0">
                                <a style="background-color: #EAEDED" class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{ get_setting('linkedin_link') }}">
                                    <span class="fab fa-linkedin btn-icon__inner"></span>
                                </a>
                            </li>
                            @endif -->

                        </ul>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        {{-- <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">{{ translate('Contact Info') }}</h6>
                            <!-- List Group -->
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                   <span class="font-weight-bold">{{ translate('Address') }}:</span>
                                   <address class="">{{ get_setting('contact_address') }}</address>
                                </li>
                                <li class="mb-2">
                                   <span class="font-weight-bold">{{translate('Phone')}}:</span>
                                   <span class="">{{ get_setting('contact_phone') }}</span>
                                </li>
                                <li class="mb-2">
                                   <span class="font-weight-bold">{{translate('Email')}}:</span>
                                   <span class="">
                                       <a href="mailto:{{ get_setting('contact_email') }}" class="text-reset">{{ get_setting('contact_email')  }}</a>
                                    </span>
                                </li>
                            </ul>
                            <!-- End List Group -->
                        </div> --}}

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <!-- List Group -->
                            <h6 class="mb-3 font-weight-bold">{{ get_setting('widget_one') }}</h6>
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                @if ( get_setting('widget_one_labels') !=  null )
                                    @foreach (json_decode( get_setting('widget_one_labels'), true) as $key => $value)
                                    <li><a class="list-group-item list-group-item-action text-white" href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}">{{ $value }}</a></li>

                                    @endforeach
                                @endif
                                    <li><a class="list-group-item list-group-item-action text-white" href=" https://amazonvietnam.com.vn/qtkth">Quy trình kiểm tra đơn đặt hàng</a></li>
                            </ul>
                            <!-- End List Group -->
                        </div>

                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">{{ translate('My Account') }}</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                {{-- <li><a class="list-group-item list-group-item-action text-white"  href="../shop/my-account.html">{{ translate('My Account') }}</a></li> --}}
                                @if (Auth::check())
                                <li><a class="list-group-item list-group-item-action text-white" href="{{ route('logout') }}">{{ translate('Logout') }}</a></li>
                                @else
                                <li><a class="list-group-item list-group-item-action text-white" href="{{ route('user.login') }}">{{ translate('Login') }}</a></li>
                                @endif
                                <li><a class="list-group-item list-group-item-action text-white" href="{{ route('wishlists.index') }}">{{ translate('Wishlist') }}</a></li>
                                <li><a class="list-group-item list-group-item-action text-white" href="{{ route('purchase_history.index') }}">{{ translate('Order History') }}</a></li>
                                <li><a class="list-group-item list-group-item-action  text-white" href="{{ route('faq') }}">{{ translate('FAQ') }}</a></li>
                                <li><a class="list-group-item list-group-item-action btn  text-white" href="{{ route('shops.create') }}">{{ translate('Be a Seller') }}</a></li>                            </ul>

                            <div class="mt-2">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <i sh class="ec ec-support text-white font-size-56"></i>
                                    </div>
                                    <div class="col pl-3">
                                        <div class="font-size-13 font-weight-light">{{ translate('Support Hotline') }}</div>
                                        <a href="tel:+84888819966" class="font-size-20 text-white">0888819966</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End List Group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-bottom-widgets -->
    <!-- Footer-copy-right -->
    <div class="bg-gray-14 py-2">
        <div class="container">
            <div class="flex-center-between d-block d-md-flex">
                <div class="mb-3 mb-md-0">
                    @php
                        echo get_setting('frontend_copyright_text');
                    @endphp
                </div>
                <div class="text-md-right">
                    @if ( get_setting('payment_method_images') !=  null )
                        @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                            <span class="d-inline-block bg-white border rounded p-1">
                                <img class="max-width-30" src="{{ uploaded_asset($value) }}" alt="Image Description" height="30">
                            </span>
                        @endforeach
                    @endif
                    {{-- <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="{{ static_asset('clever/img/100X60/img1.jpg') }}" alt="Image Description">
                    </span>
                    <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="{{ static_asset('clever/img/100X60/img2.jpg') }}" alt="Image Description">
                    </span>
                    <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="{{ static_asset('clever/img/100X60/img3.jpg') }}" alt="Image Description">
                    </span>
                    <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="{{ static_asset('clever/img/100X60/img4.jpg') }}" alt="Image Description">
                    </span>
                    <span class="d-inline-block bg-white border rounded p-1">
                        <img class="max-width-5" src="{{ static_asset('clever/img/100X60/img5.jpg') }}" alt="Image Description">
                    </span> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-copy-right -->
</footer>
<!-- ========== END FOOTER ========== -->