@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>Filter Document</p>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <select name="" id="" class="form-control">
                            <option value="" selected disabled>Select...</option>
                            <option value="">Pending</option>
                            <option value="">Approved</option>
                            <option value="">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-block btn-success">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <p>Document List</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable-basic">
                    <thead>
                    <tr>
                        <th scope="col">Submission Time</th>
                        <th scope="col">Name</th>
                        <th scope="col">Passport No.</th>
                        <th scope="col">Email</th>
                        <th scope="col">Course</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Document Qty</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pendingDocumentUsers as $recode)
                        @php
                            $candidateDetails = App\Models\Candidate::find($recode->candidate_id);
                            $cpfDetails = $candidateDetails->cpf;
                            $courseDetails = $cpfDetails->course;
                            $agentDetails = $cpfDetails->agent;


                            $documentDetails = $candidateDetails->documents;
                            $doc_count = count($documentDetails);
                            $pending = 0;
                            $approved = 0;
                            $rejected = 0;
                            foreach ($documentDetails as $doc){
                                $submitted_at = $doc->submit_date;
                                if($doc->status == 'Pending'){
                                    $pending = 1;
                                }elseif ($doc->status == 'Rejected'){
                                    $rejected = 1;
                                }elseif ($doc->status == 'Approved'){
                                    $approved = 1;
                                }
                            }
                        @endphp
                        <tr>
                            <td>{{$submitted_at}}</td>
                            <td>{{$candidateDetails->first_name.' '.$candidateDetails->sur_name}}</td>
                            <td>{{$candidateDetails->passport_no}}</td>
                            <td>{{$candidateDetails->email}}</td>
                            <td>{{$courseDetails->course_name}}</td>
                            <td>{{$agentDetails->agent_name ?? 'N/A'}}</td>
                            <td>{{$doc_count}}</td>
                            <td>
                                @if($pending === 1) <span class="badge badge-warning">Pending</span> @endif
                                @if($approved === 1) <span class="badge badge-success">Approved</span> @endif
                                @if($rejected === 1) <span class="badge badge-danger">Rejected</span> @endif
                            </td>
                            <td>
                            <span data-toggle="tooltip" data-placement="top" title="View Documents">
                                <button type="button" class="btn btn-dark btn-icon btn-document-view"
                                        candidate-id="{{$candidateDetails->candidate_id}}">
                                    <i data-feather="eye"></i>
                                </button>
                            </span>
                                <span data-toggle="tooltip" data-placement="top" title="View Student Information">
                                <button type="button" class="btn btn-primary btn-icon" data-toggle="modal"
                                        data-target="#modelact">
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

    <!-- Modal view -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="ViewModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Document List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-display" id="datatable-basic">
                            <thead>
                            <tr>
                                <th scope="col">Document Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal approve -->
    <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
                    Are you sure, do you want to approve this documents?
                </div>
                <div class="modal-footer">
                    <form action="{{route('documentStatusChange')}}" method="post">
                        @csrf
                        <input type="hidden" value="" class="docCanID" name="docCanID">
                        <input type="hidden" value="1" name="status">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal reject -->
    <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('documentStatusChange')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Reason for rejection of documents :</label>
                                <textarea name="rejectReason" id="" cols="30" rows="10" class="form-control"
                                          placeholder="write the reason here" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="" class="docCanID" name="docCanID">
                        <input type="hidden" value="0" name="status">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('.btn-document-view').click(function () {
            let element = $(this);
            $.ajax({
                url: '{{route('getDocumentDetails')}}',
                method: 'post',
                data: {
                    CandidateID: element.attr('candidate-id'),
                    _token: "{{csrf_token()}}",
                }, beforeSend: function () {
                    element.html("<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span>");
                }, success: function (response) {
                    element.html("<i data-feather='eye'></i>");

                    $('.data-display tbody').html(response);
                    $('#ViewModal').modal('show');
                    feather.replace();

                    $('.btn-approve, .btn-reject').click(function () {
                        let docCandiId = $(this).attr('data-id');

                        $('.docCanID').val(docCandiId);
                        $('#ViewModal').modal('hide');
                    });

                }, error: function () {
                    element.html("<i data-feather=\"eye\"></i>");
                    feather.replace();
                }
            })
        });


    </script>
@endsection
