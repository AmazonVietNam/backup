@extends('frontend-v2.layouts.app')

@section('content')


<section class="mb-4 gry-bg">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-xxl-8 col-xl-10 mx-auto">
                <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                    @csrf
                        @if(Auth::check())
                        <div class="shadow-sm bg-white p-4 rounded mb-4">
                            <div class="row gutters-5">
                                @foreach (Auth::user()->addresses as $key => $address)
                                    <div class="col-md-6 mb-3">
                                        <label class="border rounded p-2 d-block bg-white mb-0">
                                            <input type="radio" name="address_id" value="{{ $address->id }}" @if ($address->set_default)
                                                checked
                                            @endif required>
                                            <span class="d-flex p-3 aiz-megabox-elem">
                                                <span class="rounded flex-shrink-0 mt-1"></span>
                                                <span class="flex-grow-1 pl-3 text-left">
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Address') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->address }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Postal Code') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->postal_code }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Ward') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->ward_name }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('District') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->district_name }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('City') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->city }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Country') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->country }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="opacity-60">{{ translate('Phone') }}:</span>
                                                        <span class="fw-600 ml-2">{{ $address->phone }}</span>
                                                    </div>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                                <input type="hidden" name="checkout_type" value="logged">
                                <div class="col-md-6 mx-auto mb-3" >
                                    <div class="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center" onclick="add_new_address()">
                                        <i class="las la-plus la-2x mb-3"></i>
                                        <div class="alpha-7">{{ translate('Add New Address') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="shadow-sm bg-white p-4 rounded mb-4">
                                <div class="form-group">
                                    <label class="control-label">{{ translate('Name')}}</label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ translate('Name')}}" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{ translate('Email')}}</label>
                                    <input type="text" class="form-control" name="email" placeholder="{{ translate('Email')}}" required>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{ translate('Address')}}</label>
                                    <input type="text" class="form-control" name="address" placeholder="{{ translate('Address')}}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">{{ translate('Select your country')}}</label>
                                            <select class="form-control js-select" data-live-search="true" name="country">
                                                @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{ translate('City')}}</label>
                                            <input type="text" class="form-control" placeholder="{{ translate('City')}}" name="city" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <!--<div class="form-group has-feedback">
                                            <label class="control-label">{{ translate('Postal code')}}</label>
                                            <input type="text" class="form-control" placeholder="{{ translate('Postal code')}}" name="postal_code" required>
                                        </div>-->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label">{{ translate('Phone')}}</label>
                                            <input type="number" min="0" class="form-control" placeholder="{{ translate('Phone')}}" name="phone" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="checkout_type" value="guest">
                            </div>
                        @endif
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                            <a href="{{ route('home') }}" class="btn btn-link">
                                <i class="las la-arrow-left"></i>
                                {{ translate('Return to shop')}}
                            </a>
                        </div>
                        <div class="col-md-6 text-center text-md-right">
                            <button type="submit" class="btn btn-primary fw-600">{{ translate('Continue to Delivery Info')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ translate('New Address')}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Address')}}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{ translate('Your Address')}}" rows="1" name="address" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Country')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select id="sl_country" class="form-control mb-3 js-select" data-live-search="true" name="country" required>
                                    @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Province')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select id="sl_province" class="form-control js-select selectpicker" data-live-search="true" data-placeholder="{{ translate('Select your province')}}" name="province" required>
                                        <option disabled selected>{{ translate('Select your province')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('District')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select id="sl_district" class="form-control js-select selectpicker" data-live-search="true" data-placeholder="{{ translate('Select your district')}}" name="district" required>
                                        <option disabled selected>{{ translate('Select your district')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Ward')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select id="sl_ward" class="form-control js-select selectpicker" data-live-search="true" data-placeholder="{{ translate('Select your ward')}}" name="ward" required>
                                        <option disabled selected>{{ translate('Select your ward')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Postal code')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="" required>
                            </div>
                        </div>
                        -->
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Phone')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Phone')}}" name="phone" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{  translate('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type='text/javascript'>
    $(document).ready(function(){
        var initId = $('#sl_country').val()
        if(initId) {
            $('#sl_province').find('option').not(':first').remove();
            $.ajax({
                url: 'addresses/country/'+initId,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    for(var i=0; i < response.length; i++){
                        var option = "<option value='"+response[i].id+"'>" + response[i].name + "</option>"; 
               
                        $("#sl_province").append(option); 
                    }
                    $("#sl_province").selectpicker('refresh');
                }
            });
        }
      // Department Change
        $('#sl_country').change(function(){
            var id = $(this).val();
            if(id) {
                $('#sl_province').find('option').not(':first').remove();
                $('#sl_district').find('option').not(':first').remove();
                $('#sl_ward').find('option').not(':first').remove();

                $.ajax({
                    url: 'addresses/country/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        for(var i=0; i < response.length; i++){
                            var option = "<option value='"+response[i].id+"'>"+response[i].name+"</option>"; 
                
                            $("#sl_province").append(option); 
                        }
                        $("#sl_province").selectpicker('refresh');
                    }
                });
            }
        });

        $('#sl_province').change(function() {
            var id = $(this).val();
            if(id) {
                $('#sl_district').find('option').not(':first').remove();
                $('#sl_ward').find('option').not(':first').remove();

                $.ajax({
                    url: 'addresses/province/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        for(var i=0; i < response.length; i++){
                            var option = "<option value='"+response[i].id+"'>"+response[i].name+"</option>"; 
                    
                            $("#sl_district").append(option); 
                        }
                        $("#sl_district").selectpicker('refresh');
                    }
                });
            }
        })

        $('#sl_district').change(function() {
            var id = $(this).val();
            if(id) {
                $('#sl_ward').find('option').not(':first').remove();

                $.ajax({
                    url: 'addresses/district/'+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        for(var i=0; i < response.length; i++){
                            var option = "<option value='"+response[i].id+"'>"+response[i].name+"</option>"; 
                        
                            $("#sl_ward").append(option); 
                        }
                        $("#sl_ward").selectpicker('refresh');
                    }
                });
            }
        })
    });
    </script>

<script type="text/javascript">
    function add_new_address(){
        $('#new-address-modal').modal('show');
    }
</script>
@endsection
