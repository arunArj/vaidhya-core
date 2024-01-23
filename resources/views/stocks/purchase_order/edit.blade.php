@extends('layouts.theme.base')
@section('dashboard')

<section class="section">
    {{-- <livewire:medicine-update /> --}}
    @livewire('medicine-update', ['purchaseId' => $purchase->id])

</section>
@endsection
@section('custom-script')
<script>
     Livewire.on('productAdded',data => {

alert('purchase order created')
$("#purchaseform").trigger("reset");
});
</script>

@endsection
