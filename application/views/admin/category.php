<!-- make modal open button -->

<section class="content">
    <div class="container-fluid">
<div class="row">
    <div class="col-12 mb-3">
        <button type="button" class="btn btn-primary float-end" id="addcategory">Add Category</button>
    </div>
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="table_div table-responsive">
                    <table class="table" id="category_list">
                        <thead>
                            <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Color</th>
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
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="add_category_model" tabindex="-1" role="dialog" aria-labelledby="add_category_modelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add user form -->
                <form id="add_category" name="add_category">

                    <div class="form-row">
                        <input type="hidden" name="hid" id="hid" value="<?php echo isset($categoryData) ? $categoryData['id'] : '' ?>">
                        <div class="col-12">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" value="<?php echo isset($categoryData) ? $categoryData['category_name'] : '' ?>" name="category_name">
                        </div>
                        <div class="col-12">
                            <label for="category_color">Color</label>
                            <input type="color" class="form-control" id="category_color" value="<?php echo isset($categoryData) ? $categoryData['category_color'] : '' ?>" name="category_color">
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
        $('#addcategory').on('click', function() {
            $('#add_category_model').modal('show');
        });
        $('#close').on('click', function() {
            $('#add_category_model').modal('hide');
        });


        //validate form  use validate js and submit data to database
        $('#add_category').validate({
            rules: {
                category_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
            },
            messages: {
                category_name: {
                    required: "Please enter first name",
                },
            },
            submitHandler: function(form) {
                var id = $(this).data("id");
                var formData = new FormData(form);
                showLoader();
                $.ajax({
                    url: "<?php echo base_url('admin/category/add_category'); ?>",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success(data.message);
                            $('#add_category_model').modal('hide');
                                $('#add_category')[0].reset();
                                $('#category_list').DataTable().ajax.reload();
                            hideLoader();
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
        $('#category_list').DataTable({
            searching: true,
            paging: true,
            info: true,
            responsive: true,
            paging: true,
            scrollCollapse: true,
            ajax: {
                url: '<?= base_url('admin/category/get_category_list') ?>',
                type: 'POST',
            },
            columns: [{
                    data: 'SrNo'
                },
                {
                    data: 'Name'
                },
                {
                    data: 'Color'
                },
                {
                    data: 'action'
                }
            ],
        });
    });

    $(document).on("click", ".edit-category", function() {
        var id = $(this).data("id");

        $.ajax({
            url: "<?php echo base_url('admin/category/get_category_data'); ?>",
            type: "POST",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(response) {
                if (response.status === 1) {
                    console.log(response.data);
                    $("#hid").val(response.data.id);
                    $("#category_name").val(response.data.category_name);
                    $("#category_color").val(response.data.category_color);
                    $("#add_category_model").modal("show");
                } else {
                    console.error(response.message);
                }
            },
        });
    });

    $(document).on('click', '.delete-category', function() {
        var category_id = $(this).data('id');

        if (confirm('Are you sure you want to delete this category?')) {
            showLoader();
            $.ajax({
                url: '<?= base_url('admin/category/delete_category') ?>',
                type: 'POST',
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        hideLoader();
                        toastr.success(result.message);
                        $('#category_list').DataTable().ajax.reload();

                    } else {
                        toastr.error(result.message);
                        hideLoader();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
</script>