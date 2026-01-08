<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;
    protected $table = 'user_data'; 
    protected $fillable = ['user_id', 'user_name', 'phone_no'];
}
