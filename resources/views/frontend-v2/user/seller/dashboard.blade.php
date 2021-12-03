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
                        {{ count(\App\Product::where('user_id', Auth::user()->id)->get()) }}
                        </div>
                        <div class="opacity-50">{{ translate('Products')}}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-bg-light mb-4 overflow-hidden">
                    <div class="card-body">
                        <div class="h3 font-weight-bold">
                        {{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}
                        </div>
                        <div class="opacity-50">{{ translate('Total sale')}}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-bg-light mb-4 overflow-hidden">
                    <div class="card-body">
                        @php
                            $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                            $total = 0;
                            foreach ($orderDetails as $key => $orderDetail) {
                                if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                    $total += $orderDetail->price;
                                }
                            }
                        @endphp
                        <div class="h3 font-weight-bold">{{ single_price($total) }}</div>
                        <div class="opacity-50">{{ translate('Total earnings') }}</div>
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
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Orders') }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table aiz-table mb-0">
                            <tr>
                                <td>{{ translate('Total orders')}}:</td>
                                <td>{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->get()) }}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ translate('Pending orders')}}:</td>
                                <td>{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'pending')->get()) }}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ translate('Cancelled orders')}}:</td>
                                <td>{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'cancelled')->get()) }}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ translate('Successful orders')}}:</td>
                                <td>{{ count(\App\OrderDetail::where('seller_id', Auth::user()->id)->where('delivery_status', 'delivered')->get()) }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card d-flex align-items-center h-100">
                    {{-- <div class="p-4"> --}}
                        @if(Auth::user()->seller->verification_status == 0)
                            <img class="my-auto mx-auto d-block" src="{{ static_asset('assets/img/non_verified.png') }}" alt="" width="130">
                        @else
                            <img class="my-auto mx-auto d-block" src="{{ static_asset('assets/img/verified.png') }}" alt="" width="130">
                        @endif
                    {{-- </div> --}}
                    @if(Auth::user()->seller->verification_status == 0)
                        <a href="{{ route('shop.verify') }}" class="btn btn-primary">{{ translate('Verify Now')}}</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">{{ translate('Products') }}</h6>
                    </div>
                            <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>{{ translate('Category')}}</th>
                                <th>{{ translate('Product')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach (\App\Category::all() as $key => $category)
                            @if(count($category->products->where('user_id', Auth::user()->id))>0)
                                <tr>
                                    <td>{{ $category->getTranslation('name') }}</td>
                                    <td>{{ count($category->products->where('user_id', Auth::user()->id)) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('seller.products.upload')}}" class="btn btn-primary d-inline-block">{{ translate('Add New Product')}}</a>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('Purchased Package') }}</h6>
                        </div>
                        @php
                            $seller_package = \App\SellerPackage::find(Auth::user()->seller->seller_package_id);
                        @endphp
                        <div class="card-body text-center">
                            @if($seller_package != null)
                            <img src="{{ uploaded_asset($seller_package->logo) }}" class="img-fluid mb-4 h-110px">
                            <p class="mb-1 text-muted">{{ translate('Product Upload Remaining') }}: {{ Auth::user()->seller->remaining_uploads }} {{ translate('Times')}}</p>
                            <p class="text-muted mb-1">{{ translate('Digital Product Upload Remaining') }}: {{ Auth::user()->seller->remaining_digital_uploads }} {{ translate('Times')}}</p>
                            <p class="text-muted mb-4">{{ translate('Package Expires at') }}: {{ Auth::user()->seller->invalid_at }}</p>
                            <h6 class="font-weight-semi-bold mb-3 text-primary">{{ translate('Current Package') }}: {{ $seller_package->name }}</h6>
                            @else
                                <h6 class="font-weight-semi-bold mb-3 text-primary">{{translate('Package Not Found')}}</h6>
                            @endif
                            <div class="text-center">
                                <a href="{{ route('seller_packages_list') }}" class="btn btn-soft-primary">{{ translate('Upgrade Package')}}</a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card mb-4 p-4 text-center">
                    <div class="h5 font-weight-semi-bold">{{ translate('Shop')}}</div>
                    <p>{{ translate('Manage & organize your shop')}}</p>
                    <a href="{{ route('shops.index') }}" class="btn btn-soft-primary">{{ translate('Go to setting')}}</a>
                </div>
                <div class="card mb-4 p-4 text-center">
                    <div class="h5 font-weight-semi-bold">{{ translate('Payment')}}</div>
                    <p>{{ translate('Configure your payment method')}}</p>
                    <a href="{{ route('profile') }}" class="btn btn-soft-primary">{{ translate('Configure Now')}}</a>
                </div>
            </div>
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