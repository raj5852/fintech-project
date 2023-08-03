<form action="{{ route('update.brand',$data->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="modal-header">
		<h5 class="modal-title">Edit Brand</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<div class="col-md-12">
				<label for="inputFirstName" class="form-label">Brand Name <sup class="text-danger">*</sup></label>
				<input type="text" class="form-control" value="{{ $data->brand_name }}" name="brand_name" id="inputFirstName">
			</div>
			<br>
			<div class="row">
				<div class="mb-3 col-md-8">
					<label for="formFile" class="form-label">Brand Image <sup class="text-danger">*</sup></label>
					<input class="form-control" name="brand_image" type="file" id="formFile">
					<small class="text-danger form-label">NB : Max size 2 MB.</small>
				</div>
				<div class="col-md-4 mt-3">
					<img src="{{ asset($data->brand_image) }}" width="100">
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Save Change</button>
	</div>
</form>