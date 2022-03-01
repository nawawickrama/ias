@extends('layouts.dashboard.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <p>My Leads</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable-basic">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Course</th>
                                <th scope="col">Intake</th>
                                <th scope="col">City</th>
                                <th scope="col">Country</th>
                                <th scope="col">Source</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Ayesh Nawawickrama</td>
                                <td>nawawickrama@gmail.com</td>
                                <td>STEP</td>
                                <td>2022</td>
                                <td>Hambantota</td>
                                <td>Sri Lanka</td>
                                <td>Facebook Ad</td>
                                <td>No comment</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="Add to reminder" data-id="#">
                                        <i data-feather="bell"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="Send Email" data-id="#">
                                        <i data-feather="mail"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="Send whatsapp message" data-id="#">
                                        <i data-feather="phone-call"></i>
                                    </button>
                                    <button type="button" class="btn btn-dark btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="View lead info & recent activities" data-id="#">
                                        <i data-feather="eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="Move to Potential lead" data-id="#">
                                        <i data-feather="key"></i>
                                    </button>
                                    <button type="button" class="btn btn-info btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="Edit Leads" data-id="#">
                                        <i data-feather="edit"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Ayesh Nawawickrama</td>
                                <td>nawawickrama@gmail.com</td>
                                <td>STEP</td>
                                <td>2022</td>
                                <td>Hambantota</td>
                                <td>Sri Lanka</td>
                                <td>Facebook Ad</td>
                                <td>No comment</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="Add to reminder" data-id="#">
                                        <i data-feather="bell"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="Send Email" data-id="#">
                                        <i data-feather="mail"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="Send whatsapp message" data-id="#">
                                        <i data-feather="phone-call"></i>
                                    </button>
                                    <button type="button" class="btn btn-dark btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="View lead info & recent activities" data-id="#">
                                        <i data-feather="eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-icon resend-email" data-toggle="tooltip" data-placement="top" title="Move to Potential lead" data-id="#">
                                        <i data-feather="key"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection