<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index(){
        $suppliers = Suppliers::paginate(10);
        return view('stocks.suppliers.supplier_list',compact('suppliers'));
    }
    public function create(){
        return view('stocks.suppliers.supplier_create');
    }
    public function edit(Suppliers $supplier){
        return view('stocks.suppliers.supplier_edit',compact('supplier'));
    }
    public function store(Request $request)  {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pin' => 'required|string|max:10',
            'district' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers|max:255',
            'phone' => 'required|string|max:15',
        ]);
        Suppliers::create($validatedData);
        return redirect()->back()->with(['success' => 'Data has been stored successfully']);
    }
    public function update(Request $request, Suppliers $supplier)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'pin' => 'required|string|max:10',
            'district' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:suppliers,email,'.$supplier->id,
            'phone' => 'required|string|max:15',
        ]);

        // Update the model with the validated data
        $supplier->update($validatedData);
        // You can also return a response or redirect as needed
        return redirect()->back()->with(['success' => 'Data has been stored successfully']);
    }
    public function destroy(Suppliers $supplier)
    {
        try {
            // Find the model instance by ID

            // Delete the model
            $supplier->delete();

            // Optionally, you can set a success message
           // session()->flash('success', 'Record has been successfully deleted.');

            // Return a view with a success message
            return redirect()->back()->with('success','Record has been successfully deleted.');
        } catch (\Exception $e) {
            // Handle any exceptions, such as the model not found

            return redirect()->back()->with('error','An error occurred while deleting data.');
        }
    }
}
