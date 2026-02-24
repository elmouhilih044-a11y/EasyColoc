<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Expense extends Model
{
     

    protected $fillable = [
        'title',
        'amount',
        'expense_date',
        'colocation_id',
        'category_id',
        'user_id',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
