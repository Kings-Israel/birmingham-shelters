<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $referee->applicant_name }}</title>
    <style>
        body {
            background: #ffffff;
            color:#4e5c79;
            font-size:16px;
            font-family: 'Muli', sans-serif;
            margin: 0;
            overflow-x: hidden !important;
            font-weight: 400;
        }
        html {
            position: relative;
            min-height: 100%;
            background: #ffffff; 
        }
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color:#2D3954;
            font-weight:700;
            text-transform: capitalize;
            font-family: 'Jost', sans-serif;
        }

        h5,
        h6 {
            color:#2D3954;  
        }
        h1 {
        line-height: 40px;
        font-size: 36px; }

        h2 {
        line-height: 36px;
        font-size: 30px; }

        h3 {
        line-height: 30px;
        font-size: 24px; }

        h4 {
        line-height: 26px;
        font-size: 21px; }

        h5 {
        line-height: 22px;
        font-size: 18px;
        }

        h6 {
        line-height: 20px;
        font-size: 16px;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid transparent;
            border-top: 0px !important;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color:#f7f9fb;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            border-top: 1px solid #f7f9fb;
        }
        .table tr th, .table tr td {
            border-color: #eaeff5;
            padding: 12px 15px;
            vertical-align: middle;
        }
        .table.tbl-big tr th, .table.tbl-big tr td {
            padding:20px 15px;
        }
        .table.tbl-big.center tr th, .table.tbl-big.center tr td {
            padding:20px 15px;
            text-align:center;
        }
        table.table tr th {
            font-weight: 600;
        }
        .nav-brand img {
            max-width:100px;
            position: relative;
            top: 2px;
        }
        @page {
                margin: 100px 25px;
            }

        header {
            position: fixed;
            float: right;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }
        .pbw-flex-thumb img {
            max-width: 50px;
            border-radius: 50%;
            margin-right: 10px;
            float: right;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        <a class="nav-brand" href="#">
            <img src="{{ asset('img/sb-mock-logo.png') }}" class="logo" alt="" />
        </a>
    </header>
    <div class="container">
        @if ($referee->applicant_image != 'blank-profile-picture.png')
            <div class="pbw-flex-1">
                <div class="pbw-flex-thumb">
                    <img src="{{ asset('storage/referee/image/'.$referee->applicant_image) }}" class="img-fluid" alt="" />
                </div>
            </div>
        @endif
        <div class="pbw-flex">
                <div class="prt-detail-title-desc">
                    <h3>{{ $referee->applicant_name }}</h3>
                    <table width="100%">
                        <thead>
                            <tr>
                            <td>Email</td>
                            <td>Phone Number</td>
                            <td>Gender</td>
                            <td>National Insurance Number</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>{{ $referee->applicant_email }}</strong></td>
                                <td><strong>+{{ $referee->applicant_phone_number }}</strong></td>
                                <td><strong>{{ $referee->applicant_gender }}</strong></td>
                                <td><strong>{{ $referee->applicant_ni_number }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <div class="pbw-flex">
            <div class="prt-detail-title-desc">
                <table width="100%">
                    <thead>
                        <tr>
                            <td>Current Address</td>
                            <td>Date of Birth</td>
                            <td>Sexual Orientation</td>
                            <td>Ethnicity</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>.{{ $referee->applicant_current_address }}</strong></td>
                            <td><strong>{{ $referee->applicant_date_of_birth }}</strong></td>
                            <td><strong>{{ $referee->applicant_sexual_orientation }}</strong></td>
                            <td><strong>{{ $referee->applicant_ethnicity }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        </div>
        <div class="property_block_wrap style-2">
            <div class="property_block_wrap_header">
                <h5 class="property_block_title">Referral Type: <strong>{{ $referee->referral_type }}</strong></h5>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                <div class="block-body">
                    @if ($referee->referral_type == 'Agency Referral')
                        <div class="row">
                            <div class="col-4">Referrer Name: <strong>{{ $referee->referrer_name }}</strong></div>
                            <div class="col-4">Referrer Phone Number: <strong>{{ $referee->referrer_phone_number }}</strong></div>
                            <div class="col-4">Referrer Email: <strong>{{ $referee->referrer_email }}</strong></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="property_block_wrap style-2">

            <div class="property_block_wrap_header">
                <h4 class="property_block_title">Referral Reason:</h4>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                <div class="block-body">
                    <p>{{ $referee->referral_reason }}</p>
                </div>
            </div>
        </div>

        <div class="property_block_wrap style-2">

            <div class="property_block_wrap_header">
                <h4 class="property_block_title">Next of Kin:</h4>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                <div class="block-body">
                    <div class="row">
                        <div class="col-md-3">Name: <strong>{{ $referee->applicant_kin_name }}</strong></div>
                        <div class="col-md-3">Relationship: <strong>{{ $referee->applicant_kin_relationship }}</strong></div>
                        <div class="col-md-3">Email: <strong>{{ $referee->applicant_kin_email }}</strong></div>
                        <div class="col-md-3">Phone Number: <strong>{{ $referee->applicant_kin_phone_number }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="property_block_wrap style-2">
            <div class="property_block_wrap_header">
                <h4 class="property_block_title">Address Information:</h4>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                <div class="block-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td><strong>Move In</strong></td>
                                <td><strong>Move Out</strong></td>
                                <td><strong>Reason For Leaving</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($address_info as $info)
                                <tr>
                                    <td>{{ $info->address }}</td>
                                    <td>{{ $info->moved_in }}</td>
                                    <td>{{ $info->moved_out }}</td>
                                    <td>{{ $info->reason_for_leaving }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="property_block_wrap style-2">

            <div class="property_block_wrap_header">
                <h4 class="property_block_title">Health Information:</h4>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                <div class="block-body">
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
                </div>
            </div>
        </div>

        <div class="property_block_wrap style-2">

            <div class="property_block_wrap_header">
                <h4 class="property_block_title">Income Information:</h4>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                @foreach ($income_info as $income)
                    <div class="block-body">
                        <h6>Source Of Income</h6>
                        <ul class="avl-features third color">
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
            </div>
        </div>

        <div class="property_block_wrap style-2">

            <div class="property_block_wrap_header">
                <h4 class="property_block_title">Risk Assessment Information:</h4>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                <div class="block-body">
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
                                    <td><strong>{{ $assessment->risk_level }}</strong></td>
                                    <td><strong>{{ $assessment->risk_details }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="property_block_wrap style-2">

            <div class="property_block_wrap_header">
                <h4 class="property_block_title">Support Needs:</h4>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                <div class="block-body">
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
            </div>
        </div>
    </div>
</body>
</html>