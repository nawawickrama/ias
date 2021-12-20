@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>Add Agents</p>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Name :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Email :</label>
                    <input type="email" name="" id="" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Contact Number :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Country :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Contact Person Name :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Whatsapp Number :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Website :</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-success btn-block">Add Agent</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <p>Agent List</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable-basic">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Whatsapp Number</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>PRODESIGNER.LK (PVT) LTD</td>
                        <td>hello@prodesigner.lk</td>
                        <td>0717183318</td>
                        <td>0779389533</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-icon btn-down" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i data-feather="edit"></i>
                            </button></a>
                            <button type="button" class="btn btn-danger btn-icon btn-down" data-toggle="tooltip" data-placement="top" title="Deactivate Agent">
                                <i data-feather="shield-off"></i>
                            </button></a>
                            <button type="button" class="btn btn-success btn-icon btn-down" data-toggle="tooltip" data-placement="top" title="Activate Agent">
                                <i data-feather="shield"></i>
                            </button></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>PRODESIGNER.LK (PVT) LTD</td>
                        <td>hello@prodesigner.lk</td>
                        <td>0717183318</td>
                        <td>0779389533</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-icon btn-down" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i data-feather="edit"></i>
                            </button></a>
                            <button type="button" class="btn btn-danger btn-icon btn-down" data-toggle="tooltip" data-placement="top" title="Deactivate Agent">
                                <i data-feather="shield-off"></i>
                            </button></a>
                            <button type="button" class="btn btn-success btn-icon btn-down" data-toggle="tooltip" data-placement="top" title="Activate Agent">
                                <i data-feather="shield"></i>
                            </button></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection