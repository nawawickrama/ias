@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header">
        <p>Selected Student Requests</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable-basic">
                <thead>
                    <tr>
                        <th scope="col">Application Id</th>
                        <th scope="col">Program</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Agent</th>
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
                        @php
                            $agent = App\Models\Agent::find($candidate->agent_id);
                        @endphp
                        <td>{{ $agent->agent_name }}</td>
                        <td>{{ $candidate->telephone }}</td>
                        <td>{{ $candidate->country }}</td>
                        <td>
                            <form action="" id="send-form" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="" id="email_form">
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
</div>

<script>
    $('document').ready(function() {
        $('.btn-email').click(function() {
            let email = $(this).attr('data-email');
            $('#email_form').val(email);
            $('#send-form').attr('action', "{{ route('email_button') }}");
            $('#send-form').submit();
        });
    });
</script>
@endsection