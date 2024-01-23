<?php

namespace App\Livewire;

use App\Models\Medicines;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItems;
use App\Models\Suppliers;
use Livewire\Component;

class MedicineUpdate extends Component
{
    public $search;
    public $supplier_id;
    public $selectedProducts = [];
    public $grantTotal =0;
    public $discount =0;
    public $subTotal =0;
    public $gst =0;
    public $purchaseId;
    public $purchaseOrder;
    public $vendors;
    public $products = [];
    public $supply;
    public function mount($purchaseId)
    {
        // $this->vendors = Suppliers::all();
        // $this->products = Medicines::all();
        $this->purchaseId = $purchaseId;
        $this->purchaseOrder = PurchaseOrder::findOrFail($purchaseId);
        $this->grantTotal =0;
        $this->discount = $this->purchaseOrder->discount;
        $this->subTotal = $this->purchaseOrder->amount;
        $this->gst = $this->purchaseOrder->gst;
        $this->supply = $this->purchaseOrder->supplier_id;
       foreach($this->purchaseOrder->items as $key=>$item){
            $this->selectedProducts[] =[
                'id' =>$item->id,
                'medicine_id' => $item->medicine_id,
                'title' =>$item->medicine->title,
                'quantity' => $item->quantity, // default quantity
                'company' =>  $item->company,     // default cost // You can set a default quantity if needed
                'batch_no' =>  $item->batch_no,     // default cost // You can set a default quantity if needed
                'expire_date' =>  $item->expire_date,     // default cost // You can set a default quantity if needed
                'cost' =>  $item->cost,     // default cost // You can set a default quantity if needed
                'total' => (double)$item->cost*(double)$item->quantity,     // default cost // You can set a default quantity if needed
            ];
       }

    }
    public function addProduct()
    {
        $product = Medicines::find($this->search);

        // Check if the product is not already in the selectedProducts array
        if (!in_array($product, $this->selectedProducts)) {
            $this->selectedProducts[] = [

                'medicine_id' => $product['id'],
                'title' =>$product->title,
                'quantity' => 1, // default quantity
                'company' => null,     // default cost // You can set a default quantity if needed
                'batch_no' => null,     // default cost // You can set a default quantity if needed
                'expire_date' => null,     // default cost // You can set a default quantity if needed
                'cost' => 0,     // default cost // You can set a default quantity if needed
                'total' => 0,     // default cost // You can set a default quantity if needed
            ];
        }
    }
    public function updateTotals($index)
    {
        $this->selectedProducts[$index]['total'] =
        $this->selectedProducts[$index]['quantity']*$this->selectedProducts[$index]['cost'];
        $this->updateGrantTotal();
    }
    public function removeProduct($index)
    {
        unset($this->selectedProducts[$index]);
        $this->selectedProducts = array_values($this->selectedProducts);
    }

    public function submitForm()
    {
        $this->purchaseOrder->update([
            'supplier_id' =>$this->supplier_id,
            'amount' => $this->subTotal,
            'discount' => $this->discount,
            'gst' => $this->gst,
            'total' => $this->grantTotal,

        ]);
       // $purchase->items()->createMany($this->selectedProducts);
        // Clear the form fields after submission
        // $this->resetForm();
        foreach ($this->selectedProducts as $selectedProduct) {


            if (array_key_exists("id",$selectedProduct)) {
                $item = PurchaseOrderItems::find($selectedProduct['id']);
                $item->update($selectedProduct);
            } else {
                // Create new item
                $this->purchaseOrder->items()->create($selectedProduct);
            }
        }


        $this->dispatch('productAdded',4);

    }

    public function updateGrantTotal(){
        $sum=0;
        foreach($this->selectedProducts as $product){
            $sum = $sum+$product['total'];
        }

        $this->subTotal = $sum;
        $this->grantTotal = (double)$sum+(double)$this->gst-(double)$this->discount;
        // $this->dispatch('grantTotal',  $this->grantTotal);
        // $this->dispatch('medicines',  $this->selectedProducts);
    }
    public function render()
    {
        $this->vendors = Suppliers::all();
        $this->products = Medicines::all();
        return view('livewire.medicine-update');
    }
}
