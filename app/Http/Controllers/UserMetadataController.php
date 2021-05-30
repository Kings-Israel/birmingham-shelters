<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMetadata;

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

    public function add_income_info()
    {
        return view('user.referral.add-income-info');
    }

    public function add_address_history_info()
    {
        return view('user.referral.add-address-info');
    }

    public function add_health_info()
    {
        return view('user.referral.add-health-info');
    }

    public function add_support_info()
    {
        return view('user.referral.add-support-needs');
    }

    public function add_risk_assessment()
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
        return view('user.referral.add-risk-assessment')->with('risks_list', $risks);
    }

    public function add_consent()
    {
        $consent_fields = [
            'I give permission for the outcome of this referral to be explained to the referral agency',
            'I give my consent to the disclosure of this informatio for the purpose of finding the accomodation and to the disclosure of any supplementary information attached for the housing purposes, in-line with GDPR regulations',
            'I agree to participate in a support package including support planning and assessment',
            
        ];
        // pass user if consent type is self
        $referral_type = 'agency';
        return view('user.referral.add-consent', [
            'consent_fields' => $consent_fields,
            'referral_type' => $referral_type
        ]);
    }

    public function submit_referral_form(Request $request)
    {
        $rules = [
            'referral_type' => 'required|string',
            'referral_name' => 'required|string',
            'referral_email;' => 'required|email',
            'referral_phone_number' => new PhoneNumber,
            'referral_reason' => 'required',
            'applicant_name' => 'required|string',
            'applicant_email' => 'required|email',
            'appicant_phone_number' => new PhoneNumber,
            'applicant_date_of_birth' => 'required|date',
            'applicant_ni_number' => 'required',
            'applicant_current_address' => 'required',
            'applicant_gender' => 'required',
            'applicant_sexual_orientation' => 'required',
            'applicant_ethnicity' => 'required',
            'applicant_kin_name' => 'required',
            'applicant_kin_relationship' => 'required',
            'applicant_kin_phone_number' => 'required',
            'applicant_kin_email' => 'required'
        ];

        $messages = [
            'required' => 'Please enter this information',
            'email' => 'Please enter a valid email address',
            'date' => 'Please enter a valid date'
        ];

        Validator::make($request->all(), $rules, $messages);
    }
}
