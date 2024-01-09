@extends('layouts.theme.base')
@section('dashboard')
<div class="main-content container-fluid">

    <section class="section">

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">

                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Patients List</h4>
                        <div class="d-flex ">
                            <div class="form-group">
                                <form method="get" action="/patients">
                                    <input type="text" class="form-control" id="basicInput" placeholder="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class='table mb-0' id="table1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>MRD NUMBER</th>
                                        <th>Age</th>
                                        <th>Phone</th>
                                        <th>dob</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $key =>$patient)
                                        <tr>
                                            <td>{{$patient->name}}</td>
                                            <td>{{$patient->mrd_no}}</td>
                                            <td>{{ $patient->getAgeAttribute()}}</td>
                                            <td>{{$patient->phone}}</td>
                                            <td>{{$patient->dob}}</td>
                                            <td>{{$patient->address}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-2">
                            {{ $patients->links() }}
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="col-md-4">
                <div class="card ">
                    <div class="card-header">
                        <h4>Bills</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            The most basic list group is simply an unordered list with list
                            items, and the proper classes. Build upon it with the options that
                            follow, or your own CSS as needed.
                        </p>
                        <ul class="list-group">
                            <li class="list-group-item active">Cras justo odio</li>
                            <li class="list-group-item">Dapibus ac facilisis in</li>
                            <li class="list-group-item">Morbi leo risus</li>
                            <li class="list-group-item">Porta ac consectetur ac</li>
                            <li class="list-group-item">chocolate cheesecake candy</li>
                            <li class="list-group-item">Oat cake icing pastry pie carrot</li>
                        </ul>
                    </div>
                </div>

            </div> --}}
        </div>
    </section>
</div>
@endsection

