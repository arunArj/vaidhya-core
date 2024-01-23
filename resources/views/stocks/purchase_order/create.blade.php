@extends('layouts.theme.base')
@section('dashboard')

<section class="section">
    <livewire:medicine-search />

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
