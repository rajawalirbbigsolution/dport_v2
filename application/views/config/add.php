<style type="text/css">
    .text-error {
        font-size: 12px;
        font-style: italic;
        color: red;
        letter-spacing: 0.7px;
        margin-top: 5px;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/kialap/style/order.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/gijgo.min.js"></script>

<link href="<?php echo base_url(); ?>assets/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<div class="section__content section__content--p30">
	<div class="container-fluid">
	    <div class="row">
      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<div class="breadcome-list single-page-breadcome shadow">
       			<div class="row">
	           		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		            	<div class="breadcome-heading"></div>
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
	              		<h3 class="card-title">Add Config</h3>
	            	</div>

    		        <form id="add-module" role="form" action="<?php echo base_url('Config/add_data') ?>" method="post" enctype="multipart/form-data" class="add-arko" autocomplete="off">
			            <div class="card-body">

    	                  	<p>
                        	<div class="row">
                        		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            		<div class="input-mask-title"><label>Company Name</label></div>
                          		</div>
                          		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name">
                                    <span class="text-error" id="txt_company_name"></span>
                          		</div>
                        	</div>
                        	
                        	<p>
                          	<div class="row">
                          		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            		<div class="input-mask-title"><label>IP Address</label></div>
                          		</div>
                          		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" name="ip" id="ip" class="form-control" placeholder="IP Address">
                                    <span class="text-error" id="txt_ip"></span>
                          		</div>
                        	</div>
                        	
                        	<p>
                          	<div class="row">
                          		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            		<div class="input-mask-title"><label>API Key</label></div>
                          		</div>
                          		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <button type="button" class="btn bg-blue waves-effect" id="generatedApiKey">Generated API Key</button>
                            		<textarea rows="5" cols="100%" name="api_key" id="api_key" class="form-control" placeholder="API Key" readonly></textarea>
                            		<span class="text-error" id="txt_api_key"></span>
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
                                        <button type="button" class="btn bg-blue waves-effect"  id="send_edit">Save</button>
                                        <button type="submit" class="btn bg-blue waves-effect" style="display:none;" id="kirim_edit">Save</button>
                                    </div>
                                </div>
                            </div>
                            
						</div>
              </div>

            </form>

          </div>

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
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>


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
	
  	$("#send_edit").click(function(){
        if ($('#company_name').val().length < 1) {
          $('#txt_company_name').text('company name tidak boleh kosong');
        }else{
          $('#txt_company_name').text('');
        }
        if ($('#ip').val().length < 1) {
          $('#txt_ip').text('IP Address tidak boleh kosong');
        }else{
          $('#txt_ip').text('');
        }
        if ($('#api_key').val().length < 1) {
          $('#txt_api_key').text('api key tidak boleh kosong');
        }else{
          $('#txt_api_key').text('');
        }
        
        if($('#company_name').val().length > 1  && $('#ip').val().length > 1 && $('#api_key').val().length > 1 ){
          $("#kirim_edit").click();
        }
   	});
});
</script>