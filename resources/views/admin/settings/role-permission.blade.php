@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>Role and Permission</p>
        </div>
        <div class="card-body">
            @can('permission.create')
                <form action="{{ route('permission_role_post') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Role Name :</label>
                            <select name="role_id" id="role_id" class="form-control  @error('role_id') is-invalid @enderror">
                                <option value="null" selected disabled>Select User Role</option>
                                @foreach ($role_details as $role)
                                    <option value="{{ $role->id }}" @if (old('role_id') == $role->id){{ 'selected' }}@endif>{{ $role->name }}</option>
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
                                                <td><input type="checkbox" name="{{ $permission->name }}[]" id="{{ $permission->name }}_create" value="create" class="permission_check"
                                                        @if (!$permission->create) {{ 'disabled' }} @endif></td>
                                                <td><input type="checkbox" name="{{ $permission->name }}[]" id="{{ $permission->name }}_view" value="view" class="permission_check"
                                                        @if (!$permission->view) {{ 'disabled' }} @endif></td>
                                                <td><input type="checkbox" name="{{ $permission->name }}[]" id="{{ $permission->name }}_edit" value="edit" class="permission_check"
                                                        @if (!$permission->edit) {{ 'disabled' }} @endif></td>
                                                <td><input type="checkbox" name="{{ $permission->name }}[]" id="{{ $permission->name }}_remove" value="remove" class="permission_check"
                                                        @if (!$permission->remove) {{ 'disabled' }} @endif></td>
                                                <td><input type="checkbox" name="{{ $permission->name }}[]" id="{{ $permission->name }}_accept" value="accept" class="permission_check"
                                                        @if (!$permission->accept) {{ 'disabled' }} @endif></td>
                                                <td><input type="checkbox" name="{{ $permission->name }}[]" id="{{ $permission->name }}_download" value="download" class="permission_check"
                                                        @if (!$permission->download) {{ 'disabled' }} @endif></td>
                                                <td><input type="checkbox" name="{{ $permission->name }}[]" id="{{ $permission->name }}_rollback" value="rollback" class="permission_check"
                                                        @if (!$permission->rollback) {{ 'disabled' }} @endif></td>
                                                <td><input type="checkbox" name="{{ $permission->name }}[]"
                                                        value="active/deactivate" @if (!$permission->active_deactivate) {{ 'disabled' }} @endif></td>
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
            @endcan
        </div>
    </div>
    @can('permission.view')
        <script>
            $('document').ready(function() {

                $('#role_id').change(function() {
                    let role_id = $(this).val();
                    $.ajax({
                        url: '{{ route('fill_permission') }}',
                        method: 'post',
                        data: {
                            role_id: role_id,
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: 'json',
                        beforeSend: function(){
                            $('.permission_check').prop('checked', false);
                        },
                        success: function(data) {
                            // console.log(data);
                            $.each(data, function (i, value) {
                                // console.log(value.name);
                                let name = value.name;
                                let permission = name.split(".")[0];
                                let wildcraft = name.split(".")[1];
                                // console.log(permission+'_'+wildcraft);
                                $('#'+permission+'_'+wildcraft).prop('checked', true);

                            });
                        },
                        error: function(error) {
                            // console.log(error);

                        }
                    });
                });
            });
        </script>
    @endcan

@endsection
