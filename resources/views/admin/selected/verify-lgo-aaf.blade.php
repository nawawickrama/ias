@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>Document Verification for LGO & AAF</p>
        </div>
        <div class="card-body">
            <div class="responsive">
                <table class="table table-bordered" id="datatable-basic">
                    <thead>
                    <tr>
                        <th scope="col">Submitted Date</th>
                        <th scope="col">Program</th>
                        <th scope="col">Form Type</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($forms as $form)
                            @php
                                $candidateDetails = $form->candidate;
                                $cpfDetails = $candidateDetails->cpf;
                                $courseDetails = $cpfDetails->course;
                                $agentDetails = $cpfDetails->agent;
                            @endphp
                            <td>{{$form->submit_date}}</td>
                            <td>{{$courseDetails->course_name}}</td>
                            <td>
                                @if($form->form->form_id == 1)
                                    <span class="badge badge-primary">{{$form->form->form_name}}</span>
                                @elseif($form->form->form_id == 2)
                                    <span class="badge badge-warning">{{$form->form->form_name}}</span>
                                @endif
                            </td>
                            <td>{{$candidateDetails->first_name.' '.$candidateDetails->sur_name}}</td>
                            <td>{{$candidateDetails->email}}</td>
                            <td>{{$agentDetails->agent_name ?? 'N/A'}}</td>
                            <td>
                                @if($form->status === 'Pending') <span class="badge badge-warning">Pending</span> @endif
                                @if($form->status === 'Approved') <span
                                    class="badge badge-success">Approved</span> @endif
                                @if($form->status === 'Rejected') <span class="badge badge-danger">Rejected</span>
                                <span>{{$form->reject_reason}}</span> @endif
                            </td>
                            <td>
                                @if($form->status === 'Pending' || $form->status === 'Rejected')
                                    <span data-toggle="tooltip" data-placement="top" title="Approve Document">
                                        <button type="button" class="btn btn-success btn-icon btn-status-change"
                                                data-toggle="modal" data-target="#modelapp"
                                                candi-form-id="{{$form->candidate_form_id}}">
                                            <i data-feather="check-square"></i>
                                        </button>
                                    </span>
                                @elseif($form->status === 'Approved' || $form->status === 'Rejected')
                                    <span data-toggle="tooltip" data-placement="top" title="Reject Document">
                                        <button type="button" class="btn btn-danger btn-icon btn-status-change"
                                                data-toggle="modal" data-target="#modelrej"
                                                candi-form-id="{{$form->candidate_form_id}}">
                                            <i data-feather="x-square"></i>
                                        </button>
                                    </span>
                                @endif
                                <span data-toggle="tooltip" data-placement="top" title="View Signed Document">
                                <a href="{{'/storage/'.$form->file_path}}" target="_blank"><button type="button"
                                                                                                   class="btn btn-warning btn-icon">
                                    <i data-feather="eye"></i>
                                </button></a>
                            </span>
                            </td>

                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Approve-->
    <div class="modal fade" id="modelapp" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Are you sure do you need to approve this application?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" value="" class="candiFormID" name="candiFormID">
                        <input type="hidden" value="1" name="status">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Approve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Reject-->
    <div class="modal fade" id="modelrej" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure do you need to reject this application? (Please mention the reason
                                    below)</p>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Reason :</label>
                                <textarea name="rejectReason" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="" class="candiFormID" name="candiFormID">
                        <input type="hidden" value="0" name="status">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.btn-status-change').click(function () {
            let FormCandiID = $(this).attr('candi-form-id');
            $('.candiFormID').val(FormCandiID);
        });
    </script>
@endsection
