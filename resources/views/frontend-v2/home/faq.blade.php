@extends('frontend-v2.layouts.app')

@section('title', translate('FAQ'))

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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">{{translate('Home')}}</a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{translate('FAQ')}}</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-12 text-center">
                <h1>AMAZON VIỆT NAM Có thể giúp gì cho bạn?</h1>
                <p class="text-gray-44">Thỏa thuận này được sửa đổi lần cuối vào ngày 20 tháng 08 năm 2021</p>
            </div>
            <div class="border-bottom border-color-1 mb-8 rounded-0">
                <h3 class="section-title mb-0 pb-2 font-size-25">Thông tin vận chuyển</h3>
            </div>
            <div class="row mb-8">
                <div class="col-lg-6 mb-5 mb-lg-8">
                    <h3 class="font-size-18 font-weight-semi-bold text-gray-39 mb-4">Có những phương thức vận chuyển nào?
                    </h3>
                    <p class="text-gray-90">Trong quá trình đặt hàng trên Amazonvietnam.com.vn, người mua hàng có thể chọn chuyển phát thông thường hoặc chuyển phát nhanh, nhận hàng tại nhà hoặc tại kho hàng. Người bán cung cấp sản phẩm sẽ liên hệ với khách hàng để thống nhất phương thức giao hàng.</p>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-8">
                    <h3 class="font-size-18 font-weight-semi-bold text-gray-39 mb-4">Mất bao lâu để nhận được gói hàng của tôi??</h3>
                    <p class="text-gray-90">Thời gian giao hàng tùy thuộc vào Quý khách lựa chọn chuyển phát nhanh hay chuyển phát thường, thời gian này chỉ mang tính chất tương đối.</br>
                        •   Chuyển phát nhanh: Từ 2 đến 3 ngày</br>
                        •   Chuyển phát thường: Từ 5 đến 10 ngày
</p>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-8">
                    <h3 class="font-size-18 font-weight-semi-bold text-gray-39 mb-4">Làm cách nào để theo dõi đơn hàng của tôi?</h3>
                    <p class="text-gray-90">    Chúng tôi có hệ thống kiểm soát đơn hàng, trên website để quý khách hàng có thể theo dõi trạng thái đơn hàng chi tiết cho từng giai đoạn. Quý khách sẽ theo dõi được hàng đã được giao cho đơn vị vận chuyển chưa, hàng đang được luân chuyển đến địa chỉ nào rồi, dự tính số ngày mà bạn sẽ nhận được hàng.
</p>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-8">
                    <h3 class="font-size-18 font-weight-semi-bold text-gray-39 mb-4">Tôi Có Cần Tài Khoản Để Đặt Hàng Không?
                    </h3>
                    <p class="text-gray-90">Quý khách cần phải đăng kí tài khoản để có thể tiến hành đặt hành, điều này giúp đảm bảo quyền lợi cho quý khách hàng để chúng tôi có thể ghi lại đơn đặt hàng và thông tin của quý khách để hỗ trợ trong các trường hợp xảy ra khi mua hàng hoặc bảo hành.</p>
                </div>
            </div>
            <div class="mb-12 text-center">
                <h1>Chính sách của Amazon Việt Nam</h1>
            </div>
            <!-- Basics Accordion -->
            <div id="basicsAccordion" class="mb-12">
                <!-- Card -->
                <div class="card mb-3 border-top-0 border-left-0 border-right-0 border-color-1 rounded-0">
                    <div class="card-header card-collapse bg-transparent-on-hover border-0" id="basicsHeadingOne">
                        <h5 class="mb-0">
                            <button type="button"
                                class="px-0 btn btn-link btn-block d-flex justify-content-between card-btn py-3 font-size-25 border-0"
                                data-toggle="collapse" data-target="#basicsCollapseOner" aria-expanded="true"
                                aria-controls="basicsCollapseOner">
                                Hỗ trợ những phương thức vận chuyện nào?

                                <span class="card-btn-arrow">
                                    <i class="fas fa-chevron-down text-gray-90 font-size-18"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="basicsCollapseOner" class="collapse show" aria-labelledby="basicsHeadingOne"
                        data-parent="#basicsAccordion">
                        <div class="card-body pl-0 pb-8">
                            <p class="mb-0">- Với những khách hàng đặt hàng trên Amazonvietnam.com,vn và yêu cầu giao hàng tại nhà </br>
    - Bộ phận Giao vận sẽ liên lạc trước để Quý khách sắp xếp thời gian, địa điểm cụ thể để giao hàng cho Quý khách.</br>
    - Quý khách nhận hàng, ký vào phiếu giao hàng và thanh toán cho nhân viên giao nhận toàn bộ hoặc một phần (nếu đã đặt cọc) giá trị hàng hóa đã mua (bao gồm giá trị tiền hàng + phí vận chuyển (nếu có) + phí lắp đặt (nếu có)).</br>
    - Trường hợp hàng hóa phải chuyển từ kho chứa hàng ở xa về kho tại công ty và chi nhánh của Amazon Việt Nam, nhân viên bán hàng sẽ liên hệ với Quý khách để thương thảo lại về thời gian giao hàng.</br>
    -  Trường hợp vì một lý do nào đó Nhà cung cấp không thể giao hàng kịp thời sẽ liên hệ lại và thông báo cho Quý khách được biết.
