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
    {{-- <img src="/opt/lampp/htdocs/projects/laravel/birmingham/public/storage/referee/image/{{ $referee->applicant_image }}" alt=""> --}}
    <h1> {{ $referee->applicant_name }}</h1>
    <div class="row">
        <div class="col-4">Email: <strong>{{ $referee->applicant_email }}</strong></div>
        <div class="col-4">Phone Number: <strong>{{ $referee->applicant_phone_number }}</strong></div>
        <div class="col-4">National Insurance Number: <strong>{{ $referee->applicant_ni_number }}</strong></div>
    </div>
    <div class="row">
        <div class="col-4">Gender: <strong>{{ $referee->applicant_gender }}</strong></div>
        <div class="col-4">Date of Birth: <strong>{{ $referee->applicant_date_of_birth }}</strong></div>
        <div class="col-4">Current Address: <strong>{{ $referee->applicant_current_address }}</strong></div>
    </div>

    Sexual Orientation: <strong>{{ $referee->applicant_sexual_orientation }}</strong><br>
    Ethnicity: <strong>{{ $referee->applicant_ethnicity }}</strong>
    <hr>
    <h4>Referral Type: <strong>{{ $referee->referral_type }}</strong></h4>
    @if ($referee->referral_type == 'Agency Referral')
        <div class="row">
            <div class="col-4">Referrer Name: <strong>{{ $referee->referrer_name }}</strong></div>
            <div class="col-4">Referrer Phone Number: <strong>{{ $referee->referrer_phone_number }}</strong></div>
            <div class="col-4">Referrer Email: <strong>{{ $referee->referrer_email }}</strong></div>
        </div>
    @endif
    <hr>
    <h4>Referral Reason:</h4>
    <p>{{ $referee->referral_reason }}</p>
    <hr>
    <h4>Next of Kin</h4>
    <div class="row">
        <div class="col-3">Name: <strong>{{ $referee->applicant_kin_name }}</strong></div>
        <div class="col-3">Relationship: <strong>{{ $referee->applicant_kin_relationship }}</strong></div>
        <div class="col-3">Email: <strong>{{ $referee->applicant_kin_email }}</strong></div>
        <div class="col-3">Phone Number: <strong>{{ $referee->applicant_kin_phone_number }}</strong></div>
    </div>
    <hr>
    
    <h4>Address Information</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Address</td>
                <td>Moved In</td>
                <td>Moved Out</td>
                <td>Reason For Leaving</td>
            </tr>
        </thead>
        <hr>
        <tbody>
            @foreach ($address_info as $info)
                <tr>
                    <td><strong>{{ $info->address }}</strong></td>
                    <td>{{ $info->moved_in }}</td>
                    <td><strong>{{ $info->moved_out }}</strong></td>
                    <td>{{ $info->reason_for_leaving }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Health Information</h4>
    <table class="table table-bordered">
        <tbody>
            @foreach ($health_info as $health)
            <tr>
                <td>
                    Social Worker/CPN/Probation Officer or Other Relevant Professional(s)
                </td>
                <td>
                    <strong>{{ $health->professional_officer }}</strong>
                </td>
            </tr>
            <tr>
                <td>
                    GP Name:
                </td>
                <td>
                    <strong>{{ $health->gp_name }}</strong>
                </td>
            </tr>
            <tr>
                <td>
                    GP Address
                </td>
                <td>
                    <strong>{{ $health->gp_address }}</strong>
                </td>
            </tr>
            <tr>
                <td>
                    Detained For Mental Reasons
                </td>
                <td>
                    <strong>{{ $health->detained_for_mental_reasons }}</strong>
                </td>
            </tr>
            <tr>
                <td>Mental Health History</td>
                <td><strong>{{ $health->mental_health }}</strong></td>
            </tr>
            <tr>
                <td>Physical Health</td>
                <td><strong>{{ $health->physical_health }}</strong></td>
            </tr>
            <tr>
                <td>Present Medication or Treatment</td>
                <td><strong>{{ $health->present_medication }}</strong></td>
            </tr>
            <tr>
                <td>Current Care Plan Approach</td>
                <td><strong>{{ $health->current_cpa }}</strong></td>
            </tr>
            @if ($health->other_relevant_information != "")
                <tr>
                    <td>Other Relevant Information</td>
                    <td><strong>{{ $health->other_relevant_information }}</strong></td>
                </tr>
            @endif
            <tr>
                <td>Has Criminal Record</td>
                <td><strong>{{ $health->has_criminal_offence }}</strong></td>
            </tr>
            @if ($health->has_criminal_offence == "Yes")
                <tr>
                    <td>Criminal Record Details</td>
                    <td><strong>{{ $health->criminal_offence_details }}</strong></td>
                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <hr>
    <h4>Income Information</h4>
    @foreach ($income_info as $income)
        <div class="block-body">
            <h5>Source Of Income</h5>
            <ul class="income-info">
                @foreach ($income->source_of_income_list as $item)
                    <li class="text-capitalize">{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        <div class="block-body">
            <table class="table table-bordered">
                <tbody>
                    @if ($income->dwp_office != "" || $income->dwp_office != null)
                        <tr>
                            <td>DWP Office</td>
                            <td><strong>{{ $income->dwp_office }}</strong></td>
                        </tr>
                    @endif
                    @if ($income->other_debt != "" || $income->other_debt != null)
                        <tr>
                            <td>Other Rent or Arrears Details</td>
                            <td><strong>{{ $income->other_debt }}</strong></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @endforeach
    <hr>
    <h4>Risk Assessment</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Risk</td>
                <td>Risk Level</td>
                <td>Risk Details</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($risk_assessment as $assessment)
                <tr>
                    <td><strong>{{ $assessment->risk }}</strong></td>
                    <td>{{ $assessment->risk_level }}</td>
                    <td><strong>{{ $assessment->risk_details }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <h4>Support Needs</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td><strong>Support Group</strong></td>
                <td><strong>Support Need Details</strong></td>
            </tr>
        </thead>    
        <tbody>
            @foreach ($support_info as $support)
                <tr>
                    <td>{{ $support->support_group }}</td>
                    <td>{{ $support->support_needs }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>