<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItems extends Model
{
    use HasFactory;
    protected $fillable = ['medicine_id','purchase_order_id','quantity','company','cost','batch_no','expire_date'];
    public function medicine()
    {
        return $this->belongsTo(Medicines::class);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

}
