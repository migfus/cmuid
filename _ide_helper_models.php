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
 * App\Models\RegisterStatus
 *
 * @property int $id
 * @property string $user_register_id
 * @property int|null $user_id
 * @property int $category_id
 * @property string|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StatusCategory|null $category
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\UserRegister|null $user_register
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterStatus whereUserRegisterId($value)
 */
	class RegisterStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StatusCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusCategory whereUpdatedAt($value)
 */
	class StatusCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $password
 * @property string|null $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserRegister
 *
 * @property string $id
 * @property string $picture
 * @property string $last_name
 * @property string $first_name
 * @property string|null $mid_name
 * @property string|null $ext_name
 * @property string $position
 * @property string|null $department
 * @property string|null $unit
 * @property string|null $email
 * @property string $mobile
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RegisterStatus> $status
 * @property-read int|null $status_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereExtName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereMidName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRegister whereUpdatedAt($value)
 */
	class UserRegister extends \Eloquent {}
}

