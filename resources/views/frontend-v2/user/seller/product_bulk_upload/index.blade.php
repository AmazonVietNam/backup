@extends('frontend-v2.layouts.dashboard')

@section('content')
<div class="mb-4">
    <div class="row align-items-center">
    <div class="col-md-6">
        <h1 class="h3">{{ translate('Bulk Products Upload') }}</h1>
    </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table aiz-table mb-0" >
            <tr>
                <td>{{ translate('1. Download the skeleton file and fill it with data.')}}</td>
            </tr>
            <tr >
                <td>{{ translate('2. You can download the example file to understand how the data must be filled.')}}</td>
            </tr>
            <tr>
                <td>{{ translate('3. Once you have downloaded and filled the skeleton file, upload it in the form below and submit.')}}</td>
            </tr>
            <tr>
                <td>{{ translate('4. After uploading products you need to edit them and set products images and choices.')}}</td>
            </tr>
        </table>
        <a href="{{ static_asset('download/product_bulk_demo.xlsx') }}" download><button class="btn btn-primary mt-2">{{ translate('Download CSV') }}</button></a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <table class="table aiz-table mb-0" >
            <tr>
                <td>{{ translate('1. Category and Brand should be in numerical id.')}}</td>
            </tr>
            <tr >
                <td>{{ translate('2. You can download the pdf to get Category and Brand id.')}}</td>
            </tr>
        </table>
        <a href="{{ route('pdf.download_category') }}"><button class="btn btn-primary mt-2">{{ translate('Download Category')}}</button></a>
        <a href="{{ route('pdf.download_brand') }}"><button class="btn btn-primary mt-2">{{ translate('Download Brand')}}</button></a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6">{{ translate('Upload CSV File') }}</h5>
        </div>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{ route('bulk_product_upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-md-2 col-form-label">{{ translate('CSV') }}</label>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <label class="custom-file-label">
                            <input id="inputGroupFile02" type="file" name="bulk_file" class="custom-file-input" required>
                            <span class="custom-file-label custom-file-name" for="inputGroupFile02">{{ translate('Choose File')}}</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group mb-0 text-right">
                <button type="submit" class="btn btn-primary">{{translate('Upload CSV')}}</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    // $('#inputGroupFile02').on('change',function(){
    //     //get the file name
    //     var fileName = $(this).val();
    //     //replace the "Choose a file" label
    //     $(this).next('.custom-file-label').html(fileName);
    // })
    $(".custom-file input").on('change',function (e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        if (files.length === 1) {
            $(this).next(".custom-file-name").html(files[0]);
        } else if (files.length > 1) {
            $(this)
                .next(".custom-file-name")
                .html(files.length + " Files Selected");
        } else {
            $(this).next(".custom-file-name").html("Choose file");
        }
    });
</script>
@endsection