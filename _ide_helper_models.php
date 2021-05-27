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
 * App\Models\ClientGroup
 *
 * @property int $id
 * @property int $listing_id
 * @property string $client_group
 * @property string|null $other_types
 * @property string $support_description
 * @property int $support_hours
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Listing $listing
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup whereClientGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup whereOtherTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup whereSupportDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup whereSupportHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClientGroup whereUpdatedAt($value)
 */
	class ClientGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Listing
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $postcode
 * @property string $local_authority_area
 * @property string $description
 * @property int $living_rooms
 * @property int $bedsitting_rooms
 * @property int $bedrooms
 * @property int $bathrooms
 * @property int $toilets
 * @property int $kitchen
 * @property string|null $other_rooms
 * @property string|null $features
 * @property int $user_id
 * @property int $is_available
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property string $contact_name
 * @property string $contact_email
 * @property int|null $contact_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\ClientGroup|null $clientgroup
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ListingImage[] $listingimage
 * @property-read int|null $listingimage_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ListingFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing newQuery()
 * @method static \Illuminate\Database\Query\Builder|Listing onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereBathrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereBedsittingRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereKitchen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereLivingRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereLocalAuthorityArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereOtherRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing wherePostcode($value)
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
 * App\Models\ListingDocuments
 *
 * @property int $id
 * @property int $listing_id
 * @property string $gas_certificate
 * @property string $gas_certificate_expiry_date
 * @property string $electrical_certificate
 * @property string $electrical_certificate_expiry_date
 * @property string $detectors_certificate
 * @property string $detectors_certificate_expiry_date
 * @property string $emergency_lighting_certificate
 * @property string $emergency_lighting_certificate_expiry_date
 * @property string $fire_risk_certificate
 * @property string $fire_risk_certificate_expiry_date
 * @property string $pat_certificate
 * @property string $pat_certificate_expiry_date
 * @property string $insurance_certificate
 * @property string $insurance_certificate_expiry_date
 * @property string $ownership_certificate
 * @property string $ownership_certificate_expiry_date
 * @property string|null $proofs
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Listing $listing
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereDetectorsCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereDetectorsCertificateExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereElectricalCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereElectricalCertificateExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereEmergencyLightingCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereEmergencyLightingCertificateExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereFireRiskCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereFireRiskCertificateExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereGasCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereGasCertificateExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereInsuranceCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereInsuranceCertificateExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereOwnershipCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereOwnershipCertificateExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments wherePatCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments wherePatCertificateExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereProofs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingDocuments whereUpdatedAt($value)
 */
	class ListingDocuments extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingImage
 *
 * @property int $id
 * @property int $listing_id
 * @property string $image_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Listing $listing
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage whereImageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImage whereUpdatedAt($value)
 */
	class ListingImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingInquiry
 *
 * @property int $id
 * @property int $listing_id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ListingInquiryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingInquiry whereUpdatedAt($value)
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

