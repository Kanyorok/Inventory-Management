<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'document_type', 'document_id'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
