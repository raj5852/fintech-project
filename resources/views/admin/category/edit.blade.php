<form action="{{ route('update.category',$data->id) }}" method="post">
	@csrf
	<div class="modal-header">
		<h5 class="modal-title">Edit Category</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="col-md-12">
			<label for="inputFirstName" class="form-label">Category Name <sup class="text-danger">*</sup></label>
			<input type="text" class="form-control" name="category_name" value="{{ $data->category_name }}">
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Save Change</button>
	</div>
</form>
