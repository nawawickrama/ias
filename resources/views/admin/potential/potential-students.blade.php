@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>Potential Students</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable-basic">
                    <thead>
                    <tr>
                        <th scope="col">Program</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Country</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($potentialDetails as $unit)
                        @php
                            $candidateDetails = $unit->candidate;
                            $cpfDetails = $unit->cpf;
                            $agentDetails = $cpfDetails->agent;
                            $countryDetails = $candidateDetails->countryInfo;
                        @endphp
                        <tr>
                            <td>{{$unit->potential_id}}</td>
                            <td>{{$candidateDetails->first_name.' '.$candidateDetails->sur_name}}</td>
                            <td>{{$candidateDetails->email}}</td>
                            <td>{{$agentDetails->agent_name ?? 'N/A'}}</td>
                            <td>{{$countryDetails->nicename}}</td>
                            <td>
                            <span data-toggle="tooltip" data-placement="top" title="Send Student Login">
                                <button type="button" class="btn btn-success btn-icon" data-toggle="modal"
                                        data-target="#sendstd">
                                    <i data-feather="send"></i>
                                </button>
                            </span>
                                <span data-toggle="tooltip" data-placement="top" title="Login As Student">
                                <button type="button" class="btn btn-danger btn-icon btn-ghost-login" data-toggle="modal"
                                        data-target="#loginasstd" candidate-id="{{$candidateDetails->candidate_id}}">
                                    <i data-feather="user"></i>
                                </button>
                            </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal login as a student -->
    <div class="modal fade" id="loginasstd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('logAsGhost')}}" method="post" id="switchUserForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="alert alert-primary" role="alert">
                                    Please enter your <strong>master password</strong> to login as this student
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="hidden" value="" name="candidateId" id="candidateId">
                                <input type="password" name="masterPassword" class="form-control"
                                       placeholder="Enter password" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-switch-user">Login as a student</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Send student login detaisl -->
    <div class="modal fade" id="sendstd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure, do you need to send this student login details?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('document').ready(function () {
            $('.btn-ghost-login').click(function (){
                let candidate_Id = $(this).attr('candidate-id');
                $('#candidateId').val(candidate_Id);
            });

            $('#btn-switch-user').click(function (){
                $('#switchUserForm').trigger('submit');
            });
        });
    </script>

@endsection
