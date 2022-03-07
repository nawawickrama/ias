@extends('layouts.dashboard.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="row">
                    <div class="col-md-9">
                        <p>Pending Leads</p>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-block btn-dark" data-toggle="modal" data-target="#exampleModal">Add Lead</button>
                    </div>
                </div>
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
                                    <button type="button" class="btn btn-success btn-icon btn-assign" data-toggle="tooltip" data-placement="top" title="Assign to agent" lead-id="{{ $lead->lead_id }}">
                                        <i data-feather="user-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-icon" data-toggle="tooltip" data-placement="top" title="Assign myself">
                                        <i data-feather="clipboard"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-icon btn-delete" data-toggle="tooltip" data-placement="top" title="Delete lead" lead-id="{{ $lead->lead_id }}">
                                        <i data-feather="trash"></i>
                                    </button>
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

<!-- Modal -->
<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('assgn_leads_to_agent') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign lead to agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Please select agent:
                    <select name="agent_id" id="" required>
                        <option value="" selected disabled>Select Agent</option>
                        @foreach ($agent_details as $agent)
                        @php
                        $agent_name = $agent->user->name;
                        $agent_country = $agent->country->nicename;
                        @endphp
                        <option value="{{ $agent->agent_id }}">{{ $agent_name }} -
                            {{ $agent->agent_web_site }} - {{ $agent_country }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="lead_id" id="lead_id_modal" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('leade_delete') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Please confirm delete action with reason ?<br>
                    <input type="text" name="delete_reason" id="" value="" placeholder="Enter reason" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="lead_id" id="lead_id_delete" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Name :</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Email :</label>
                            <input type="email" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Course :</label>
                            <select name="" class="form-control" id="">
                                <option value="">STEP</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Intake :</label>
                            <input type="number" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Country :</label>
                            <select name="" class="form-control" id="">
                                <option value="">Sri Lanka</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">city :</label>
                            <input type="number" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Source :</label>
                            <select name="" class="form-control" id="">
                                <option value="">Facebook</option>
                                <option value="">Google My Business</option>
                                <option value="">Youtube</option>
                                <option value="">Whatsapp</option>
                                <option value="">Official Website</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="">Comment :</label>
                        <textarea name="" class="form-control" id="" cols="30" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add Lead</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.btn-assign').click(function() {
        lead_id = $(this).attr('lead-id');
        $('#lead_id_modal').val(lead_id);
        $('#assignModal').modal('show');
    });

    $('.btn-delete').click(function() {
        lead_id = $(this).attr('lead-id');
        $('#lead_id_delete').val(lead_id);
        $('#deleteModel').modal('show');
    });
</script>
@endsection