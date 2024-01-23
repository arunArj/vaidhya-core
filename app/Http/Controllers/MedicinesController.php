<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MedicinesController extends Controller
{
    public function index()
    {
        $medicines =  Medicines::select('medicines.id', 'medicines.title', 'medicines.description', 'medicines.price')
            ->addSelect(DB::raw('SUM(purchase_order_items.quantity) as available_quantity'))
            ->leftJoin('purchase_order_items', 'medicines.id', '=', 'purchase_order_items.medicine_id')
            ->groupBy('medicines.id', 'medicines.title', 'medicines.price', 'medicines.description')
            ->paginate(10);
        return view('stocks.medicines.medicine_list', compact('medicines'));
    }
    public function create()
    {
        return view('stocks.medicines.medicine_create');
    }
    public function edit(Medicines $medicine)
    {
        return view('stocks.medicines.medicine_edit', compact('medicine'));
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'price' => 'required|string|max:22',
            'unit' => 'required|string|max:22',
        ]);
        $medicine =  Medicines::create($validatedData);

        return redirect()->back()->with(['success' => 'Medicine added successfully']);
    }
    public function update(Request $request, Medicines $medicine)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'price' => 'required|string|max:22',
            'unit' => 'required|string|max:22',

        ]);

        // Update the model with the validated data
        $medicine->update($validatedData);
        // You can also return a response or redirect as needed
        return redirect()->back()->with(['success' => 'Data has been stored successfully']);
    }
    public function destroy(Medicines $medicine)
    {
        try {

            $medicine->delete();
            return redirect()->back()->with('success', 'Record has been successfully deleted.');
        } catch (\Exception $e) {
            // Handle any exceptions, such as the model not found

            return redirect()->back()->with('error', 'An error occurred while deleting data.');
        }
    }
    public function inventory()
    {
        $medicines = Medicines::select('medicines.id', 'medicines.title', 'medicines.price')
            ->addSelect(DB::raw('SUM(purchase_order_items.quantity) as available_quantity'))
            ->leftJoin('purchase_order_items', 'medicines.id', '=', 'purchase_order_items.medicine_id')
            ->groupBy('medicines.id', 'medicines.title', 'medicines.price')
            ->paginate(10);
        dd($medicines);
    }
    public function bulkDelete(Request $request)
    {
        try {
        $validator = $request->validate([
            'recordid' => ['required', 'array', Rule::exists('medicines', 'id')],
        ]);
        $ids = $request->input('recordid');

        Medicines::whereIn('id', $ids)->delete();

        return response()->json([200]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
