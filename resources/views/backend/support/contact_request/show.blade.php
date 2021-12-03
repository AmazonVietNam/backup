@extends('backend.layouts.app')

@section('content')

<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-header row gutters-5">
            <div class="text-center text-md-left">
                <h5 class="mb-md-0 h5">{{ $contact->subject }} #{{ $contact->id }}</h5>
               <div class="mt-2">
                   <span> {{ $contact->full_name }} </span>
                   <span class="ml-2"> {{ $contact->created_at }} </span>
                   
               </div>
               <p class="mt-2">
                {{ $contact->content }}
               </p>
            </div>
        </div>
        
    </div>
</div>

@endsection

@section('script')

@endsection
