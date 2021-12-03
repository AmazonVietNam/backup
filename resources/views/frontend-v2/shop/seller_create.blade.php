@extends('frontend-v2.layouts.app')

@section('content')
<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            
            <div class="col">
                <ul class="breadcrumb bg-transparent p-0 justify-content-start">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark font-weight-bold breadcrumb-item">
                        <a class="text-reset" href="{{ route('shops.create') }}">{{ translate('Register your shop')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="pt-4 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                <div class="text-center">
                    <h1 class="font-weight-bold h4">{{ translate('Register your shop')}}</h1>
                </div>
                <form id="shop" class="" action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (!Auth::check())
                        <div class="bg-white rounded shadow-sm mb-3 p-3">
                            <div class="fs-15 fw-600 p-3 border-bottom">
                                {{ translate('Info')}}
                            </div>
                            <div class="p-3">
                                <div class="form-group">
                                    <label>{{ translate('Your Email')}} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Your Password')}} <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Repeat Password')}} <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                </div>
								<div class="form-group">
									<input type="radio" id="cn" name="dn_cn" value="cn" checked>&nbsp;<label for="cn">Cá nhân</label><input type="text" class="form-control" placeholder="Số CMND hoặc CCCD" name="id_user_code" id="id_user_code">
									<br>
									<input type="radio" id="dn" name="dn_cn" value="dn">&nbsp;<label for="dn">Doanh nghiệp</label><input type="text" class="form-control" placeholder="Mã số thuế" name="id_com_code" id="id_com_code">
								</div>
                            </div>
                        </div>
                    @endif
                    <div class="bg-white rounded shadow-sm mb-4 p-3">
                        <div class="fs-15 fw-600 p-3 border-bottom">
                            {{ translate('Basic Info')}}
                        </div>
                        <div class="p-3">
                            <div class="form-group">
                                <label>{{ translate('Shop Name')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ translate('Shop Name')}}" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>{{ translate('Phone')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ translate('Phone')}}" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label>{{ translate('Logo')}} <span class="text-danger">*</span></label>

                                <div class="custom-file" id="logo-shop">
                                    <input name="logo" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-name custom-file-label" for="customFile">Chọn ảnh</label>
                                    
                                </div>
                                <img class="mt-2 img-thumbnail h-220px" id="previewImg" src="#" alt="shop logo" />
                            </div>

                            <div class="form-group">
                                <label>{{ translate('Address')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Address')}}" name="address" required>
                            </div>
                        </div>
                    </div>

                    @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                        <div class="form-group mt-2 mx-auto row">
                            <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                        </div>
                    @endif

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mb-5">{{ translate('Register Your Shop')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#previewImg').hide();

        if($('#cn').is(':checked')) {
            $('#id_com_code').attr('disabled', true);
            $('#id_user_code').removeAttr('disabled');
        } else if($('#dn').is(':checked')) {
            $('#id_user_code').attr('disabled', true);
            $('#id_com_code').removeAttr('disabled');
        }

        $('#cn').change(function() {
            if($('#cn').is(':checked')) {
                $('#id_com_code').attr('disabled', true);
                $('#id_user_code').removeAttr('disabled');
            }
        });

        $('#dn').change(function() {
            if($('#dn').is(':checked')) {
                $('#id_user_code').attr('disabled', true);
                $('#id_com_code').removeAttr('disabled');
            }
        });

        $(".custom-file input").on('change',function (e) {
            var files = [];
            const [file] = $(this)[0].files;
            if (file) {
                const src = URL.createObjectURL(file)
                $(this).next(".custom-file-name").html(file.name);

                $("#previewImg").attr("src", src);
                $('#previewImg').show();
            }
        });
    });
    // making the CAPTCHA  a required field for form submission
    $(document).ready(function(){
        // alert('helloman');
        $("#shop").on("submit", function(evt)
        {
            var response = grecaptcha.getResponse();
            if(response.length == 0)
            {
            //reCaptcha not verified
                alert("please verify you are humann!");
                evt.preventDefault();
                return false;
            }
            //captcha verified
            //do the rest of your validations here
            $("#reg-form").submit();
        });
    });
</script>
@endsection
