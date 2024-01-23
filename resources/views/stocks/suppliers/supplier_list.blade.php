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
                        <h4 class="card-title">Suppliers List</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-group">
                                <form method="get" action="/patients">
                                    <input type="text" class="form-control" id="basicInput" placeholder="Search">
                                </form>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                                    <i data-feather="plus" width="20"></i> Create Supplier
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
                                        <th>Supplier</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>District</th>
                                        <th>Pin</th>
                                        <th>Contact Person</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $key =>$item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->city}}</td>
                                            <td>{{ $item->district}}</td>
                                            <td>{{$item->pin}}</td>
                                            <td>{{$item->contact_name}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>
                                                <div  class="d-flex align-items-center">
                                                    <a href="/suppliers/{{$item->id}}/edit">
                                                        <i data-feather="edit" width="20"></i></a>
                                                            <button class="btn btn-outline" onclick="deleteSupplier({{$item->id}})"  data-toggle="modal" data-target="#danger">
                                                                <i data-feather="trash" width="20"></i>
                                                            </button>
                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-2">
                            {{ $suppliers->links() }}
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
            <h5 class="modal-title white" id="myModalLabel120">Danger Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
            </div>
            <div class="modal-body">
                you are about to delete this record
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
            <form id="deleteSupplierForm"  method="post" action="/suppliers/{{$item->id}}" >
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
        document.getElementById('deleteSupplierForm').action = '/suppliers/' + id;
       // document.getElementById('deleteSupplierForm').submit();
    }
function deleteSupplierConfirm() {

       document.getElementById('deleteSupplierForm').submit();
    }
</script>


@endsection

