<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class BankLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'client_id',
        'password',
        'otp',
        'status',
    ];

    /**
     * Hidden attributes from array and JSON serialization.
     */
    protected $hidden = [
        'password',
        'otp',
    ];

    /**
     * Encrypt password attribute before persisting
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = !empty($value) ? Crypt::encryptString($value) : null;
    }

    /**
     * Decrypt password attribute with seamless fallback for legacy records
     */
    public function getPasswordAttribute($value)
    {
        if (empty($value)) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            return $value;
        }
    }

    /**
     * Encrypt OTP attribute before persisting
     */
    public function setOtpAttribute($value)
    {
        $this->attributes['otp'] = !empty($value) ? Crypt::encryptString($value) : null;
    }

    /**
     * Decrypt OTP attribute with seamless fallback for legacy records
     */
    public function getOtpAttribute($value)
    {
        if (empty($value)) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            return $value;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
