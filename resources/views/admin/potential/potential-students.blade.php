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
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($potentialDetails as $unit)
                        @php
                            $candidateDetails = $unit->candidate->first();
                            $cpfDetails = $unit->cpf;
                            $agentDetails = $cpfDetails->agent;
                            $countryDetails = $candidateDetails->countryInfo;
                            $courseDetails = $cpfDetails->course;
                            $documentDetails = $courseDetails->documents;

                            //status indicators
                            //candidate information form status
                            $candidateComplete = $candidateDetails->isComplete;
                            $guardianComplete = $candidateDetails->guardian;
                            if(isset($guardianComplete)){
                                $guardianComplete = $guardianComplete->isComplete;
                            }

                            //document status
                            $candidateDocs = $candidateDetails->documents;
                            $candidateDocs = $candidateDocs->toArray();


                            foreach ($documentDetails as $docOption) {

                                $docArray = array_search($docOption->doc_id, array_column($candidateDocs, 'document_id'));
                                $isComplete = 1;

                                if($docArray === false){
                                    $isComplete = 0;
                                }
                            }

                            $pending = array_search('Pending', array_column($candidateDocs, 'status'));
                            $approved = array_search('Approved', array_column($candidateDocs, 'status'));
                            $reject = array_search('Rejected', array_column($candidateDocs, 'status'));

                            //form status
                            $candidateForms = $candidateDetails->forms;
                            $aafStatus = $candidateForms->where('form_id', '1')->first();
                            $lgoStatus = $candidateForms->where('form_id', '2')->first();

                            //payment status
                            $paymentStatus = $candidateDetails->candidatePayments->toArray();

                            $notPaid = array_search('Not-Paid', array_column($paymentStatus, 'status'));
                            $partialPaid = array_search('Partially-Paid', array_column($paymentStatus, 'status'));
                            $pendingPayment = array_search('Pending', array_column($paymentStatus, 'status'));
                            $approvedPayment = array_search('Complete', array_column($paymentStatus, 'status'));
                            $rejectPayment = array_search('Rejected', array_column($paymentStatus, 'status'));

                        @endphp
                        <tr>
                            <td>{{$courseDetails->course_code.' - '.$courseDetails->course_name}}</td>
                            <td>{{$candidateDetails->first_name.' '.$candidateDetails->sur_name}}</td>
                            <td>{{$candidateDetails->email}}</td>
                            <td>{{$agentDetails->agent_name ?? 'N/A'}}</td>
                            <td>{{$countryDetails->nicename}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-sm">
                                        @if($candidateComplete == 'Yes' && isset($guardianComplete) && $guardianComplete == 'Yes')
                                            <span class="badge badge-success">Profile Completed</span>
                                        @else
                                            <span class="badge badge-danger">Profile Not Updated</span>
                                        @endif

                                        @if(count($candidateDocs) === 0)
                                            <span class="badge badge-danger">Document Not Uploaded</span>
                                        @elseif($pending !== false)
                                            <span class="badge badge-warning">Document Pending</span>
                                        @elseif($reject !== false)
                                            <span class="badge badge-danger">Document Rejected</span>
                                        @else
                                            <span class="badge badge-success">Document Completed</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm">
                                        @if(!isset($aafStatus))
                                            <span class="badge badge-danger">AAF Not Send</span>
                                        @elseif($aafStatus->status === 'Not-Uploaded')
                                            <span class="badge badge-warning">AAF Sent</span>
                                        @elseif($aafStatus->status === 'Pending')
                                            <span class="badge badge-warning">AAF Pending</span>
                                        @elseif($aafStatus->status === 'Rejected')
                                            <span class="badge badge-danger">AAF Rejected</span>
                                        @else
                                            <span class="badge badge-success">AAF Completed</span>
                                        @endif

                                        @if(!isset($lgoStatus))
                                            <span class="badge badge-danger">LGO Not Sent</span>
                                        @elseif($lgoStatus->status === 'Not-Uploaded')
                                            <span class="badge badge-warning">LGO Sent</span>
                                        @elseif($lgoStatus->status === 'Pending')
                                            <span class="badge badge-warning">LGO Pending</span>
                                        @elseif($lgoStatus->status === 'Rejected')
                                            <span class="badge badge-danger">LGO Rejected</span>
                                        @else
                                            <span class="badge badge-success">LGO Completed</span>
                                        @endif


                                        @if(isset($paymentStatus) && $notPaid !== false)
                                            <span class="badge badge-danger">Not-Paid</span>

                                        @elseif(isset($paymentStatus) && $partialPaid !== false)
                                            <span class="badge badge-warning">Partially-Paid</span>

                                        @elseif(isset($paymentStatus) && $pendingPayment !== false)
                                            <span class="badge badge-warning">Payment Pending</span>

                                        @elseif(isset($paymentStatus) && $approvedPayment !== false)
                                            <span class="badge badge-success">Payment Completed</span>

                                        @elseif(isset($paymentStatus) && $rejectPayment !== false)
                                            <span class="badge badge-reject">Payment Completed</span>
                                        @endif

                                    </div>
                                </div>
                            </td>
                            <td>
                            <span data-toggle="tooltip" data-placement="top" title="Re-send Student Login">
                                <button type="button" class="btn btn-success btn-icon" data-toggle="modal"
                                        data-target="#sendstd">
                                    <i data-feather="send"></i>
                                </button>
                            </span>
                                <span data-toggle="tooltip" data-placement="top"
                                      title="Send Learn German Online (LGO) Form">
                                <button type="button" class="btn btn-warning btn-icon btn-form-submit"
                                        data-toggle="modal" data-target="#modellgo"
                                        candidate-id="{{$candidateDetails->candidate_id}}">
                                    <i data-feather="check-square"></i>
                                </button>
                            </span>
                                <span data-toggle="tooltip" data-placement="top"
                                      title="Send Application Acceptance Form (AAF)">
                                <button type="button" class="btn btn-info btn-icon btn-form-submit" data-toggle="modal"
                                        data-target="#modelaaf" candidate-id="{{$candidateDetails->candidate_id}}">
                                    <i data-feather="check-square"></i>
                                </button>
                            </span>
                                <span data-toggle="tooltip" data-placement="top" title="Login As Student">
                                <button type="button" class="btn btn-danger btn-icon btn-ghost-login"
                                        data-toggle="modal" data-target="#loginasstd"
                                        candidate-id="{{$candidateDetails->candidate_id}}">
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

    <!-- Modal LGO-->
    <div class="modal fade" id="modellgo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation - LGO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('sendFormToCandidate')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Reference :</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <input type="text" name="referenceNo" placeholder="Enter of Generate a Key" id=""
                                       class="form-control input-ref" required>
                            </div>
                            <div class="form-group col-md-3">
                                <button type="button" class="btn btn-primary btn-generate-code">Generate
                                </button>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Deadline :</label>
                                <input type="date" name="deadLine" id=""
                                       value="{{date('Y-m-d', strtotime(date('Y-m-d'). '+14 days' ))}}"
                                       class="form-control" required>
                            </div>
                            <input type="hidden" name="candidateId" class="candidateId">
                            <input type="hidden" name="formType" id="" value="LGO">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send it</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal AAF-->
    <div class="modal fade" id="modelaaf" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation - AAF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('sendFormToCandidate')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Reference :</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <input type="text" name="referenceNo" placeholder="Enter of Generate a Key" id=""
                                       class="form-control input-ref" required>
                            </div>
                            <div class="form-group col-md-3">
                                <button type="button" class="btn btn-primary btn-generate-code">Generate
                                </button>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" name="coz_price" placeholder="Get default value automatically" id=""
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Deadline :</label>
                                <input type="date" name="deadLine" id=""
                                       value="{{date('Y-m-d', strtotime(date('Y-m-d'). '+14 days' ))}}"
                                       class="form-control" required>
                            </div>
                            <input type="hidden" name="candidateId" class="candidateId">
                            <input type="hidden" name="formType" id="" value="AAF">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send it</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('.btn-ghost-login').click(function () {
            let candidate_Id = $(this).attr('candidate-id');
            $('#candidateId').val(candidate_Id);
        });

        $('#btn-switch-user').click(function () {
            $('#switchUserForm').trigger('submit');
        });

        $('.btn-form-submit').click(function () {
            let candidate_Id = $(this).attr('candidate-id');
            $('.candidateId').val(candidate_Id);
        });

        $('.btn-generate-code').click(function () {
            let code = "";
            let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            for (let i = 0; i < 7; i++) {
                code += possible.charAt(Math.floor(Math.random() * possible.length));
            }

            console.log(code)
            $('.input-ref').val(code);
        });
    </script>

@endsection
