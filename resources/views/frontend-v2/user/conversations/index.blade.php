@extends('frontend-v2.layouts.dashboard')

@section('content')

<div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
        <div class="col-md-6">
            <b class="h4">{{ translate('Conversations')}}</b>
        </div>
    </div>
</div>

<div class="card no-border mt-4 p-3">
    <div class="card-header">
        {{translate('Conversations')}}
    </div>
    <div class="card-body">
        @if($conversations->count() > 0)
        @foreach ($conversations as $key => $conversation)
            @if ($conversation->receiver != null && $conversation->sender != null)
                <div class="block block-comment border-bottom mt-2">
                    <div class="row">
                        <div class="col-1">
                            <div class="media">
                                <span class="avatar avatar-sm mr-3 flex-shrink-0">
                                @if (Auth::user()->id == $conversation->sender_id)
                                    <img class="u-sm-avatar rounded-circle" @if ($conversation->receiver->avatar_original == null) src="{{ static_asset('assets/img/avatar-place.png') }}" @else src="{{ uploaded_asset($conversation->receiver->avatar_original) }}" @endif >
                                @else
                                    <img @if ($conversation->sender->avatar_original == null) src="{{ static_asset('assets/img/avatar-place.png') }}" @else src="{{ uploaded_asset($conversation->sender->avatar_original) }}" @endif class="u-sm-avatar rounded-circle">
                                @endif
                            </span>
                            </div>
                        </div>
                        <div class="col-2">
                            <p>
                                @if (Auth::user()->id == $conversation->sender_id)
                                    <a href="javascript:;">{{ $conversation->receiver->name }}</a>
                                @else
                                    <a href="javascript:;">{{ $conversation->sender->name }}</a>
                                @endif
                                <br>
                                <span class="comment-date">
                                    {{ date('h:i:m d-m-Y', strtotime($conversation->messages->last()->created_at)) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-9">
                            <div class="block-body">
                                <div class="block-body-inner pb-3">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <h6 class="mt-0">
                                                <a href="{{ route('conversations.show', encrypt($conversation->id)) }}" class="text-dark">
                                                    {{ $conversation->title }}
                                                </a>
                                                @if ((Auth::user()->id == $conversation->sender_id && $conversation->sender_viewed == 0) || (Auth::user()->id == $conversation->receiver_id && $conversation->receiver_viewed == 0))
                                                    <span class="badge badge-inline badge-danger">{{ translate('New') }}</span>
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                    <p class="comment-text mt-0">
                                        {{ $conversation->messages->last()->message }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        {{ $conversations->links('vendor.pagination.list_product') }}
        @else
        {{translate('Nothing Found')}}
        @endif

    </div>
</div>


@endsection
