@extends('layouts.dashboard.main')

@section('content')
    @php
        $user = Auth::user();
    @endphp
    @if ($user->hasRole('Agent'))
        @php
            $user = App\Models\User::find(Auth::user()->id)->agent;
            // dd($user);
        @endphp
        <div class="input-group mb-3">

            <input type="text" class="form-control" id="ref_link" placeholder="Agent Link"
                value="{{ config('app.url') }}/reg_cpf/{{ $user->reference_no }}" readonly>

            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="button" id="copy_btn">Copy Link</button>
            </div>
        </div>
    @else
        <div class="input-group mb-3">

            <input type="text" class="form-control" id="ref_link" placeholder="Agent Link"
                value="{{ config('app.url') }}/direct_cpf" readonly>

            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="button" id="copy_btn">Copy Link</button>
            </div>
        </div>
    @endif

    <script>
        $('document').ready(function(){
            $('#copy_btn').click(function(){  
                var link = $('#ref_link').select();
                document.execCommand('copy');
            });
        });
    </script>
@endsection
