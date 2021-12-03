@extends('frontend-v2.layouts.dashboard')

@section('content')


    <div class="mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Products') }}</h1>
            </div>
        </div>
    </div>

    <div class="row gutters-10 justify-content-center mb-4">
        @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
        <div class="col-md-6 mx-auto" >
            <div class="card card-bg-light overflow-hidden">
                <div class="card-body">
                    <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                        <i class="fas fa-upload"></i>
                    </span>
                    <div class="px-3 pt-3 pb-3">
                        <div class="h4 font-weight-bold text-center">{{ max(0, Auth::user()->seller->remaining_digital_uploads) }}</div>
                        <div class="opacity-50 text-center">{{  translate('Remaining Uploads') }}</div>
                    </div>
                </div>
                
            </div>
        </div>
        @endif

        @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
        @php
            $seller_package = \App\SellerPackage::find(Auth::user()->seller->seller_package_id);
        @endphp
            <div class="col-md-4">
                {{-- <a href="{{ route('seller_packages_list') }}" class="text-center bg-white shadow-sm hov-shadow-lg text-center d-block p-3 rounded"> --}}
                <a href="{{ route('seller_packages_list') }}" class="card card-bg-light text-center d-block p-3 rounded h-100">
                    <div class="card-body">
                    @if($seller_package != null)
                        <img src="{{ uploaded_asset($seller_package->logo) }}" height="44" class="mw-100 mx-auto">
                        <span class="d-block sub-title mb-2">{{ translate('Current Package')}}: {{ $seller_package->getTranslation('name') }}</span>
                    @else
                        <i class="la la-frown-o mb-2 la-3x"></i>
                        <div class="d-block sub-title mb-2">{{ translate('No Package Found')}}</div>
                    @endif
                    <div class="btn btn-outline-primary py-1">{{ translate('Upgrade Package')}}</div>
                    </div>
                </a>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <a href="{{ route('seller.digitalproducts.upload')}}" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i>{{ translate('Add New Digital Product') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($products->count() > 0)
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="30%">{{ translate('Name')}}</th>
                        <th data-breakpoints="md">{{ translate('Category')}}</th>
                        <th data-breakpoints="md">{{ translate('Base Price')}}</th>
                        <th data-breakpoints="md">{{ translate('Published')}}</th>
                        <th data-breakpoints="md">{{ translate('Featured')}}</th>
                        <th>{{ translate('Options')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{ route('product', $product->slug) }}" target="_blank">{{   $product->getTranslation('name')  }}</a></td>
                            <td>
                                <a href="{{ route('product', $product->slug) }}" target="_blank" class="text-reset">
                                    {{ $product->getTranslation('name') }}
                                </a>
                            </td>
                            <td>{{ $product->unit_price }}</td>
                            <td><label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->published == 1) echo "checked";?> >
                                <span class="slider round"></span></label>
                            </td>
                            <td><label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_featured(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->featured == 1) echo "checked";?> >
                                <span class="slider round"></span></label>
                            </td>
                            <td class="text-right">
                                <a href="{{route('seller.digitalproducts.edit',  ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
                                    <i class="fas fa-edit text-primary mr-1"></i>
                                </a>
                                <a href="{{route('digitalproducts.download', encrypt($product->id))}}" title="{{ translate('Download') }}">
                                    <i class="fas fa-download text-success mr-1"></i>
                                </a>
                                <a href="javascript:void(0)" class="confirm-delete" data-href="{{route('digitalproducts.destroy', $product->id)}}" title="{{ translate('Delete') }}">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links('vendor.pagination.list_product')}}
            @else
            {{translate('Nothing Found')}}
            @endif
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Featured products updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '{{ translate('Published products updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
