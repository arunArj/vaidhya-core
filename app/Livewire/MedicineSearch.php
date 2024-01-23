<?php

namespace App\Livewire;

use App\Models\Medicines;
use App\Models\PurchaseOrder;
use App\Models\Suppliers;
use Livewire\Component;

class MedicineSearch extends Component
{
    public $search;
    public $supplier_id;
    public $selectedProducts = [];
    public $grantTotal =0;
    public $discount =0;
    public $subTotal =0;
    public $gst =0;
    public $vendors;
    public $preID;
    public $products = [];

    public function render()
    {

        $latest = PurchaseOrder::latest()->first();

        $this->preID = $latest?$latest->id:'1';
        $this->vendors = Suppliers::all();
        $this->products = Medicines::all();

        return view('livewire.medicine-search');
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
        $this->selectedProducts[$index]['total'] =  $this->selectedProducts[$index]['quantity']*$this->selectedProducts[$index]['cost'];
        $this->updateGrantTotal();
    }
    public function removeProduct($index)
    {
        unset($this->selectedProducts[$index]);
        $this->selectedProducts = array_values($this->selectedProducts);
    }

    public function submitForm()
    {
        // Save the product to the database
       $purchase = PurchaseOrder::create([
            'supplier_id' =>$this->supplier_id,
            'amount' => $this->subTotal,
            'discount' => $this->discount,
            'gst' => $this->gst,
            'total' => $this->grantTotal,

        ]);
        $purchase->items()->createMany($this->selectedProducts);
        // Clear the form fields after submission
        // $this->resetForm();


        $this->dispatch('productAdded',4);
        $this->reset();
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
}
