
<div class="mb-8 border border-color-3 borders-radius-6 overflow-hidden">
    <!-- List -->
    
    <ul id="sidebarNav" class="list-unstyled sidebar-navbar">
        <li>
            <div class="px-4 text-center mt-4 dropdown-title">
                <span class="avatar avatar-md">
                    @if (Auth::user()->avatar_original != null)
                        <img class="u-xl-avatar rounded-circle" src="{{ uploaded_asset(Auth::user()->avatar_original) }}" >
                    @else
                        <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="u-xl-avatar rounded-circle">
                    @endif
                </span>
    
                @if(Auth::user()->user_type == 'customer')
                    <h4 class="h5 font-weight-semi-bold">{{ Auth::user()->name }}</h4>
                @else
                    <h4 class="h5 font-weight-semi-bold">{{ Auth::user()->name }}
                        <span class="ml-2">
                            @if(Auth::user()->seller->verification_status == 1)
                                <i class="fa fa-check-circle text-success"></i>
                            @else
                                <i class="fa fa-check-circle text-danger"></i>
                            @endif
                        </span>
                    </h4>
                @endif
            </div>
            <ul id="sidebarNav1" class="list-unstyled dropdown-list">
                <!-- Menu List -->
            
                <li>
                    <a href="{{ route('dashboard') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['dashboard'])}}">
                        <div><i class="fa fa-home dropdown-item-icon"></i>
                        {{ translate('Dashboard') }}</div>
                    </a>
                </li>
                @php
                    $delivery_viewed = App\Order::where('user_id', Auth::user()->id)->where('delivery_viewed', 0)->get()->count();
                    $payment_status_viewed = App\Order::where('user_id', Auth::user()->id)->where('payment_status_viewed', 0)->get()->count();
                @endphp
                <li>
                    <a href="{{ route('purchase_history.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['purchase_history.index'])}}">
                        <div><i class="fa fa-like dropdown-item-icon"></i><i class="fa fa-file dropdown-item-icon"></i>
                        {{ translate('Purchase History') }}&nbsp;
                        </div>
                        @if($delivery_viewed > 0 || $payment_status_viewed > 0)<span class="badge badge-danger" style="font-size: 16px"> {{ translate('New') }}</span>@endif
                    </a>
                </li>
                <!--
                <li>
                    <a href="{{ route('digital_purchase_history.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['digital_purchase_history.index'])}}">
                        <div><i class="fa fa-like dropdown-item-icon"></i>
                        <i class="fa fa-download dropdown-item-icon"></i>
                        {{ translate('Downloads') }}
                        </div>
                    </a>
                </li>
                -->
                @php
                    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                    $club_point_addon = \App\Addon::where('unique_identifier', 'club_point')->first();
                @endphp
                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                    <li>
                        <a href="{{ route('customer_refund_request') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['customer_refund_request'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fa fa-chevron-circle-left dropdown-item-icon"></i>
                            {{ translate('Sent Refund Request') }}
                            </div>
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('wishlists.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['wishlists.index'])}}">
                        <div><i class="fa fa-like dropdown-item-icon"></i><i class="fa fa-heart dropdown-item-icon"></i>
                        {{ translate('Wishlist') }}</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['profile'])}}">
                        <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-user dropdown-item-icon"></i>
                        {{translate('Manage Profile')}}</div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['dashboard'])}}">
                        <div><i class="fa fa-home dropdown-item-icon"></i>
                        {{ translate('My Store') }}</div>
                    </a>
                </li>
                @if(Auth::user()->user_type == 'seller')
                    <li>
                        <a href="{{ route('seller.products') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['seller.products', 'seller.products.upload', 'seller.products.edit'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-gem dropdown-item-icon"></i>
                            {{ translate('Products') }}</div>
                        </a>
                    </li>

                    <!--
                    <li>
                        <a href="{{route('product_bulk_upload.index')}}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['product_bulk_upload.index'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-upload dropdown-item-icon"></i>
                            {{ translate('Product Bulk Upload') }}</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('seller.digitalproducts') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['seller.digitalproducts', 'seller.digitalproducts.upload', 'seller.digitalproducts.edit'])}}">
                            <div><i class="fas fa-gem dropdown-item-icon"></i>
                            {{ translate('Digital Products') }}</div>
                        </a>
                    </li>
                    -->
                @endif
                <!--
                @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
                    <li>
                        <a href="{{ route('customer_products.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['customer_products.index', 'customer_products.create', 'customer_products.edit'])}}">
                            <div><i class="fas fa-gem dropdown-item-icon"></i>
                            {{ translate('Classified Products') }}</div>
                        </a>
                    </li>
                @endif
                -->
                @if(Auth::user()->user_type == 'seller')
                    @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)
                        @if (\App\BusinessSetting::where('type', 'pos_activation_for_seller')->first() != null && \App\BusinessSetting::where('type', 'pos_activation_for_seller')->first()->value != 0)
                            <li>
                                <a href="{{ route('poin-of-sales.seller_index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['poin-of-sales.seller_index'])}}">
                                    <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-fax dropdown-item-icon"></i>
                                    {{ translate('POS Manager') }}</div>
                                </a>
                            </li>
                        @endif
                    @endif

                    @php
                        $orders = DB::table('orders')
                                    ->orderBy('code', 'desc')
                                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                    ->where('order_details.seller_id', Auth::user()->id)
                                    ->where('orders.viewed', 0)
                                    ->select('orders.id')
                                    ->distinct()
                                    ->count();
                    @endphp
                    <li>
                        <a href="{{ route('orders.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['orders.index'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-money-bill dropdown-item-icon"></i>
                            {{ translate('Orders') }}</div>
                            @if($orders > 0)<span class="badge badge-success">{{ $orders }}</span>@endif
                        </a>
                    </li>

                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                        <li>
                            <a href="{{ route('vendor_refund_request') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['vendor_refund_request','reason_show'])}}">
                                <i class="fa fa-like dropdown-item-icon"></i><i class="las la-backward dropdown-item-icon"></i>
                                <span class="aiz-side-nav-text">{{ translate('Received Refund Request') }}</span>
                            </a>
                        </li>
                    @endif

                    @php
                        $review_count = DB::table('reviews')
                                    ->orderBy('code', 'desc')
                                    ->join('products', 'products.id', '=', 'reviews.product_id')
                                    ->where('products.user_id', Auth::user()->id)
                                    ->where('reviews.viewed', 0)
                                    ->select('reviews.id')
                                    ->distinct()
                                    ->count();
                    @endphp
                    <li>
                        <a href="{{ route('reviews.seller') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['reviews.seller'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-star-half-alt dropdown-item-icon"></i>
                            {{ translate('Product Reviews') }}</div>
                            @if($review_count > 0)<span class="badge badge-success">{{ $review_count }}</span>@endif
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('payments.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['payments.index'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-history dropdown-item-icon"></i>
                            {{ translate('Payment History') }}</div>
                        </a>
                    </li>


                @endif

                @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                    @php
                        $conversation = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                    @endphp
                    <li>
                        <a href="{{ route('conversations.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['conversations.index', 'conversations.show'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-comment dropdown-item-icon"></i>
                            {{ translate('Conversations') }}</div>
                            @if (count($conversation) > 0)
                                <span class="badge badge-success">({{ count($conversation) }})</span>
                            @endif
                        </a>
                    </li>
                @endif


                @if (\App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                    <li>
                        <a href="{{ route('wallet.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['wallet.index'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-dollar-sign dropdown-item-icon"></i>
                            {{translate('My Wallet')}}</div>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('withdraw_requests.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['withdraw_requests.index'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-money-bill-wave-alt dropdown-item-icon"></i>
                            {{ translate('Money Withdraw') }}</div>
                        </a>
                    </li>
                @endif

                @if ($club_point_addon != null && $club_point_addon->activated == 1)
                    <li>
                        <a href="{{ route('earnng_point_for_user') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['earnng_point_for_user'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-dollar-sign dropdown-item-icon"></i>
                            {{translate('Earning Points')}}</div>
                        </a>
                    </li>
                @endif

                @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                    <li>
                        <a href="{{ route('affiliate.user.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['affiliate.user.index', 'affiliate.payment_settings'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-dollar-sign dropdown-item-icon"></i>
                            {{translate('Affiliate System')}}</div>
                        </a>
                    </li>
                @endif

                @php
                    $support_ticket = DB::table('tickets')
                                ->where('client_viewed', 0)
                                ->where('user_id', Auth::user()->id)
                                ->count();
                @endphp

                <li>
                    <a href="{{ route('support_ticket.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['support_ticket.index'])}}">
                        <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-ticket-alt dropdown-item-icon"></i>
                        {{translate('Support Ticket')}}</div>
                        @if($support_ticket > 0)<span class="badge badge-danger" style="font-size: 16px">{{ $support_ticket }}</span> @endif
                    </a>
                </li>


                <li>
                        <a href="{{ route('shops.index') }}" class="dropdown-item d-flex justify-content-between {{ areActiveRoutes(['shops.index'])}}">
                            <div><i class="fa fa-like dropdown-item-icon"></i><i class="fas fa-cog dropdown-item-icon"></i>
                            {{ translate('Shop Setting') }}</div>
                        </a>
                </li>
        
                
                <!-- End Menu List -->
            </ul>
        </li>
        
        {{-- @if($category != null)
        <li>
            <a class="dropdown-current active" href="#">{{\Illuminate\Support\Str::limit($category->getTranslation('name'), 20, $end='...')}}</a>

            <ul class="list-unstyled dropdown-list">
                <!-- Menu List -->
                @foreach($category->childrenCategories as $ch)
                <li><a class="dropdown-item" href="{{ route('products.category', $ch->slug) }}">{{\Illuminate\Support\Str::limit($ch->getTranslation('name'), 22, $end='...')}}</a></li>
                @endforeach
                <!-- End Menu List -->
            </ul>
        </li>
        @endif --}}
    </ul>
    @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1 && Auth::user()->user_type == 'customer')
        <div>
            <a href="{{ route('shops.create') }}" class="btn btn-block btn-soft-primary rounded-0">
                </i>{{ translate('Be A Seller') }}
            </a>
        </div>
    @endif
    @if(Auth::user()->user_type == 'seller')
        <hr>
        <h4 class="h5 font-weight-semi-bold text-center">{{ translate('Sold Amount')}}</h4>
        <!-- <div class="sidebar-widget-title py-3">
            <span></span>
        </div> -->
        @php 
            $date = date("Y-m-d");
            $days_ago_30 = date('Y-m-d', strtotime('-30 days', strtotime($date)));
            $days_ago_60 = date('Y-m-d', strtotime('-60 days', strtotime($date)));
        @endphp
        <div class="widget-balance">
        <div class="text-left p-3">
            <div class="text-center heading-4 strong-700 mb-4">
                @php
                    $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', $days_ago_30)->get();
                    $total = 0;
                    foreach ($orderDetails as $key => $orderDetail) {
                        if($orderDetail->order != null && $orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                            $total += $orderDetail->price;
                        }
                    }
                @endphp
                <small class="d-block fs-12 mb-2">{{ translate('Your sold amount (current month)')}}</small>
                <span class="btn btn-primary font-weight-semi-bold fs-18">{{ single_price($total) }}</span>
            </div>
            <table class="table table-borderless">
                <tr>
                    @php
                        $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                        $total = 0;
                        foreach ($orderDetails as $key => $orderDetail) {
                            if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                $total += $orderDetail->price;
                            }
                        }
                    @endphp
                    <td class="p-1" width="60%">
                        {{ translate('Total Sold')}}:
                    </td>
                    <td class="p-1 font-weight-semi-bold" width="40%">
                        {{ single_price($total) }}
                    </td>
                </tr>
                <tr>
                    @php
                        $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', $days_ago_60)->where('created_at', '<=', $days_ago_30)->get();
                        $total = 0;
                        foreach ($orderDetails as $key => $orderDetail) {
                            if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                $total += $orderDetail->price;
                            }
                        }
                    @endphp
                    <td class="p-1" width="60%">
                        {{ translate('Last Month Sold')}}:
                    </td>
                    <td class="p-1 font-weight-semi-bold" width="40%">
                        {{ single_price($total) }}
                    </td>
                </tr>
            </table>
        </div>
        <table>

        </table>
    </div>
    @endif
    <!-- End List -->
</div>