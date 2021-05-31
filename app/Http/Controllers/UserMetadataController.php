<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMetadata;
use App\Models\ApplicantIncomeInfo;
use App\Models\ApplicantAddressInfo;
use App\Models\ApplicantHealthInfo;
use App\Models\ApplicantSupportNeeds;
use App\Models\ApplicantRiskAssessment;
use App\Models\Consent;
use Illuminate\Support\Facades\Validator;
use App\Rules\PhoneNumber;

class UserMetadataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show_select_referral_type_form()
    {
        return view('user.referral.index');
    }

    public function self_referral()
    {
        return view('user.referral.self-referral');
    }

    public function agency_referral()
    {
        return view('user.referral.agency-referral');
    }

    public function add_income_info($id)
    {
        $income_fields = [
            'JSA', 'DLA', 'Incapacity Benefit/ESA', 'Income Support', 'Pension', 'UC', 'Working', 'None'
        ];
        return view('user.referral.add-income-info')->with(['id' => $id, 'income_fields' => $income_fields]);
    }

    public function add_address_history_info($id)
    {
        return view('user.referral.add-address-info')->with('id', $id);
    }

    public function add_health_info($id)
    {
        return view('user.referral.add-health-info')->with('id', $id);
    }

    public function add_support_info($id)
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
        return view('user.referral.add-support-needs')->with(['id' => $id, 'support_group_list' => $support_group_list]);
    }

    public function add_risk_assessment($id)
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
        return view('user.referral.add-risk-assessment')->with(['risks_list' => $risks, 'id' => $id]);
    }

    public function add_consent(UserMetadata $userMetadata)
    {
        return view('user.referral.add-consent', [
            'id' => $userMetadata->id,
            'referral_type' => $userMetadata->referral_type,
        ]);
    }

    public function submit_referral_form(Request $request)
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
            'applicant_kin_email' => 'nullable|email'
        ];

        $messages = [
            'required' => 'Please enter this information',
            'email' => 'Please enter a valid email address',
            'date' => 'Please enter a valid date'
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        if ($userMetadata = UserMetadata::create($request->all())) {
            return redirect()->route('referral.add.income-info', $userMetadata->id);
        }

        return redirect()->back()->withError('There was a problem. Please try again');
    }

    public function submit_income_info(Request $request)
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
        $incomeInfo->user_metadata_id = $request->user_metadata_id;
        $incomeInfo->source_of_income = implode(',', $request->source_of_income);
        $incomeInfo->dwp_office = $request->dwp_office;
        $incomeInfo->other_debt = $request->other_debt;
        if($incomeInfo->save()) {
            return redirect()->route('referral.add.address-history-info', $request->user_metadata_id);
        }

        return redirect()->back()->withError('A problem occurred while saving the data. Please try again');
    }

    public function submit_address_history_info(Request $request)
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
                    'user_metadata_id' => $request->user_metadata_id,
                    'address' => $request->address[$i],
                    'moved_in' => $request->moved_in_date[$i],
                    'moved_out' => $request->moved_out_date[$i],
                    'tenure' => $request->tenure[$i],
                    'landlord_details' => $request->landlord_details[$i],
                    'reason_for_leaving' => $request->reason_for_leaving[$i]
                ]);
            }
        }

        return redirect()->route('referral.add.health-info', $request->user_metadata_id);

    }

    private function _validateTextIfRadioIsSelected(Request $request)
    {
        if($request->has_criminal_offence === 'Yes') {
            return true;
        }

        return false;
    }

    public function submit_health_info(Request $request)
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
            return redirect()->route('referral.add.support-info', $request->user_metadata_id);
        }

        return redirect()->back()->withErrors('An Error Occured. Please try again');
    }

    public function submit_support_info(Request $request)
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
            $applicantSupport->user_metadata_id = $request->user_metadata_id;
            $applicantSupport->support_group = $group;
            $applicantSupport->support_needs = $request->support_needs[$group];
            $applicantSupport->save();
        }

        return redirect()->route('referral.add.risk-assessment', $request->user_metadata_id);
    }

    public function submit_risk_assessment(Request $request)
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
                    $riskAssessment->user_metadata_id = $request->user_metadata_id;
                    $riskAssessment->risk = $risk;
                    $riskAssessment->risk_level = $risk_level;
                    $riskAssessment->risk_details = $description;
                    $riskAssessment->save();
                }
            }
        }

        return redirect()->route('referral.add.consent', $request->user_metadata_id);
    }

    public function submit_consent_form(Request $request)
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
            return redirect()->route()->with('success', "Your information has been saved successfully");
        }

        return redirect()->back()->withErrors('An error occurred. Please tru y again.');
    }
}
