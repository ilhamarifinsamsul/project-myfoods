<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    // use hasFactory
    use HasFactory;

    protected $guarded = [];
    protected $table = 'barcodes';

    public function users(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
