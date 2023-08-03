@extends('layouts.app')

@section('admin_content')
    @push('css')
    @endpush


    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Manage API</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">API</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
            @include('alert.alert')
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('update.api',$data->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="method_type" value="{{ $data->name }}">
                            @foreach (json_decode($data->details) as $key => $dt)
                                <div class="col-md-6">
                                    <label class="form-label"> {{ StringManipulation($key) }} </label>
                                    <input type="text" class="form-control" name="{{ $key }}"
                                        id="inputFirstName" placeholder="{{ StringManipulation($key) }}" required=""
                                        value="{{ $dt }}">
                                </div>
                            @endforeach
                            <div class="col-md-12">
                                <center>
                                    <button class="btn btn-primary mt-3">Update</button>
                                </center>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('js')
    @endpush
@endsection
MAIL FROM_ADDRESS
Mail from Address
