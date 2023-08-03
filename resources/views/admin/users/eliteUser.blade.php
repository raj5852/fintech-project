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
                                    <h5 class="mb-0">Elite Members</h5>

                                </div>
                                <div class="col-5">
                                    <form action="{{ route('admin.all-user') }}" method="GET">

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
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @forelse ($members as $member)
                                <tbody>
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>
                                            <a href="{{ route('editSubscription', $member->id) }}"
                                                class="btn btn-success btn-sm">Edit</a>
                                            <a onclick="return confirm('Do you want to delete subscription?')"
                                                href="{{ route('subscription-delete', $member->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
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
                            {{ $members->links() }}
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
