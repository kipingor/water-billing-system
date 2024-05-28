<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasBills;
use App\Traits\HasNotifications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, HasBills, HasNotifications, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'idnumber',
        'physical_address',
        'postal_address',
        'account_status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'account_status' => 'string',
    ];

    /**
     * Interact with the user's first name.
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? ucfirst($value) : null,
            set: fn (string $value) => strtolower($value)
        );
    }

    /**
     * Interact with the user's last name.
     */
    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? ucfirst($value) : null,
            set: fn (string $value) => strtolower($value)
        );
    }

    /**
     * Interact with the user's full name.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($this->first_name) . ' ' . ucfirst($this->last_name),
        );
    }

    
    /**
     * Get the meters associated with the customer.
     */
    public function meters()
    {
        return $this->hasMany(Meter::class);
    }

    /**
     * Get the notifications associated with the customer.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Automatically generate a unique 6-digit account_number attribute.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->account_number = static::generateUniqueAccountNumber();
        });
    }

    /**
     * Generate a unique 6-digit account number.
     *
     * @return string
     */
    protected static function generateUniqueAccountNumber()
    {
        $accountNumber = null;
        do {
            $accountNumber = sprintf('%06d', mt_rand(1, 999999));
        } while (static::where('account_number', $accountNumber)->exists());

        return $accountNumber;
    }
}
