<form action="{{ route('update.testimonial',$data->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="modal-header">
		<h5 class="modal-title">Edit Testimonial</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<div class="col-md-12">
				<label for="inputFirstName" class="form-label">Name <sup class="text-danger">*</sup></label>
				<input type="text" class="form-control" value="{{ $data->name }}" placeholder="Enter name" name="name" id="inputFirstName">
			</div>
			<br>
			<div class="col-md-12">
				<label for="inputFirstName" class="form-label">Designation <sup class="text-danger">*</sup></label>
				<input type="text" class="form-control" value="{{ $data->designation }}" placeholder="Enter designation" name="designation" id="inputFirstName">
			</div>
			<br>
			<div class="mb-3 col-md-12 row">
				<div class="col-md-10">
					<label for="formFile" class="form-label">Image</label>
					<input class="form-control" name="image" type="file" id="formFile">
				</div>
				<div class="col-md-2 mt-4">
					<img src="{{ asset($data->image) }}" width="50">
				</div>
			</div>
			<br>
			<div class="mb-3 col-md-12">
				<label for="formFile" class="form-label">Description <sup class="text-danger">*</sup></label>
				<textarea class="form-control" name="description" placeholder="Enter description...." rows="6" id="formFile">{{ $data->description }}</textarea>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>