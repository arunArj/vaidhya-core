<form wire:submit.prevent="submitForm">
    @csrf
    <div class="row mb-4 justify-content-center align-items-center">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Purchase Order</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6" style="border: 1px solid #bbbbbb52;padding: 15px;">
                        <div class="form-group">
                            <label for="supplierSelect">Select Supplier</label>
                            <div class="form-group">
                                <select name="supplier_id" class=" form-select" wire:model="supplier_id">
                                    {{-- <option value="" >Select</option> --}}
                                  @foreach ($vendors as $vendor)
                                  <option value="{{$vendor->id}}"  @if ($vendor->id == $supply)
                                    selected
                                  @endif>{{$vendor->name}}</option>
                                  @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" style="border: 1px solid #bbbbbb52;padding: 15px;">
                        <div class="text-muted mb-2">Order</div>
                        <h4 class="mb-0">#PID <span>-{{$purchaseId}}</span> </h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <div class="row mb-4 justify-content-center align-items-center">
            <div class="col-md-12">

<div>


    <div class="form-group">
        <label for="productSelect">Select Medicine</label>
        <select name="search" wire:model="search" class="form-control" wire:change="addProduct">
          @foreach ($products as $product)

          <option value="{{$product->id}}">{{$product->title}}</option>
          @endforeach
        </select>
    </div>

    @if(count($selectedProducts) > 0)
    <div class="mt-4">
        <h4>Selected Medicines</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Medicine</th>
                    <th>Company</th>
                    <th>Bathch No</th>
                    <th>Expire Date</th>

                    <th>Quantitiy</th>
                    <th>Cost</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($selectedProducts)
                @forelse($selectedProducts as $index => $selectedProduct)
                    <tr>
                        <td>{{ $index+1 }}</td>

                        <td>{{ $selectedProduct['title'] }}</td>
                        <td> <input wire:model="selectedProducts.{{ $index }}.company" type="text" class="form-control" wire:change="updateTotals({{$index}})"></td>
                        <td> <input wire:model="selectedProducts.{{ $index }}.batch_no" type="text" class="form-control" wire:change="updateTotals({{$index}})"></td>
                        <td> <input wire:model="selectedProducts.{{ $index }}.expire_date" type="date" class="form-control" wire:change="updateTotals({{$index}})"></td>
                        <td> <input wire:model="selectedProducts.{{ $index }}.quantity" type="number" class="form-control" wire:change="updateTotals({{$index}})"></td>
                        <td>
                            <input wire:model="selectedProducts.{{ $index }}.cost" type="number" step="0.01" class="form-control" wire:change="updateTotals({{$index}})">
                        </td>
                        <td>{{ $selectedProducts[$index]['total'] }}</td>
                        <td>
                            <button wire:click="removeProduct({{ $index }})" class="btn btn-sm btn-danger">X</button>
                        </td>
                    </tr>


                @endforeach

                @endif

                </tbody>
            </table>
            </div>
        @endif
</div>

            </div>
    </div>
    <div class="row mb-4 justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">Additional details</h4>
                </div>
                <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal">
                    <div class="form-body">
                        <div class="row">
                        <div class="col-md-4">
                            <label>GST</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="gst" wire:model="gst" class="form-control" name="gst" wire:change="updateGrantTotal" >
                        </div>
                        <div class="col-md-4">
                            <label>Discount</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="discount" wire:model='discount' class="form-control" name="discount" placeholder="Discount" wire:change="updateGrantTotal">
                        </div>

                        </div>
                    </div>

                </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">



            <div class="card">
                <div class="card-header">
                <h4 class="card-title">Cost summary</h4>
                </div>
                <div class="card-content">
                <div class="card-body">
                    <div class="bg-white rounded-lg shadow-md p-4">

                        <ul class="list-unstyled">
                            <li class="py-3">

                                <div class="d-flex justify-content-between">
                                    <span class="text-secondary small">Subtotal:</span>
                                    <input type="hidden" id="subtotal" name="subtotal">
                                    <span class="text-dark" id="subTotal">{{$subTotal}}</span>
                                </div>
                            </li>
                            <li class="py-3">

                                <div class="d-flex justify-content-between">
                                    <span class="text-secondary small">GST</span>
                                    <span class="text-dark" id="gstText">{{$gst}}</span>

                                </div>
                                {{-- <div class="d-flex justify-content-between">
                                    <span class="text-secondary small">Already received:</span>
                                    <span class="text-dark">$100</span>
                                </div> --}}
                            </li>
                            <li class="py-3">
                                <div class="d-flex justify-content-between">
                                    <span class="text-secondary small">Discount:</span>

                                    <span id="discountText" class="text-dark">{{$discount}}</span>
                                </div>
                            </li>
                            <li class="py-3">
                                <div class="d-flex justify-content-between">
                                    <span class="text-secondary  font-weight-bold">Total:</span>
                                    <span class="text-dark" id="grant">{{$grantTotal}}</span>
                                </div>
                            </li>
                            <!-- Add more bills as needed -->
                        </ul>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row mb-4 justify-content-end align-items-center">
        <div class="col-md-2">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </div>
</form>

