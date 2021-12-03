@extends('frontend-v2.layouts.app')

@section('title', translate('Contact Us'))

@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">{{ translate('Home') }}</a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{translate('Contact Us')}}
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->


        <div class="container">
            <div class="mb-5">
                <h1 class="text-center">{{ translate('Contact Us') }}</h1>
            </div>
            <div class="row mb-10">
                <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0">
                    <div class="mr-xl-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">{{translate('Contact')}}</h3>
                        </div>
                        <form action="{{route('contact-us.store')}}" method="POST" class="js-validate" novalidate="novalidate">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <!-- Input -->
                                    <div class="js-form-message mb-4">
                                        <label class="form-label">
                                            {{translate('Full name')}}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="fullName" placeholder=""
                                            aria-label="" required="" data-msg="Vui lòng nhập họ và tên của bạn"
                                            data-error-class="u-has-error" data-success-class="u-has-success"
                                            autocomplete="off">
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-12">
                                    <!-- Input -->
                                    <div class="js-form-message mb-4">
                                        <label class="form-label">
                                            {{translate('Subject')}}
                                        </label>
                                        <input type="text" class="form-control" name="subject" placeholder="" aria-label=""
                                            data-msg="Vui lòng nhập tiêu đề" data-error-class="u-has-error"
                                            data-success-class="u-has-success">
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="col-md-12">
                                    <div class="js-form-message mb-4">
                                        <label class="form-label">
                                            {{translate('Message')}}
                                        </label>

                                        <div class="input-group">
                                            <textarea class="form-control p-5" rows="4" name="content"
                                                placeholder="" data-error-class="u-has-error" data-success-class="u-has-success" data-msg="Vui lòng nhập nội dung" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary-dark-w px-5 text-white">{{translate('Send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-6">
                    <div class="mb-6">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.0608487721724!2d106.69639571480178!3d10.882976592249243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d7e519621755%3A0x817b2e2274c4c668!2sAmazon%20Vi%E1%BB%87t%20Nam!5e0!3m2!1svi!2s!4v1632512217626!5m2!1svi!2s" 
                            width="100%" height="288" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-25">Văn Phòng Giao Dịch</h3>
                    </div>
                    <address class="mb-6 text-lh-23">
                       <p>
                       <span class="font-size-20 font-weight-bold">CÔNG TY CP AMAZON VIỆT NAM, thành viên của TẬP ĐOÀN AMAZON</span></br><br>
                        Trụ sở:<span class="font-weight-bold"> Số 9 Nguyễn Thị Định, Thanh Châu, Phủ Lý, Hà Nam, Việt Nam</span> </br>                    
                        VP: <span class="font-weight-bold">Số 219 Đại Lộ Bình Dương, Vĩnh Phú, Thuận An, Bình Dương, Việt Nam</span></br>
                        Hotline: <span class="font-weight-bold">0888819966</span> </br>
                        Email:     <span class="font-weight-bold">info@amazonvietnam.com.vn</span></br>
                        Website: <span class="font-weight-bold">AMAZONVIETNAM.COM.VN</span></br>
                        Số ĐKKD: <span class="font-weight-bold">0700827959 - Ngày cấp 17/06/2019</span></br>
                        Nơi cấp: <span class="font-weight-bold">Sở Kế Hoạch & Đầu Tư Hà Nam.</span></br>
                        Hotline: <span class="font-weight-bold">08888.199.66</span></p>

                    </address>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
