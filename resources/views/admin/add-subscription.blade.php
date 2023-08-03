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

                        <form action="{{ route('storesubscription', $user->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Membership</label>
                                        <select class="form-control" name="subscribe_id" id="">
                                            @foreach ($memberships as $membership)
                                                <option value="{{ $membership->id }}">{{ $membership->membership_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Start Date</label>
                                        <input type="date" class="form-control" name="start_date" required>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Expire Date</label>
                                        <input type="date" class="form-control" name="expire_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Total Fee</label>
                                        <input type="number" class="form-control" name="total_fee" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Subscribe Fee</label>
                                        <input type="number" class="form-control" name="subscribe_fee" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Monthly Charge</label>
                                        <input type="number" class="form-control" name="monthly_charge" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Payment Method</label>
                                        <input type="text" class="form-control" name="payment_method" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Monthly Charge Date</label>
                                        <input type="date" class="form-control" name="monthly_charge_date" required>
                                    </div>
                                </div>
                                <center>
                                    <button type="submit" class="btn btn-primary">Save</button>
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
