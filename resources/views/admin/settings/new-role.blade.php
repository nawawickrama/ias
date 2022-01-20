@extends('layouts.dashboard.main')

@section('content')

    <head>
        <style>
            select.icon-menu option {
                background-repeat: no-repeat;
                background-position: bottom left;
                padding-left: 30px;
            }

            select#colors option[value="primary"] {
                background-color: blue;
            }

            select#colors option[value="secondary"] {
                background-color: gray;
            }

            select#colors option[value="success"] {
                background-color: green;
            }

            select#colors option[value="danger"] {
                background-color: red;
            }

            select#colors option[value="warning"] {
                background-color: yellow;
            }

            select#colors option[value="info"] {
                background-color: lightskyblue;
            }

            select#colors option[value="dark"] {
                background-color: black;
            }

            select#colors option[value="white"] {
                background-color: white;
            }

        </style>
    </head>

    <div class="card">
        <div class="card-header">
            <p>New User Role</p>
        </div>
        <div class="card-body">
            <form action="{{ route('role_post') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Role Name :</label>
                        <input type="text" name="role" id="" class="form-control @error('role') is-invalid @enderror">
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Role Color :</label>
                        <select name="role_color" id="colors" class="form-control @error('role_color') is-invalid @enderror">
                            <option value="null" selected disabled>Select Color</option>
                            <option value="primary">Primary</option>
                            <option value="secondary">Secondary</option>
                            <option value="success">Success</option>
                            <option value="danger">Danger</option>
                            <option value="warning">Warning</option>
                            <option value="info">Info</option>
                            <option value="dark">Dark</option>
                            <option value="white bg-dark">White</option>
                        </select>
                        @error('role_color')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-success btn-block">Create Role</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            <p>Role List</p>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Role Id</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Color</th>
                        <th scope="col">User Count</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($role_details as $role)
                        <tr>
                            <th scope="row">{{ $role->id }}</th>
                            <td>{{ $role->name }}</td>
                            <td><span class="badge badge-{{$role->color}}">{{ $role->color ?? 'N/A' }}</span></td>
                            <td>@php
                                echo $user_count = App\Models\User::role($role->name)->count();
                            @endphp</td>
                            <td>
                                <button type="button" data-id="" status="1" class="btn btn-primary btn-icon btn-status"
                                    data-toggle="tooltip" data-placement="top" title="View Users">
                                    <i data-feather="user"></i>
                                </button>
                                <button type="button" data-id="" status="0" class="btn btn-success btn-icon btn-status"
                                    data-toggle="tooltip" data-placement="top" title="Add Users">
                                    <i data-feather="user-check"></i>
                                </button>
                                <button type="button" data-id="" status="1" class="btn btn-danger btn-icon btn-status"
                                    data-toggle="tooltip" data-placement="top" title="Remove Users">
                                    <i data-feather="user-x"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm user <span class="ac_deac"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to <span class="ac_deac"></span> this user?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('active_inactive') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="">
                        <input type="hidden" name="status" id="status" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection
