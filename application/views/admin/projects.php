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
                <!-- <table id="user_list" class="table table-bordered table-striped">
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
                </table> -->
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
            <form id="add_project" name="add_project">
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
                            <select class="form-control" id="team_leader" name="team_leader" required>
                                <!-- Add options for team leaders here -->
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="team_members">Team Members <span class="text-danger">*</span></label>
                            <select class="form-control" id="team_members" name="team_members[]" multiple required>
                                <!-- Add options for team members here -->
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="project_status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="project_status" name="project_status" required>
                                <option value="in_progress">In Progress</option>
                                <option value="on_hold">On Hold</option>
                                <option value="finished">Finished</option>
                                <option value="not_started">Not Started</option>
                                <option value="cancelled">Cancelled</option>
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
    });
</script>