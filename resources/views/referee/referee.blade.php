<x-app-dashboard-layout pageTitle="Referee">
    <div class="container">
        <div class="property_block_wrap_header">
            @if (Auth::user()->isOfType('landlord'))
                <a style="float: right" href="{{ route('listing.referee.pdf', $referee->id) }}">Download PDF</a>
            @endif
            <h4 class="property_block_title">
                <a href="{{ url()->previous() }}">
                    <i class="ti-angle-left"></i> 
                </a>
                Referee:
            </h4>
            <div class="pbw-flex-1">
                <div class="pbw-flex-thumb">
                    <img src="{{ asset('storage/referee/image/'.$referee->applicant_image) }}" class="img-fluid" width="300" style="height: 200px; object-fit:cover" alt="" />
                </div>
            </div>

            <div class="pbw-flex">
                <div class="prt-detail-title-desc">
                    <h3>{{ $referee->applicant_name }}</h3>
                    <div class="referee-details">
                        <div class="details">
                            <h6>Email: </h6><span>{{ $referee->applicant_email }}</span><br>
                        </div>
                        <div class="details">
                            <h6>Phone Number: </h6><span>{{ $referee->applicant_phone_number }}</span>
                        </div>
                        <div class="details">
                            <h6>Gender: </h6><span>{{ $referee->applicant_gender }}</span>
                        </div>
                        <div class="details">
                            <h6>National Insurance Number: </h6><span>{{ $referee->applicant_ni_number }}</span>
                        </div>
                        <div class="details">
                            <h6>Current Address: </h6><span>{{ $referee->applicant_current_address }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="referee-details">
                        <div class="details">
                            <h6>Date of Birth: </h6><span>{{ $referee->applicant_date_of_birth }}</span>
                        </div>
                        <div class="details">
                            <h6>Sexual Orientation: </h6><span>{{ $referee->applicant_sexual_orientation }}</span>
                        </div>
                        <div class="details">
                            <h6>Ethnicity: </h6><span>{{ $referee->applicant_ethnicity }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>

        <div class="property_block_wrap style-2">

            <div class="property_block_wrap_header">
                <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                    href="javascript:void(0);" aria-expanded="true">
                    <h4 class="property_block_title">Referral Reason:</h4>
                </a>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                <div class="block-body">
                    <p>{{ $referee->referral_reason }}</p>
                </div>
            </div>
        </div>

        <div class="property_block_wrap style-2">

            <div class="property_block_wrap_header">
                <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                    href="javascript:void(0);" aria-expanded="true">
                    <h4 class="property_block_title">Kin Information:</h4>
                </a>
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
                <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                    href="javascript:void(0);" aria-expanded="true">
                    <h4 class="property_block_title">Address Information:</h4>
                </a>
            </div>
            <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
                <div class="block-body">
                    <div class="row">
                        <div class="col-md-2"><strong>Address</strong></div>
                        <div class="col-md-2"><strong>Move In</strong></div>
                        <div class="col-md-2"><strong>Move Out</strong></div>
                        <div class="col-md-6"><strong>Reason For Leaving</strong></div>
                    </div>
                    @foreach ($address_info as $info)
                    <div class="row">
                        <div class="col-md-2">
                            {{ $info->address }}
                        </div>
                        <div class="col-md-2">
                            {{ $info->moved_in }}
                        </div>
                        <div class="col-md-2">
                            {{ $info->moved_out }}
                        </div>
                        <div class="col-md-6">
                            {{ $info->reason_for_leaving }}
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="property_block_wrap style-2">

            <div class="property_block_wrap_header">
                <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                    href="javascript:void(0);" aria-expanded="true">
                    <h4 class="property_block_title">Health Information:</h4>
                </a>
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
                <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                    href="javascript:void(0);" aria-expanded="true">
                    <h4 class="property_block_title">Income Information:</h4>
                </a>
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
                <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                    href="javascript:void(0);" aria-expanded="true">
                    <h4 class="property_block_title">Risk Assessment Information:</h4>
                </a>
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
                <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                    href="javascript:void(0);" aria-expanded="true">
                    <h4 class="property_block_title">Support Needs:</h4>
                </a>
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
</x-app-dashboard-layout>