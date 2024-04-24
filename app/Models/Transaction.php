<?php

namespace App\Models;

use App\Models\Work;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'amount', 'net_amount', 'tranid'];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

}
