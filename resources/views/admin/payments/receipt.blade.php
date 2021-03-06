<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ url('assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/demo_1/style.css') }}">

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <header>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <img src="https://iaos.de/wp-content/uploads/2019/03/logo.png" alt="" srcset="">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 text-right">
                            {{date('d F Y')}}
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <p><b><u>To whom it may concern,</u></b></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <p>IAS College hereby confirms that we received {{$paid_amount}}€ on {{date('d F Y', strtotime($candidatePaymentInfo->updated_at))}} of {{$candidateInfo->first_name.' '.$candidateInfo->sur_name}}
                                (born on 28.08.2002) passport number {{$candidateInfo->passport_no ?? 'N/A'}} for the course {{$courseInfo->course_code}} - {{$courseInfo->course_name}} Program starting in 2022.
                            </p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <p>
                                Kind regards,
                                IAS College.
                            </p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <p style="margin-bottom:100%">
                                Note : This document is valid without signature
                            </p>
                        </div>
                    </div>
                </header>

                <footer>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <p>
                                IAS College <br>
                                Geschäftsführer:<br>
                                Dr. Krishna Nagarajan<br>
                                Maria-Goeppert Str. 1<br>
                                23562 Lübeck
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p>
                                Deutsche Bank Lübeck<br>
                                Konto: 0365551<br>
                                BLZ: 23070700<br>
                                IBAN: DE80 2307 0700 0036 5551 00<br>
                                BIC: DEUTDEDB237<br>
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
