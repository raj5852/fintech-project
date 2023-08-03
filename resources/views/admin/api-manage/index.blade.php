@extends('layouts.app')

@section('admin_content')
@push('css')

@endpush


<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3">Manage API</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">API</li>
					</ol>
				</nav>
			</div>
			<div class="ms-auto">

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
								<th >SL</th>
								<th>Title</th>
								<th >Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->id}} </td>
                                    <td>{{$data->title}} </td>
                                    <td> <a href="{{ route('edit.api',$data->id) }}" class="btn btn-primary"> Manage </a> </td>
                                </tr>
                            @endforeach

						</tbody>
						<tfoot>
							<tr>
								<th >SL</th>
								<th>Title</th>

								<th >Action</th>
							</tr>
						</tfoot>
					</table>
				</div>


				<!--View Modal -->

			</div>
		</div>
	</div>
</div>

@push('js')



@endpush

@endsection
