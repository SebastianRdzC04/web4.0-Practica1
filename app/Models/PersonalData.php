<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
