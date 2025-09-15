<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $guarded = [];

    public function barcodes(){
        return $this->belongsTo(Barcode::class, 'barcodes_id', 'id');
    }

    public function items(){
        return $this->hasMany(TransactionItems::class, 'transactions_id', 'id');
    }
}
