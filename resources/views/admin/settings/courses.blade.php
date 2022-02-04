@extends('layouts.dashboard.main')

@section('content')

    @can('course.create')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <p>Add Course</p>
                    </div>
                    <form action="{{ route('course_add') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Course Name* :</label>
                                    <input type="text" name="course_name" id="" class="form-control @error('course_name') is-invalid @enderror">
                                    @error('course_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Course Code* :</label>
                                    <input type="text" name="course_code" id="" class="form-control @error('course_code') is-invalid @enderror">
                                    @error('course_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row"">
                                                        <div class="    form-group col-md-12">
                                <label for="">Description :</label>
                                <input type="text" name="course_description" id="" class="form-control @error('course_description') is-invalid @enderror">
                                @error('course_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">Add course</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    @endcan

    @can('course.view')
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <p>Course List</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable-basic">
                        <thead>
                            <tr>
                                <th scope="col">Course Code</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course_details as $course)
                                <tr>
                                    <th scope="row">{{ $course->course_code }}</th>
                                    <td>{{ $course->course_name }}</td>
                                    <td>{{ $course->course_description }}</td>
                                    @php
                                        $status = $course->course_status;
                                    @endphp
                                    <td>@if($status == 1) <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span> @endif</td>
                                    <td>
                                        <button type="button" data-id="" status="1" class="btn btn-primary btn-icon btn-status"
                                            data-toggle="tooltip" data-placement="top" title="View Registered Students">
                                            <i data-feather="user-check"></i>
                                        </button>
                                        <button type="button" data-id="" status="0"
                                            class="btn btn-warning btn-icon btn-status text-white" data-toggle="tooltip"
                                            data-placement="top" title="Edit Course">
                                            <i data-feather="edit"></i>
                                        </button>
                                        @can('user.active/deactive')

                                            <button type="button" data-id="" status="0" class="btn btn-danger btn-icon btn-status"
                                                data-toggle="tooltip" data-placement="top" title="Inactivate Course">
                                                <i data-feather="x-circle"></i>
                                            </button>

                                            <button type="button" data-id="" status="1" class="btn btn-success btn-icon btn-status"
                                                data-toggle="tooltip" data-placement="top" title="Activate Course">
                                                <i data-feather="check-circle"></i>
                                            </button>

                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcan
@endsection
