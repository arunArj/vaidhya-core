<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id','amount', 'discount','gst','total'];
    public function items()
    {
        return $this->hasMany(PurchaseOrderItems::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Suppliers::class);
    }
}
