<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    public function items(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function sales(){
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
