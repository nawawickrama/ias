@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>Pending Student Requests</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable-basic">
                    @php
                        $user = Auth::user();
                        $action_permission = $user->can('cpf.view') || $user->can('cpf.download') || $user->can('pending-request.accept') || $user->can('email-send.create');
                    @endphp
                    <thead>
                        <tr>
                            <th scope="col">Application Id</th>
                            <th scope="col">Program</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Country</th>
                            @if ($action_permission)
                                <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cpf_details as $cpf)
                            @php
                                $candidate = $cpf->candidate;
                                if (!empty($cpf->agent_id)) {
                                    $agent = App\Models\Agent::find($cpf->agent_id)->user;
                                }
                                $country = App\Models\Country::find($candidate->country)->nicename;

                                $program = $cpf->course;

                            @endphp
                            <tr>
                                <td scope="row">{{ $cpf->cpf_id }}</td>
                                <td>{{ $program->course_code }} @if ($program->course_code == 'Direct job') ({{ $cpf->job_feild }}) @endif</td>
                                <td>{{ $candidate->first_name }} {{ $candidate->sur_name }}</td>
                                <td>{{ $candidate->email }}</td>
                                <td>@if(isset($cpf->agent_id)) {{ $agent->name}} @else {{ 'N/A' }} @endif</td>
                                <td>{{ $candidate->telephone }}</td>
                                <td>{{ $country }}</td>
                                @if ($action_permission)

                                    <td>
                                        <form action="" id="send-form" method="POST">
                                            @csrf
                                            <input type="hidden" name="email" value="" id="email_form">

                                            @can('cpf.view')
                                                <a href="{{ route('view-application', $cpf->cpf_id) }}" target="_blank"
                                                    class="text-white"><button type="button" class="btn btn-primary btn-icon"
                                                        data-toggle="tooltip" data-placement="top" title="View Application">
                                                        <i data-feather="eye"></i>
                                                    </button>
                                                </a>
                                            @endcan

                                            @can('cpf.download')
                                                <a href="{{ route('download-application', $cpf->cpf_id) }}" target="_blank"
                                                    class="text-white"><button type="button" class="btn btn-warning btn-icon"
                                                        data-toggle="tooltip" data-placement="top" title="Download Application">
                                                        <i data-feather="download"></i>
                                                    </button>
                                                </a>
                                            @endcan

                                            @can('pending-request.accept')
                                                <a href="{{ route('send_assessment_form', $cpf->cpf_id) }}"><button
                                                        type="button" class="btn btn-success btn-icon" data-toggle="tooltip"
                                                        data-placement="top" title="Send Assestment Form">
                                                        <i data-feather="flag"></i>
                                                    </button>
                                                </a>
                                            @endcan

                                            @can('email-send.create')
                                                <button type="button" class="btn btn-danger btn-icon btn-email"
                                                    data-email="{{ $candidate->email }}" data-toggle="tooltip"
                                                    data-placement="top" title="Send Email">
                                                    <i data-feather="mail"></i>
                                                </button>
                                            @endcan

                                        </form>
                                    </td>
                                @endif

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
