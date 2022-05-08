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
                    @if ($action_permission)
                            <th scope="col">Action</th>
                        @endif
                        <th scope="col">Id</th>
                        <th scope="col">Program</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Contact No</th>
                        <th scope="col">Country</th>
                        <th scope="col">Comment</th>
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
                        @if ($action_permission)
                                <td>
                                    <form action="" id="send-form" method="POST">
                                        @csrf
                                        <input type="hidden" name="email" value="" id="email_form">
                                        <input type="hidden" name="appli_id" value="" id="appli_id">

                                        @can('cpf.view')
                                            <a href="{{ route('view-application', $cpf->cpf_id) }}" target="_blank"
                                               class="text-white">
                                                <button type="button" class="btn btn-primary btn-icon"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="View Application">
                                                    <i data-feather="eye"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('cpf.download')
                                            <a href="{{ route('download-application', $cpf->cpf_id) }}" target="_blank"
                                               class="text-white">
                                                <button type="button" class="btn btn-warning btn-icon"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Download CPF Form">
                                                    <i data-feather="download"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('assessment-form.email')
                                            <button type="button" class="btn btn-success btn-icon resend-email"
                                                    data-toggle="tooltip" data-placement="top"
                                                    data-id="{{ $cpf->cpf_id }}" title="Re-email Assessment Form">
                                                <i data-feather="send"></i>
                                            </button>

                                        @endcan
                                        @can('assessment-form.download')
                                            <button type="button" class="btn btn-dark btn-icon btn-down"
                                                    data-toggle="tooltip" data-placement="top"
                                                    data-id="{{ $cpf->cpf_id }}" title="Download Assessment Form">
                                                <i data-feather="download"></i>
                                            </button>
                                        @endcan

                                        @can('email-send.create')
                                            <button type="button" class="btn btn-danger btn-icon btn-email"
                                                    data-email="{{ $candidate->email }}" data-toggle="tooltip"
                                                    data-placement="top" title="Send Email">
                                                <i data-feather="mail"></i>
                                            </button>
                                        @endcan

                                        @can('student.make-potential')
                                            <button type="button" class="btn btn-warning btn-icon btn-make-potential"
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="Convert as potential student"
                                                    cpf-id="{{ $cpf->cpf_id }}"
                                                    candidate-id="{{ $candidate->candidate_id }}">
                                                <i data-feather="star"></i>
                                            </button>
                                        @endcan
                                    </form>
                                </td>
                            @endif
                            <td scope="row">{{ $cpf->cpf_id }}</td>
                            <td>{{ $program->course_code }} @if ($program->course_code == 'Direct job')
                                    ({{ $cpf->job_feild }}) @endif</td>
                            <td>{{ $candidate->first_name }} {{ $candidate->sur_name }}</td>
                            <td>{{ $candidate->email }}</td>
                            <td>@if (isset($cpf->agent_id)) {{ $agent->name }} @else {{ 'N/A' }} @endif</td>
                            <td>{{ $candidate->telephone }}</td>
                            <td>{{ $country }}</td>
                            <td>{{ $cpf->comment_institute ? $cpf->comment_institute : 'N/A' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Email -->
    <div class="modal fade" id="ModalEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Email Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('email_assestment_form_by_button') }}" method="POST">
                        @csrf
                        <label>Send this assessment form to :</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="email_method" id="" value="1"
                                       required>
                                Student
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="email_method" id="" value="2"
                                       required>
                                Agent
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="email_method" id="" value="3"
                                       required>
                                Both
                            </label>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="" id="applicant_id" name="appli_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Re-send Email</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('document').ready(function () {
            $('.btn-down').click(function () {
                let appli_id = $(this).attr('data-id');
                $('#appli_id').val(appli_id);
                $('#send-form').attr('action', "{{ route('download_assessment_form_by_approve') }}");
                $('#send-form').submit();
            });

            $('.btn-email').click(function () {
                let email = $(this).attr('data-email');
                $('#email_form').val(email);
                $('#send-form').attr('action', "{{ route('email_button') }}");
                $('#send-form').submit();
            });

            $('.resend-email').click(function () {
                let cpf_id = $(this).attr('data-id');

                $('#applicant_id').val(cpf_id);
                $('#ModalEmail').modal('show');
            });

            $('.btn-make-potential').click(function () {
                let element = $(this);
                let candidate_id = $(this).attr('candidate-id');
                let cpf_id = $(this).attr('cpf-id');
                $(this).html("<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span>");

                $.ajax({
                    url: '{{route('make-potential')}}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        candidateID: candidate_id,
                        cpfID: cpf_id,
                    },
                    beforeSend:function (){
                        element.html("<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span>");
                    },
                    success: function (response) {
                        element.html("<i data-feather=\"star\"></i>");

                        notify('success', 'Student added to potential category.');
                        setTimeout(function () {
                            location.reload();
                        }, 3000);

                    }, error: function (error) {
                        element.html("<i data-feather=\"alert-octagon\"></i>");
                        notify('error', error.responseJSON.message);

                    }
                })
            });
        });
    </script>
@endsection
