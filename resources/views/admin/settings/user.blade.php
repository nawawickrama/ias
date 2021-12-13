@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>User Settings</p>
    </div>
    <div class="card-body">
        <form action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Name :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Email :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="">Role :</label>
                    <select name="" id="" class="form-control">
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
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">User Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Ayesh Nawawickrama</td>
                    <td>nawawickrama@gmail.com</td>
                    <td>Administrator</td>
                    <td><span class="badge badge-success">Active</span><span class="badge badge-danger">Inactive</span></td>
                    <td>
                        <button type="button" class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="Activate User">
                            <i data-feather="user"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="Inactivate User">
                            <i data-feather="user-x"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Ayesh Nawawickrama</td>
                    <td>nawawickrama@gmail.com</td>
                    <td>Administrator</td>
                    <td><span class="badge badge-success">Active</span><span class="badge badge-danger">Inactive</span></td>
                    <td>
                        <button type="button" class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="Activate User">
                            <i data-feather="user"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="Inactivate User">
                            <i data-feather="user-x"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Ayesh Nawawickrama</td>
                    <td>nawawickrama@gmail.com</td>
                    <td>Administrator</td>
                    <td><span class="badge badge-success">Active</span><span class="badge badge-danger">Inactive</span></td>
                    <td>
                        <button type="button" class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="Activate User">
                            <i data-feather="user"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="Inactivate User">
                            <i data-feather="user-x"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection