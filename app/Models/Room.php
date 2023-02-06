<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function roomTransactions(){
        return $this->hasMany(RoomTransaction::class, 'room_id');
    }
}
