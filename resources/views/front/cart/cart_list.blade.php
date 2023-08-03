@if(! $data->isEmpty())
<div class="hovercart-wrapper">
	@foreach($data as $row)
	<div class="hovercart-hoverwrapper">
		<form id="delete_form" action="{{ route('delete.cart',$row->rowId) }}" style="display: inline-block;" method="POST">
		    @csrf
		    @method('DELETE')
		    <button class="btn btn-sm" id="delete" type="submit"><img class="hover-wish" src="{{ asset('frontend/') }}/img/close.png" alt=""></button>
		</form>
	<div class="hovercart-thumb">
		<img src="{{ asset($row->options->image) }}" width="50" alt="">
	</div>
	<div class="hovercart-content">
		<strong>{{ $row->name }}</strong>

		<p>{{ $row->options->title }}</p>
		<span>{{ $row->qty }} X ${{ $row->price }}</span>
	</div>
	</div>

	@endforeach
	<div class="hovercart-total bg-total">
		<span>Total: </span>
		<span>$ {{ Cart::subtotal() }} </span>
	</div>

	<div class="hovercart-total">
		{{-- <span class="btn-two" href="#">Checkout</span> --}}
		<a href="{{ route('index.cart') }}"> <span class="btn-two">view cart</span></a>
	</div>
</div>
@else
<div class="text-center">
	<p class="text-white">Empty !</p>
</div>
@endif
