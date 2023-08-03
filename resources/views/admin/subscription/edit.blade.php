@extends('layouts.app')

@section('admin_content')

    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Add Subscription for <b>{{ $user->email }} </b> </h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('updatesubscription', $user->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Membership</label>
                                        <select class="form-control" name="subscribe_id" id="">
                                            @foreach ($memberships as $membership)
                                                <option @if ($subscription->subscribe_id == $membership->id) selected @endif value="{{ $membership->id }}">{{ $membership->membership_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Start Date</label>
                                        <input type="date" class="form-control" value="{{$subscription->start_date }}" name="start_date" required>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Expire Date</label>
                                        <input type="date" class="form-control" value="{{$subscription->expire_date }}" name="expire_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Total Fee</label>
                                        <input type="number" class="form-control" value="{{$subscription->total_fee }}" name="total_fee" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Subscribe Fee</label>
                                        <input type="number" class="form-control" value="{{$subscription->subscribe_fee }}" name="subscribe_fee" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Monthly Charge</label>
                                        <input type="number" class="form-control" value="{{$subscription->monthly_charge }}" name="monthly_charge" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Payment Method</label>
                                        <input type="text" class="form-control" value="{{$subscription->payment_method }}" name="payment_method" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Monthly Charge Date</label>
                                        <input type="date" class="form-control" value="{{$subscription->monthly_charge_date }}"  name="monthly_charge_date" required>
                                    </div>
                                </div>
                                <center>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </center>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end page wrapper -->
    </div>
@endsection
