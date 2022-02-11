@extends('layouts.dashboard.main')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <p>Selected Student Requests</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable-basic">
                <thead>
                    @php
                    $user = Auth::user();
                    $action_permission = $user->can('cpf.view') || $user->can('cpf.download') || $user->can('pending-request.accept') || $user->can('email-send.create');
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
                        <td>{{ $program->course_code }} @if ($program->course_code == 'Direct job') ({{ $cpf->job_feild }}) @endif</td>
                        <td>{{ $candidate->first_name }} {{ $candidate->sur_name }}</td>
                        <td>{{ $candidate->email }}</td>
                        <td>@if(isset($cpf->agent_id)) {{ $agent->name}} @else {{ 'N/A' }} @endif</td>
                        <td>{{ $candidate->telephone }}</td>
                        <td>{{ $country }}</td>
                        <td>{{ $cpf->comment_institute ? $cpf->comment_institute : 'N/A' }}</td>
                        @if ($action_permission)
                        <td>
                            <form action="" id="send-form" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="" id="email_form">

                                @can('cpf.view')
                                <a href="{{ route('view-application', $cpf->cpf_id) }}" target="_blank" class="text-white"><button type="button" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="top" title="View Application">
                                        <i data-feather="eye"></i>
                                    </button>
                                </a>
                                @endcan

                                @can('cpf.download')
                                <a href="{{ route('download-application', $cpf->cpf_id) }}" target="_blank" class="text-white"><button type="button" class="btn btn-warning btn-icon" data-toggle="tooltip" data-placement="top" title="Download CPF Form">
                                        <i data-feather="download"></i>
                                    </button>
                                </a>
                                @endcan

                                @can('pending-request.accept')
                                <a href="#"><button type="button" class="btn btn-success btn-icon" data-placement="top" data-toggle="modal" data-target="#ModalEmail1" title="Re-send Assesment Form">
                                        <i data-feather="flag"></i>
                                    </button>
                                </a>
                                @endcan
                                <!-- Added New -->
                                <a href="#"><button type="button" class="btn btn-dark btn-icon" data-toggle="tooltip" data-placement="top" title="Download Assessment Form">
                                        <i data-feather="download"></i>
                                    </button>
                                </a>
                                @can('email-send.create')
                                <button type="button" class="btn btn-danger btn-icon btn-email" data-email="{{ $candidate->email }}" data-toggle="tooltip" data-placement="top" title="Send Email">
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
<!-- Modal Email -->
<div class="modal fade" id="ModalEmail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Email Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <label>Send this assessment form to :</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="email_method" id="" value="1" required>
                            Student
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="email_method" id="" value="2" required>
                            Agent
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="email_method" id="" value="3" required>
                            Both
                        </label>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" value="" id="appli_id" name="appli_id">
                <input type="hidden" value="" id="comments" name="comments">
                <input type="hidden" value="" id="addmission" name="addmission">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Re-send Email</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('document').ready(function() {
        $('.btn-down').click(function() {
            $('#send-form').attr('action', "{{ route('download_assessment_form_by_approve') }}");
            $('#send-form').submit();
        });

        $('.btn-email').click(function() {
            let email = $(this).attr('data-email');
            $('#email_form').val(email);
            $('#send-form').attr('action', "{{ route('email_button') }}");
            $('#send-form').submit();
        });
    });
</script>
@endsection