<form action="{{ route('specification.update',$data->id) }}" method="POST">
	@csrf
	<div class="modal-header">
		<h5 class="modal-title">Edit Specification</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="form-group">
			<div class="col-md-12">
				<label for="inputFirstName" class="form-label">Question <sup class="text-danger">*</sup></label>
				<input type="text" class="form-control" value="{{ $data->question }}" name="question" id="inputFirstName">
			</div>
			<br>
			<div class="col-md-12">
				<label for="inputFirstName" class="form-label">Answer <sup class="text-danger">*</sup></label>
                <textarea name="answer" rows="4" class="form-control">{{ $data->answer }}</textarea>
			</div>
			<br>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Save Change</button>
	</div>
</form>
