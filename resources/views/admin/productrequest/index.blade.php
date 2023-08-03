@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">All Request Product</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page"> Request Product</li>
					</ol>
				</nav>
			</div>
            <div class="ms-auto">
				<div class="btn-group">
					<a href="{{ route('add.productrequest') }}" class="btn btn-sm btn-primary pull-right">Add Product Request</a>
				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<hr/>
		@include('alert.alert')
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Product Heading</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($requesstproducts as $key=>$requestproduct)
							<tr>
								<td>{{ ++$key }}</td>
								<td>{{ $requestproduct->name }}</td>

								<td>
									<a href="{{ route('edit.productrequest',$requestproduct->id) }}" class="btn btn-primary">Edit</a>
									<a href="{{ route('delete.productrequest',$requestproduct->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                    
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
                                <th width="5%">SL</th>
								<th>Product Heading</th>

								<th width="10%">Action</th>
							</tr>
						</tfoot>
					</table>
				</div>

				<!--Edit Modal -->

			</div>
		</div>
	</div>
</div>

@push('js')



@endpush

@endsection
