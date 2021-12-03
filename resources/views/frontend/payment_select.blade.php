@extends('frontend-v2.layouts.app')

@section('content')

<section class="mb-4">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">{{translate('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ translate('Payment Select') }}</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container text-left">
        <div class="row">
            <div class="col-lg-8">

                <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
                    @csrf
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-header p-3">
                            <h3 class="fs-16 font-weight-semi-bold mb-0">
                                {{ translate('Select a payment option')}}
                            </h3>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-xxl-8 col-xl-10 mx-auto">
                                    <div class="row gutters-10">
                                        @if(\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="rounded border p-2 d-block mb-3">
                                                    <input value="paypal" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/paypal.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('Paypal')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="rounded border p-2 d-block mb-3">
                                                    <input value="stripe" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/stripe.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('Stripe')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif

                                        @if(\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="rounded border p-2 d-block mb-3">
                                                    <input value="sslcommerz" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/sslcommerz.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('sslcommerz')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1)
                                            <div class="col-6 col-sm-12">
                                                <label class="rounded border p-2 d-block mb-3">
                                                    <input value="instamojo" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/instamojo.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('Instamojo')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="razorpay" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/rozarpay.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('Razorpay')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'paystack')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="paystack" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/paystack.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('Paystack')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'voguepay')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="voguepay" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/vogue.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('VoguePay')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'payhere')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="payhere" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/payhere.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('payhere')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'ngenius')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="ngenius" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/ngenius.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('ngenius')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'iyzico')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="iyzico" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/iyzico.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('Iyzico')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\Addon::where('unique_identifier', 'african_pg')->first() != null && \App\Addon::where('unique_identifier', 'african_pg')->first()->activated)
                                            @if(\App\BusinessSetting::where('type', 'mpesa')->first()->value == 1)
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="mpesa" class="online_payment" type="radio" name="payment_option" checked>
                                                        <span class="d-block p-3 aiz-megabox-elem">
                                                            <img src="{{ static_asset('assets/img/cards/mpesa.png')}}" class="img-fluid mb-2">
                                                            <span class="d-block text-center">
                                                                <span class="d-block font-weight-semi-bold fs-15">{{ translate('mpesa')}}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endif
                                            @if(\App\BusinessSetting::where('type', 'flutterwave')->first()->value == 1)
                                                <div class="col-6 col-sm-12">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="flutterwave" class="online_payment" type="radio" name="payment_option" checked>
                                                        <span class="d-block p-3 aiz-megabox-elem">
                                                            <img src="{{ static_asset('assets/img/cards/flutterwave.png')}}" class="img-fluid mb-2">
                                                            <span class="d-block text-center">
                                                                <span class="d-block font-weight-semi-bold fs-15">{{ translate('flutterwave')}}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endif
                                            @if(\App\BusinessSetting::where('type', 'payfast')->first()->value == 1)
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="payfast" class="online_payment" type="radio" name="payment_option" checked>
                                                        <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/payfast.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('payfast')}}</span>
                                                        </span>
                                                    </span>
                                                    </label>
                                                </div>
                                            @endif
                                        @endif
                                        @if(\App\Addon::where('unique_identifier', 'paytm')->first() != null && \App\Addon::where('unique_identifier', 'paytm')->first()->activated)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="paytm" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/paytm.jpg')}}" class="img-fluid mb-2">
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('Paytm')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                            @php
                                                $digital = 0;
                                                foreach(Session::get('cart') as $cartItem){
                                                    if($cartItem['digital'] == 1){
                                                        $digital = 1;
                                                    }
                                                }
                                            @endphp
                                            @if($digital != 1)
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="cash_on_delivery" class="online_payment" type="radio" name="payment_option" checked>
                                                        <span class="d-block p-3 aiz-megabox-elem">
                                                            <img src="{{ static_asset('assets/img/cards/cod.png')}}" class="img-fluid mb-2">
                                                            <span class="d-block text-center">
                                                                <span class="d-block font-weight-semi-bold fs-15">{{ translate('Cash on Delivery')}}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endif
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'internetbanking_payment')->first()->value == 1)
                                            <div class="col-md-6 col-sm-12">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="internet_banking" class="online_payment" type="radio" name="payment_option" checked>
                                                    <span class="d-block p-3 aiz-megabox-elem">
                                                        <img src="{{ static_asset('assets/img/cards/ACB.png')}}" class="img-fluid mb-2">
                                                        <span class="d-block font-weight-bold">{{ env('INTERNETBANK_NAME') }}</span>
                                                        <span class="d-block fs-15">Chủ tài khoản: <span class="font-weight-semi-bold">{{ env('INTERNETBANK_ACCOUNTNAME') }}</span></span>
                                                        <span class="d-block fs-15">Số tài khoản: <span class="font-weight-semi-bold">{{ env('INTERNETBANK_ID') }}</span></span>
                                                        <span class="d-block text-center">
                                                            <span class="d-block font-weight-semi-bold fs-15">{{ translate('Internet Banking')}}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        @if (Auth::check())
                                            @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                                @foreach(\App\ManualPaymentMethod::all() as $method)
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="aiz-megabox d-block mb-3">
                                                            <input value="{{ $method->heading }}" type="radio" name="payment_option" onchange="toggleManualPaymentData({{ $method->id }})" data-id="{{ $method->id }}" checked>
                                                            <span class="d-block p-3 aiz-megabox-elem">
                                                                <img src="{{ uploaded_asset($method->photo) }}" class="img-fluid mb-2">
                                                                <span class="d-block text-center">
                                                                    <span class="d-block font-weight-semi-bold fs-15">{{ $method->heading }}</span>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach

                                                @foreach(\App\ManualPaymentMethod::all() as $method)
                                                    <div id="manual_payment_info_{{ $method->id }}" class="d-none">
                                                        @php echo $method->description @endphp
                                                        @if ($method->bank_info != null)
                                                            <ul>
                                                                @foreach (json_decode($method->bank_info) as $key => $info)
                                                                    <li>{{ translate('Bank Name') }} - {{ $info->bank_name }}, {{ translate('Account Name') }} - {{ $info->account_name }}, {{ translate('Account Number') }} - {{ $info->account_number}}, {{ translate('Routing Number') }} - {{ $info->routing_number }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                <div class="bg-white border mb-3 p-3 rounded text-left d-none">
                                    <div id="manual_payment_description">

                                    </div>
                                </div>
                            @endif
                            @if (Auth::check() && \App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                                @php
                                    $amount = get_wallet_amount(Auth::user()->id)
                                @endphp

                                <div class="separator mb-3">
                                    <span class="bg-white px-3">
                                        <span class="opacity-60">{{ translate('Or')}}</span>
                                    </span>
                                </div>
                                <div class="text-center py-4">
                                    <div class="h6 mb-3">
                                        <span class="opacity-80">{{ translate('Your wallet balance :')}}</span>
                                        <span class="font-weight-semi-bold">{{ single_price($amount) }}</span>
                                    </div>
                                    @if($amount < $total)
                                        <button type="button" class="btn btn-secondary" disabled>{{ translate('Insufficient balance')}}</button>
                                    @else
                                        <button  type="button" onclick="use_wallet()" class="btn btn-primary font-weight-semi-bold">{{ translate('Pay with wallet')}}</button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="pt-3">
                        <label class="checkbox">
                            <input type="checkbox" required id="agree_checkbox">
                            <span class="square-check"></span>
                            <span style="font-weight:bold;">{{ translate('I agree to the')}}</span>
                        </label>
                        <a href="{{ route('terms') }}" style="font-weight: bold;text-decoration: underline;">{{ translate('terms and conditions')}}</a>,
                        <a href="{{ route('returnpolicy') }}" style="font-weight: bold;text-decoration: underline;">{{ translate('return policy')}}</a> <span style="font-weight:bold;">&</span>
                        <a href="{{ route('privacypolicy') }}" style="font-weight: bold;text-decoration: underline;">{{ translate('privacy policy')}}</a>
                    </div>

                    <div class="row align-items-center pt-3">
                        <div class="col-6">
                            <a href="{{ route('home') }}" class="card-link">
                                <i class="fa fa-arrow-left"></i>
                                {{ translate('Return to shop')}}
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-primary font-weight-semi-bold">{{ translate('Complete Order')}}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                @include('frontend.partials.cart_summary')
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            $(".online_payment").click(function(){
                $('#manual_payment_description').parent().addClass('d-none');
            });
            toggleManualPaymentData($('input[name=payment_option]:checked').data('id'));
        });

        function use_wallet(){
            $('input[name=payment_option]').val('wallet');
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                AIZ.plugins.notify('danger','{{ translate('You need to agree with our policies') }}');
            }
        }
        function submitOrder(el){
            $(el).prop('disabled', true);
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                AIZ.plugins.notify('danger','{{ translate('You need to agree with our policies') }}');
                $(el).prop('disabled', false);
            }
        }

        function toggleManualPaymentData(id){
            $('#manual_payment_description').parent().removeClass('d-none');
            $('#manual_payment_description').html($('#manual_payment_info_'+id).html());
        }
    </script>
@endsection
