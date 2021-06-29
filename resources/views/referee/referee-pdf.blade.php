<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $referee->applicant_name }}</title>
</head>
<body>
    <div class="container">
        <h1> {{ $referee->applicant_name }}</h1>
        <div class="row">
            <div class="col-4">
                <p>Email: </p><strong>{{ $referee->applicant_email }}</strong>
            </div>
            <div class="col-4">
                <p>Phone Number:</p><strong>{{ $referee->applicant_phone_number }}</strong>
            </div>
            <div class="col-4">
                <p>National Insurance Number:</p><strong>{{ $referee->applicant_ni_number }}</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <p>Gender:</p><strong>{{ $referee->applicant_gender }}</strong>
            </div>
            <div class="col-4">
                <p>Date of Birth:</p><strong>{{ $referee->applicant_date_of_birth }}</strong>
            </div>
            <div class="col-4">
                <p>Current Address:</p><strong>{{ $referee->applicant_current_address }}</strong>
            </div>
        </div>
        <div class="row">
            <p>Sexual Orientation:</p><strong>{{ $referee->applicant_sexual_orientation }}</strong>
        </div>
        <div class="row">
            <p>Ethnicity:</p><strong>{{ $referee->applicant_ethnicity }}</strong>
        </div>
        <hr>
        <h4>Referral Type:</h4><strong>{{ $referee->referral_type }}</strong>
    </div>
</body>
</html>