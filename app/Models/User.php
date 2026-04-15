<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'photo',
    'name',
    'email',
    'contact_no',
    'profession',
    'education',
    'dob',
    'time_of_dob',
    'gender',
    'address',
    'city',
    'father_name',
    'father_occupation',
    'mother_name',
    'mother_occupation',
    'siblings',
    'maternal_relatives',
    'marital_status',
    'height',
    'weight',
    'about',
    'password',
])]
#[Hidden(['password', 'remember_token'])]
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $contact_no
 * @property string|null $photo
 * @property string|null $profession
 * @property string|null $education
 * @property \Illuminate\Support\Carbon|null $dob
 * @property string|null $time_of_dob
 * @property string|null $gender
 * @property string|null $address
 * @property string|null $city
 * @property string|null $father_name
 * @property string|null $father_occupation
 * @property string|null $mother_name
 * @property string|null $mother_occupation
 * @property string|null $siblings
 * @property string|null $maternal_relatives
 * @property string|null $marital_status
 * @property float|null $height
 * @property float|null $weight
 * @property string|null $about
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'dob' => 'date',
            'password' => 'hashed',
            'height' => 'decimal:2',
            'weight' => 'decimal:2',
        ];
    }

    public function wishlistProfiles(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'wishlists', 'user_id', 'profile_id')->withTimestamps();
    }

    public function wishedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'wishlists', 'profile_id', 'user_id')->withTimestamps();
    }
}
