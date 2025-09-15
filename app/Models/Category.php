<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // use HasFactory;
    use HasFactory;

    protected $guarded = [];
    protected $table = 'categories';

    public function foods(){
        return $this->hasMany(Foods::class, 'categories_id', 'id');
    }


}
