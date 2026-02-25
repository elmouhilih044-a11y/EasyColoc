<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Expense extends Model
{
     

   protected $fillable = ['title', 'amount', 'expense_date', 'category_id'];

  
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function colocation()
    {
        return $this->hasOneThrough(Colocation::class, Category::class, 'id', 'id', 'category_id', 'colocation_id');
    }
}
