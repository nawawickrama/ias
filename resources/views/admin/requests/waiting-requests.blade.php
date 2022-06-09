@extends('layouts.dashboard.main')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <p>Selected under condition Requests</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="datatable-basic">
                    <thead>
                    @php
                        $user = Auth::user();
                        $action_permission = $user->can('cpf.view') || $user->can('selected-under-condition-request.rollback') || $user->can('cpf.download') || $user->can('assestment-form.download') || $user->can('email-send.create');
                    @endphp
                    <tr>
                        <th scope="col">Application Id</th>
                        <th scope="col">Program</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Country</th>
                        <th scope="col">Assesment Comment</th>
                        @if ($action_permission)
                            <th scope="col">Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cpf_details as $cpf)
                        @php
                            $candidate = $cpf->candidate;
                            if (isset($cpf->agent_id)) {
                            $agent = App\Models\Agent::find($cpf->agent_id)->user;
                            }
                            $country = App\Models\Country::find($candidate->country)->nicename;

                            $program = $cpf->course;

                        @endphp
                        <tr>
                            <td scope="row">{{ $cpf->cpf_id }}</td>
                            <td>{{ $program->course_code }} @if ($program->course_code == 'Direct job')
                                    ({{ $cpf->job_field }}) @endif</td>
                            <td>{{ $candidate->first_name }} {{ $candidate->sur_name }}</td>
                            <td>{{ $candidate->email }}</td>
                            <td>@if(isset($cpf->agent_id)) {{ $agent->name}} @else {{ 'N/A' }} @endif</td>
                            <td>{{ $candidate->telephone }}</td>
                            <td>{{ $country }}</td>
                            <td>{{ $cpf->comment_institute }}</td>
                            @if ($action_permission)
                                <td>
                                    <form action="" method="POST" id="send-form">
                                        @csrf
                                        <input type="hidden" name="email" value="" id="email_form">
                                        <input type="hidden" name="appli_id" value="{{ $cpf->cpf_id }}">

                                        @can('cpf.view')
                                            <a href="{{ route('view-application', $cpf->cpf_id) }}" target="_blank"
                                               class="text-white">
                                                <button type="button" class="btn btn-primary btn-icon"
                                                        data-toggle="tooltip" data-placement="top" title="View CPF">
                                                    <i data-feather="eye"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('selected-under-condition-request.rollback')
                                            <button type="button" class="btn btn-primary btn-icon btn-convert-pending"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Convert to Pending Request">
                                                <i data-feather="rotate-cw"></i>
                                            </button>
                                        @endcan

                                        @can('cpf.download')
                                            <a href="{{ route('download-application', $cpf->cpf_id) }}" target="_blank"
                                               class="text-white">
                                                <button type="button" class="btn btn-warning btn-icon"
                                                        data-toggle="tooltip" data-placement="top" title="Download CPF">
                                                    <i data-feather="download"></i>
                                                </button>
                                            </a>
                                        @endcan
                                        @can('assessment-form.download')
                                            <button type="button" class="btn btn-success btn-icon btn-down"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Download Assessment Form">
                                                <i data-feather="flag"></i>
                                            </button>
                                        @endcan
                                        @can('assessment-form.email')
                                            <button type="button" class="btn btn-success btn-icon resend-email"
                                                    data-toggle="tooltip" data-placement="top"
                                                    data-id="{{ $cpf->cpf_id }}" agent-id="{{$cpf->agent_id}}" title="Re-email Assessment Form">
                                                <i data-feather="send"></i>
                                            </button>
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
        $('document').ready(function () {
            $('.btn-down').click(function () {
                $('#send-form').attr('action', "{{ route('download_assessment_form_by_approve') }}");
                $('#send-form').submit();
            });

            $('.btn-convert-pending').click(function () {
                $('#send-form').attr('action', "{{ route('convert_pending') }}");
                $('#send-form').submit();
            });

            $('.btn-email').click(function () {
                let email = $(this).attr('data-email');
                $('#email_form').val(email);
                $('#send-form').attr('action', "{{ route('email_button') }}");
                $('#send-form').submit();
            });
        });
    </script>
@endsection
