<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   
protected $fillable = ['amount','payed_date','payer_id','receiver_id','expense_id'];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function expense()
{
    return $this->belongsTo(Expense::class);
}
}
