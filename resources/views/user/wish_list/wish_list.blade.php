{{-- @if(!$data->isEmpty()) --}}
@if($data->count() > 0)
@foreach($data as $row)
<div class="hovercart-wrapper">
	<div class="hovercart-wishlistwrapper">
	<div class="hovercart-wishthumb">
		<form id="delete_form" action="{{ route('delete.wishlist',$row->id) }}" style="display: inline-block;" method="POST">
		    @csrf
		    @method('DELETE')
		    <button class="btn btn-sm" id="delete" type="submit"><img class="hover-wish" src="{{ asset('frontend/') }}/img/close.png" alt=""></button>
		</form>
		<img class="wishthumb" src="{{ asset('frontend/') }}/img/sm-p.png" alt="">
		<div class="hovercart-content">
			<strong>{{ $row->product_name }}</strong>
			<p>{{ $row->product_title }}</p>
		</div>
	</div>
	{{-- @if($row->product_price == 0.00)
	<span>${{ $row->product_price }}</span>
	@else
	<span>${{ $row->discount_price }}</span>
	@endif --}}

	</div>
</div>


@endforeach
<div class="text-center">
	<a class="btn-three" href="{{ url('user/home') }}">view list</a>
</div>


@else
<div class="text-center">
	<p class="text-white">Empty !</p>
</div>
@endif
