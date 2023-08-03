@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Product</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Product</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">
				<div class="btn-group">
					<a href="{{ route('create.product') }}" class="btn btn-sm btn-primary pull-right">Create New</a>
				</div>
			</div>
		</div>
		<!--end breadcrumb-->
		<hr/>
		@include('alert.alert')
		<div class="card">
			<div class="card-body">
                <div class="">
                    <div class="row">
                        <div class="col-7">
                            <h5 class="mb-0">All Products</h5>

                        </div>
                        <div class="col-5">
                            <form action="{{ route('index.product') }}" method="GET">

                                <div class="d-flex">
                                    <input type="text" name="search" class="form-control" value="{{ request('search') }}" autocomplete="off" placeholder="Search by product name"> <button style="margin-left: 4px" type="submit" class="btn btn-primary btn-sm">Search</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <br>

				<div class="table-responsive">
					<table id="example2" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="5%">SL</th>
                                <th>Image</th>
								<th>Name</th>
								<th>Sell Price</th>
								<th>Status</th>
								<th>Category</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $key=>$row)
							<tr>
								<td width="5%">{{ ++$i }}</td>
                                <td>
									<img src="{{ asset($row->thumbnail) }}" width="60">
								</td>
								<td>{{ $row->product_name }}</td>
								<td>{{ $row->discount_price }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn  {{ $row->status == 1 ? 'btn-primary':'btn-danger' }} btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                          {{$row->status == 1 ? 'Publish':'Unpublish' }}
                                        </button>

                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="{{ route('product.status.change',['productId'=>$row->id,'statusId'=>1]) }}">Publish</a></li>
                                          <li><a class="dropdown-item" href="{{ route('product.status.change',['productId'=>$row->id,'statusId'=>0]) }}">Unpublish</a></li>
                                        </ul>
                                      </div>


                                </td>
								<td>{{ $row->category->category_name }}</td>


								<td>


                                    <div class="dropdown">
                                        <button type="button" class="btn  btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                          Options
                                        </button>

                                        <ul class="dropdown-menu">
                                          <li><a target="_blank" class="dropdown-item"href="{{ url('product/details',$row->product_slug) }}"  >View</a></li>
                                            <li><a href="{{ route('edit.product',$row->id) }}" class="dropdown-item">Edit</a></li>
                                            <li>
                                                <a href="{{ route('delete.product',$row->id) }}" class="dropdown-item" id="delete">Delete</a>

                                            </li>
                                        </ul>
                                      </div>







								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Product Code</th>
								<th>Category</th>

								<th>Price</th>
								<th>Image</th>
								<th width="15%">Action</th>
							</tr>
						</tfoot>
					</table>
                    {{$products->links()}}
				</div>


				<!--View Modal -->
				<div class="modal fade" id="viewModel" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content" id="view_part">

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@push('js')

	<script>
			//edit modal show and after submit
		    $('body').on('click', '.view', function () {
		      var id = $(this).data('id'); //i or 2 categoryid
		      $.get("{{ url('admin/product/view') }}/"+id,
		      function (data) {
		           $('#view_part').html(data);
		        })
		    });
	</script>

@endpush

@endsection
