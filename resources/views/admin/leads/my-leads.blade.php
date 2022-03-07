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
                                                            title="Move to Potential lead" lead-id="{{ $lead->lead_id }}"
                                                            @if ($lead->status == 1) {{ 'disabled' }} @endif>
                                                            <i data-feather="key"></i>
                                                        </button>
                                                    @endcan
                                                @endif

                                                @can('lead.edit')
                                                    <button type="button" class="btn btn-info btn-icon btn-lead-edit"
                                                        data-toggle="tooltip" data-placement="top"
                                                        lead_id="{{ $lead->lead_id }}" 
                                                        lead_sur_name = "{{ $lead->lead_sur_name }}"
                                                        lead_first_name = "{{ $lead->lead_first_name }}"
                                                        lead_email = "{{ $lead->lead_email }}"
                                                        lead_course_id = "{{ $lead->lead_couse_id }}"
                                                        lead_city = "{{ $lead->lead_city }}"
                                                        lead_intake_year = "{{ $lead->lead_intake_year }}"
                                                        lead_country_id = "{{ $lead->lead_country_id }}"
                                                        lead_source = "{{ $lead->lead_source }}"
                                                        lead_comment = "{{ $lead->lead_comment }}"
                                                        lead_whtasapp = "{{ $lead->lead_whatsapp }}"
                                                        lead_contact = "{{ $lead->lead_contact }}"
                                                        
                                                        title="Edit Leads">
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

    <div class="modal fade bd-example-modal-lg" id="editModel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Lead</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('edit_lead') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Sur Name :</label>
                                <input type="text" name="sur_name" id="edit_form_sur_name" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">First Name :</label>
                                <input type="text" name="first_name" id="edit_form_first_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Whatsapp No :</label>
                                <input type="text" name="whatsapp_no" id="edit_form_whatsapp" placeholder="Without country code. - XXXXXXXXXX"
                                    class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Contact No :</label>
                                <input type="text" name="contact_no" id="edit_form_contact" placeholder="With country code. - +1XXXXXXXXXX"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Course :</label>
                                <select name="course_id" class="form-control" id="edit_form_course">
                                    <option value="">Select Course</option>
                                    @foreach ($couses as $course)
                                        <option value="{{ $course->course_id }}">{{ $course->course_code }} -
                                            {{ $course->course_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Intake :</label>
                                <input type="number" name="intake_year" id="edit_form_intake_year" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Country :</label>
                                <select name="country_id" class="form-control" id="edit_form_country">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->nicename }} -
                                            {{ $country->iso3 }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">city :</label>
                                <input type="text" name="city_id" id="edit_form_city_id" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Email :</label>
                                <input type="email" name="email" id="edit_form_email" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Source :</label>
                                <select name="source" class="form-control" id="edit_form_sourcr">
                                    <option value="Facebook">Facebook</option>
                                    <option value="Google My Business">Google My Business</option>
                                    <option value="Youtube">Youtube</option>
                                    <option value="Whatsapp">Whatsapp</option>
                                    <option value="Official Website">Official Website</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="">Comment :</label>
                            <textarea name="comment" class="form-control" id="edit_form_comment" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="" name="lead_id" id="lead_id_edit_form">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Lead</button>
                    </div>
                </form>

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

            $('.btn-lead-edit').click(function() {
                let lead_id = $(this).attr('lead_id');

                let lead_sur_name = $(this).attr('lead_sur_name');
                let lead_first_name = $(this).attr('lead_first_name');
                let lead_email = $(this).attr('lead_email');
                let lead_course_id = $(this).attr('lead_course_id');
                let lead_whtasapp = $(this).attr('lead_whtasapp');
                let lead_contact = $(this).attr('lead_contact');
                let lead_intake_year = $(this).attr('lead_intake_year');
                let lead_country_id = $(this).attr('lead_country_id');
                let lead_source = $(this).attr('lead_source');
                let lead_city = $(this).attr('lead_city');
                let lead_comment = $(this).attr('lead_comment');

                $('#lead_id_edit_form').val(lead_id);
                $('#edit_form_sur_name').val(lead_sur_name);
                $('#edit_form_first_name').val(lead_first_name);
                $('#edit_form_whatsapp').val(lead_whtasapp);
                $('#edit_form_contact').val(lead_contact);
                $('#edit_form_intake_year').val(lead_intake_year);
                $('#edit_form_country').val(lead_country_id);
                $('#edit_form_sourcr').val(lead_source);
                $('#edit_form_comment').val(lead_comment);
                $('#edit_form_email').val(lead_email);
                $('#edit_form_city_id').val(lead_city);
                $('#edit_form_course').val(lead_course_id);


                $('#editModel').modal('show');
            });
        });
    </script>
@endsection
