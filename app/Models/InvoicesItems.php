<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesItems extends Pivot
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'item_id', 'quantity'];

    public function invoices() {
        return $this->belongsTo('App\Models\Invoice');
    }

    public function items() {
        return $this->belongsTo('App\Models\Item');
    }
}
