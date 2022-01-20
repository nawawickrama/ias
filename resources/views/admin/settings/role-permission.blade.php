@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <p>Role and Permission</p>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="">Role Name :</label>
                        <select name="role" id="" class="form-control  @error('role') is-invalid @enderror">
                            <option value="null" selected disabled>Select User Role</option>
                            @foreach ($role_details as $role)
                                <option value="{{ $role->id }}" @if (old('role') == $role->id){{ 'selected' }}@endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Permisssion</th>
                                    <th scope="col">Create</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permission_details as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td><input type="checkbox" name="wildcard[]" value="create"></td>
                                    <td><input type="checkbox" name="wildcard[]" value="view"></td>
                                    <td><input type="checkbox" name="wildcard[]" value="update"></td>
                                    <td><input type="checkbox" name="wildcard[]" value="delete"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <button type="button" class="btn btn-success btn-block">Assign Permissions</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="card mt-4">
        <div class="card-header">
            <p>Role List</p>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Role</th>
                        <th scope="col">Permisssion</th>
                        <th scope="col">Add</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($role_details as $role)
                        <td>{{ $role->name }}</td>
                        @php
                            $role_Per_info = $role->permissions->pluck('name');
                        @endphp
                        @foreach ($role_Per_info as $item)
                            <td>{{ $item }}</td>
                            <td>{{ $item }}</td>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> --}}
@endsection
