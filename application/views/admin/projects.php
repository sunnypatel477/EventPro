<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff !important;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-primary float-end" id="addProject">Add Project</button>
            </div>
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <p>Project List</p>
                    </div>
                    <div class="card-body">
                        <table id="project_list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Sr No.</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Team Leaders</th>
                                    <th scope="col">Team Members</th>
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



<!-- project modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_project">
                <div class="modal-body">
                    <!-- add project form -->
                    <div class="form-row">
                        <input type="hidden" name="hid" id="hid" value="<?php echo isset($projectData) ? $projectData['id'] : '' ?>">
                        <div class="col-12 mb-3">
                            <label for="project_name">Project Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="project_name" id="project_name" value="" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="ceo_name">CEO Name <span class="text-danger">*</span></label>
                            <select class="form-control" id="ceo_name" name="ceo_name" required>
                                <!-- Add options for ceo name here -->
                                <option value="">Select CEO</option>
                                <?php foreach ($ceo_list as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['first_name'] . ' ' . $value['last_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="team_leader">Team Leader <span class="text-danger">*</span></label>
                            <select class="team_leader" multiple="multiple" name="team_leader[]" style="width: 100%;" required>
                                <?php foreach ($team_leaders as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['first_name'] . '' . $value['last_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="team_member">Team Members <span class="text-danger">*</span></label>
                                <select class="team_member" name="team_member[]" multiple="multiple" style="width: 100%;">
                                    <?php foreach ($team_members as $key => $value) { ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['first_name'] . '' . $value['last_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="project_status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="project_status" name="project_status" required>
                                <?php foreach ($project_status as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['status_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="start_date">Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
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


<!-- project modal -->

<!-- delete modal -->


<!-- delete modal -->
<!-- make modal open and close -->
<script>
    $(document).ready(function() {
        //modal open and close
        $('#addProject').click(function() {
            $('#addProjectModal').modal('show');
            $('#addProjectModal').find('.modal-title').text('Add Project');
        });

        $('.team_leader').select2({
            placeholder: "Select a Team Leader",
            allowClear: true
        });

        $('.team_member').select2({
            placeholder: "Select a Team Member",
            allowClear: true
        });

        $('#ceo_name').change(function() {
            var ceo_id = $(this).val();
            $.ajax({
                url: "<?php echo base_url('admin/projects/get_team_leader'); ?>",
                type: "POST",
                data: {
                    ceo_id: ceo_id
                },
                dataType: "json",
                success: function(data) {
                    $('.team_leader').empty();
                    $.each(data, function(key, value) {
                        $('.team_leader').append($('<option>', {
                            value: value.id,
                            text: value.first_name + ' ' + value.last_name
                        }));
                    });
                    $('.team_leader').trigger('change');
                }
            });


            $.ajax({
                url: "<?php echo base_url('admin/projects/get_team_member'); ?>",
                type: "POST",
                data: {
                    ceo_id: ceo_id
                },
                dataType: "json",
                success: function(data) {
                    $('.team_member').empty();

                    $.each(data, function(key, value) {
                        $('.team_member').append($('<option>', {
                            value: value.id,
                            text: value.first_name + ' ' + value.last_name
                        }));
                    });

                    $('.team_member').trigger('change');
                }
            });
        });

        $('#addProjectModal').on('hidden.bs.modal', function() {
            $('#add_project')[0].reset();
            $('.team_leader').val([]).trigger('change');
            $('.team_member').val([]).trigger('change');
        });
        
        //list_table
        var table = $('#project_list').DataTable({
            searching: true,
            paging: true,
            info: true,
            responsive: true,
            paging: true,
            scrollCollapse: true,
            ajax: {
                url: '<?= base_url('admin/projects/list_table') ?>',
                type: 'POST',
            },
            columns: [{
                    data: 'sr_no'
                },
                {
                    data: 'project_name'
                },
                {
                    data: 'start_date'
                },
                {
                    data: 'team_leader'
                },
                {
                    data: 'team_member'
                },
                {
                    data: 'action'
                },
            ]
        });

        //form submit use validate js
        $('#add_project').validate({
            rules: {
                project_name: {
                    required: true,
                    remote: {
                        url: "<?php echo base_url('admin/projects/check_project'); ?>",
                        type: "post"
                    }
                },
                team_leader: {
                    required: true,
                },
                team_members: {
                    required: true,
                },
                project_status: {
                    required: true,
                },
                start_date: {
                    required: true,
                },
            },
            messages: {
                project_name: {
                    required: "Please enter project name",
                    remote: "Project already exist"
                },
                team_leader: {
                    required: "Please select team leader",
                },
                team_members: {
                    required: "Please select team members",
                },
                project_status: {
                    required: "Please select project status",
                },
                start_date: {
                    required: "Please select start date",
                },
            },
            submitHandler: function(form) {
                showLoader();
                var url = "<?php echo base_url('admin/projects/add_project') ?>";
                var data = $('#add_project').serialize();
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 1) {
                            hideLoader();
                            $('#addProjectModal').modal('hide');
                            // $('#add_project')[0].reset();
                            $('.team_leader').val([]).trigger('change');
                            $('.team_member').val([]).trigger('change');
                            toastr.success(response.message);
                            $('#project_list').DataTable().ajax.reload();
                        } else {
                            hideLoader();
                            toastr.error(response.message);
                        }
                    }
                });
            }
        });
    });

    // Delete Project
    $(document).on('click', '.delete_project', function() {
        var id = $(this).data('id');
        var url = "<?php echo base_url('admin/projects/delete_project') ?>";
        if (confirm('Are you sure you want to delete this project?')) {
            showLoader();
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 1) {
                        hideLoader();
                        toastr.success(response.message);
                        $('#project_list').DataTable().ajax.reload();
                    } else {
                        hideLoader();
                        toastr.error(response.message);
                    }
                }
            });
        }
    });
</script>