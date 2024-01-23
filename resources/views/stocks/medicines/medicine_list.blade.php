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
                            <h4 class="card-title">Medicines List</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-group">
                                    <form method="get" action="/patients">
                                        <input type="text" class="form-control" id="basicInput" placeholder="Search">
                                    </form>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('medicines.create') }}" style="color: #fff" class="btn btn-primary">
                                        <i data-feather="plus" width="20"></i> Create Supplier
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body px-0 pb-0">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <div>
                                    <i data-feather="more-vertical" width="20" style="margin-left: 28px; display:none"
                                        id="vertical-icon" onclick="togglePopup()"></i>
                                    <!-- Popup div -->
                                    <div id="popup"
                                        style=" display: none;
                                        position: relative;
                                        padding: 10px;
                                        z-index: 1;
                                        top: -31px;
                                        margin-left: 50px;">
                                        <button data-toggle="modal"
                                        data-target="#bulk-delete" class="btn btn-danger" style="color: #fff"><i
                                                data-feather="trash-2" width="30" height="1.2rem"></i>Delete
                                            Selected</button>

                                    </div>
                                </div>

                                <table class='table mb-0' id="table1">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="form-check-input" name="master_checkbox[]"
                                                    id="master_checkbox" /></th>
                                            <th>Medicine</th>

                                            <th>price</th>
                                            <th>Quantity</th>
                                            <th>description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($medicines as $key => $item)
                                            @if ($item->available_quantity <= 10)
                                                <tr style="background-color: #ffb4b4">
                                                @else
                                                <tr>
                                            @endif
                                            <td><input type="checkbox" class="form-check-input" name="medicine_id[]"
                                                    value="{{ $item->id }}" />
                                            </td>
                                            <td>{{ $item->title }}</td>

                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->available_quantity ?? 0 }} </i></td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="/medicines/{{ $item->id }}/edit">
                                                        <i data-feather="edit" width="20"></i></a>
                                                    <button class="btn btn-outline"
                                                        onclick="deleteSupplier({{ $item->id }})" data-toggle="modal"
                                                        data-target="#danger">
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
                                {{ $medicines->links() }}
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>

    <div class="modal-danger mr-1 mb-1 d-inline-block">


        <!--Danger theme Modal -->
        <div class="modal fade text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title white" id="myModalLabel120">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p> you are about to delete this record</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="button" onclick="deleteSupplierConfirm()" class="btn btn-danger ml-1"
                            data-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Delete</span>
                        </button>
                        <form id="deleteSupplierForm" method="post" action="/medicines">
                            @method('DELETE')
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-danger mr-1 mb-1 d-inline-block">
        <!--Danger theme Modal -->
        <div class="modal fade text-left" id="bulk-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel122"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title white" id="myModalLabel122">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p> you are about to delete these record</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="button" onclick="bulkDeleteRecord()" class="btn btn-danger ml-1"
                            data-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Delete</span>
                        </button>
                        <form id="deleteSupplierForm" method="post" action="/medicines">
                            @method('DELETE')
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function bulkDeleteRecord() {
            var recordid = $("input[name='medicine_id[]']:checked").map(function() {
                return $(this).val();
            }).get();

            // Construct data object
            var formData = {
                recordid: recordid,

            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            // AJAX request
            $.ajax({
                type: "DELETE", // or "GET" depending on your server-side implementation
                url: "/medicine-bulkdelete", // replace with the actual server-side endpoint
                data: formData,
                success: function(response) {

                    alert('records removed')
                    location.reload(true)
                },
                error: function(error) {
                    // Handle the error response from the server
                    console.error("Error submitting form:", error);
                }
            });
        }

        function deleteSupplier(id) {
            // var supplierId = document.getElementById('supplier_id').value;
            document.getElementById('deleteSupplierForm').action = '/medicines/' + id;
            // document.getElementById('deleteSupplierForm').submit();
        }

        function deleteSupplierConfirm() {

            document.getElementById('deleteSupplierForm').submit();
        }

        $('#master_checkbox').on('click', function() {
            const isChecked = $(this).prop('checked');
            if (isChecked) {
                $('#vertical-icon').show()
            } else {
                $('#vertical-icon').hide()
            }
            $('input[name="medicine_id[]"]').prop('checked', $(this).prop('checked'));
        });
        $('input[name="medicine_id[]"]').on('click', function() {
            const isChecked = $('input[name="medicine_id[]"]:checked').length > 0;
            if ($('input[name="medicine_id[]"]:checked').length === $('input[name="medicine_id[]"]').length) {
                $('#master_checkbox').prop('checked', true);
            } else {
                $('#master_checkbox').prop('checked', false);
            }
            if (isChecked) {
                $('#vertical-icon').show()
            } else {
                $('#vertical-icon').hide()
            }
        });

        function togglePopup() {

            var popup = document.getElementById("popup");
            if (popup.style.display === "none" || popup.style.display === "") {
                popup.style.display = "block";
            } else {
                popup.style.display = "none";
            }
        }
    </script>
@endsection
