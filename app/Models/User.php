<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'first_name', 'maiden_name', 'last_name', 'email', 'image', 'password', 'designation', 'is_active'];

    public function usercompany()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }
    public function userdocument()
    {
        return $this->hasMany(UserDocument::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


}
