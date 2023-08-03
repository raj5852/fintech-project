@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">All Conatct</div>


			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page"> All Conatct</li>
					</ol>
				</nav>



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
								<th>Name</th>
								<th>Email</th>
								<th>Subject</th>
								<th>Address</th>
								<th>Your Message</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($contact as $key=>$row)
							<tr>
								<td>{{ ++$key }}</td>
								<td>{{ $row->name }}</td>
								<td>{{ $row->email }}</td>
								<td>{{ $row->subject }}</td>
								<td>{{ $row->address }}</td>

								<td>

                                    {{ Str::limit($row->description, 20, '') }}
                                </td>


								<td>
									<a href="{{ route('contact.view',$row->id) }}" class="btn btn-primary">View</a>
									<a href="{{ route('contact.delete',$row->id) }}" class="btn btn-danger" id="delete">Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
                                <th width="5%">SL</th>
								<th>Name</th>
								<th>Email</th>
								<th>Subject</th>
								<th>Address</th>
								<th>Your Message</th>
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
