<?php namespace AbuseIO\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PermissionRole
 * @package AbuseIO\Models
 * @property integer $id
 * @property integer $role_id
 * @property integer $permission_id
 */
class PermissionRole extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permission_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    /*
     * Validation rules for this model being created
     *
     * @param  Model $permissionRole
     * @return Array $rules
     */
    public function createRules($permissionRole)
    {
        $rules = [
            'role_id'               => 'required|integer|' .
                'unique:permission_role,role_id,NULL,id,permission_id,' . $permissionRole->permission_id,
            'permission_id'         => 'required|integer|' .
                'unique:permission_role,permission_id,NULL,id,role_id,' . $permissionRole->role_id,
        ];

        return $rules;
    }

    /*
     * Validation rules for this model being updated
     *
     * @param  Model $permissionRole
     * @return Array $rules
     */
    public function updateRules($permissionRole)
    {
        $rules = [
            'id'                    => 'required|exists:permissions_role,id',
            'role_id'               => 'required|integer|' .
                'unique:permission_role,role_id,NULL,id,permission_id,' . $permissionRole->permission_id,
            'permission_id'         => 'required|integer|' .
                'unique:permission_role,permission_id,NULL,id,role_id,' . $permissionRole->role_id,
        ];

        return $rules;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
     * One-To-Many relation to account
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('AbuseIO\Models\Role');
    }

    /**
     * One-To-Many relation to account
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo('AbuseIO\Models\Permission');
    }
}
