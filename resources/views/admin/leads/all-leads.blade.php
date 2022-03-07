@extends('layouts.dashboard.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <p>All Leads</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable-basic">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Intake</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Source</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lead_details as $lead)
                                    @php
                                        $course_name = $lead->course->course_name;
                                        $country_name = $lead->country->nicename;
                                    @endphp
                                    <tr @if ($lead->status == 1) class="table-success" @endif>
                                        <td>{{ $lead->lead_first_name }} {{ $lead->lead_sur_name }}</td>
                                        <td>{{ $lead->lead_email }}</td>
                                        <td>{{ $course_name }}</td>
                                        <td>{{ $lead->lead_intake_year }}</td>
                                        <td>{{ $lead->lead_city }}</td>
                                        <td>{{ $country_name }}</td>
                                        <td>{{ $lead->lead_source }}</td>
                                        <td>{{ $lead->lead_comment ?? 'N/A' }}</td>
                                        <td>
                                            @if ($lead->status == 1)
                                                <span class="badge badge-success badge-sm">POTENTIAL</span>
                                            @elseif ($lead->status == 2)
                                                <span class="badge badge-warning badge-sm">PENDING</span>
                                            @elseif ($lead->status == 3)
                                                <span class="badge badge-primary badge-sm">ASSIGNED TO AGENT</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="" id="send-form" method="POST">
                                                @csrf
                                                <input type="hidden" name="email" value="" id="email_form">
                                                <input type="hidden" name="lead_id" value="" id="lead_id_form">
                                                <button type="button" class="btn btn-success btn-icon" data-toggle="tooltip"
                                                    data-placement="top" title="Add to reminder" data-id="#">
                                                    <i data-feather="bell"></i>
                                                </button>
                                                @can('lead-my-lead-send-email.create')
                                                    <button type="button" class="btn btn-primary btn-icon btn-email"
                                                        data-toggle="tooltip" data-placement="top" title="Send Email"
                                                        data-email="{{ $lead->lead_email }}">
                                                        <i data-feather="mail"></i>
                                                    </button>
                                                @endcan

                                                @can('lead-my-lead-whatapp-msg.create')
                                                    <button type="button" class="btn btn-warning btn-icon btn-whtsapp"
                                                        data-toggle="tooltip" data-placement="top" title="Send whatsapp message"
                                                        @if (empty($lead->lead_whatsapp)) {{ 'disabled' }} @else lead_whatsapp="{{ $lead->lead_whatsapp }}" @endif>
                                                        <i data-feather="phone-call"></i>
                                                    </button>
                                                @endcan

                                                <button type="button" class="btn btn-dark btn-icon" data-toggle="tooltip"
                                                    data-placement="top" title="View lead info & recent activities"
                                                    data-id="#">
                                                    <i data-feather="eye"></i>
                                                </button>

                                                @if ($lead->status != 1)
                                                    @can('lead-potential.create')
                                                        <button type="button" class="btn btn-danger btn-icon btn-potential"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Move to Potential lead" lead-id="{{ $lead->lead_id }}">
                                                            <i data-feather="key"></i>
                                                        </button>
                                                    @endcan
                                                @endif

                                                <button type="button" class="btn btn-info btn-icon " data-toggle="tooltip"
                                                    data-placement="top" title="Edit Leads">
                                                    <i data-feather="edit"></i>
                                                </button>
                                            </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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

            $('.btn-potential').click(function() {
                let lead_id = $(this).attr('lead-id');
                $('#lead_id_form').val(lead_id);
                $('#send-form').attr('action', "{{ route('lead_convert_to_potential') }}");
                $('#send-form').submit();
            });

            $('.btn-whtsapp').click(function() {
                let whtsapp = $(this).attr('lead_whatsapp');
                var url = "https://wa.me/" + whtsapp;
                window.open(url, "_blank");
            });
        });
    </script>
@endsection
