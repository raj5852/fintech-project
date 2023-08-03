<form action="{{ route('update.sub_category',$data->id) }}" method="post">
	@csrf
	<div class="modal-header">
		<h5 class="modal-title">Edit Sub-category</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<div class="col-md-12">
			<label for="inputFirstName" class="form-label">Category <sup class="text-danger">*</sup></label>
			<select type="text" class="form-control" name="category_id" id="inputFirstName">
				<option value="" selected>--Select--</option>
				@foreach($category as $cat)
				<option value="{{ $cat->id }}" @if($cat->id == $data->category_id) selected @endif>{{ $cat->category_name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="modal-body">
		<div class="col-md-12">
			<label for="inputFirstName" class="form-label">Sub-category Name <sup class="text-danger">*</sup></label>
			<input type="text" class="form-control" name="subcategory_name" value="{{ $data->subcategory_name }}">
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Save Change</button>
	</div>
</form>