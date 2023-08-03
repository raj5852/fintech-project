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

                <div class="card radius-10">
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-7">
                                    <h5 class="mb-0">Add User Balance</h5>

                                </div>
                                <div class="col-5">
                                    <form action="{{ route('balance.index') }}" method="GET">

                                        <div class="d-flex">
                                            <input type="text" name="emailSearch" class="form-control"
                                                value="{{ request()->emailSearch }}" autocomplete="off"
                                                placeholder="Search by email"> <button style="margin-left: 4px"
                                                type="submit" class="btn btn-primary btn-sm">Search</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nmae</th>
                                        <th>Email</th>
                                        <th>User Balance</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @forelse ($users as $user)
                                <tbody>
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            {{ number_format ($user->balance,2) }}

                                        </td>
                                        <td>

                                            <a href="{{ route('balance.edit',$user->id) }}" class="btn btn-primary btn-sm">Edit Balance</a>

                                        </td>
                                    </tr>
                                </tbody>
                            @empty
                                <tfoot>
                                    <tr>
                                        <td> No Data found </td>
                                    </tr>
                                </tfoot>
                                @endforelse
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
    <!--end wrapper-->
    <!--start switcher-->
@endsection
