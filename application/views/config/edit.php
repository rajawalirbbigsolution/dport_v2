<link rel="stylesheet" href="<?php echo base_url(); ?>assets/kialap/style/order.css">

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

            <div class="card-header">

              <h3 class="card-title">Edit Config</h3>

            </div>

			<br>
			<?php echo $this->session->flashdata('notice'); ?>
			
			
            <form id="add-product" role="form" action="<?php echo base_url('Config/update') ?>" method="post" enctype="multipart/form-data" class="add-department" autocomplete="off">

              <div class="card-body">

                  <div class="row">

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                      <div class="input-mask-title">

                        <label>Company Name</label>

                      </div>

                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                      <div class="input-mark-inner mg-b-22">

                        <input type="text" class="form-control" name="company_name" placeholder="Company Name" value="<?php echo $data->company_name; ?>">
                        <input type="hidden" name="id" value="<?php echo $data->id; ?>">

                        <small class="form-text text-muted"><?php echo form_error('company_name');  ?></small>

                      </div>

                    </div>

                  </div>

                  <p>



                    <div class="row">

                      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                        <div class="input-mask-title">

                          <label>IP Address</label>

                        </div>

                      </div>

                      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                        <div class="input-mark-inner mg-b-22">

                          <input name="ip" type="text" class="form-control" value="<?php echo $data->ip; ?>" placeholder="IP Address">

                          <small class="form-text text-muted"><?php echo form_error('ip');  ?></small>

                        </div>

                      </div>

                    </div>

                    <p>

                      <div class="row">

                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                          <div class="input-mask-title">

                            <label>API Key</label>

                          </div>

                        </div>

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                          <div class="input-mark-inner mg-b-22">
                          
                          	<button type="button" class="btn bg-blue waves-effect" id="generatedApiKey">Generated API Key</button>
                    		<textarea rows="5" cols="100%" name="api_key" id="api_key" class="form-control" placeholder="API Key" readonly><?php echo $data->api_key; ?></textarea>
                    		<span class="text-error" id="txt_api_key"></span>

                          </div>

                        </div>

                      </div>

                      <p>
                          <div class="row">

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                              <div class="input-mask-title">

                                <label></label>

                              </div>

                            </div>

                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                              <div class="input-mark-inner mg-b-22">



                                <a href="<?php echo base_url('Config') ?>" class="btn btn-danger" style="margin-left: 5px;">Back</a>

                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>

                              </div>

                            </div>

                          </div>

              </div>

            </form>

          </div>

          <!-- /.card -->











          <!-- /.card -->



        </div>

        <!--/.col (left) -->



        <!-- /.card -->

      </div>

      <!--/.col (right) -->

    </div>

    <!-- /.row -->

</div><!-- /.container-fluid -->

</section>



<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/gijgo.min.js"></script>

<link href="<?php echo base_url(); ?>assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />



<!-- <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->

<script>
  var loadFile = function(event) {

    var output = document.getElementById('output');

    output.src = URL.createObjectURL(event.target.files[0]);

  };
</script>

<script type="text/javascript">
function generatedID(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
   var charactersLength = characters.length;
   for ( var i = 0; i < 100; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}
	
$(document).ready(function() {
	$("#generatedApiKey").click(function() {
		$('#api_key').val(generatedID(100));
	});
});
</script>