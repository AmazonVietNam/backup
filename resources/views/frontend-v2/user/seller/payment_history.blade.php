@extends('frontend-v2.layouts.dashboard')

@section('content')


<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{ translate('Payment History') }}</h5>
    </div>
        <div class="card-body">
            @if (count($payments) > 0)
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ translate('Date')}}</th>
                        <th>{{ translate('Amount')}}</th>
                        <th>{{ translate('Payment Method')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $key => $payment)
                        <tr>
                            <td>
                                {{ $key+1 }}
                            </td>
                            <td>{{ date('d-m-Y', strtotime($payment->created_at)) }}</td>
                            <td>
                                {{ single_price($payment->amount) }}
                            </td>
                            <td>
                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }} @if ($payment->txn_code != null) ({{  translate('TRX ID') }} : {{ $payment->txn_code }}) @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $payments->links('vendor.pagination.list_product') }}
            @else
            {{translate('Nothing Found')}}
            @endif
        </div>
 
</div>

@endsection
