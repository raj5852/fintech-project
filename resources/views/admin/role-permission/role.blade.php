@extends('layouts.app')

@section('admin_content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Create Role</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
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

            <div class="card">
                <div class="card-body">
                    <form class="g-3" method="POST" action="{{ route('role.store') }}">
                        @csrf

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="channel_name" class="form-label">Role name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" placeholder="Discussion channel name"
                                    name="name" id="channel_name" value="{{ old('channel_name') }}">
                            </div>

                            <div class="mb-3 select2-sm col-md-6" id="user">
                                <label class="form-label">Select Permission <sup class="text-danger">*</sup></label>
                                <select class="single-select" name="permissions[]" multiple required>

                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}"> {{ $permission->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 select2-sm col-md-6">
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </div>

                    </form>
                </div>
            </div>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }} </td>
                            <td>{{ $role->name }} </td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach

                            </td>
                            <td>
                                <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
