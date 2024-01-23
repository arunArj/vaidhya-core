<div>
    <div class="form-group">
        <label for="productSearch">Search Product:</label>
        <input wire:model="search" type="text" class="form-control" id="productSearch" placeholder="Type to search">
    </div>

    <div class="form-group">
        <label for="productSelect">Select Product:</label>
        <select wire:model="search" class="form-control" id="productSelect">
            <option value="">Select a product</option>
            @foreach ($products as $product)
                <option value="{{ $product->name }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
</div>
