
<section class="content">
    <div class="container-fluid">
<div class="row">
    <div class="col-12 mb-3">
        <button type="button" class="btn btn-primary float-end" id="addUser">Add User</button>
    </div>
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">
                <p>Users List</p>
            </div>
            <div class="card-body">
                <table id="user_list" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sr No.</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_user">
                <!-- <input type="hidden" name="user_id" id="user_id" value=""> -->
                <div class="modal-body">
                    <!-- add user form -->
                    <div class="form-row">
                        <div class="col-12 mb-3">
                            <label for="first_name">First name <sapn class="text-danger">*</sapn></label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="last_name">Last name <sapn class="text-danger">*</sapn></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="email">Email <sapn class="text-danger">*</sapn></label>
                            <input type="text" class="form-control" name="email" id="email" value="" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="role">Role <sapn class="text-danger">*</sapn></label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="">Select Role</option>
                                <option value="2">Ceo</option>
                                <option value="3">Team Lead</option>
                                <option value="4">Team Member</option>
                            </select>

                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- make modal open and close -->
<script>
    $(document).ready(function() {
        $('#addUser').on('click', function() {
            $('#addUserModal').modal('show');
        });
        $('#close').on('click', function() {
            $('#addUserModal').modal('hide');
        });



        //hiden bs modal 
        $('#addUserModal').on('hidden.bs.modal', function() {
            $('#teamLeadField').addClass('d-none');
            $('#add_user')[0].reset();
        });

        //show user list
        var table = $('#user_list').DataTable({
            "pageLength": 10,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columnDefs: [{
                    targets: [0, 1, 2, 3, 4],
                    className: "desktop"
                },
                {
                    targets: [0, 1],
                    className: "tablet mobile"
                },
            ],
            ajax: {
                url: base_url + 'admin/users/list_table',
                type: 'GET',
                dataType: 'json',
            },
            columns: [{
                    data: 'sr_no'
                },
                {
                    data: 'user_name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'role'
                },
                {
                    data: 'action',
                    orderable: false,
                },
            ],
            responsive: true // Enable responsive extension
        });


        //validate form  use validate js and submit data to database
        $('#add_user').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo base_url('admin/users/check_email'); ?>",
                        type: "post"
                    }
                },
                role: {
                    required: true
                }
            },
            messages: {
                first_name: {
                    required: "Please enter first name",
                    minlength: "Name must be at least 3 characters long"
                },
                last_name: {
                    required: "Please enter last name",
                    minlength: "Name must be at least 3 characters long"
                },
                email: {
                    required: "Please enter email",
                    email: "Please enter valid email",
                    remote: "Email already exist"
                },
                role: {
                    required: "Please select role"
                }
            },
            submitHandler: function(form) {
                showLoader();
                $.ajax({
                    url: "<?php echo base_url('admin/users/add_user'); ?>",
                    type: "POST",
                    data: $('#add_user').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 1) {
                            $('#addUserModal').modal('hide');
                            $('#add_user')[0].reset();
                            table.ajax.reload();
                            hideLoader();
                            toastr.success(response.message);
                        } else {
                            hideLoader();
                            toastr.error(response.message);
                        }
                    }
                });
            }
        });

        //delete user
        $(document).on('click', '.delete_user', function() {
            var user_id = $(this).attr('data-id');
            var user_name = $(this).attr('data-name');
            var confirm_delete = confirm('Are you sure you want to delete ' + user_name + ' ?');
            if (confirm_delete) {
                $.ajax({
                    url: "<?php echo base_url('admin/users/delete_user'); ?>",
                    type: "POST",
                    data: {
                        user_id: user_id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 1) {
                            table.ajax.reload();
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });
            }
        });


        //edit user
        // $(document).on('click', '.edit_user', function() {
        //     var user_id = $(this).attr('data-id');
        //     $.ajax({
        //         url: "<?php echo base_url('admin/users/edit_user'); ?>",
        //         type: "POST",
        //         data: {
        //             user_id: user_id
        //         },
        //         dataType: "json",
        //         success: function(response) {
        //             if (response.status == 1) {
        //                 $('#addUserModal').modal('show');
        //                 //modal title change
        //                 $('.modal-title').html('Edit User');
        //                 $('#first_name').val(response.data.first_name);
        //                 $('#last_name').val(response.data.last_name);
        //                 $('#email').val(response.data.email);
        //                 $('#role').val(response.data.role);
        //                 $('#user_id').val(response.data.id);
        //             } else {
        //                 toastr.error(response.message);
        //             }
        //         }
        //     });
        // });



    });
</script>