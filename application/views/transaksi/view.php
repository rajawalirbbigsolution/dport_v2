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
                                            <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">View Order</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list mt-b-30 shadow">
                            <div class="sparkline12-graph">
                                <h1> View Order </h1>
                                <form id="add-product" action="<?php echo base_url('Transaksi/update') ?>" method="post" enctype="multipart/form-data" class="add-professors" autocomplete="off" disabled="disabled">
                                    <div class="input-knob-dial-wrap">
                                        <p>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Kode Pesanan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="code_order" type="text" class="form-control" value="<?php echo $data[0]->code_order; ?>" disabled="disabled">
                                                    <small class="form-text text-muted"><?php echo form_error('code_order');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Kode produk</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
													<input name="code_product" id="code_product" type="text" class="form-control" value="<?php echo $data[0]->code_product_order; ?>" placeholder="Kode produk" disabled="disabled">
													<small class="form-text text-muted"><?php echo form_error('code_product');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Nama Pemesan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="name_order" type="text" class="form-control" value="<?php echo $data[0]->name_order; ?>" disabled="disabled">
                                                    <small class="form-text text-muted"><?php echo form_error('name_order');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="email" type="text" class="form-control" id="email" value="<?php echo $data[0]->email; ?>" autocomplete="off" disabled="disabled">
                                                    <small class="form-text text-muted"><?php echo form_error('email');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Phone</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $data[0]->phone; ?>" data-mask="9999-9999-9999" disabled="disabled">
                                                    <small class="form-text text-muted"><?php echo form_error('phone');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>address</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="address" type="text" class="form-control" id="address" value="<?php echo $data[0]->address; ?>" disabled="disabled">
                                                    <small class="form-text text-muted"><?php echo form_error('address');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Provinsi</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <select class="form-control" name="state" disabled="disabled">
														<option value="Jawa Barat" <?php if($data[0]->state == "Jawa Barat"){ echo 'selected=" selected"';} ?>>Jawa Barat</option>
														<option value="Jakarta" <?php if($data[0]->state == "Jakarta"){ echo 'selected=" selected"';} ?>>Jakarta</option>
													</select>
                                                    <small class="form-text text-muted"><?php echo form_error('state');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Kota</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                     <select class="form-control" name="city" disabled="disabled">
														<option value="Bekasi" <?php if($data[0]->city == "Bekasi"){ echo 'selected=" selected"';} ?>>Bekasi</option>
														<option value="Kab Bekasi" <?php if($data[0]->city == "Kab Bekasi"){ echo 'selected=" selected"';} ?>>Kab Bekasi</option>
														<option value="Cikarang" <?php if($data[0]->city == "Cikarang"){ echo 'selected=" selected"';} ?>>Cikarang</option>
													</select>
                                                    <small class="form-text text-muted"><?php echo form_error('city');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Kecamatan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                     <select class="form-control" name="district"disabled="disabled" >
														<option value="Sukatani" <?php if($data[0]->district == "Sukatani"){ echo 'selected=" selected"';} ?>>Sukatani</option>
													</select>
                                                    <small class="form-text text-muted"><?php echo form_error('district');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Jumlah Pesanan</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="qty" type="text" class="form-control" id="qty" value="<?php echo $data[0]->qty; ?>" disabled="disabled">
                                                    <small class="form-text text-muted"><?php echo form_error('qty');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>variation</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="variation" type="text" class="form-control" id="variation" value="<?php echo $data[0]->variation; ?>" disabled="disabled">
                                                    <small class="form-text text-muted"><?php echo form_error('variation');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>No Resi</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="gross_revenue" type="text" class="form-control" id="gross_revenue" value="<?php echo $data[0]->receipt_number; ?>" disabled="disabled">
                                                    <small class="form-text text-muted"><?php echo form_error('gross_revenue');  ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Status No Resi</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="gross_revenue" type="text" class="form-control" id="gross_revenue" value="<?php echo $data[0]->receipt_number; ?>" disabled="disabled">
                                                    <small class="form-text text-muted"><?php echo form_error('gross_revenue');  ?></small>
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        $(document).ready(function(){

            $('#code_product').autocomplete({
                source: "<?php echo site_url('Transaksi/searchDataProduct');?>",
     
                select: function (event, ui) {
                    $('[name="code_product"]').val(ui.item.label);
                }
            });

        });
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#discount').autoNumeric('init', {
            decimalCharacterAlternative: '&',
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '99',
            vMin: '-99'
        });
        
        $('#qty').autoNumeric('init', {
            decimalCharacterAlternative: '&',
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999',
            vMin: '-999'
        });
        
        $('#bump_price').autoNumeric('init', {
            decimalCharacterAlternative: '&',
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });
        
        $('#cod_cost').autoNumeric('init', {
            decimalCharacterAlternative: '&',
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });
        
        $('#net_revenue').autoNumeric('init', {
            decimalCharacterAlternative: '&',
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });
        
        $('#gross_revenue').autoNumeric('init', {
            decimalCharacterAlternative: '&',
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });
        
    });
</script>