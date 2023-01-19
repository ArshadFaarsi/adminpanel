<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function usercompany(){
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
     }
     public function  userdocument()
     {
         return $this->hasMany(UserDocument::class,'user_id');
     }
}
