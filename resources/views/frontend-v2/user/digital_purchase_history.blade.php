@extends('frontend-v2.layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{ translate('Download Your Product') }}</h5>
    </div>
    <div class="card-body">
        @if($orders->count() > 0)
        <table class="table aiz-table mb-0">
            
            <thead>
                <tr>
                    <th>{{ translate('Product')}}</th>
                    <th width="20%">{{ translate('Option')}}</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($orders as $key => $order_id)
                    @php
                        $order = \App\OrderDetail::find($order_id->id);
                    @endphp
                    <tr>
                        <td><a href="{{ route('product', $order->product->slug) }}">{{ $order->product->getTranslation('name') }}</a></td>
                        <td>
                            <a href="{{route('digitalproducts.download', encrypt($order->product->id))}}" title="{{ translate('Download') }}">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        {{ $orders->links() }}
        @else
            <span class="text-center">{{ translate('Nothing Found') }}</span>
        @endif
    </div>
</div>

@endsection