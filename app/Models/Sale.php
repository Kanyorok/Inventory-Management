<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'user_id'
    ];
    public function client() {
        return $this->belongsTo(Client::class);
    }
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
    public function products() {
        return $this->hasMany(SoldProduct::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
