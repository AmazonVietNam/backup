@extends('frontend-v2.layouts.app')

@section('content')

<section class="pt-4 mb-4">
    <div class="container">
        <div class="row">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('brands.all') }}">{{ translate('All Brands') }}</a>
                    </li>
                </ul>
        </div>
    </div>
</section>
<section class="mb-4">
    <div class="container">
        <div class="px-3 pt-3">
            <div class="row">
                @foreach (\App\Brand::all() as $brand)
                    <div class="col-3 col-sm-3 col-md-3 col-xl-2 col-lg-2 text-center">
                        <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-3 mb-3 border rounded">
                            <img src="{{ uploaded_asset($brand->logo) }}" class="lazyload mx-auto h-70px mw-100" alt="{{ $brand->getTranslation('name') }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
