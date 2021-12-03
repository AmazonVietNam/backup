@extends('frontend-v2.layouts.dashboard')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{ translate('Product Reviews') }}</h5>
    </div>
    <div class="card-body">
        @if($reviews->count() > 0)
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('Product')}}</th>
                    <th>{{ translate('Customer')}}</th>
                    <th>{{ translate('Rating')}}</th>
                    <th>{{ translate('Comment')}}</th>
                    <th>{{ translate('Published')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $key => $value)
                    @php
                        $review = \App\Review::find($value->id);
                    @endphp
                    @if($review != null && $review->product != null && $review->user != null)
                        <tr>
                            <td>
                                {{ $key+1 }}
                            </td>
                            <td>
                                <a href="{{ route('product', $review->product->slug) }}" target="_blank">{{  $review->product->getTranslation('name') }}</a>
                            </td>
                            <td>{{ $review->user->name }} ({{ $review->user->email }})</td>
                            <td>
                                <span class="rating rating-sm">
                                    {{renderStarRatingv2($review->rating)}}
                                </span>
                            </td>
                            <td>{{ $review->comment }}</td>
                            <td>
                                @if ($review->status == 1)
                                    <span class="badge badge-inline badge-success">{{  translate('Published') }}</span>
                                @else
                                    <span class="badge badge-inline badge-danger">{{  translate('Unpublished') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
  
        {{ $reviews->links('vendor.pagination.list_product') }}
        @else
            {{translate('Not Found')}}
        @endif

    </div>
</div>

@endsection
