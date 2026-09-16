<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'message',
        'action_url',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Relationship to recipient user (null indicates global broadcast)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get CSS badge class according to notification type
     */
    public function getTypeBadgeClass()
    {
        switch ($this->type) {
            case 'success':
                return 'bg-success text-white';
            case 'warning':
                return 'bg-warning text-dark';
            case 'danger':
            case 'alert':
                return 'bg-danger text-white';
            case 'info':
            default:
                return 'bg-primary text-white';
        }
    }

    /**
     * Get FontAwesome icon according to notification type
     */
    public function getTypeIcon()
    {
        switch ($this->type) {
            case 'success':
                return 'fa-circle-check text-success';
            case 'warning':
                return 'fa-triangle-exclamation text-warning';
            case 'danger':
            case 'alert':
                return 'fa-circle-exclamation text-danger';
            case 'info':
            default:
                return 'fa-bell text-primary';
        }
    }
}

