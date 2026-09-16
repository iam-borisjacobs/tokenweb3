<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Mt4Details extends Model
{
    use HasFactory;

    protected $hidden = [
        'mt4_password',
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
        'reminded_at' => 'datetime:Y-m-d',
    ];

    /**
     * Automatically encrypt MT4 password before persisting
     */
    public function setMt4PasswordAttribute($value)
    {
        $this->attributes['mt4_password'] = !empty($value) ? Crypt::encryptString($value) : null;
    }

    /**
     * Automatically decrypt MT4 password with fallback for legacy plaintext records
     */
    public function getMt4PasswordAttribute($value)
    {
        if (empty($value)) return null;
        try {
            return Crypt::decryptString($value);
        } catch (\Throwable $e) {
            return $value;
        }
    }

    public function tuser()
    {
        return $this->belongsTo('App\Models\User', 'client_id');
    }
}