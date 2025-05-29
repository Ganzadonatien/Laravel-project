<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'status',
        'serial_number',
        'location',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the device.
     */
    public function user()
    {
        return $this->hasOne(User::class, 'device_id');
    }

    /**
     * Scope to get available devices
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope to get assigned devices
     */
    public function scopeAssigned($query)
    {
        return $query->where('status', 'assigned');
    }

    /**
     * Check if device is available
     */
    public function isAvailable()
    {
        return $this->status === 'available';
    }

    /**
     * Check if device is assigned
     */
    public function isAssigned()
    {
        return $this->status === 'assigned';
    }

    public function assignedUser()
{
    return $this->hasOne(User::class, 'assigned_device', 'id');
}
}
