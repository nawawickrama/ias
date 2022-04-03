@extends('layouts.dashboard.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <p>My Leads</p>
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
                                        <form action="" class="send-form" method="POST">
                                            @csrf
                                            <input type="hidden" name="email" value="" class="email_form">
                                            <input type="hidden" name="lead_id" value="" class="lead_id_form">

                                            <button type="button" class="btn btn-success btn-icon btn-set-reminder"
                                                    data-toggle="tooltip" data-placement="top" title="Add to reminder"
                                                    lead-id="{{ $lead->lead_id }}">
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
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Send whatsapp message"
                                                        @if (empty($lead->lead_whatsapp)) {{ 'disabled' }} @else lead_whatsapp="{{ $lead->lead_whatsapp }}" @endif>
                                                    <i data-feather="phone-call"></i>
                                                </button>
                                            @endcan

                                            <button type="button" class="btn btn-dark btn-icon btn-activity-log"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="View lead info & recent activities"
                                                    lead-id="{{ $lead->lead_id }}">
                                                <i data-feather="eye"></i>
                                            </button>

                                            @if ($lead->status != 1)
                                                @can('lead-potential.create')
                                                    <button type="button" class="btn btn-danger btn-icon btn-potential"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Move to Potential lead"
                                                            lead-id="{{ $lead->lead_id }}"
                                                    @if ($lead->status == 1) {{ 'disabled' }} @endif>
                                                        <i data-feather="key"></i>
                                                    </button>
                                                @endcan
                                            @endif

                                            @can('lead.edit')
                                                <button type="button" class="btn btn-info btn-icon btn-lead-edit"
                                                        data-toggle="tooltip" data-placement="top"
                                                        lead_id="{{ $lead->lead_id }}"
                                                        lead_sur_name="{{ $lead->lead_sur_name }}"
                                                        lead_first_name="{{ $lead->lead_first_name }}"
                                                        lead_email="{{ $lead->lead_email }}"
                                                        lead_course_id="{{ $lead->lead_course_id }}"
                                                        lead_city="{{ $lead->lead_city }}"
                                                        lead_intake_year="{{ $lead->lead_intake_year }}"
                                                        lead_country_id="{{ $lead->lead_country_id }}"
                                                        lead_source="{{ $lead->lead_source }}"
                                                        lead_comment="{{ $lead->lead_comment }}"
                                                        lead_whtasapp="{{ $lead->lead_whatsapp }}"
                                                        lead_contact="{{ $lead->lead_contact }}" title="Edit Leads">
                                                    <i data-feather="edit"></i>
                                                </button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
