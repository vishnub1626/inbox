<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $guarded = [];

    public static function logUserActivity($description)
    {
        return static::create([
            'level' => 'user',
            'description' => $description
        ]);
    }

    public static function logSystemActivity($description)
    {
        return static::create([
            'level' => 'system',
            'description' => $description
        ]);
    }
}
