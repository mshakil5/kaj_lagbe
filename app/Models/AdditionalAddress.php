<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdditionalAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_line',
        'second_line',
        'third_line',
        'town',
        'post_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
