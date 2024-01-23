<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
use App\Models\Unavilable;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(){
       $purchase = PurchaseOrder::paginate(5);

       return view('stocks.purchase_order.list',compact('purchase'));
    }
    public function create(){
        return view('stocks.purchase_order.create');
    }
    public function show(PurchaseOrder $purchase){

        $items = $purchase->items()->paginate(5);
        return view('stocks.purchase_order.list_items',compact('items','purchase'));
    }
    public function updateQty(Request $request,PurchaseOrderItems $purchaseId){
        $data = $request->validate([
            'quantity' =>'required',
            'reason' =>'required',
        ]);
     $record =   Unavilable::find($purchaseId->id);
     $record->update([
        'quantity' => $data['quantity'],
        'reason' => $data['reason']
     ]);
    }
    public function edit(PurchaseOrder $purchase){

        return view('stocks.purchase_order.edit',compact('purchase'));
    }
    public function destroy(PurchaseOrder $purchase){

        try {

            $purchase->delete();
            return redirect()->back()->with('success','Record has been successfully deleted.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error','An error occurred while deleting data.');
        }
    }
}
