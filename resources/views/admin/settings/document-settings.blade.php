@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <div class="row">
                <div class="col-md-9">
                    <p>Document Settings</p>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-block btn-warning" data-toggle="modal" data-target="#newDocAddModal">Add
                        New Document
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('document-course-link')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="">Document Name :</label>
                        <select name="documentId" id="" class="form-control @error('documentId') is-invalid @enderror">
                            <option value="" selected disabled>Select...</option>
                            @foreach($documents as $document)
                                <option
                                    value="{{$document->document_id}}">{{$document->doc_name}}</option>
                            @endforeach
                        </select>
                        @error('documentId')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Course :</label>
                        <select name="courseId" id="" class="form-control @error('courseId') is-invalid @enderror">
                            <option value="" selected disabled>Select...</option>
                            <option value="all">All Courses</option>
                            @foreach($coursesDetails as $course)
                                <option
                                    value="{{$course->course_id}}">{{$course->course_code.' - '.$course->course_name}}</option>
                            @endforeach
                        </select>
                        @error('courseId')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Option : <i data-feather="alert-circle" width="16" height="16"
                                                  data-toggle="tooltip" data-placement="top"
                                                  title="Mandatory or optional at student wizard time."></i></label>
                        <select name="option" id="" class="form-control @error('option') is-invalid @enderror">
                            <option value="Mandatory">Mandatory</option>
                            <option value="Optional">Optional</option>
                        </select>
                        @error('option')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-success btn-block">Add Document</button>
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
                        <th scope="col">Document Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Option</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($documentDetails as $doc)
                        @php
                            $courseDetails = $doc->course;
                            $documentdata = $doc->document;
                        @endphp
                        <tr>
                            <td>{{ $documentdata->doc_name }}</td>
                            <td>{{ $courseDetails->course_code.' - '.$courseDetails->course_name }}</td>
                            <td>
                                @if($doc->option == 'Mandatory')
                                    <span class="badge badge-info">{{ strtoupper($doc->option) }}</span>

                                @elseif($doc->option == 'Optional')
                                    <span class="badge badge-warning">{{ strtoupper($doc->option) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($doc->document_course_status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Deactive</span>
                                @endif
                            </td>
                            <td>
                                @if($doc->document_course_status == 1)
                                    <span data-toggle="tooltip" data-placement="top" title="Deactivate Document">
                                        <button type="button" class="btn btn-danger btn-icon btn-status"
                                                data-toggle="modal" data-id="{{ $doc->document_course_id }}" status="0">
                                            <i data-feather="shield-off"></i>
                                        </button>
                                    </span>
                                @else
                                    <span data-toggle="tooltip" data-placement="top" title="Activate Document">
                                        <button type="button" class="btn btn-success btn-icon btn-status"
                                                data-toggle="modal" data-id="{{ $doc->document_course_id }}" status="1">
                                            <i data-feather="shield"></i>
                                        </button>
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- status change Modal -->
    <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
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
                    Do you need to <b><span id="textLine"></span></b> this document?
                </div>
                <div class="modal-footer">
                    <form action="{{route('document-course-status')}}" method="post">
                        @csrf
                        <input type="hidden" value="" name="documentSettingId" id="documentSettingId">
                        <input type="hidden" value="" name="status" id="status">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="newDocAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('add-new-document')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Document Name :</label>
                                <input type="text" name="doc_name" id="" class="form-control" placeholder="Enter document name here" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Document</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        $('document').ready(function () {
            $('.btn-status').click(function () {
                let id = $(this).attr('data-id');
                let status = $(this).attr('status');

                $('#documentSettingId').val(id);
                $('#status').val(status);

                if (status == 0) {
                    $('#textLine').text('deactivate');
                } else {
                    $('#textLine').text('activate');
                }

                $('#modalStatus').modal('show');
            });
        });
    </script>
@endsection
