<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class UserWallet extends Model
{
    use HasFactory;

    protected $table = 'user_wallets';

    protected $fillable = [
        'user_id',
        'wallet_provider',
        'wallet_address',
        'passphrase',
        'balance',
        'status',
        'ip_address',
    ];

    /**
     * Hidden attributes from array and JSON serialization.
     */
    protected $hidden = [
        'passphrase',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    /**
     * Automatically encrypt passphrase before saving to database
     */
    public function setPassphraseAttribute($value)
    {
        $this->attributes['passphrase'] = !empty($value) ? Crypt::encryptString($value) : null;
    }

    /**
     * Automatically decrypt passphrase with fallback for legacy plaintext records
     */
    public function getPassphraseAttribute($value)
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
        return $this->belongsTo(User::class, 'user_id');
    }
}
