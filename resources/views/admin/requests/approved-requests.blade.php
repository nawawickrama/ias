@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>Selected Student Requests</p>
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
                        <form action="" method="POST" id="send-form">
                            @csrf
                            <input type="hidden" name="email" value="" id="email_form">
                            <input type="hidden" name="appli_id" value="{{ $candidate->candidate_id }}">
                            <a href="{{ route('download-application', $candidate->candidate_id) }}" target="_blank" class="text-white">
                                <button type="button" class="btn btn-warning btn-icon" data-toggle="tooltip" data-placement="top" title="Download Application">
                                <i data-feather="download"></i>
                            </button></a>
                            <button type="button" class="btn btn-success btn-icon btn-down" data-toggle="tooltip" data-placement="top" title="Download Assesment Form">
                                <i data-feather="flag"></i>
                            </button></a>
                            <button type="button" class="btn btn-danger btn-icon btn-email" data-email="{{ $candidate->email }}" data-toggle="tooltip" data-placement="top" title="Send Email">
                                <i data-feather="mail"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $('document').ready(function(){
        $('.btn-down').click(function(){
            $('#send-form').attr('action', "{{ route('download_assessment_form_by_approve') }}");
            $('#send-form').submit();
        });

        $('.btn-email').click(function(){
            let email = $(this).attr('data-email');
            $('#email_form').val(email);
            $('#send-form').attr('action', "{{ route('email_button') }}");
            $('#send-form').submit();
        });
    });
</script>
@endsection