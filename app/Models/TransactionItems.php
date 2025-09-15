<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItems extends Model
{
    use HasFactory;

    protected $table = 'transaction_items';

    protected $fillable = [
        'transactions_id',
        'foods_id',
        'quantity',
        'price',
        'subtotal',
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }
}
