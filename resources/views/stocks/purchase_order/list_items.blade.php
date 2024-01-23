
@extends('layouts.theme.base')
@section('dashboard')
<div class="main-content container-fluid">

    <section class="section">

        <div class="row mb-4">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Purchase Item List</h4>
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

                                        <th>Medicine</th>
                                        <th>Cost</th>
                                        <th>Quantity Available</th>
                                        <th>Company</th>
                                        <th>batch_no</th>
                                        <th>Expire Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key =>$item)
                                        <tr>
                                            <td>PID-{{$purchase->id}}</td>

                                            <td>{{$item->medicine->title}}</td>
                                            <td>{{$item->cost??0}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->company}}</td>
                                            <td>{{$item->batch_no}}</td>
                                            <td>{{$item->expire_date}}</td>
                                            <td>
                                                <div  class="d-flex align-items-center">

                                                            <a  href ="/purchase/{{$item->id}}" class="btn btn-outline"  data-toggle="modal" data-target="#danger">
                                                                <i data-feather="sliders" width="20">View Items</i>
                                                            </button>
                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-2">
                            {{ $items->links() }}
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Unavailable Items</h4>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class='table mb-0' id="table1" >
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th>Medicine</th>
                                        <th>Quantity</th>
                                        <th>discount</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key =>$item)
                                        <tr>
                                            <td>{{++$key}}</td>

                                            <td>{{$item->medicine->title}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->reason}}</td>

                                            <td>
                                                <div  class="d-flex align-items-center">

                                                            <a  href ="/purchase/{{$item->id}}" class="btn btn-outline"  data-toggle="modal" data-target="#danger">
                                                                <i data-feather="sliders" width="20">View Items</i>
                                                            </button>
                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<div class="modal fade text-left" id="danger" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
<div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="myModalLabel33">Move to Unavailable </h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
    </div>
    <form  method="POST" id="updateqty" action="/update-qty/{{$item->id}}">
        @method('PUT')
        @csrf
        <div class="modal-body">
        <label> Quantity: </label>
        <div class="form-group">
        <input type="number" placeholder="Enter the Quantity" class="form-control">
        </div>
        <label>Reason: </label>
        <div class="form-group">
            <fieldset class="form-group">
                <select class="form-select" name="reason" id="reason">
                    <option value="reshedule">reshedule</option>
                    <option value="expired">expired</option>
                    <option value="damaged">damaged</option>
                </select>
            </fieldset>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
        </button>
        <button type="submit" class="btn btn-primary ml-1" >
        <i class="bx bx-check d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Save</span>
        </button>
    </div>
    </form>
</div>
</div>
</div>


<script>

</script>


@endsection

