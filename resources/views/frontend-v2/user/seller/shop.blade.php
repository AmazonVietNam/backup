@extends('frontend-v2.layouts.dashboard')

@section('content')
@error('logo')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('sliders')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="aiz-titlebar mb-4">
    <div class="row align-items-center">
    <div class="col-md-6">
        <h1 class="h3">{{ translate('Shop Settings')}}
            <a href="{{ route('shop.visit', $shop->slug) }}" class="btn btn-link btn-sm" target="_blank">({{ translate('Visit Shop')}})<i class="la la-external-link"></i>)</a>
        </h1>
    </div>
    </div>
</div>

{{-- Basic Info --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="h6 font-weight-semi-bold">{{ translate('Basic Info') }}</h5>
    </div>
    <div class="card-body">
        <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <div class="row">
                <label class="col-md-2 col-form-label">{{ translate('Shop Name') }}<span class="text-danger text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control mb-3" placeholder="{{ translate('Shop Name')}}" name="name" value="{{ $shop->name }}" required>
                </div>
            </div>
            <div class="row">
                <label class="col-md-2 col-form-label">{{ translate('Phone') }}<span class="text-danger text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control mb-3" placeholder="{{ translate('Phone')}}" name="phone" value="{{ $shop->phone }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-2 col-form-label">{{ translate('Shop Logo') }}</label>
                <div class="col-md-10">
                    <div class="custom-file">
                        <input name="logo" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-name custom-file-label" for="customFile">Choose file</label>
                    </div>
                    {{-- <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                        <input type="hidden" name="logo" value="{{ $shop->logo }}" class="selected-files">
                    </div> --}}
                    <div class="file-preview box sm mt-3">
                    @if($shop->logo != null)
                        <img id="originalImg" src="{{ uploaded_asset($shop->logo) }}" class="img-thumbnail h-220px" >
                    @else
                        <img src="#" id="previewImg" class="img-thumbnail h-220px" >
                    @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col-md-2 col-form-label">{{ translate('Shop Address') }} <span class="text-danger text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control mb-3" placeholder="{{ translate('Address')}}" name="address" value="{{ $shop->address }}" required>
                </div>
            </div>
            @if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping')
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ translate('Shipping Cost')}} <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-10">
                        <input type="number" min="0" class="form-control mb-3" placeholder="{{ translate('Shipping Cost')}}" name="shipping_cost" value="{{ $shop->shipping_cost }}" required>
                    </div>
                </div>
            @endif 
            @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
            <div class="row mb-3">
                <label class="col-md-2 col-form-label">{{ translate('Pickup Points') }}</label>
                <div class="col-md-10">
                    <select class="form-control js-select selectpicker" data-placeholder="{{ translate('Select Pickup Point') }}" id="pick_up_point" name="pick_up_point_id[]" multiple>
                        @foreach (\App\PickupPoint::all() as $pick_up_point)
                            @if (Auth::user()->shop->pick_up_point_id != null)
                                <option value="{{ $pick_up_point->id }}" @if (in_array($pick_up_point->id, json_decode(Auth::user()->shop->pick_up_point_id))) selected @endif>{{ $pick_up_point->getTranslation('name') }}</option>
                            @else
                                <option value="{{ $pick_up_point->id }}">{{ $pick_up_point->getTranslation('name') }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            @endif

            <div class="row">
                <label class="col-md-2 col-form-label">{{ translate('Meta Title') }}<span class="text-danger text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control mb-3" placeholder="{{ translate('Meta Title')}}" name="meta_title" value="{{ $shop->meta_title }}" required>
                </div>
            </div>
            <div class="row">
                <label class="col-md-2 col-form-label">{{ translate('Meta Description') }}<span class="text-danger text-danger">*</span></label>
                <div class="col-md-10">
                    <textarea name="meta_description" rows="3" class="form-control mb-3" required>{{ $shop->meta_description }}</textarea>
                </div>
            </div>
            <div class="form-group mb-0 text-right">
                <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
            </div>
        </form>
    </div>
</div>

{{-- Banner Settings --}}
{{-- <div class="card mb-4">
    <div class="card-header">
        <h5 class="h6 font-weight-semi-bold">{{ translate('Banner Settings') }}</h5>
    </div>
    <div class="card-body">
        <form class="dropzone border rounded" action="{{ route('dropzone.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label class="col-md-2 col-form-label font-weight-semi-bold">{{ translate('Banners') }} (1500x450)</label>
                <div class="col-md-10">                  
                    <div class="fallback">
                        <input name="slider" type="file" multiple />
                    </div>
                    <small class="text-muted">{{ translate('We had to limit height to maintian consistancy. In some device both side of the banner might be cropped for height limitation.') }}</small>
                </div>
            </div>
        </form>
        @if($sliders->count() > 0)
        <div class="file-preview box sm">
            @foreach($sliders as $slider)
            <img src="{{ uploaded_asset($slider->id) }}" class="img-thumbnail h-220px" >
            @endforeach
        </div>
        @endif
    </div>
</div> --}}

{{-- Social Media Link --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="h6 font-weight-semi-bold">{{ translate('Social Media Link') }}</h5>
    </div>
    <div class="card-body">
        <form class="" action="{{ route('shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <div class="form-box-content p-3">
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">{{ translate('Facebook') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="{{ translate('Facebook')}}" name="facebook" value="{{ $shop->facebook }}">
                        <small class="text-muted">{{ translate('Insert link with https ') }}</small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">{{ translate('Twitter') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="{{ translate('Twitter')}}" name="twitter" value="{{ $shop->twitter }}">
                        <small class="text-muted">{{ translate('Insert link with https ') }}</small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">{{ translate('Google') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="{{ translate('Google')}}" name="google" value="{{ $shop->google }}">
                        <small class="text-muted">{{ translate('Insert link with https ') }}</small>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label">{{ translate('Youtube') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="{{ translate('Youtube')}}" name="youtube" value="{{ $shop->youtube }}">
                        <small class="text-muted">{{ translate('Insert link with https ') }}</small>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0 text-right">
                <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    $('#previewImg').hide();

    $(".custom-file input").on('change',function (e) {
        var files = [];
        const [file] = $(this)[0].files;
        if (file) {
            const src = URL.createObjectURL(file)
            $(this).next(".custom-file-name").html(file.name);

            $("#previewImg").attr("src", src);
            $('#previewImg').show();
            $('#originalImg').hide();
        }
    });

</script>
@endsection
