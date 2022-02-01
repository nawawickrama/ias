<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      box-sizing: border-box;
    }

    /* Create four equal columns that floats next to each other */
    .column {
      float: left;
      width: 50%;
      padding: 10px;
      /* Should be removed. Only for demonstration */
    }
    .column1 {
      float: left;
      width: 100%;
      padding: 10px;
      /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .arial {
      font-family: Arial, Helvetica, sans-serif;
    }

    .right {
      float: right;
    }

    .ash {
      color: #F9F9FB;
    }
  </style>
</head>

<body>
  <p class="arial">ASSESSMENT FORM</p>
  <hr>
  <div class="row">
    <div class="column">
      <p class="arial"><b>Applying for :</b>{{ $program }}</p>
    </div>
    <div class="column">
      <p class="arial"><b>Intake :</b> 2022</p>
    </div>
  </div>
  <div class="row">
    <div class="column1">
      <p class="arial"><b>Applicant Name :</b> {{ $name }}</p>
    </div>
  </div>
  <div class="row">
    <div class="column1">
      <p class="arial"><b>Address :</b> {{ $address }}</p>
    </div>
  </div>
  <div class="row">
    <div class="column1">
      
      <p class="arial"><b>Adimission decision :</b>
          @php
            if($adimssion == 1){
                echo "Selected for the $program program.";
            }elseif($adimssion == 3){
                echo "Selected for the $program program with the condition.";
            }elseif($adimssion == 0){
                echo "Not selected.";
            }
          @endphp
      </p>
    </div>
  </div>
  <div class="row">
    <div class="column1">
      <p class="arial">This is the initial assessment result of you and this is not the admission letter. In order to receive the Admission Acceptance Form (AAF), complete documents must be sent to the college as per the guidelines stipulated in our official website (www iaos de). Only upon receiving the complete documents the final admission decision will be made.</p>
    </div>
  </div>
  <div class="row">
    <div class="column1">
      <p class="arial"><b>Special Note :</b> {{ $comment_institute }}</p>
    </div>
  </div>
  <div class="row">
    <div class="column1">
      <img src="{{url('assets/images/txt.png')}}"  alt="Logo" width="30%" height="30%">
      <p class="arial"><b>Datum :</b> {{ $status_date }}, Unterschrift/Stempel prufer(n).</p>
    </div>
  </div>
</body>

</html>