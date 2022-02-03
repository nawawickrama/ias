@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <p>Role and Permission</p>
    </div>
    <div class="card-body">
        <form action="{{ route('permission_role_post') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="">Role Name :</label>
                    <select name="role_id" id="" class="form-control  @error('role_id') is-invalid @enderror">
                        <option value="null" selected disabled>Select User Role</option>
                        @foreach ($role_details as $role)
                        <option value="{{ $role->id }}" @if (old('role_id')==$role->id){{ 'selected' }}@endif>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Permisssion</th>
                                    <th scope="col">Create</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Remove</th>
                                    <th scope="col">Accept</th>
                                    <th scope="col">Download</th>
                                    <th scope="col">Rollback</th>
                                    <th scope="col">Active/ Deactive</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permission_details as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td><input type="checkbox" name="{{ $permission->name }}[]" value="create" @if(!$permission->create) {{ 'disabled' }} @endif></td>
                                    <td><input type="checkbox" name="{{ $permission->name }}[]" value="view" @if(!$permission->view) {{ 'disabled' }} @endif></td>
                                    <td><input type="checkbox" name="{{ $permission->name }}[]" value="edit" @if(!$permission->edit) {{ 'disabled' }} @endif></td>
                                    <td><input type="checkbox" name="{{ $permission->name }}[]" value="remove" @if(!$permission->remove) {{ 'disabled' }} @endif></td>
                                    <td><input type="checkbox" name="{{ $permission->name }}[]" value="accept" @if(!$permission->accept) {{ 'disabled' }} @endif></td>
                                    <td><input type="checkbox" name="{{ $permission->name }}[]" value="download" @if(!$permission->download) {{ 'disabled' }} @endif></td>
                                    <td><input type="checkbox" name="{{ $permission->name }}[]" value="rollback" @if(!$permission->rollback) {{ 'disabled' }} @endif></td>
                                    <td><input type="checkbox" name="{{ $permission->name }}[]" value="active/deactive" @if(!$permission->active_deactive) {{ 'disabled' }} @endif></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-success btn-block">Assign Permissions</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- <div class="card mt-4">
        <div class="card-header bg-primary text-white">
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