<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use Hasfactory;
    protected $fillable = ["content", "user_id"];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }


}


