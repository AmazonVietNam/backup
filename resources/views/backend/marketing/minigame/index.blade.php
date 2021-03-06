@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
			<h1 class="h3">{{translate('All Mini')}}</h1>
	</div>
</div>

<div class="row">
	<div class="col-md-7">
		<div class="card">
		    <div class="card-header row gutters-5">
				<div class="col text-center text-md-left">
					<h5 class="mb-md-0 h6">{{ translate('Mini Game') }}</h5>
				</div>
				<div class="col-md-4">
					<form class="" id="sort_brands" action="" method="GET">
						<div class="input-group input-group-sm">
					  		<input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
						</div>
					</form>
				</div>
		    </div>
		    <div class="card-body">
		        <table class="table aiz-table mb-0">
		            <thead>
		                <tr>
		                    <th>#</th>
		                    <th>{{translate('Name')}}</th>
		                    <th>{{translate('Logo')}}</th>
		                    <th>{{translate('Top')}}</th>
		                    <th>{{translate('Status')}}</th>
		                    <th class="text-right">{{translate('Options')}}</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($brands as $key => $brand)
		                    <tr>
		                        <td>{{ ($key+1) + ($brands->currentPage() - 1)*$brands->perPage() }}</td>
		                        <td>{{ $brand->name }}</td>
														<td>
		                            <img src="{{ uploaded_asset($brand->logo) }}" alt="{{translate('name')}}" class="h-50px">
		                        </td>
		                        <td>{{ $brand->top }}</td>
		                        <td>
		                        	{{ $brand->status }}
		                            <!--
		                            <label class="aiz-switch aiz-switch-success mb-0">
		                                <input type="checkbox" onchange="update_featured(this)" value="{{ $brand->status }}" <?php if($brand->status == 1) echo "checked";?>>
		                                <span></span>
		                            </label>
		                        -->
		                        </td>
		                        <td class="text-right">
		                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('brands.edit', ['id'=>$brand->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
		                                <i class="las la-edit"></i>
		                            </a>
		                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('minigame.destroy', $brand->id)}}" title="{{ translate('Delete') }}">
		                                <i class="las la-trash"></i>
		                            </a>
		                        </td>
		                    </tr>
		                @endforeach
		            </tbody>
		        </table>
		        <div class="aiz-pagination">
                	{{ $brands->appends(request()->input())->links() }}
            	</div>
		    </div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0 h6">{{ translate('Add Minigame') }}</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('minigame.store') }}" method="POST">
					@csrf
					<div class="form-group mb-3">
						<label for="name">{{translate('Name Minigame')}}</label>
						<input type="text" placeholder="{{translate('Name Minigame')}}" name="name" class="form-control" required>
					</div>
					<div class="form-group mb-3">
					<div class="form-group mb-3">
						<label for="name">{{translate('Main Banner')}} <small>({{ translate('200x200') }})</small></label>
						<div class="input-group" data-toggle="aizuploader" data-type="image">
							<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
							</div>
							<div class="form-control file-amount">{{ translate('Choose File') }}</div>
							<input type="hidden" name="logo" class="selected-files">
						</div>
						<div class="file-preview box sm">
						</div>
					<div class="form-group mb-3">
						<label for="name">{{translate('Banner Event')}} <small>({{ translate('200x200') }})</small></label>
						<div class="input-group" data-toggle="aizuploader" data-type="image">
							<div class="input-group-prepend">
									<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
							</div>
							<div class="form-control file-amount">{{ translate('Choose File') }}</div>
							<input type="hidden" name="banner" class="selected-files">
						</div>
						<div class="file-preview box sm">
						</div>
						<label for="name">{{translate('Start time')}}</label>
						<input type="datetime-local" name="timestart" class="form-control" required>
					</div>
					<div class="form-group mb-3">
						<label for="name">{{translate('Dial time')}}</label>
						<input type="number" placeholder="{{translate('Minute')}}" name="cd" class="form-control">
					</div>
					<div class="form-group mb-3">
						<label for="name">{{translate('Top')}}</label>
						<input type="number" placeholder="{{translate('Top')}}" name="top" class="form-control">
					</div>
					<div class="form-group mb-3">
						<label for="name">{{translate('Status')}}</label>
						<input type="number" placeholder="{{translate('Status')}}" name="status" class="form-control">
					</div>
					<div class="form-group mb-3 text-right">
						<button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">
    function sort_brands(el){
        $('#sort_brands').submit();
    }
</script>
@endsection
