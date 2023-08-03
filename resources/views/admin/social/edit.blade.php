<form action="{{ route('update.social',$data->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="modal-header">
		<h5 class="modal-title">Edit Social</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<div class="col-md-12">
				<label for="inputFirstName" class="form-label">Icon class <sup class="text-danger">*</sup></label>
				<input type="text" class="form-control" value="{{ $data->icon_class }}" name="icon_class" id="inputFirstName">
			</div>
			<br>
			<div class="col-md-12">
				<label for="inputFirstName" class="form-label">Social Url<sup class="text-danger">*</sup></label>
				<input type="text" class="form-control" value="{{ $data->link }}" name="link" id="inputFirstName">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>