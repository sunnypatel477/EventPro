<!-- make modal open button -->


<div class="row">
    <div class="col-12 mb-3">
        <button type="button" class="btn btn-primary float-end" id="addUser">Add User</button>
    </div>
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="table_div table-responsive">
                    <table class="table" id="ceo_user_list">
                        <thead>
                            <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">Name</th>
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
            <div class="modal-body">
                <!-- add user form -->
                <form id="add_user">
                    <div class="form-row">
                        <div class="col-12">
                            <label for="first_name">First name</label>
                            <input type="text" class="form-control" id="first_name" value="" name="first_name">
                        </div>
                        <div class="col-12">
                            <label for="last_name">Last name</label>
                            <input type="text" class="form-control" id="last_name" value="" name="last_name">
                        </div>
                        <div class="col-12">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" value="" name="email">
                        </div>
                        <div class="col-12">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="">Select Role</option>
                                <option value="3">Team Lead</option>
                                <option value="4">Team Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
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
                        url: "<?php echo base_url('ceo/user/check_email'); ?>",
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
                var formData = new FormData(form);
                showLoader();
                $.ajax({
                    url: "<?php echo base_url('ceo/user/add_user'); ?>",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success(data.message);
                            hideLoader();
                            setTimeout(function() {
                                $('#addUserModal').modal('hide');
                                $('#add_user')[0].reset();
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(data.message);
                            hideLoader();
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });
    });

    $(document).ready(function() {
        var table = $('#ceo_user_list').DataTable({
            info: true,
            searching: true,
            paging: true,
            pageLength: 10,
            ordering: false,
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
                url: base_url + 'ceo/user/list_table',
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
                    data: 'action'
                },
            ],
            responsive: true
        });
    });
    $(document).on('click', '.delete_user', function() {
        var user_id = $(this).attr('data-id');
        var user_name = $(this).attr('data-name');
        var confirm_delete = confirm('Are you sure you want to delete ' + user_name + ' ?');
        if (confirm_delete) {
            $.ajax({
                url: "<?php echo base_url('ceo/user/delete_user'); ?>",
                type: "POST",
                data: {
                    user_id: user_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 1) {
                        $('#ceo_user_list').DataTable().ajax.reload();
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
</script>