@extends('layouts.app')

@section('admin_content')
    @push('css')
    @endpush


    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Add Request </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> </li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->
            <hr />
            @include('alert.alert')
            <div class="card">
                <div class="card-body">
                    <form class="g-3" method="POST" action="{{ route('admin.requeststore') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <label for="" class="form-label">Name <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" placeholder="Enter Name" name="customer_name"
                                    value="{{ old('customer_name') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Email <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" placeholder="Enter Email" name="customer_email"
                                    id="" value="{{ old('customer_email') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 select2-sm col-md-6" id="membershipItem">
                                <label class="form-label">User Email <sup class="text-danger">*</sup></label>
                                <select class="single-select" name="userid" required>

                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"> {{ $user->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Amount <sup class="text-danger">*</sup></label>
                                <input type="number" class="form-control" placeholder="Amount" name="amount"
                                    id="" required>
                            </div>
                        </div>
                        <br>
                        <h4>What Would You Like To Do *</h4>
                        <br>
                        @foreach ($requestproducts as $requestproduct)
                            <div class="col-lg-4">
                                <div class="custom__form-markcheck">
                                    <input id="{{ $requestproduct->name }}" type="checkbox" name="liketodo[]"
                                        value="{{ $requestproduct->name }}">
                                    <label for="{{ $requestproduct->name }}">{{ $requestproduct->name }} </label>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <h5>Select Platform *</h5>
                        <br>
                        @foreach ($requesstproducts as $requesstproduct)
                            <div class="col-lg-4">
                                <div class="custom__form-markcheck">
                                    <input id="{{ $requesstproduct->name }}" type="checkbox" name="liketodo[]"
                                        value="{{ $requesstproduct->name }}">
                                    <label for="{{ $requesstproduct->name }}">{{ $requesstproduct->name }} </label>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <div class="col-md">
                            <label for="" class="form-label">Software Information <sup
                                    class="text-danger">*</sup></label>
                            <input type="text" class="form-control" placeholder="Software Name" name="software_name">
                        </div>
                        <br>

                        <div class="col-md">
                            <label for="" class="form-label">Upload a zip file describing your EA or Indicator
                                Strategy <sup class="text-danger">*</sup></label>
                            <input type="file" class="form-control" name="imageone">
                        </div>
                        <br>

                        <div class="col-md">
                            <label for="" class="form-label">Upload EA or Indicator <sup
                                    class="text-danger">*</sup></label>
                            <input type="file" class="form-control" name="imagetwo">
                        </div>
                        <br>

                        <div class="col-md">
                            <label for="" class="form-label">Anything Else we need to know?
                                <sup class="text-danger">*</sup></label>
                            <textarea name="details" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary">
                    </form>

                    <!--Edit Modal -->

                </div>
            </div>
        </div>
    </div>

    @push('js')
    @endpush
@endsection
