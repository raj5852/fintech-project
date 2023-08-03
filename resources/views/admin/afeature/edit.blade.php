
							<form action="{{ route('update.afeature', $data->id) }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="modal-header">
									<h5 class="modal-title">Create New Feature</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">Title <sup class="text-danger">*</sup></label>
										<input type="text" class="form-control" name="title" id="inputFirstName" value="{{ $data->title }}">
									</div>
								</div>
								<div class="modal-body">
									<div class="col-md-12">
										<label for="inputFirstName" class="form-label">Description <sup class="text-danger">*</sup></label>
                                        <textarea name="description" rows="6" id="summernote2"  class="form-control">{{ $data->description }}</textarea>
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
