<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_no', 'invoice_date', 'due_date','sub_total','discount','total','customer_id'];

    public function item(){
        return $this->belongsToMany(Item::class,'invoices_items');
    }
}
