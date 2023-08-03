<div class="card p-2">
	<div class="card-header">
		<h3>Product Details</h3>
	</div>
	<div class="card-body">
		<div class="row p-2">
			<div class="col-lg-4 border-end">
				<div class="text-center">
					<img class="p-2 border" src="{{ asset($data->thumbnail) }}" width="250">
					<hr>
					<h5 class="border-bottom">More Image</h5>
					<div class="row">
						@foreach($more_image as $key=>$image)
						<div class="col-lg-4">
							<img class="p-2 border" src="{{ asset($image) }}" width="100">
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="row">
					<div class="col-lg-6 border-end">
						<table class="table table-borderd">
							<tr class="text-center border-bottom">
								<th align="text-center text-primary" colspan="3">Details</th>
							</tr>
							<tr>
								<th>Product Name</th>
								<th>:</th>
								<td>{{ $data->product_name }}</td>
							</tr>
							<tr>
								<th>Product Code</th>
								<th>:</th>
								<td>{{ $data->product_name }}</td>
							</tr>
							<tr>
								<th>Category</th>
								<th>:</th>
								<td>{{ $data->category->category_name }}</td>
							</tr>
							<tr>
								<th>Sub-category</th>
								<th>:</th>
								<td>{{ $data->subcategory_id ? $data->subcategory->subcategory_name :''  }}</td>
							</tr>

							<tr>
								<th>Price</th>
								<th>:</th>
								<td>{{ $data->product_price }}</td>
							</tr>
							<tr>
								<th>Discount Type</th>
								<th>:</th>
								<td>{{ $data->discount_type }}</td>
							</tr>
							<tr>
								<th>Discount Rate</th>
								<th>:</th>
								@if($data->discount_type == "Flat")
								<td>{{ $data->discount_rate }} TK</td>
								@elseif($data->discount_type == "Percent")
								<td>{{ $data->discount_rate }} %</td>
								@endif
							</tr>
							<tr>
								<th>Discount Price</th>
								<th>:</th>
								<td>{{ $data->discount_price }}</td>
							</tr>
						</table>
					</div>
					<div class="col-lg-6">
						<table class="table table-borderd">
							<tr class="text-center border-bottom">
								<th align="text-center text-primary" colspan="3">Specification</th>
							</tr>
							@foreach($specification as $key=>$speci)
							<tr>
								<th>{{ $speci }}</th>
								<th>:</th>
								<td>{{ json_decode($data->specification_ans,true)[$key] }}</td>
							</tr>
							@endforeach
							<tr>
								<th>Tag</th>
								<th>:</th>
								<td>
									@foreach($tag as $key=>$t)
									<span class="badge bg-primary" >{{ $t }}</span>
									@endforeach
								</td>
							</tr>
							<tr class="text-center border-bottom">
								<th align="text-center bg-primary" colspan="3">Product Priority</th>
							</tr>
							<tr>
								<th>Free Product</th>
								<th>:</th>
								@if($data->is_free == 1)
								<td><span class="badge bg-primary" >Yes</span></td>
								@else
								<td><span class="badge bg-danger" >No</span></td>
								@endif
							</tr>
							
							<tr>
								<th>Visibility</th>
								<th>:</th>
								<td>{{ $data->visibility == 4 ? 'Reseller Member' : 'All Member' }}</td>
							</tr>
						</table>
					</div>
				</div>
				<p><span style="font-weight:bold;">Description :</span> {!! $data->description !!}</p>
			</div>
		</div>
	</div>
</div>
