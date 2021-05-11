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
 * App\Models\Listing
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $map_location
 * @property int $service_charge
 * @property string $features
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property int $is_available
 * @property int $landlord_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ListingFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing newQuery()
 * @method static \Illuminate\Database\Query\Builder|Listing onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereLandlordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereMapLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereServiceCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereVerifiedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Listing withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Listing withoutTrashed()
 */
	class Listing extends \Eloquent {}
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

