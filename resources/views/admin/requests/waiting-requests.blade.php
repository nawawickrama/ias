@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>Selected under condition Requests</p>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="datatable-basic">
            <thead>
                <tr>
                    <th scope="col">Application Id</th>
                    <th scope="col">Program</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Country</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>499494</th>
                    <td>STEP Program</td>
                    <td>Ayesh Nawawickrama</td>
                    <td>nawawickrama@gmail.com</td>
                    <td>0779389533</td>
                    <td>Sri Lanka</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="top" title="Convert to Pending Request">
                            <i data-feather="rotate-cw"></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-icon" data-toggle="tooltip" data-placement="top" title="Download Application">
                            <i data-feather="download"></i>
                        </button>
                        <button type="button" class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="Download Assesment Form">
                            <i data-feather="flag"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="Send Email">
                            <i data-feather="mail"></i>
                        </button>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</div>

@endsection