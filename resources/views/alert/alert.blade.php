

@if (Session::has('success'))
<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <b>{{ Session::get('success') }}</b>
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <b>{{ Session::get('error') }}</b>
</div>
@endif
@if(count($errors) > 0)
<div class="alert alert-danger validation">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
			aria-hidden="true">×</span></button>
	<ul class="text-left {{ count($errors) == 1 ? 'list-unstyled' : '' }}">
		@foreach($errors->all() as $error)
		<li>
            <b>{{$error}}</b>
        </li>
		@endforeach
	</ul>
</div>
@endif



{{--
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                	<div class="text-white"><i class='bx bxs-message-square-x'></i> {{ $error }}</div>
                	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        </ul>
    </div>
@elseif(session()->has('success'))
<div class="alert alert-success border-0 bg-success alert-dismissible fade show">
	<div class="text-white"><i class='bx bxs-check-circle'></i> {{ session()->get('success') }}</div>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
    <div class="text-white"><i class='bx bxs-check-circle'></i> {{ session()->get('error') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session()->has('warning'))
<div class="alert alert-warning border-0 bg-warning alert-dismissible fade show">
    <div class="text-white"><i class='bx bxs-check-circle'></i> {{ session()->get('warning') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}
<!--End alert-->
