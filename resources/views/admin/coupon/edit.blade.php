<form action="{{ route('update.coupon',$data->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="modal-header">
		<h5 class="modal-title">Create New Coupon</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="form-group row">
			<div class="col-md-6">
				<label for="inputFirstName" class="form-label">Coupon Code<sup class="text-danger">*</sup></label>
				<input type="text" class="form-control" placeholder="Enter coupon code" name="coupon_name" value="{{ $data->coupon_name }}" id="inputFirstName">
			</div>
			<div class="col-md-6">
				<label for="inputFirstName" class="form-label">Coupon Type <sup class="text-danger">*</sup></label>
				<select class="form-control" name="coupon_type" id="inputFirstName">
					<option value="" disabled selected>---Select--</option>
					<option value="Flat" @if($data->coupon_type == "Flat") selected @endif >Flat</option>
					<option value="Percent" @if($data->coupon_type == "Percent") selected @endif >Percent</option>
				</select>
			</div>
			<div class="col-md-6 mt-3">
				<label for="inputFirstName" class="form-label">Coupon Rate <sup class="text-danger">*</sup></label>
				<input type="number" class="form-control" value="{{ $data->coupon_rate }}" placeholder="Enter coupon rate" name="coupon_rate" id="inputFirstName">
			</div>
			<div class="col-md-6 mt-3">
				<label for="inputFirstName" class="form-label">Max Use <sup class="text-danger">*</sup></label>
				<input type="number" class="form-control" value="{{ $data->coupon_use }}" placeholder="Enter maximum use name" name="coupon_use" id="inputFirstName">
			</div>
			<div class="col-md-6 mt-3">
				<label for="inputFirstName" class="form-label">Minimum Use Amount<sup class="text-danger">*</sup></label>
				<input type="text" placeholder="Enter minimum use amount" value="{{ $data->use_amount }}" class="form-control" name="use_amount" id="inputFirstName">
			</div>
			<div class="col-md-6 mt-3">
				<label for="inputFirstName" class="form-label">Coupon Status<sup class="text-danger">*</sup></label>
				<select class="form-control" name="coupon_status" id="inputFirstName">
					<option value="Active" @if($data->coupon_status == 'Active') selected @endif >Active</option>
					<option value="Deactive" @if($data->coupon_status == 'Deactive') selected @endif >Deactive</option>
				</select>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>