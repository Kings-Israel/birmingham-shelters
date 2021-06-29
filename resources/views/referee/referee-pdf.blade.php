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
        @if ($referee->referral_type == 'Agency Referral')
            <div class="row">
                <div class="col-4"><p>Referrer Name:</p><strong>{{ $referee->referrer_name }}</strong></div>
                <div class="col-4"><p>Referrer Phone Number:</p><strong>{{ $referee->referrer_phone_number }}</strong></div>
                <div class="col-4"><p>Referrer Email:</p><strong>{{ $referee->referrer_email }}</strong></div>
            </div>
        @endif
        <hr>
        <h4>Referral Reason:</h4>
        <p>{{ $referee->referral_reason }}</p>
        <hr>
        <h4>Next of Kin</h4>
        <div class="row">
            <div class="col-3"><p>Name:</p><strong>{{ $referee->applicant_kin_name }}</strong></div>
            <div class="col-3"><p>Relationship:</p><strong>{{ $referee->applicant_kin_relationship }}</strong></div>
            <div class="col-3"><p>Email:</p><strong>{{ $referee->applicant_kin_email }}</strong></div>
            <div class="col-3"><p>Phone Number:</p><strong>{{ $referee->applicant_kin_phone_number }}</strong></div>
        </div>
        <hr>
        <h4>Address Information</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td><p>Address</p></td>
                    <td><p>Moved In</p></td>
                    <td><p>Moved Out</p></td>
                    <td><p>Reason For Leaving</p></td>
                </tr>
            </thead>
            <hr>
            <tbody>
                @foreach ($address_info as $info)
                    <tr>
                        <td><p><strong>{{ $info->address }}</strong></p></td>
                        <td><p>{{ $info->moved_in }}</p></td>
                        <td><p><strong>{{ $info->moved_out }}</strong></p></td>
                        <td><p>...{{ $info->reason_for_leaving }}</p></td>
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
                        <p>
                            Social Worker/CPN/Probation 
                            Officer or Other Relevant Professional(s)
                        </p>
                    </td>
                    <td>
                        <p>
                            <strong>{{ $health->professional_officer }}</strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            GP Name:
                        </p>
                    </td>
                    <td>
                        <p>
                            <strong>{{ $health->gp_name }}</strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            GP Address
                        </p>
                    </td>
                    <td>
                        <p>
                            <strong>{{ $health->gp_address }}</strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            Detained For Mental Reasons
                        </p>
                    </td>
                    <td>
                        <p>
                            <strong>{{ $health->detained_for_mental_reasons }}</strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td><p>Mental Health History</p></td>
                    <td><p><strong>{{ $health->mental_health }}</strong></p></td>
                </tr>
                <tr>
                    <td><p>Physical Health</p></td>
                    <td><p><strong>{{ $health->physical_health }}</strong></p></td>
                </tr>
                <tr>
                    <td><p>Present Medication or Treatment</p></td>
                    <td><p><strong>{{ $health->present_medication }}</strong></p></td>
                </tr>
                <tr>
                    <td><p>Current Care Plan Approach</p></td>
                    <td><p><strong>{{ $health->current_cpa }}</strong></p></td>
                </tr>
                @if ($health->other_relevant_information != "")
                    <tr>
                        <td><p>Other Relevant Information</p></td>
                        <td><p><strong>{{ $health->other_relevant_information }}</strong></p></td>
                    </tr>
                @endif
                <tr>
                    <td><p>Has Criminal Record</p></td>
                    <td><p><strong>{{ $health->has_criminal_offence }}</strong></p></td>
                </tr>
                @if ($health->has_criminal_offence == "Yes")
                    <tr>
                        <td><p>Criminal Record Details</p></td>
                        <td><p><strong>{{ $health->criminal_offence_details }}</strong></p></td>
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
                    <td><p><strong>Support Group</strong></p></td>
                    <td><p><strong>Support Need Details</strong></p></td>
                </tr>
            </thead>    
            <tbody>
                @foreach ($support_info as $support)
                    <tr>
                        <td><p>{{ $support->support_group }}</p></td>
                        <td><p>{{ $support->support_needs }}</p></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>