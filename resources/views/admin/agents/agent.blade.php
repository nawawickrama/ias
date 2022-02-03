@extends('layouts.dashboard.main')

@section('content')
    @can('agent.create')
        <div class="card">
            <div class="card-header bg-primary text-white" id="add-agent-head">
                <p>Add Agents </p>
            </div>
            <div class="card-body" id="add-agent">
                <form action="{{ route('add_agents') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            @php
                                $user = Auth::user();
                                $agent = $user->hasRole('Agent');
                            @endphp
                            <label for="">Name :</label>
                            @if ($agent)
                                <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror"
                                    @if (old('name') != null) value="{{ old('name') }}" @else value="{{ Auth::user()->name }}" @endif readonly>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            @else
                                <select name="name" id="agent">
                                    <option value="null" selected disabled>Select Agent...</option>
                                    @foreach ($user_agents as $user)
                                        <option value="{{ $user->id }}" @if (old('name') != null && old('name') == $user->id) {{ 'selected' }} @endif>{{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Email :</label>
                            <input type="email" name="email" id="agent_emal"
                                class="form-control @error('email') is-invalid @enderror" @if ($agent) value="{{ Auth::user()->email }}" @else  @if (old('email') != null) value="{{ old('email') }}" @endif @endif readonly>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Contact Number :</label>
                            <input type="number" name="tp" id="" class="form-control @error('tp') is-invalid @enderror"
                                value="{{ old('tp') }}">
                            @error('tp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Contact Number(Optional) :</label>
                            <input type="number" name="tp_2" id="" class="form-control @error('tp_2') is-invalid @enderror"
                                value="{{ old('tp_2') }}">
                            @error('tp_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Country :</label>
                            <select name="country" id=""
                                class="js-example-basic-single w-100 form-control @error('country') is-invalid @enderror">
                                <option selected disabled>Select Country</option>
                                @foreach ($country as $cou)
                                    <option value="{{ $cou->id }}" @if (old('country') == $cou->id) {{ 'selected' }} @endif>{{ $cou->nicename }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Contact Person Name :</label>
                            <input type="text" name="person_name" id=""
                                class="form-control @error('person_name') is-invalid @enderror"
                                value="{{ old('person_name') }}">
                            @error('person_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Whatsapp Number :</label>
                            <input type="number" name="whatsapp_no" id=""
                                class="form-control @error('whatsapp_no') is-invalid @enderror"
                                value="{{ old('whatsapp_no') }}">
                            @error('whatsapp_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Website :</label>
                            <input type="text" name="web_site" id=""
                                class="form-control @error('web_site') is-invalid @enderror" value="{{ old('web_site') }}">
                            @error('web_site')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <button type="submit" class="btn btn-success btn-block">Add Agent</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    @can('agent.view')
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <p>Agent List</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable-basic">
                        <thead>
                            <tr>
                                <th scope="col">Agent Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Contact Number Secondary</th>
                                <th scope="col">Whatsapp Number</th>
                                <th scope="col">Country</th>
                                <th scope="col">Website</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agent_details as $agent)
                                @php
                                    $country_name = App\Models\Country::find($agent->agent_country)->nicename;
                                    $user_details = App\Models\Agent::find($agent->agent_id)->user;
                                @endphp
                                <tr>
                                    <td>{{ $agent->agent_id }}</td>
                                    <td>{{ $user_details->name }}</td>
                                    <td>{{ $user_details->email }}</td>
                                    <td>{{ $agent->agent_tp_1 }}</td>
                                    <td>{{ $agent->agent_tp_2 }}</td>
                                    <td>{{ $agent->agent_whtaspp }}</td>
                                    <td>{{ $country_name }}</td>
                                    <td>{{ $agent->agent_web_site }}</td>
                                    <td>@if ($agent->agent_status == 1)<span class="badge badge-success">Active</span>@elseif($agent->agent_status == 0)<span class="badge badge-danger">Inactive</span>@endif</td>

                                    <td>
                                        <form action="" method="POST">
                                            @csrf
                                            <button type="button" class="btn btn-warning btn-icon btn-down btn-edit"
                                                data-toggle="tooltip" data-placement="top" title="Edit"
                                                agent_id="{{ $agent->agent_id }}" agent_name="{{ $agent->agent_name }}"
                                                agent_email="{{ $agent->agent_email }}" agent_tp="{{ $agent->agent_tp }}"
                                                agent_wp="{{ $agent->agent_whtaspp }}"
                                                country="{{ $agent->agent_country }}"
                                                agent_web="{{ $agent->agent_web_site }}"
                                                person_name={{ $agent->agent_contact_person_name }}>
                                                <i data-feather="edit"></i>
                                            </button></a>
                                            @if ($agent->agent_status == 1)
                                                <button type="button" status="0" data-id="{{ $agent->agent_id }}"
                                                    class="btn btn-danger btn-icon btn-down btn-status" data-toggle="tooltip"
                                                    data-placement="top" title="Deactivate Agent">
                                                    <i data-feather="shield-off"></i>
                                                </button></a>
                                            @elseif($agent->agent_status == 0)
                                                <button type="button" data-id="{{ $agent->agent_id }}" status="1"
                                                    class="btn btn-success btn-icon btn-down btn-status" data-toggle="tooltip"
                                                    data-placement="top" title="Activate Agent">
                                                    <i data-feather="shield"></i>
                                                </button></a>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcan


    <!--Edit Modal -->
    <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('edit_agents') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Name :</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Email :</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Contact Number :</label>
                                <input type="number" name="tp" id="tp"
                                    class="form-control @error('tp') is-invalid @enderror" value="">
                                @error('tp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Country :</label>
                                <select name="country" id="country"
                                    class="js-example-basic-single w-100 @error('country') is-invalid @enderror">
                                    @foreach ($country as $cou)
                                        <option value="{{ $cou->id }}" @if (old('country') == $cou->id) {{ 'selected' }} @endif>
                                            {{ $cou->nicename }}</option>
                                    @endforeach
                                </select>
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Contact Person Name :</label>
                                <input type="text" name="person_name" id="person_name"
                                    class="form-control @error('person_name') is-invalid @enderror" value="">
                                @error('person_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Whatsapp Number :</label>
                                <input type="number" name="whatsapp_no" id="whatsapp_no"
                                    class="form-control @error('whatsapp_no') is-invalid @enderror" value="">
                                @error('whatsapp_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Website :</label>
                                <input type="text" name="web_site" id="web_site"
                                    class="form-control @error('web_site') is-invalid @enderror" value="">
                                @error('web_site')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="agent_id" id="agent_id" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Agent</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--confirm Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm user <span class="ac_deac"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to <span class="ac_deac"></span> this agent?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('act_dea_agents') }}" method="POST">
                        @csrf
                        <input type="hidden" name="agent_id" id="agent" value="">
                        <input type="hidden" name="status" id="status" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('document').ready(function() {

            $('#agent').change(function() {
                let user_id = $(this).val();

                $.ajax({
                    url: '{{ route('name_email_ajax') }}',
                    type: 'POST',
                    data: {
                        user_id: user_id,
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        $('#agent_emal').val(data.email);
                    },
                    error: function(error) {
                        // console.log(error);
                    }
                });
            });

            $('.btn-edit').click(function() {
                let agent_id = $(this).attr('agent_id');
                let agent_name = $(this).attr('agent_name');
                let agent_email = $(this).attr('agent_email');
                let agent_wp = $(this).attr('agent_wp');
                let agent_tp = $(this).attr('agent_tp');
                let agent_web = $(this).attr('agent_web');
                let person_name = $(this).attr('person_name');
                let contry = $(this).attr('country');

                $('#agent_id').val(agent_id);
                $('#name').val(agent_name);
                $('#email').val(agent_email);
                $('#whatsapp_no').val(agent_wp);
                $('#tp').val(agent_tp);
                $('#web_site').val(agent_web);
                $('#person_name').val(person_name);
                $('#country').val(contry);
                $('#editModel').modal('show');
            });

            $('.btn-status').click(function() {
                let status = $(this).attr('status');
                let agent_id = $(this).attr('data-id');

                if (status == 0) {
                    $('.ac_deac').text('deactivate');
                } else {
                    $('.ac_deac').text('activate');
                }
                $('#agent').val(agent_id);
                $('#status').val(status);
                $('#statusModal').modal('show');
            });
        });
    </script>
@endsection
