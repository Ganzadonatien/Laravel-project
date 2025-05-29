<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'device_id',
        'permissions',
        'last_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'permissions' => 'array',
            'last_login' => 'datetime',
        ];
    }

    /**
     * Get the device associated with the user.
     * Updated to use belongsTo relationship since user has device_id
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Check if user has a specific permission
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        if (!isset($this->permissions) || !is_array($this->permissions)) {
            return false;
        }

        return isset($this->permissions[$permission]) && $this->permissions[$permission];
    }

    /**
     * Check if user has admin role
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }



    /**
     * Check if user has user role
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->role === 'User';
    }




    /**
     * Get all permissions for the user's role
     *
     * @return array
     */
    public function getRolePermissions()
    {
        switch ($this->role) {
            case 'Admin':
                return [
                    'can_create_users' => true,
                    'can_delete_users' => true,
                    'can_manage_devices' => true,
                    'can_view_reports' => true,
                    'can_modify_settings' => true,
                    'can_access_logs' => true,
                ];

            case 'User':
                return [
                    'can_create_users' => false,
                    'can_delete_users' => false,
                    'can_manage_devices' => false,
                    'can_view_reports' => false,
                    'can_modify_settings' => false,
                    'can_access_logs' => false,
                ];

            default:
                return [
                    'can_create_users' => false,
                    'can_delete_users' => false,
                    'can_manage_devices' => false,
                    'can_view_reports' => false,
                    'can_modify_settings' => false,
                    'can_access_logs' => false,
                ];
        }
    }

    /**
     * Check if user can perform a specific action
     * Renamed from 'can' to 'canPerform' to avoid conflict with Laravel's built-in can() method
     *
     * @param string $action
     * @return bool
     */
    public function canPerform($action)
    {
        // Check custom permissions first
        if ($this->hasPermission($action)) {
            return true;
        }

        // Fall back to role-based permissions
        $rolePermissions = $this->getRolePermissions();
        return isset($rolePermissions[$action]) && $rolePermissions[$action];
    }

    /**
     * Update user's last login timestamp
     *
     * @return void
     */
    public function updateLastLogin()
    {
        $this->update(['last_login' => now()]);
    }

    /**
     * Get formatted role name
     *
     * @return string
     */
    public function getFormattedRoleAttribute()
    {
        return ucfirst($this->role);
    }

    /**
     * Get role badge class for UI
     *
     * @return string
     */
    public function getRoleBadgeClassAttribute()
    {
        return match(strtolower($this->role)) {
            'Admin' => 'bg-red-100 text-red-800',

            'User' => 'bg-green-100 text-green-800',

            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get role description
     *
     * @return string
     */
    public function getRoleDescriptionAttribute()
    {
        return match(strtolower($this->role)) {
            'Admin' => 'Full system access and user management',
            'User' => 'Standard user access',

            default => 'Custom role'
        };
    }

    /**
     * Scope to filter users by role
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope to get users with devices
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithDevice($query)
    {
        return $query->whereNotNull('device_id');
    }

    /**
     * Scope to get users without devices
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutDevice($query)
    {
        return $query->whereNull('device_id');
    }

    public function assignedDevice()
{
    return $this->belongsTo(Device::class, 'assigned_device', 'id');
}
}
