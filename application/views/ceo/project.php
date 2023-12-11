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
                                    <th scope="col">Status</th>
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
    <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-md-12 mb-3">
                            <label for="project_name">Project Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="project_name" id="project_name" value="" required>
                        </div>

                        <div class="tem_list" style="display: contents;">

                            <div class="col-md-5 mb-3">
                                <label for="team_leader">Team Leader <span class="text-danger">*</span></label>
                                <select class="team_leader form-control" name="team_leader[]" style="width: 100%;" required>
                                    <?php foreach ($team_leaders as $key => $value) { ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['first_name'] . ' ' . $value['last_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                    <label for="team_member">Team Members <span class="text-danger">*</span></label>
                                    <select class="team_member" name="team_member[0][]" multiple="multiple" style="width: 100%;">
                                        <?php foreach ($team_members as $key => $value) { ?>
                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['first_name'] . ' ' . $value['last_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 mb-3" style="padding: 28px;">
                                <a href="JavaScript:void(0);" id="add_team" class="btn btn-primary float-end"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <label for="project_status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="project_status" name="project_status" required>
                                <?php foreach ($status as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['status_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
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



<script>
    $(document).ready(function() {

        $('.team_member').select2({
            placeholder: "Select a Team Member",
            allowClear: true
        });

        //modal open and close
        $('#addProject').click(function() {
            $('#addProjectModal').modal('show');
            $('#addProjectModal').find('.modal-title').text('Add Project');
        });

        $('#addProjectModal').on('hidden.bs.modal', function() {
            $('#add_project')[0].reset();
            $('.team_leader').val([]).trigger('change');
            $('.team_member').val([]).trigger('change');
        });

        // list_table
        $('#project_list').DataTable({
            "pageLength": 10,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            columnDefs: [{
                    targets: [0, 1, 5],
                    className: "desktop"
                },
                {
                    targets: [0, 1, 5],
                    className: "tablet mobile"
                },
            ],
            ajax: {
                url: '<?= base_url('ceo/project/list_table') ?>',
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
                    data: 'status'
                },
                {
                    data: 'action',
                    orderable: false,

                },
            ],
            responsive: true
        });

        //form submit use validate js
        $('#add_project').validate({
            rules: {
                project_name: {
                    required: true,
                    remote: {
                        url: "<?php echo base_url('ceo/project/check_project'); ?>",
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
                var url = "<?php echo base_url('ceo/project/add_project') ?>";
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
                            $('#add_project')[0].reset();

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

    var team_member_count = 0; // Variable to keep track of the team count

    $(document).on('click', '#add_team', function() {
        team_member_count++; // Increment the team count
        var html = '';
        html += '<div class="append_div" style="display: contents;">';
        html += '<div class="col-md-5 mb-3">';
        html += '<label for="team_leader">Team Leader <span class="text-danger">*</span></label>';
        html += '<select class="team_leader form-control" name="team_leader[]" style="width: 100%;" required>';
        html += '<option value="">Select Team Leader</option>';
        <?php foreach ($team_leaders as $key => $value) { ?>
            html += '<option value="<?php echo $value['id'] ?>"><?php echo $value['first_name'] . ' ' . $value['last_name'] ?></option>';
        <?php } ?>
        html += '</select>';
        html += '</div>';
        html += '<div class="col-md-5 mb-3">';
        html += '<div class="form-group">';
        html += '<label for="team_member">Team Members <span class="text-danger">*</span></label>';
        html += '<select class="team_member" name="team_member[' + team_member_count + '][]" multiple="multiple" style="width: 100%;">';
        <?php foreach ($team_members as $key => $value) { ?>
            html += '<option value="<?php echo $value['id'] ?>"><?php echo $value['first_name'] . ' ' . $value['last_name'] ?></option>';
        <?php } ?>
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-2 mb-3" style="padding: 28px;">';
        html += '<a href="JavaScript:void(0);" class="btn btn-danger float-end remove_team"><i class="fa fa-minus" aria-hidden="true"></i></a>';
        html += '</div>';
        html += '</div>';
        $('.tem_list').append(html);
        $('.team_member').select2({
            placeholder: "Select a Team Member",
            allowClear: true
        });
    });

    // Remove div on click remove_team
    $(document).on('click', '.remove_team', function() {
        $(this).closest('.append_div').remove();
    });
    

    //Delete Project
    $(document).on('click', '.delete_project', function() {
        var id = $(this).data('id');
        var url = "<?php echo base_url('ceo/project/delete_project') ?>";
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