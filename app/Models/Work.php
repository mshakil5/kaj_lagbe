<?php

namespace App\Models;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'orderid',
        'date',
        'name',
        'email',
        'phone',
        'address_first_line',
        'address_second_line',
        'address_third_line',
        'town',
        'post_code',
        'assigned_to',
        'status',
        'is_new',
        'updated_by',
        'created_by',
    ];

    public function workimage()
    {
        return $this->hasMany(WorkImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function workTimes()
    {
        return $this->hasMany(WorkTime::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
