
{{-- @if(session('success'))
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="position: absolute; bottom: 1rem; left: 1rem; z-index: 1055;">
    <div class="toast-header">
      <strong class="mr-auto text-success py-2">{{ translate('Success') }}</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body p-2">
      {{session('success')}}
   </div>
  </div>
@endif
@if(session('error'))
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000" style="position: absolute; bottom: 1rem; left: 1rem; z-index: 1055;">
    <div class="toast-header">
      <strong class="mr-auto text-error py-2">{{ translate('Error') }}</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body p-2">
      {{session('error')}}
   </div>
  </div>
@endif --}}

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(session('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
  {{session('info')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{session('warning')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{session('error')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if ($errors->any())
  @foreach ($errors->all() as $error)
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{$error}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endforeach
@endif
@foreach (session('flash_notification', collect())->toArray() as $message)
<div class="alert alert-{{$message['level']}} alert-dismissible fade show" role="alert">
  {{$message['message']}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endforeach