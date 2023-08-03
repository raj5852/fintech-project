<form action="{{ route('update.page',$data->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="modal-header">
		<h5 class="modal-title">Create New It Work</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<div class="col-md-12">
				<label for="inputFirstName" class="form-label"> Title <sup class="text-danger">*</sup></label>
				<input type="text" class="form-control" value="{{ $data->page_title }}" placeholder="Enter page title" name="page_title" id="inputFirstName">
			</div>
			<br>
			<div class="mb-3 col-md-12">
				<label for="formFile" class="form-label">Description <sup class="text-danger">*</sup></label>
				<textarea class="form-control" name="page_description" placeholder="Enter description...." rows="6" id="summernote2">{!! $data->page_description !!}</textarea>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>

<script>
	$(document).ready(function() {
	  $('#summernote2').summernote({
	  	height: 280, 
	  });
	});
</script>