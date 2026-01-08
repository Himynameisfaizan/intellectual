<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_url', 'approved_projects', 'pdf', 
        'password', 'user_id', 'is_delete'
    ];
}
