<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ApplicantAddressInfo
 *
 * @property int $id
 * @property int $referee_data_id
 * @property string $address
 * @property string $moved_in
 * @property string $moved_out
 * @property string $tenure
 * @property string $landlord_details
 * @property string $reason_for_leaving
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RefereeData $refereedata
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereLandlordDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereMovedIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereMovedOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereReasonForLeaving($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereRefereeDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereTenure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereUpdatedAt($value)
 */
	class ApplicantAddressInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApplicantHealthInfo
 *
 * @property int $id
 * @property int $referee_data_id
 * @property string|null $professional_officer
 * @property string|null $gp_name
 * @property string|null $gp_address
 * @property string $detained_for_mental_health
 * @property string $mental_health
 * @property string $physical_health
 * @property string $present_medication
 * @property string|null $current_cpa
 * @property string|null $other_relevant_information
 * @property string $has_criminal_offence
 * @property string|null $criminal_offence_details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RefereeData $refereedata
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereCriminalOffenceDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereCurrentCpa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereDetainedForMentalHealth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereGpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereGpName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereHasCriminalOffence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereMentalHealth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereOtherRelevantInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo wherePhysicalHealth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo wherePresentMedication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereProfessionalOfficer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereRefereeDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereUpdatedAt($value)
 */
	class ApplicantHealthInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApplicantIncomeInfo
 *
 * @property int $id
 * @property int $referee_data_id
 * @property string $source_of_income
 * @property string|null $dwp_office
 * @property string|null $other_debt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $source_of_income_list
 * @property-read \App\Models\RefereeData $refereedata
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereDwpOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereOtherDebt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereRefereeDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereSourceOfIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereUpdatedAt($value)
 */
	class ApplicantIncomeInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApplicantRiskAssessment
 *
 * @property int $id
 * @property int $referee_data_id
 * @property string $risk
 * @property string $risk_level
 * @property string $risk_details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RefereeData $refereedata
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereRefereeDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereRisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereRiskDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereRiskLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereUpdatedAt($value)
 */
	class ApplicantRiskAssessment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApplicantSupportNeeds
 *
 * @property int $id
 * @property int $referee_data_id
 * @property string $support_group
 * @property string $support_needs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RefereeData $refereedata
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereRefereeDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereSupportGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereSupportNeeds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereUpdatedAt($value)
 */
	class ApplicantSupportNeeds extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Booking
 *
 * @property int $id
 * @property int $listing_id
 * @property int $user_id
 * @property int $referee_data_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Listing $listing
 * @property-read \App\Models\RefereeData $refereedata
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereRefereeDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUserId($value)
 */
	class Booking extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Consent
 *
 * @property int $id
 * @property int $referee_data_id
 * @property string $consent_name
 * @property string $consent_date
 * @property string $consent_company_position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RefereeData $refereedata
 * @method static \Illuminate\Database\Eloquent\Builder|Consent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Consent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Consent query()
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereConsentCompanyPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereConsentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereConsentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereRefereeDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereUpdatedAt($value)
 */
	class Consent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property \App\Enums\InvoiceTypeEnum $invoice_type
 * @property string|null $description
 * @property int $total
 * @property int $user_id
 * @property int $invoiceable_id
 * @property string $invoiceable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $invoiceable
 * @property-read \App\Models\Payment|null $payment
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\InvoiceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Query\Builder|Invoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Invoice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Invoice withoutTrashed()
 */
	class Invoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Listing
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $postcode
 * @property string $description
 * @property int $living_rooms
 * @property int $bedrooms
 * @property int $bathrooms
 * @property int $toilets
 * @property int $kitchen
 * @property \Illuminate\Support\Collection|null $other_rooms
 * @property \Illuminate\Support\Collection|null $features
 * @property int $user_id
 * @property bool $is_available
 * @property string $contact_name
 * @property string $contact_email
 * @property string|null $contact_number
 * @property \Illuminate\Database\Eloquent\Casts\AsCollection|null $images
 * @property array|null $supported_groups
 * @property string|null $support_description
 * @property int|null $support_hours
 * @property \App\Enums\ListingProofsEnum|null $proofs
 * @property \App\Enums\ListingStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ListingDocument[] $documents
 * @property-read int|null $documents_count
 * @property-read bool $is_verified
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ListingFeedback[] $listingFeedback
 * @property-read int|null $listing_feedback_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ListingInquiry[] $listinginquiry
 * @property-read int|null $listinginquiry_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ListingFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing newQuery()
 * @method static \Illuminate\Database\Query\Builder|Listing onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereBathrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereKitchen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereLivingRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereOtherRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereProofs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereSupportDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereSupportHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereSupportedGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereToilets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Listing withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Listing withoutTrashed()
 */
	class Listing extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingDocument
 *
 * @property int $id
 * @property int $listing_id
 * @property \App\Enums\ListingDocumentTypesEnum $document_type
 * @property string $filename
 * @property \Illuminate\Support\Carbon $expiry_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Listing $listing
 * @method static \Database\Factories\ListingDocumentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocument whereUpdatedAt($value)
 */
	class ListingDocument extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingFeedback
 *
 * @property int $id
 * @property int $listing_id
 * @property int $admin_id
 * @property string $message
 * @property bool $is_resolved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $admin
 * @property-read \App\Models\Listing $listing
 * @method static \Database\Factories\ListingFeedbackFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback whereIsResolved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingFeedback whereUpdatedAt($value)
 */
	class ListingFeedback extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingInquiry
 *
 * @property int $id
 * @property int $listing_id
 * @property string $user_name
 * @property string $user_email
 * @property string $user_phone_number
 * @property string $listing_message
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ListingInquiryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereListingMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereUserPhoneNumber($value)
 */
	class ListingInquiry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $amount
 * @property string $method
 * @property string $transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Invoice $invoice
 * @method static \Database\Factories\PaymentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Payment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Payment withoutTrashed()
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RefereeData
 *
 * @property int $id
 * @property int $user_id
 * @property string $referral_type
 * @property string $referrer_name
 * @property string $referrer_phone_number
 * @property string $referrer_email
 * @property string $referral_reason
 * @property string $applicant_name
 * @property string $applicant_email
 * @property string $applicant_phone_number
 * @property string $applicant_date_of_birth
 * @property int $applicant_ni_number
 * @property string $applicant_current_address
 * @property string $applicant_gender
 * @property string $applicant_sexual_orientation
 * @property string $applicant_ethnicity
 * @property string $applicant_kin_name
 * @property string $applicant_kin_relationship
 * @property string $applicant_kin_phone_number
 * @property string $applicant_kin_email
 * @property string|null $applicant_image
 * @property \App\Models\Consent|null $consent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ApplicantAddressInfo|null $applicantaddressinfo
 * @property-read \App\Models\ApplicantHealthInfo|null $applicanthealthinfo
 * @property-read \App\Models\ApplicantIncomeInfo|null $applicantincomeinfo
 * @property-read \App\Models\ApplicantRiskAssessment|null $applicantriskassessment
 * @property-read \App\Models\ApplicantSupportNeeds|null $applicantsupportneeds
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Booking[] $booking
 * @property-read int|null $booking_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData query()
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantCurrentAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantEthnicity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantKinEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantKinName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantKinPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantKinRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantNiNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereApplicantSexualOrientation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereConsent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereReferralReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereReferralType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereReferrerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereReferrerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereReferrerPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RefereeData whereUserId($value)
 */
	class RefereeData extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone_number
 * @property \App\Enums\UserTypeEnum $user_type
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $phone_number_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Booking[] $bookings
 * @property-read int|null $bookings_count
 * @property-read string $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Listing[] $listings
 * @property-read int|null $listings_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RefereeData[] $refereedata
 * @property-read int|null $refereedata_count
 * @method static \Illuminate\Database\Eloquent\Builder|User admins()
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumberVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

