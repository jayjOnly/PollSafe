<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidateTable extends Model
{
    use HasFactory;

    protected $table = 'candidatetable'; 

    protected $fillable = [
        'organization_uuid',
        'name',
        'age',
        'description',
        'image_path',
        'email', 
        'user_id'
    ];
}