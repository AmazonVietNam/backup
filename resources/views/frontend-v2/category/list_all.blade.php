@extends('frontend-v2.layouts.app')

@section('title', 'Danh sách danh mục')

@section('content')
    <div class="container">
        <!-- Top Categories this Month -->
        <div class="mb-2">
            <div class="border-bottom border-color-1 mb-5">
                <h3 class="section-title section-title__full d-inline-block mb-0 pb-2 font-size-22">Danh sách danh mục
                </h3>
            </div>
            <div class="row align-items-start">
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        <div class="col-4 col-wd-3 border-right border-lg-down-0 mb-8">
                            <div class="row align-items-center align-items-xl-start">
                                <div class="col-md-5 mb-3 mb-md-0">
                                    <a href="../shop/product-categories-7-column-full-width.html" class="d-block">
                                        <img class="img-fluid" src="{{ uploaded_asset($category->banner) }}"
                                            alt="{{ $category->getTranslation('name') }}">
                                    </a>
                                </div>
                                <div class="col-md-7 pl-lg-0">
                                    <h4 class="font-size-18 mb-0 mb-xl-2 font-size-14-down-lg text-center text-md-left">
                                        <a href="{{ route('products.category', $category->slug) }}"
                                            class="underline-on-hover">{{ $category->getTranslation('name') }}</a>
                                    </h4>
                                    <ul class="mb-1 font-size-13 list-unstyled text-lh-21 d-none d-xl-block">
                                        @foreach ($category->childrenCategories as $children)
                                            <li>
                                                <a href="{{ route('products.category', $children->slug) }}"
                                                    class="text-gray-15 underline-on-hover">{{ $children->getTranslation('name') }}</a>
                                            </li>
                                        @endforeach
                                        
                                    </ul>
                                    <a href="{{ route('products.category', $category->slug) }}"
                                        class="d-none d-xl-block text-right font-weight-bold text-gray-15 underline-on-hover">See
                                        all</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-muted">Không có danh mục nào</div>
                @endif

            </div>
        </div>
    </div>
    <!-- End Top Categories this Month -->
@endsection
