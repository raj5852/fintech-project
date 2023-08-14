@extends('layouts.app')

@section('admin_content')
    @push('css')
    @endpush

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Discussion</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('discussion.create') }}" class="btn btn-sm btn-primary pull-right">Add channel</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
            {{-- @include('alert.alert') --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- discussion --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                   <th>Name</th>
                                   <th>Total Users</th>
                                   <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($discussions as $discussion)
                                    <tr>
                                        <td>{{ $discussion->id }} </td>
                                        <td>{{ $discussion->name }} </td>
                                        <td>{{ $discussion->discussion_users_count }} </td>
                                        <td>
                                            <a href="{{ route('discussion.edit',$discussion->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <form action="{{ route('discussion.destroy',$discussion->id) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
