@extends('master')

@section('content')
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
{{-- <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
<!-- DataTables core -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- Buttons extension -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Buttons scripts -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- Export dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<style>
    table.dataTable {
    width: 100% !important;
    table-layout: auto;
}

.dataTables_wrapper {
    overflow-x: auto; /* Only scroll if table is really too wide */
}
</style>
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<h2 class="mb-2 lh-sm">Users</h2>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-12">
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-soft">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-12 col-md">
                                <h4 class="text-900 mb-0" data-anchor="data-anchor">Daftar User</h4>
                                <p class="mb-0 mt-2 text-800">Daftar <code>User</code> Di Universitas DIponegoro</p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">

                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <button class="btn btn-primary btn-sm px-6 px-sm-8" data-bs-toggle="modal" data-bs-target="#addUser">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah User
                                    </button>
                                </div>
                            </div>
                            <br>
                            <br>
                            {{-- <div class="mb-3">
                                <label>Filter by Role:</label>
                                <select id="roleFilter" class="form-select" style="width:200px; display:inline-block;">
                                    <option value="">All</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}


                            <div id="tableExample3">

                                <div class="table-responsive usersTable">
                                    <table class="table table-striped table-bordered" id="usersTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="sort border-top" data-sort="nomor" width="5%">No</th>
                                                <th class="sort border-top" data-sort="name" width="15%">Nama</th>
                                                <th class="sort border-top" data-sort="email" width="15%">Email</th>
                                                <th class="sort border-top" data-sort="username" width="15%">Username</th>
                                                <th class="sort border-top" data-sort="username" width="10%">Status</th>
                                                <th class="sort border-top" data-sort="last_login" width="15%">Last Login</th>
                                                <th class="sort border-top" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        {{-- <tbody class="list">
                                            <?php
                                                    $no = 1;
                                                ?>
                                            @foreach($users as $user)
                                            <tr>
                                                <td class="align-middle ps-3 nomor">{{ $no++ }}</td>
                                                <td class="align-middle name">{{$user->name}}</td>
                                                <td class="align-middle email">{{$user->email}}</td>
                                                <td class="align-middle username">{{$user->username}}</td>
                                                <td class="align-middle last_login">{{$user->last_login}}</td>
                                                <td class="align-middle white-space-nowrap text-end pe-0">
                                                    <div class="font-sans-serif btn-reveal-trigger position-static">
                                                        <button
                                                            class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2"
                                                            type="button" data-bs-toggle="dropdown"
                                                            data-boundary="window" aria-haspopup="true"
                                                            aria-expanded="false" data-bs-reference="parent"><span
                                                                class="fas fa-ellipsis-h fs--2"></span></button>
                                                        <div class="dropdown-menu dropdown-menu-end py-2"><a
                                                                class="dropdown-item" href="#!">View</a><a
                                                                class="dropdown-item" href="#!">Export</a>
                                                            <div class="dropdown-divider"></div><a
                                                                class="dropdown-item text-danger" href="#!">Remove</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody> --}}
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->

{{-- Modal Add --}}
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
            </div>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label" for="basic-form-name" >Name</label>
                <input class="form-control" id="basic-form-name" type="text" name="name" placeholder="Name" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-form-email">Email address</label>
                <input class="form-control" id="basic-form-email" type="email" name="email" placeholder="name@example.com" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-form-name" >Username</label>
                <input class="form-control" id="basic-form-name" type="text" name="username" placeholder="Name" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-form-password" >Password</label>
                <input class="form-control" id="basic-form-password" type="password" name="password" placeholder="Password" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-form-gender" >Status</label>
                <select class="form-select" id="basic-form-gender" aria-label="Default select example" name="status">
                <option selected="selected">Select status</option>
                <option value="1" selected>Active</option>
                <option value="0">Not Active</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Image</label>
                <input class="form-control" type="file" name="image" />
            </div>


        </div>
        <div class="modal-footer">
            <button class="btn btn-outline-primary" type="submit">Submit</button>
            <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button></div>
        </div>
        </form>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" id="editName" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" id="editEmail" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" id="editUsername" name="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="text" id="editPassword" name="password" class="form-control" placeholder="Leave blank if not update password">
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select id="editStatus" name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

<script>
$(document).ready(function () {
    let table = $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('user') }}",
            data: function (d) {
                d.role = $('#roleFilter').val(); // send filter value
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'username', name: 'username' },
            { data: 'status', name: 'status', render: function(data) {
                return data == 1
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            } },
            { data: 'last_login', name: 'last_login' },
            { data: 'action', orderable: false, searchable: false }
        ],

        dom: 'lBfrtip', // show buttons above table
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 10, // default
        lengthMenu: [ [10, 50, 100], [10, 50, 100] ], // dropdown options
        destroy: true // if re-initializing
    });

    // // Reload table when filter changes
    // $('#roleFilter').change(function () {
    //     table.ajax.reload();
    // });
    // Open modal for editing
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');
        $.get("{{ url('user-show') }}/" + id, function (data) {
            $('#editId').val(data.id);
            $('#editName').val(data.name);
            $('#editEmail').val(data.email);
            $('#editUsername').val(data.username);
            $('#editStatus').val(data.status);
            $('#editModal').modal('show');
        });
    });
    // Save changes
    $('#editForm').submit(function (e) {
        e.preventDefault();
        let id = $('#editId').val();
        $.ajax({
            url: "{{ url('user-edit') }}/" + id,
            type: "PUT",
            data: $(this).serialize(),
            success: function (res) {
                // $('#editModal').modal('hide');
                // table.ajax.reload(null, false); // reload without resetting pagination
                // alert(res.message);
                if (res.success) {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    };
                    toastr.success(res.message);

                    // refresh DataTable without reload
                    $('#usersTable').DataTable().ajax.reload(null, false);

                    // close modal
                    $('#editModal').modal('hide');
                } else {
                    toastr.error('Something went wrong.');
                }
            },
            error: function(xhr) {
                toastr.error('Server error: ' + xhr.status);
            }
        });
    });
    // Delete user
    $(document).on('click', '.deleteBtn', function () {
        if (confirm("Delete this user?")) {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ url('user-destroy') }}/" + id,
                type: "DELETE",
                data: {_token: '{{ csrf_token() }}'},
                success: function (res) {
                    if (res.success) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-top-right"
                        };
                        toastr.success(res.message);

                        // refresh DataTable without reload
                        $('#usersTable').DataTable().ajax.reload(null, false);

                        // close modal
                        $('#editModal').modal('hide');
                    } else {
                        toastr.error('Something went wrong.');
                    }
                },error: function(xhr) {
                    toastr.error('Server error: ' + xhr.status);
                }
            });
        }
    });
});
</script>
<script>
    @if(session('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right"
        };
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right"
        };
        toastr.error("{{ session('error') }}");
    @endif
</script>

@endsection
