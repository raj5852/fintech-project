@extends('layouts.app')

@section('admin_content')
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">


                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{$error}} </li>
                    @endforeach
                </ul>

                @endif
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-7">
                                    <h5 class="mb-0">User: {{$user->email}} </h5>

                                </div>

                            </div>
                        </div>
                        <hr />
                        <form action="{{ route('balance.update',$user->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="balance" value="{{ number_format($user->balance,2)  }}" class="form-control" >

                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
    <!--end wrapper-->
    <!--start switcher-->
@endsection
