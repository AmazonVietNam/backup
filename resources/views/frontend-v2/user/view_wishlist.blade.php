@extends('frontend-v2.layouts.dashboard')

@section('content')
<!-- Shop-control-bar Title -->
<div class="d-block d-md-flex flex-center-between mb-3 border-bottom">
    <h3 class="font-size-25 mb-2 mb-md-0">{{translate('Wishlists')}}</h3>
    @if($wishlists->count() > 0)<p class="font-size-14 text-gray-90 mb-0">Showing {{$wishlists->firstItem()}}-{{$wishlists->lastItem()}} of {{$wishlists->total()}} results</p>@endif
</div>
<!-- End Shop-control-bar -->
<!-- Shop Body -->
<!-- Tab Content -->
@if($wishlists->count() > 0)
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade pt-2 show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab" data-target-group="groups">
        
        <ul class="d-block list-unstyled products-group prodcut-list-view-small">
            @foreach($wishlists as $key => $wishlist)
            @if ($wishlist->product != null)
            <li class="product-item remove-divider">
                <div class="product-item__outer w-100">
                    <div class="product-item__inner remove-prodcut-hover py-4 row">
                        <div class="product-item__header col-6 col-md-2">
                            <div class="mb-2">
                                <a href="{{ route('product', $wishlist->product->slug) }}" class="d-block text-center"><img class="prdt-img" src="{{ uploaded_asset($wishlist->product->thumbnail_img) }}" alt="Image Description"></a>
                            </div>
                        </div>
                        <div class="product-item__body col-6 col-md-7">
                            <div class="pr-lg-10">
                                <div class="mb-2"><a href="{{ route('products.category', $wishlist->product->category->slug) }}" class="font-size-12 text-gray-5">{{ $wishlist->product->category->getTranslation('name') }}</a></div>
                                <h5 class="mb-2 product-item__title"><a href="{{ route('product', $wishlist->product->slug) }}" class="text-blue font-weight-bold">{{$wishlist->product->getTranslation('name')}}</a></h5>
                                <div class="prodcut-price d-md-none">
                                    @if (home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id))
                                    <del class="text-gray-50">{{ home_base_price($wishlist->product->id) }}</del>
                                    @endif
                                    @if (home_discounted_base_price($wishlist->product->id) == '0đ')
                                    <div class="text-gray-100">Liên Hệ</div>
                                    @else
                                    <div class="text-gray-100">{{ home_discounted_base_price($wishlist->product->id) }}</div>
                                    @endif
                                    
                                </div>
                                
                                <div class="mb-3 d-none d-md-block">
                                    <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="{{ route('product', $wishlist->product->slug) }}">
                                        @php
                                            $total = 0;
                                            $total += $wishlist->product->reviews->count();
                                        @endphp
                                        <div class="text-warning mr-2">
                                            {{ renderStarRatingv2($wishlist->product->rating) }}
                                        </div>
                                        <span class="text-secondary font-size-13">({{ $total }} {{ translate('reviews')}})</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-item__footer col-md-3 d-md-block">
                            <div class="mb-2 flex-center-between">
                                <div class="prodcut-price">
                                    @if (home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id))
                                    <del class="text-gray-50">{{ home_base_price($wishlist->product->id) }}</del>
                                    @endif
                                    @if (home_discounted_base_price($wishlist->product->id) == '0đ')
                                    <div class="text-gray-100">Liên Hệ</div>
                                    @else
                                    <div class="text-gray-100">{{ home_discounted_base_price($wishlist->product->id) }}</div>
                                    @endif
                                </div>
                                <div class="prodcut-add-cart">
                                    <a href="{{ route('product', $wishlist->product->slug) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                </div>
                            </div>
                            <div class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                <a href="{{route('compare.add', $wishlist->product->id )}}" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-compare mr-1 font-size-15"></i> {{translate('Compare')}}</a>
                                <a href="{{ route('wishlists.remove_new', $wishlist->id) }}" class="text-gray-6 font-size-13 mx-wd-3"><i class="ec ec-close-remove mr-1 font-size-15"></i> {{translate('Remove')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endif
            @endforeach
        </ul>
        
    </div>
</div>

<!-- End Tab Content -->
<!-- End Shop Body -->
<!-- Shop Pagination -->
{{ $wishlists->links('vendor.pagination.list_product')}}
@else
<span class="text-center">{{ translate('Nothing Found') }}</span>
@endif
@endsection

@section('script')

@endsection