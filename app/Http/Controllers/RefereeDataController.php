<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RefereeData;
use App\Models\ApplicantIncomeInfo;
use App\Models\ApplicantAddressInfo;
use App\Models\ApplicantHealthInfo;
use App\Models\ApplicantSupportNeeds;
use App\Models\ApplicantRiskAssessment;
use App\Models\Consent;
use Illuminate\Support\Facades\Validator;
use App\Rules\PhoneNumber;
use PDF;

class RefereeDataController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function selfReferral()
    {
        return view('referral.self-referral');
    }

    public function agencyReferral()
    {
        return view('referral.agency-referral');
    }

    public function addIncomeInfo(RefereeData $refereeData)
    {
        $income_fields = [
            'JSA', 'DLA', 'Incapacity Benefit/ESA', 'Income Support', 'Pension', 'UC', 'Working', 'None'
        ];
        return view('referral.add-income-info')->with(['refereeData' => $refereeData, 'income_fields' => $income_fields]);
    }

    public function addAddressHistoryInfo(RefereeData $refereeData)
    {
        return view('referral.add-address-info')->with('refereeData', $refereeData);
    }

    public function addHealthInfo(RefereeData $refereeData)
    {
        return view('referral.add-health-info')->with('refereeData', $refereeData);
    }

    public function addSupportInfo(RefereeData $refereeData)
    {
        $support_group_list = [
            'Mental Health Problems', 
            'Single Homeless with support needs', 
            'Training Educator Employment', 
            'Leisure, Cultural, Faith, Informal Learning Activities', 
            'Primary Health Care/Mental Health or Drug/Alcohol Services', 
            'Accomodation/Housing', 
            'Safeguarding: Avoid self-harm and/or harm to others', 
            'Independent Living Skills', 
            'Inclusion in Community', 
            'Social Isolation/Contact with family/friends',
            'Other'
        ];
        return view('referral.add-support-needs')->with(['refereeData' => $refereeData, 'support_group_list' => $support_group_list]);
    }

    public function addRiskAssessment(RefereeData $refereeData)
    {
        $risks = [
            'Violence/Aggresive Behaviour',
            'Self-harm/Suicide/Mental Health Formal Diagnosis',
            'Drug/Alcohol Misuse',
            'Child Protection Issues',
            'Sexual or Schedule 1 offence',
            'Criminal Convictions/offences',
            'Self-neglect/Neglect of others',
            'Antisocial Behaviour',
            'Damage to property',
            'Neighbourhood problems',
            'Arson',
            'Rent arrears',
            'Harm from Others'
        ];
        return view('referral.add-risk-assessment')->with(['risks_list' => $risks, 'refereeData' => $refereeData]);
    }

    public function addConsent(RefereeData $refereeData)
    {
        return view('referral.add-consent', [
            'id' => $refereeData->id,
            'referral_type' => $refereeData->referral_type,
        ]);
    }

    public function submitReferralForm(Request $request)
    {
        $rules = [
            'referral_type' => 'required|string',
            'referrer_name' => 'required|string',
            'referrer_email' => 'required|email',
            'referrer_phone_number' => new PhoneNumber,
            'referral_reason' => 'required',
            'applicant_name' => 'required|string',
            'applicant_email' => 'required|email',
            'applicant_phone_number' => new PhoneNumber,
            'applicant_date_of_birth' => 'required|date',
            'applicant_ni_number' => 'required',
            'applicant_current_address' => 'required',
            'applicant_gender' => 'required',
            'applicant_sexual_orientation' => 'required',
            'applicant_ethnicity' => 'required',
            'applicant_kin_name' => 'nullable',
            'applicant_kin_relationship' => 'nullable',
            'applicant_kin_phone_number' => new PhoneNumber,
            'applicant_kin_email' => 'nullable|email',
            'applicant_image' => 'sometimes|mimes:png,jpg,jpeg'
        ];

        $messages = [
            'required' => 'Please enter this information',
            'email' => 'Please enter a valid email address',
            'date' => 'Please enter a valid date'
        ];

        Validator::make($request->all(), $rules, $messages)->validate();
        
        if ($request->has('applicant_image')) {
            pathinfo($request->file('applicant_image')->store('image', 'referee'), PATHINFO_BASENAME);
        }

        $refereeData = new RefereeData;
        $refereeData->user_id = $request->user()->id;
        $refereeData->referral_type = $request->referral_type;
        $refereeData->referrer_name = $request->referrer_name;
        $refereeData->referrer_email = $request->referrer_email;
        $refereeData->referrer_phone_number = $request->referrer_phone_number;
        $refereeData->referral_reason = $request->referral_reason;
        $refereeData->applicant_name = $request->applicant_name;
        $refereeData->applicant_email = $request->applicant_email;
        $refereeData->applicant_phone_number = $request->applicant_phone_number;
        $refereeData->applicant_date_of_birth = $request->applicant_date_of_birth;
        $refereeData->applicant_ni_number = $request->applicant_ni_number;
        $refereeData->applicant_current_address = $request->applicant_current_address;
        $refereeData->applicant_gender = $request->applicant_gender;
        $refereeData->applicant_sexual_orientation = $request->applicant_sexual_orientation;
        $refereeData->applicant_ethnicity = $request->applicant_ethnicity;
        $refereeData->applicant_kin_name = $request->applicant_kin_name;
        $refereeData->applicant_kin_email = $request->applicant_kin_email;
        $refereeData->applicant_kin_phone_number = $request->applicant_kin_phone_number;
        $refereeData->applicant_kin_relationship = $request->applicant_kin_relationship;

        if ($request->has('applicant_image')) {
            $refereeData->applicant_image = pathinfo($request->file('applicant_image')->store('image', 'referee'), PATHINFO_BASENAME);
        } else {
            $refereeData->applicant_image = 'blank-profile-picture.png';
        }

        if ($refereeData->save()) {
            return redirect()->route('referral.add.income-info', $refereeData);
        }

        return redirect()->back()->withError('There was a problem. Please try again');
    }

    public function submitIncomeInfo(Request $request)
    {
        $rules = [
            'source_of_income' => 'required|min:1',
        ];

        $messages = [
            'required' => 'Please select one option',
            'min:1' => 'Please select at least one option'
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        $incomeInfo = new ApplicantIncomeInfo;
        $incomeInfo->referee_data_id = $request->referee_data_id;
        $incomeInfo->source_of_income = implode(',', $request->source_of_income);
        $incomeInfo->dwp_office = $request->dwp_office;
        $incomeInfo->other_debt = $request->other_debt;
        if($incomeInfo->save()) {
            return redirect()->route('referral.add.address-history-info', $request->referee_data_id);
        }

        return redirect()->back()->withError('A problem occurred while saving the data. Please try again');
    }

    public function submitAddressHistoryInfo(Request $request)
    {
        $rules = [
            'address.0' => 'required|string',
            'moved_in_date' => 'array|min:1',
            'moved_in_date.0' => 'required|date',
            'moved_out_date' => 'array|min:1',
            'moved_out_date.0' => 'required|date',
            'tenure' => 'array|min:1',
            'tenure.0' => 'required|string',
            'landlord_details' => 'array|min:1',
            'landlord_details.0' => 'required|string',
            'reason_for_leaving' => 'array|min:1',
            'reason_for_leaving.0' => 'required|string'
        ];
        
        $messages = [
            'required' => 'Please enter the information.',
            'min:1' => 'Please fill an entire row',
            'date' => 'Please enter valid dates.'
        ];
        
        Validator::make($request->all(), $rules, $messages)->validate();
        
        for ($i=0; $i < 4; $i++) { 
            if($request->address[$i] != null && $request->moved_in_date[$i] != null && $request->moved_out_date[$i] != null && $request->tenure[$i] != null && $request->landlord_details[$i] && $request->reason_for_leaving != null) {
                ApplicantAddressInfo::create([
                    'referee_data_id' => $request->referee_data_id,
                    'address' => $request->address[$i],
                    'moved_in' => $request->moved_in_date[$i],
                    'moved_out' => $request->moved_out_date[$i],
                    'tenure' => $request->tenure[$i],
                    'landlord_details' => $request->landlord_details[$i],
                    'reason_for_leaving' => $request->reason_for_leaving[$i],
                ]);
            }
        }

        return redirect()->route('referral.add.health-info', $request->referee_data_id);

    }

    private function _validateTextIfRadioIsSelected(Request $request)
    {
        if($request->has_criminal_offence === 'Yes') {
            return true;
        }

        return false;
    }

    public function submitHealthInfo(Request $request)
    {
        $rules = [
            'professional_officer' => 'nullable|string',
            'gp_name' => 'nullable|string',
            'detained_for_mental_health' => 'required',
            'mental_health' => 'required|string',
            'physical_health' => 'required|string',
            'present_medication' => 'nullable|string',
            'current_cpa' => 'nullable|string',
            'other_relevant_information' => 'nullable|string',
            'has_criminal_offence' => 'required',
            'criminal_offence_details' => ''.($this->_validateTextIfRadioIsSelected($request) ? 'required' : '').'',
        ];

        $message = [
            'required' => 'A value must be entered in this field',
            'string' => 'The values entered here must be letters only',
            'detained_for_mental_health.required' => 'Please select one option here.',
            'has_criminal_offence.required' => 'Please select one option here.',
            'criminal_offence_details.required' => 'Please enter the details of the criminal offence'
        ];

        Validator::make($request->all(), $rules, $message)->validate();

        if (ApplicantHealthInfo::create($request->all())) {
            return redirect()->route('referral.add.support-info', $request->referee_data_id);
        }

        return redirect()->back()->withErrors('An Error Occured. Please try again');
    }

    public function submitSupportInfo(Request $request)
    {
        $rules = [];
        $messages = [];
        foreach($request->support_needs as $key => $need) {
            for ($i=0; $i < count($request->support_group); $i++) { 
                if ($request->support_group[$i] === $key) {
                    $rules[$key] = 'required|string';
                    $messages[$key.'.required'] = 'Please enter the support needs';
                    $messages[$key.'.string'] = 'Enter the support description using only letters';
                }
            }
        }
        Validator::make($request->support_needs, $rules, $messages)->validate();

        foreach ($request->support_group as $key => $group) {
            $applicantSupport = new ApplicantSupportNeeds;
            $applicantSupport->referee_data_id = $request->referee_data_id;
            $applicantSupport->support_group = $group;
            $applicantSupport->support_needs = $request->support_needs[$group];
            $applicantSupport->save();
        }

        return redirect()->route('referral.add.risk-assessment', $request->referee_data_id);
    }

    public function submitRiskAssessment(Request $request)
    {
        $risks_with_risk_level = collect($request->risk_level, $request->risks);
        $rules = [];
        $messages = [];
        foreach($request->risk_description as $key => $description) {
            foreach ($risks_with_risk_level as $risk => $risk_level) {
                if($risk === $key) {
                    $rules[$risk] = 'required';
                    $rules[$key] = 'required|string';
                    $messages[$key.'.required'] = 'Please enter a description';
                }
            }
        }
        
        Validator::make($request->risk_description, $rules, $messages)->validate();

        foreach($request->risk_description as $key => $description) {
            foreach ($risks_with_risk_level as $risk => $risk_level) {
                if($risk === $key) {
                    $riskAssessment = new ApplicantRiskAssessment;
                    $riskAssessment->referee_data_id = $request->referee_data_id;
                    $riskAssessment->risk = $risk;
                    $riskAssessment->risk_level = $risk_level;
                    $riskAssessment->risk_details = $description;
                    $riskAssessment->save();
                }
            }
        }

        return redirect()->route('referral.add.consent', $request->referee_data_id);
    }

    public function submitConsentForm(Request $request)
    {
        $rules = [
            'consent_name' => 'required|string',
            'consent_date' => 'required|date',
            'consent_company_position' => 'required'
        ];

        $messages = [
            'required' => "Please fill this field",
            "date" => 'Please enter a correct date',
            'string' => 'Enter letters only in this field'
        ];

        Validator::make($request->all(), $rules, $messages);

        if (Consent::create($request->all())) {
            $refereeData = refereeData::find($request->referee_data_id);
            $refereeData->consent = 0;
            if($refereeData->save()){
                return redirect()->route('listing.all')->with('success', "Your information has been saved successfully");
            }
        }

        return redirect()->back()->withErrors('An error occurred. Please try again.');
    }

    public function deleteReferee(RefereeData $refereeData)
    {
        if($refereeData->applicant_image != 'blank-profile-picture.png') {
            Storage::disk('referee')->delete('image', $refereeData->applicant_image);
        }
        $refereeData->applicantaddressinfo->delete();
        $refereeData->applicanthealthinfo->delete();
        $refereeData->applicantincomeinfo->delete();
        $refereeData->applicantriskassessment->delete();
        $refereeData->applicantsupportneeds->delete();
        $refereeData->booking->delete();
        $refereeData->delete();

        return redirect()->back()->with('success', 'Referee Details have been deleted');
    }

    public function getPdf(RefereeData $refereeData)
    {
        $applicant_addresses = ApplicantAddressInfo::where('referee_data_id', '=', $refereeData->id)->get();
        $applicant_health = ApplicantHealthInfo::where('referee_data_id', '=', $refereeData->id)->get();
        $applicant_support = ApplicantSupportNeeds::where('referee_data_id', '=', $refereeData->id)->get();
        $applicant_income = ApplicantIncomeInfo::where('referee_data_id', '=', $refereeData->id)->get();
        $applicant_risk_assessment = ApplicantRiskAssessment::where('referee_data_id', '=', $refereeData->id)->get();
        $pdf = PDF::loadView('referee.referee-pdf', [
            'referee' => $refereeData,
            'address_info' => $applicant_addresses,
            'health_info' => $applicant_health,
            'income_info' => $applicant_income,
            'support_info' => $applicant_support,
            'risk_assessment' => $applicant_risk_assessment
        ]);
        return $pdf->download($refereeData->applicant_name.'.pdf');
    }
}
