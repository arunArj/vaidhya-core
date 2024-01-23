@extends('layouts.theme.base')
@section('dashboard')

<div class="main-content container-fluid">

    <section class="section">

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">

                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Purchase List</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-group">
                                <form method="get" action="/purchase">
                                    <input type="text" class="form-control" id="basicInput" placeholder="Search">
                                </form>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('purchase.create') }}" style="color: #fff" class="btn btn-primary">
                                    <i data-feather="plus" width="20"></i> Create Purchase Order
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body px-0 pb-0">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                      @endif
                      @if(session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                    @endif
                        <div class="table-responsive">
                            <table class='table mb-0' id="table1" >
                                <thead>
                                    <tr>
                                        <th>Purchase Order Id</th>

                                        <th>Supplier</th>
                                        <th>Amount</th>
                                        <th>discount</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchase as $key =>$item)
                                        <tr>
                                            <td>PID-{{$item->id}}</td>

                                            <td>{{$item->supplier->name}}</td>
                                            <td>{{$item->amount??0}}</td>
                                            <td>{{$item->discount}}</td>
                                            <td>{{$item->amount-$item->discount}}</td>
                                            <td>
                                                <div  class="d-flex align-items-center">
                                                    <a href="/purchase/{{$item->id}}/edit">
                                                        <i data-feather="edit" width="20"></i></a>
                                                            <button class="btn btn-outline" onclick="deleteSupplier({{$item->id}})"  data-toggle="modal" data-target="#danger">
                                                                <i data-feather="trash" width="20"></i>
                                                            </button>
                                                            <a  href ="/purchase/{{$item->id}}" class="btn btn-outline">
                                                                <i data-feather="eye" width="20">View Items</i>
                                                            </button>
                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-2">
                            {{ $purchase->links() }}
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>
</div>

<div class="modal-danger mr-1 mb-1 d-inline-block">


    <!--Danger theme Modal -->
    <div class="modal fade text-left" id="danger" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel120" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
            <h5 class="modal-title white" id="myModalLabel120">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
            </div>
            <div class="modal-body" >
              <p> you are about to delete this record</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="button" onclick="deleteSupplierConfirm()" class="btn btn-danger ml-1" data-dismiss="modal">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Delete</span>
            </button>
            <form id="deleteSupplierForm"  method="post" action="/purchase" >
                @method('DELETE')
                @csrf
            </form>

            </div>
        </div>
        </div>
    </div>
</div>


<script>
    function deleteSupplier(id) {
       // var supplierId = document.getElementById('supplier_id').value;
        document.getElementById('deleteSupplierForm').action = '/purchase/' + id;
       // document.getElementById('deleteSupplierForm').submit();
    }
function deleteSupplierConfirm() {

       document.getElementById('deleteSupplierForm').submit();
    }
</script>


@endsection

