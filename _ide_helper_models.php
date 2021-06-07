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
 * @property int $user_metadata_id
 * @property string $address
 * @property string $moved_in
 * @property string $moved_out
 * @property string $tenure
 * @property string $landlord_details
 * @property string $reason_for_leaving
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserMetadata $usermetadata
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
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereTenure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantAddressInfo whereUserMetadataId($value)
 */
	class ApplicantAddressInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApplicantHealthInfo
 *
 * @property int $id
 * @property int $user_metadata_id
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
 * @property-read \App\Models\UserMetadata $usermetadata
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
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantHealthInfo whereUserMetadataId($value)
 */
	class ApplicantHealthInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApplicantIncomeInfo
 *
 * @property int $id
 * @property int $user_metadata_id
 * @property string $source_of_income
 * @property string|null $dwp_office
 * @property string|null $other_debt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserMetadata $usermetadata
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereDwpOffice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereOtherDebt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereSourceOfIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantIncomeInfo whereUserMetadataId($value)
 */
	class ApplicantIncomeInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApplicantRiskAssessment
 *
 * @property int $id
 * @property int $user_metadata_id
 * @property string $risk
 * @property string $risk_level
 * @property string $risk_details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserMetadata $usermetadata
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereRisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereRiskDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereRiskLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantRiskAssessment whereUserMetadataId($value)
 */
	class ApplicantRiskAssessment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApplicantSupportNeeds
 *
 * @property int $id
 * @property int $user_metadata_id
 * @property string $support_group
 * @property string $support_needs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserMetadata $usermetadata
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereSupportGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereSupportNeeds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicantSupportNeeds whereUserMetadataId($value)
 */
	class ApplicantSupportNeeds extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClientGroup
 *
 * @property-read \Illuminate\Support\Collection $client_group_list
 * @property-read \App\Models\Listing $listing
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup query()
 */
	class ClientGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Consent
 *
 * @property int $id
 * @property int $user_metadata_id
 * @property string $consent_name
 * @property string $consent_date
 * @property string $consent_company_position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\UserMetadata $usermetadata
 * @method static \Illuminate\Database\Eloquent\Builder|Consent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Consent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Consent query()
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereConsentCompanyPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereConsentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereConsentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Consent whereUserMetadataId($value)
 */
	class Consent extends \Eloquent {}
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
 * @property \Illuminate\Support\Collection $features
 * @property int $user_id
 * @property bool $is_available
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property string $contact_name
 * @property string $contact_email
 * @property string|null $contact_number
 * @property \Illuminate\Support\Collection $images
 * @property array $supported_groups
 * @property string $support_description
 * @property int $support_hours
 * @property array $proofs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read bool $is_verified
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
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereSupportDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereSupportHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereSupportedGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereToilets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereVerifiedAt($value)
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
 * App\Models\ListingImage
 *
 * @property-read \App\Models\Listing $listing
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage query()
 */
	class ListingImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingInquiry
 *
 * @property int $id
 * @property int $listing_id
 * @property string $user_name
 * @property string $user_email
 * @property int $user_phone_number
 * @property string $message
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
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereMessage($value)
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
 * @property-read string $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\UserMetadata|null $usermetadata
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

namespace App\Models{
/**
 * App\Models\UserMetadata
 *
 * @property int $id
 * @property int $user_id
 * @property string $referral_type
 * @property string $referrer_name
 * @property int $referrer_phone_number
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
 * @property int $applicant_kin_phone_number
 * @property string $applicant_kin_email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantCurrentAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantEthnicity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantKinEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantKinName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantKinPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantKinRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantNiNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereApplicantSexualOrientation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereReferralReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereReferralType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereReferrerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereReferrerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereReferrerPhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserMetadata whereUserId($value)
 */
	class UserMetadata extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VolunteerMetadata
 *
 * @property int $id
 * @property int $volunteer_id
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property string $paypal_email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\VolunteerMetadataFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|VolunteerMetadata newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VolunteerMetadata newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VolunteerMetadata query()
 * @method static \Illuminate\Database\Eloquent\Builder|VolunteerMetadata whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VolunteerMetadata whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VolunteerMetadata whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VolunteerMetadata wherePaypalEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VolunteerMetadata whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VolunteerMetadata whereVolunteerId($value)
 */
	class VolunteerMetadata extends \Eloquent {}
}

