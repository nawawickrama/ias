@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <div class="row">
                <div class="col-md-10">
                    <p class="text-white">Submit Documents</p>
                </div>
                <div class="col-md-2">
                    @php
                        $candidateDocument = \App\Models\CandidateDocument::where('candidate_id', $candidateDetails->candidate_id)->count();
                    @endphp
                    @if($candidateDocument === 0)
                        <button type="button" class="btn btn-warning btn-icon-text btn-block" data-toggle="modal"
                                data-target="#modelupd"><i class="btn-icon-prepend" data-feather="upload"></i>Submit
                            Documents
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr class="bg-dark">
                        <th class="text-white">No.</th>
                        <th class="text-white">Document Name</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $count = 0; @endphp
                    @foreach($documentDetails as $document)
                        @php
                            $documentInfo = $document->document;
                            $candidateDocument = \App\Models\CandidateDocument::where([['candidate_id', $candidateDetails->candidate_id], ['document_id', $documentInfo->document_id]])->first();
                        @endphp
                        <tr>
                            <td>{{++$count}}</td>
                            <td>{{$documentInfo->doc_name}}</td>
                            <td>
                                @if(empty($candidateDocument)) <span class="badge badge-warning">Not submitted</span>
                                @else
                                    @if($candidateDocument->status === 'Pending') <span class="badge badge-primary">Pending for approval</span>
                                    @elseif($candidateDocument->status === 'Approved')<span class="badge badge-success">Approved</span>
                                    @elseif($candidateDocument->status === 'Rejected')<span class="badge badge-danger">Rejected</span>
                                    Reason : {{$candidateDocument->reject_reason}}
                                    @endif</td>
                            @endif
                            <td>@if(isset($candidateDocument) && $candidateDocument->status === 'Rejected')
                                    <button type="button" doc-name="{{$documentInfo->doc_name}}"
                                            candidate-doc-id="{{$candidateDocument->candidate_document_id}}"
                                            class="btn btn-sm btn-warning btn-re-upload-doc">Re-submit document
                                    </button>
                                @else
                                    {{'No action needed'}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('student.registration.document-model')
@endsection
