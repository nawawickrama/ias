@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>Pending Student Requests</p>
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
                @foreach ($application_details as $candidate)
                <tr>
                    <th scope="row">{{ $candidate->candidate_id }}</th>
                    <td>{{ $candidate->program }}</td>
                    <td>{{ $candidate->first_name }} {{ $candidate->sur_name }}</td>
                    <td>{{ $candidate->email }}</td>
                    <td>{{ $candidate->telephone }}</td>
                    <td>{{ $candidate->country }}</td>
                    <td>
                        <a href="{{ route('view-application', $candidate->candidate_id) }}" target="_blank" class="text-white"><button type="button" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="top" title="View Application">
                                <i data-feather="eye"></i></a>
                        </button>
                        <a href="{{ route('download-application', $candidate->candidate_id) }}" target="_blank" class="text-white"><button type="button" class="btn btn-warning btn-icon" data-toggle="tooltip" data-placement="top" title="Download Application">
                            <i data-feather="download"></i>
                        </button></a>
                        <a href="{{ route('send_assessment_form', $candidate->candidate_id) }}"><button type="button" class="btn btn-success btn-icon" data-toggle="tooltip" data-placement="top" title="Send Assestment Form">
                            <i data-feather="flag"></i>
                        </button></a>
                        <button type="button" class="btn btn-danger btn-icon" data-toggle="tooltip" data-placement="top" title="Send Email">
                            <i data-feather="mail"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection