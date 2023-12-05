<!-- make modal open button -->


<div class="row">
    <div class="col-12 mb-3">
        <button type="button" class="btn btn-primary float-end" id="addUser">Add User</button>
    </div>
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">

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
                                <input type="text" class="form-control" id="first_name" value="" required>
                            </div>
                            <div class="col-12">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-control" id="last_name" value="" required>
                            </div>
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" value="" required>
                            </div>
                            <div class="col-12">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" required>
                                    <option value="">Select Role</option>
                                    <option value="2">Ceo</option>
                                    <option value="3">Team Lead</option>
                                    <option value="4">Team Member</option>
                                </select>

                            </div>

                        </div>


                        <button class="btn btn-primary" type="submit">Submit form</button>
       

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
                        url: "<?php echo base_url('admin/check_email'); ?>",
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
                $.ajax({
                    url: "<?php echo base_url('admin/add_user'); ?>",
                    type: "POST",
                    data: $('#add_user').serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 1) {
                            $('#addUserModal').modal('hide');
                            $('#add_user')[0].reset();
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        });
   
    });
</script>