@extends('frontend-v2.layouts.dashboard')

@section('title', translate('Dashboard'))

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h6 class="mb-0">{{translate('Giới thiệu thành viên')}}</h6>
                </div>
                <div class="card-body">
                    <div class="card-text mb-2">
                        <input class="form-control" readonly id="referral-link" type="text" value="{{ route('user.registration', ['referral_code' => Auth::user()->id]) }}" />
                    </div>
                    <button href="" class="btn btn-sm btn-primary" id="copyBtn"><i class="fa fa-clipboard mr-2"></i>Copy</button>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-bg-light mb-4 overflow-hidden">
                    <div class="card-body">
                        <div class="h3 font-weight-bold">
                        @if(Session::has('cart'))
                        {{ count(Session::get('cart'))}} {{ translate('Product(s)') }}
                        @else
                        0 {{ translate('Product') }}
                        @endif
                        </div>
                        <div class="opacity-50">{{ translate('in your cart') }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-bg-light mb-4 overflow-hidden">
                    <div class="card-body">
                        @php
                            $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                            $total = 0;
                            foreach ($orders as $key => $order) {
                                $total += count($order->orderDetails);
                            }
                        @endphp
                        <div class="h3 font-weight-bold">
                            {{ count(Auth::user()->wishlists)}} {{ translate('Product(s)') }}
                        </div>
                        <div class="opacity-50">{{ translate('in your wishlist') }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-bg-light mb-4 overflow-hidden">
                    <div class="card-body">
                        @php
                                    $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                                    $total = 0;
                                    foreach ($orders as $key => $order) {
                                        $total += count($order->orderDetails);
                                    }
                                @endphp
                        <div class="h3 font-weight-bold">{{ $total }} {{ translate('Product(s)') }}</div>
                        <div class="opacity-50">{{ translate('you ordered') }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-bg-light mb-4 overflow-hidden">
                    <div class="card-body">
                        @php
                        $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                        $total = 0;
                        foreach ($orders as $key => $order) {
                        $total += count($order->orderDetails);
                        }
                        @endphp
                        <div class="h3 font-weight-bold">
                            {{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}
                        </div>
                        <div class="opacity-50">{{ translate('Successful orders')}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Default Shipping Address') }}</h5>
                    </div>
                    <div class="card-body">
                        @if(Auth::user()->addresses != null)
                            @php
                                $address = Auth::user()->addresses->where('set_default', 1)->first();
                            @endphp
                            @if($address != null)
                                <ul class="list-unstyled mb-0">
                                    <li class=" py-2"><span>{{ translate('Address') }} : {{ $address->address }}</span></li>
                                    <li class=" py-2"><span>{{ translate('Ward') }} : {{ $address->ward_name }}</span></li>
                                    <li class=" py-2"><span>{{ translate('District') }} : {{ $address->district_name }}</span></li>
                                    <li class=" py-2"><span>{{ translate('City') }} : {{ $address->city }}</span></li>
                                    <li class=" py-2"><span>{{ translate('Country') }} : {{ $address->country }}</span></li>
                                    <li class=" py-2"><span>{{ translate('Postal Code') }} : {{ $address->postal_code }}</span></li>
                                    <li class=" py-2"><span>{{ translate('Phone') }} : {{ $address->phone }}</span></li>
                                </ul>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            @if (\App\BusinessSetting::where('type', 'classified_product')->first()->value)
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Purchased Package') }}</h5>
                    </div>
                    <div class="card-body text-center">
                        @php
                            $customer_package = \App\CustomerPackage::find(Auth::user()->customer_package_id);
                        @endphp
                        @if($customer_package != null)
                            <img src="{{ uploaded_asset($customer_package->logo) }}" class="img-fluid mb-4 h-110px">
                            <p class="mb-1 text-muted">{{ translate('Product Upload') }}: {{ $customer_package->product_upload }} {{ translate('Times')}}</p>
                            <p class="text-muted mb-4">{{ translate('Product Upload Remaining') }}: {{ Auth::user()->remaining_uploads }} {{ translate('Times')}}</p>
                            <h5 class="font-weight-semi-bold mb-3 text-primary">{{ translate('Current Package') }}: {{ $customer_package->getTranslation('name') }}</h5>
                        @else
                            <h5 class="font-weight-semi-bold mb-3 text-primary">{{translate('Package Not Found')}}</h5>
                        @endif
                        <a href="{{ route('customer_packages_list_show') }}" class="btn btn-success d-inline-block">{{ translate('Upgrade Package') }}</a>
                    </div>
                </div>
            </div>
            @endif
        </div>

@endsection

@section('extended_scripts')
<script>
document.getElementById("copyBtn").addEventListener("click", function() {
    copyToClipboardMsg(document.getElementById("referral-link"), "copyBtn");
});

function copyToClipboardMsg(elem, msgElem) {
	  var succeed = copyToClipboard(elem);
    var msg;
    if (!succeed) {
        msg = "Copy not supported or blocked. Press Ctrl+c to copy"
    } else {
        msg = "<i class='fa fa-clone mr-2'></i>Copied"
    }
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
    msgElem.innerHTML = msg;
    setTimeout(function() {
        msgElem.innerHTML = "<i class='fa fa-clipboard mr-2'></i>Copy";
    }, 2000);
}

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
</script>
@endsection