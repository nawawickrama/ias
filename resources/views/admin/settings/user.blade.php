@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <p>User Settings</p>
        </div>
        <div class="card-body">
            <form action="{{ route('add-user') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Name :</label>
                        <input type="text" name="name" id="" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Email :</label>
                        <input type="text" name="email" id="" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="">Role :</label>
                        <select name="role" id="" class="form-control">
                            <option value="">Administrator</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-success btn-block">Send login to the email</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            <p>Users List</p>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">User Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user_details as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>Admin</td>
                            <td>
                                @if ($user->status == 1)<span class="badge badge-success">Active</span>@elseif($user->status == 0)<span class="badge badge-danger">Inactive</span>@endif
                            </td>
                            <td>
                                    @if ($user->status == 1) 
                                        <button
                                            type="button" data-id="{{ $user->id }}" status="0" 
                                            class="btn btn-danger btn-icon btn-status" data-toggle="tooltip"
                                            data-placement="top" title="Inactivate User">
                                            <i data-feather="user-x"></i>
                                        </button>
                                    @elseif($user->status == 0)
                                        <button type="button" 
                                            data-id="{{ $user->id }}" status="1" class="btn btn-success btn-icon btn-status" data-toggle="tooltip"
                                            data-placement="top" title="Activate User">
                                            <i data-feather="user"></i>
                                        </button>
                                    @endif
                                
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
        $('document').ready(function() {
            $('.btn-status').click(function() {
                let status = $(this).attr('status');
                let user_id = $(this).attr('data-id');

                if (status == 0) {
                    $('.ac_deac').text('deactivate');
                } else {
                    $('.ac_deac').text('activate');
                }
                $('#user_id').val(user_id);
                $('#status').val(status);
                $('#statusModal').modal('show');
            });
        });
    </script>
@endsection
