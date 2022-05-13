<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script>
   document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Data Tidak Boleh Kosong");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
});
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("select");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Data Tidak Boleh Kosong");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
});

</script>


<link href="<?php echo base_url(); ?>assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="section__content section__content--p30">

    <div class="container-fluid">

        <div class="row">

            <!--<br><br> -->

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="breadcome-list single-page-breadcome shadow">

                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                            <div class="breadcome-heading">



                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                            <ul class="breadcome-menu">



                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>



    </div>

    <!-- Main content -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- left column -->

                <div class="col-md-12">

                    <!-- general form elements -->

                    <div class="card card-primary">

                        <div class="card-header" style="background-color: #0565af">

                            <h3 class="card-title">Edit Users</h3>

                        </div>

                        <div class="card-body">
                            <form role="form" action="<?php echo base_url('users/updateData') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">
                                
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label>Name</label>
                                        <input  name="name" id="name" class="form-control" placeholder="username" value = "<?php echo $data->name ?>" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value = "<?php echo $data->email ?>" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Role</label>
                                         <select name="role_name" class="form-control" id="role_name">
                                            <option value="">-select-</option>
                                            <?php foreach($role as $list_role):
                                                if($list_role->id != 3){
                                                ?>
                                        		<option value="<?= $list_role->id?>"
                                        			<?php if ($data->role_id == $list_role->id) : ?> 
                                        				selected
                                        				<?php endif; ?>>
                                        				<?= $list_role->role?>
                                				</option>
                                            <?php
                                                }
                                                endforeach; ?>
                                        </select>
                                        <span class="text-error" id="txt_role"></span>
                                    </div>
                                </div>
                                
                                <p>
                                    <div class="row clearfix">
                                        <div class="col-sm-2">
                                            <input type="hidden" name="id" class="form-control" value="<?php echo $data->id ?>" readonly>
                                            <a href="<?php echo base_url('Users') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>
                                            
                                            <button type="submit" class="btn bg-blue waves-effect" id="kirim_edit">Update</button>
                                        </div>
                                    </div>
                                    <p>
                            </form>


                        </div>

                    </div>
                </div>
            </div>
        </div>
</div><!-- /.container-fluid -->

</section>

