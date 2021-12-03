@extends('backend.layouts.app')

@section('content')

<div class="card">
    <form class="" id="sort_support" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col text-center text-md-left">
                <h5 class="mb-md-0 h6">{{ translate('Support Desk') }}</h5>
            </div>
            <div class="col-md-2">
                {{-- <div class="input-group input-group-sm">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type ticket code & Enter') }}">
                </div> --}}
            </div>
        </div>
    </from>

    <div class="card-body">
        <table class="aiz-table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ translate('ID') }}</th>
                    <th>{{ translate('Subject') }}</th>
                    <th>{{ translate('Full Name') }}</th>
                    <th>{{ translate('Sending Date') }}</th>
                    <th class="text-right">{{ translate('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($contact_requests as $key => $request)
                    <tr>
                        <td>#{{ $request->id }}</td>
                        <td>{{ $request->subject }} @if($request->viewed == 0) <span class="badge badge-inline badge-info">{{ translate('New') }}</span> @endif</td>
                        <td>{{ $request->full_name }}</td>
                        <td>{{ $request->created_at }}</td>
                        <td class="text-right">
                            <a href="{{route('contact_requests.show', encrypt($request->id))}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="{{ translate('View Details') }}">
                                <i class="las la-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $contact_requests->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