</p>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card --
                <div class="card mb-3 border-top-0 border-left-0 border-right-0 border-color-1 rounded-0">
                    <div class="card-header card-collapse bg-transparent-on-hover border-0" id="basicsHeadingTwo">
                        <h5 class="mb-0">
                            <button type="button"
                                class="px-0 btn btn-link btn-block d-flex justify-content-between card-btn collapsed py-3 font-size-25 border-0"
                                data-toggle="collapse" data-target="#basicsCollapseTwo" aria-expanded="false"
                                aria-controls="basicsCollapseTwo">
                                How Long Will it Take To Get My Package?

                                <span class="card-btn-arrow">
                                    <i class="fas fa-chevron-down text-gray-90 font-size-18"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="basicsCollapseTwo" class="collapse" aria-labelledby="basicsHeadingTwo"
                        data-parent="#basicsAccordion">
                        <div class="card-body pl-0 pb-8">
                            <p class="mb-0">In egestas, libero vitae scelerisque tristique, turpis augue faucibus dolor, at
                                aliquet ligula massa at justo. Donec viverra tortor quis tortor pretium, in pretium risus
                                finibus. Integer viverra pretium auctor. Aliquam eget convallis eros, varius sagittis nulla.
                                Suspendisse potenti. Aenean consequat ex sit amet metus ultrices tristique. Nam ac nunc
                                augue. Suspendisse finibus in dolor eget volutpat.</p>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card 
                <div class="card mb-3 border-top-0 border-left-0 border-right-0 border-color-1 rounded-0">
                    <div class="card-header card-collapse bg-transparent-on-hover border-0" id="basicsHeadingThree">
                        <h5 class="mb-0">
                            <button type="button"
                                class="px-0 btn btn-link btn-block d-flex justify-content-between card-btn collapsed py-3 font-size-25 border-0"
                                data-toggle="collapse" data-target="#basicsCollapseThree" aria-expanded="false"
                                aria-controls="basicsCollapseThree">
                                How Do I Track My Order?

                                <span class="card-btn-arrow">
                                    <i class="fas fa-chevron-down text-gray-90 font-size-18"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="basicsCollapseThree" class="collapse" aria-labelledby="basicsHeadingThree"
                        data-parent="#basicsAccordion">
                        <div class="card-body pl-0 pb-8">
                            <p class="mb-0">In egestas, libero vitae scelerisque tristique, turpis augue faucibus dolor, at
                                aliquet ligula massa at justo. Donec viverra tortor quis tortor pretium, in pretium risus
                                finibus. Integer viverra pretium auctor. Aliquam eget convallis eros, varius sagittis nulla.
                                Suspendisse potenti. Aenean consequat ex sit amet metus ultrices tristique. Nam ac nunc
                                augue. Suspendisse finibus in dolor eget volutpat.</p>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card 
                <div class="card mb-3 border-top-0 border-left-0 border-right-0 border-color-1 rounded-0">
                    <div class="card-header card-collapse bg-transparent-on-hover border-0" id="basicsHeadingFour">
                        <h5 class="mb-0">
                            <button type="button"
                                class="px-0 btn btn-link btn-block d-flex justify-content-between card-btn collapsed py-3 font-size-25 border-0"
                                data-toggle="collapse" data-target="#basicsCollapseFour" aria-expanded="false"
                                aria-controls="basicsCollapseFour">
                                How Do I Place an Order?

                                <span class="card-btn-arrow">
                                    <i class="fas fa-chevron-down text-gray-90 font-size-18"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="basicsCollapseFour" class="collapse" aria-labelledby="basicsHeadingFour"
                        data-parent="#basicsAccordion">
                        <div class="card-body pl-0 pb-8">
                            <p class="mb-0">In egestas, libero vitae scelerisque tristique, turpis augue faucibus dolor, at
                                aliquet ligula massa at justo. Donec viverra tortor quis tortor pretium, in pretium risus
                                finibus. Integer viverra pretium auctor. Aliquam eget convallis eros, varius sagittis nulla.
                                Suspendisse potenti. Aenean consequat ex sit amet metus ultrices tristique. Nam ac nunc
                                augue. Suspendisse finibus in dolor eget volutpat.</p>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card 
                <div class="card mb-3 border-top-0 border-left-0 border-right-0 border-color-1 rounded-0">
                    <div class="card-header card-collapse bg-transparent-on-hover border-0" id="basicsHeadingFive">
                        <h5 class="mb-0">
                            <button type="button"
                                class="px-0 btn btn-link btn-block d-flex justify-content-between card-btn collapsed py-3 font-size-25 border-0"
                                data-toggle="collapse" data-target="#basicsCollapseFive" aria-expanded="false"
                                aria-controls="basicsCollapseFive">
                                How Should I to Contact if I Have Any Queries?

                                <span class="card-btn-arrow">
                                    <i class="fas fa-chevron-down text-gray-90 font-size-18"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="basicsCollapseFive" class="collapse" aria-labelledby="basicsHeadingFive"
                        data-parent="#basicsAccordion">
                        <div class="card-body pl-0 pb-8">
                            <p class="mb-0">In egestas, libero vitae scelerisque tristique, turpis augue faucibus dolor, at
                                aliquet ligula massa at justo. Donec viverra tortor quis tortor pretium, in pretium risus
                                finibus. Integer viverra pretium auctor. Aliquam eget convallis eros, varius sagittis nulla.
                                Suspendisse potenti. Aenean consequat ex sit amet metus ultrices tristique. Nam ac nunc
                                augue. Suspendisse finibus in dolor eget volutpat.</p>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card 
                <div class="card mb-3 border-top-0 border-left-0 border-right-0 border-color-1">
                    <div class="card-header card-collapse bg-transparent-on-hover border-0" id="basicsHeadingSix">
                        <h5 class="mb-0">
                            <button type="button"
                                class="px-0 btn btn-link btn-block d-flex justify-content-between card-btn collapsed py-3 font-size-25 border-0"
                                data-toggle="collapse" data-target="#basicsCollapseSix" aria-expanded="false"
                                aria-controls="basicsCollapseSix">
                                Do I Need an Account to Place an Order?

                                <span class="card-btn-arrow">
                                    <i class="fas fa-chevron-down text-gray-90 font-size-18"></i>
                                </span>
                            </button>
                        </h5>
                    </div>
                    <div id="basicsCollapseSix" class="collapse" aria-labelledby="basicsHeadingSix"
                        data-parent="#basicsAccordion">
                        <div class="card-body pl-0">
                            <p class="mb-0">In egestas, libero vitae scelerisque tristique, turpis augue faucibus dolor, at
                                aliquet ligula massa at justo. Donec viverra tortor quis tortor pretium, in pretium risus
                                finibus. Integer viverra pretium auctor. Aliquam eget convallis eros, varius sagittis nulla.
                                Suspendisse potenti. Aenean consequat ex sit amet metus ultrices tristique. Nam ac nunc
                                augue. Suspendisse finibus in dolor eget volutpat.</p>
                        </div>
                    </div>
                </div>
                <!-- End Card -->

                <div class="col-12 col-md mb-4 mb-md-0">
                            <!-- List Group -->
                            <h6 class="mb-3 font-weight-bold">{{ get_setting('widget_one') }}</h6>
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                    <li><a class="list-group-item list-group-item-action" href="https://amazonvietnam.com.vn/terms">Chính sách đổi trả.</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://amazonvietnam.com.vn/terms">Chính sách hàng hóa do sàn bán.</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://amazonvietnam.com.vn/terms">Chính sách vận chuyển giao nhận hàng hóa.</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://amazonvietnam.com.vn/terms">Hướng dẫn đăng kí tài khoản.</a></li>
                                    <li><a class="list-group-item list-group-item-action" href="https://amazonvietnam.com.vn/terms">Hướng dẫn đăng kí gian hàng.</a></li>

                            </ul>
                            <!-- End List Group -->
                        </div>
            </div>
            <!-- End Basics Accordion -->
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
