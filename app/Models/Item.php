<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable= ['name','sales_price','purchase_price', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function invoices(){
        return $this->belongsToMany(Invoice::class, 'invoices_items')->withPivot('quantity');;
    }

}
