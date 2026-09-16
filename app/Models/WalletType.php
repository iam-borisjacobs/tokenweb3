<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletType extends Model
{
    use HasFactory;

    protected $table = 'wallet_types';

    protected $guarded = [];

    protected $appends = ['icon_url'];

    /**
     * Resolve the public URL for the wallet icon.
     */
    public function getIconUrlAttribute()
    {
        if (empty($this->icon)) {
            return asset('assets/wallet-types/icons/generic.png');
        }

        if (str_starts_with($this->icon, 'http://') || str_starts_with($this->icon, 'https://')) {
            return $this->icon;
        }

        return asset('assets/wallet-types/icons/' . $this->icon);
    }
}
