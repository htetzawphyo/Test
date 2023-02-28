<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Features;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permissions extends Model
{
    use HasFactory;

    public function feature() {
        return $this->belongsTo(Features::class, 'feature_id', 'id');
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permissions_id', 'role_id');
    }

    // public static function boot() {
    //     parent::boot();

    //     static::deleting(function($permissions) { // before delete() method call this
    //          $permissions->roles()->detach();
    //     });
    // }
}
