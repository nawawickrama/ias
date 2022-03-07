@extends('layouts.dashboard.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <p>Potential Leads</p>
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
                                        $config = config('app.url');
                                    @endphp
                                    <tr>
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
                                                <input type="hidden" name="cpf_no" value="" id="random_cpf_no">

                                                @can('lead-potential-send-cpf.create')
                                                <button type="button" class="btn btn-success btn-icon btn-cpf"
                                                    data-toggle="tooltip" data-placement="top" title="Send CPF link" random-no="{{ $lead->lead_random_number }}" base-url="{{ $config }}">
                                                    <i data-feather="link"></i>
                                                </button>
                                                @endcan

                                                @can('lead-potential-send-email.create')
                                                    <button type="button" class="btn btn-primary btn-icon btn-email"
                                                        data-toggle="tooltip" data-placement="top" title="Send Email"
                                                        data-email="{{ $lead->lead_email }}">
                                                        <i data-feather="mail"></i>
                                                    </button>
                                                @endcan

                                                <button type="button" class="btn btn-dark btn-icon resend-email"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="View lead info & recent activities" data-id="#">
                                                    <i data-feather="eye"></i>
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

            $('.btn-cpf').click(function(){
                let random_cpf_no = $(this).attr('random-no');
                $('#random_cpf_no').val(random_cpf_no);
                $('#send-form').attr('action', "{{ route('send_potential_liad_cpf') }}");
                $('#send-form').submit();
                
                // let base_url = $(this).attr('base-url');
                // var url = base_url+"/lead-cpf-form/"+random_cpf_no;
                // window.open(url, '_blanck');


            });
        });
    </script>
@endsection
