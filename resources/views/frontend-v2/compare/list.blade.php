@extends('frontend-v2.layouts.app')

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
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ translate('Comparison')}}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End breadcrumb -->
                </div>
            </div>
            <!-- End breadcrumb -->

            <div class="container">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                    <div class="fs-15 fw-600">{{ translate('Comparison')}}</div>
                    <a href="{{ route('compare.reset') }}" style="text-decoration: none;" class="btn btn-soft-primary btn-sm fw-600">{{ translate('Reset Compare List')}}</a>
                </div>
                @if(Session::has('compare'))
                    @if(count(Session::get('compare')) > 0)
                    <div class="table-responsive table-bordered table-compare-list mb-10 border-0">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="min-width-200">{{ translate('Name')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                    <td>
                                        <a href="{{ route('product', \App\Product::find($item)->slug) }}" class="product d-block">
                                            <div class="product-compare-image">
                                                <div class="d-flex mb-3">
                                                    <img class="prdt-img mx-auto" src="{{ uploaded_asset(\App\Product::find($item)->thumbnail_img) }}" alt="Image">
                                                </div>
                                            </div>
                                            <h3 class="product-item__title text-blue font-weight-bold mb-3">{{ \App\Product::find($item)->getTranslation('name') }}</h3>
                                        </a>
                                        <div class="text-warning mb-2">
                                            {{ renderStarRatingv2(\App\Product::find($item)->rating) }}
                                        </div>
                                    </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>{{ translate('Price')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        @if (home_discounted_base_price(\App\Product::find($item)->id) == '0đ')
                                        <td class="product-price">Liên hệ</td>
                                        @else
                                        <td class="product-price">{{ home_discounted_base_price(\App\Product::find($item)->id) }}</td>
                                        @endif
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>{{ translate('Brand')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        <td>
                                            @if (\App\Product::find($item)->brand != null)
                                                {{ \App\Product::find($item)->brand->getTranslation('name') }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>{{ translate('Description')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        <td>
                                            @if (\App\Product::find($item)->description != null)
                                                @php
                                                    $description = \App\Product::find($item)->getTranslation('description');
                                                    $des = \Str::limit(strip_tags($description), 400);
                                                @endphp
                                                    {!! $des !!} <a href="{{ route('product', \App\Product::find($item)->slug) }}">Xem thêm</a>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>{{ translate('Sub Sub Category')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                        <td>
                                            @if (\App\Product::find($item)->subsubcategory != null)
                                                {{ \App\Product::find($item)->subsubcategory->getTranslation('name') }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>{{ translate('Add to cart')}}</th>
                                    @foreach (Session::get('compare') as $key => $item)
                                    <td>
                                        <div class=""><a href="{{ route('product', \App\Product::find($item)->slug) }}" class="btn btn-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-3 px-xl-5">Thêm vào giỏ hàng</a></div>
                                    </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>{{ translate('Remove')}}</th>
                                    @foreach(Session::get('compare') as $key => $item)
                                    <td class="text-center">
                                        <a href="{{ route('compare.removeOne', $key) }}" class="text-gray-90"><i class="fa fa-times"></i></a>
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                @else
                    <div class="text-center p-4">
                        <p class="fs-17">{{ translate('Your comparison list is empty')}}</p>
                    </div>
                @endif
            </div>
        </main>
        <!-- ========== END MAIN CONTENT ========== -->

@endsection
