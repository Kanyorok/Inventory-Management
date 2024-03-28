<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'reference', 'amount', 'payment_method_id', 'type', 'client_id', 'user_id', 'sale_id', 'provider_id', 'transfer_id'
    ];

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

    public function scopeFindByPaymentMethodId($query, $id)
    {
        return $query->where('payment_method_id', $id);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month);
    }
}
