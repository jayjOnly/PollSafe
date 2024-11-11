<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public $incrementing = false; // Disable auto-incrementing for the primary key

    protected $keyType = 'string'; // Set the key type as string

    // Automatically generate a UUID for the id attribute
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
