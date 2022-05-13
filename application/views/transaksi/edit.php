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
                                            <li><span class="bread-blod">Ubah Order</span>
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
                                <h1> Edit Order </h1>
                                <form id="add-product" action="<?php echo base_url('Transaksi/update') ?>" method="post" enctype="multipart/form-data" class="add-professors" autocomplete="off">
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
                                                    <input name="code_order" type="text" class="form-control" placeholder="Kode pesanan" value="<?php echo $data[0]->code_order; ?>" disabled="disabled">
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
													<input name="code_product" id="code_product" type="text" class="form-control" value="<?php echo $data[0]->code_product_order; ?>" placeholder="Kode produk">
													<small class="form-text text-muted"><?php echo form_error('code_product');  ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Harga produk</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
													<input name="price_product" id="price_product" type="text" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Berat produk</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
													<input name="weight_product" id="weight_product" type="text" class="form-control" disabled>
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
                                                    <input name="qty" type="text" class="form-control" id="qty" value="<?php echo $data[0]->qty; ?>" placeholder="Jumlah pesanan">
                                                    <small class="form-text text-muted"><?php echo form_error('qty');  ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
										    <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Total Harga</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="price_order" type="text" class="form-control" id="price_order" value="<?php echo $data[0]->product_price; ?>" placeholder="Harga pesanan" readonly="readonly">
                                                    <small class="form-text text-muted"><?php echo form_error('qty');  ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Diskon</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="discount" type="text" class="form-control" id="discount" value="<?php echo $data[0]->discount; ?>" placeholder="Diskon">
                                                    <small class="form-text text-muted"><?php echo form_error('discount');  ?></small>
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
                                                    <input name="name_order" type="text" class="form-control" value="<?php echo $data[0]->name_order; ?>" placeholder="Nama pemesan">
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
                                                    <input name="email" type="text" class="form-control" id="email" placeholder="Email pemesan" value="<?php echo $data[0]->email; ?>" autocomplete="off">
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
                                                    <input name="phone" type="text" class="form-control" id="phone" placeholder="No telepon pemesan" value="<?php echo $data[0]->phone; ?>">
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
                                                    <input name="address" type="text" class="form-control" id="address" value="<?php echo $data[0]->address; ?>" placeholder="Alamat pemesan" >
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
                                                    <select class="form-control" name="state" id="state"></select>
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
                                                     <select class="form-control" name="city" id="city"></select>
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
                                                     <select class="form-control" name="district" id="district"></select>
                                                    <small class="form-text text-muted"><?php echo form_error('district');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Bump</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="bump_price" type="text" class="form-control" id="bump_price" value="<?php echo $data[0]->bump_price; ?>" placeholder="bump">
                                                    <small class="form-text text-muted"><?php echo form_error('bump_price');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>payment method</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <select class="form-control" name="payment_method">
														<option value="Cod" <?php if($data[0]->payment_method == "Cod"){ echo 'selected=" selected"';} ?>>Cod</option>
														<option value="Hutang" <?php if($data[0]->payment_method == "Hutang"){ echo 'selected=" selected"';} ?>>Hutang</option>
														<option value="Bank Transfer" <?php if($data[0]->payment_method == "Bank Transfer"){ echo 'selected=" selected"';} ?>>Bank Transfer</option>
													</select>
													<small class="form-text text-muted"><?php echo form_error('payment_method');  ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Kurir</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <select class="form-control" name="kurir" id="kurir">
														<option value="jne" <?php if($data[0]->kurir_name == "JNE" || $data[0]->kurir_name == "jne"){ echo 'selected=" selected"';} ?>>JNE</option>
														<option value="jnt" <?php if($data[0]->kurir_name == "J&T" || $data[0]->kurir_name == "jnt"){ echo 'selected=" selected"';} ?>>J&T</option>
													</select>
													<small class="form-text text-muted"><?php echo form_error('kurir');  ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>Ongkir</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <input name="ongkir" type="text" class="form-control" id="ongkir" placeholder="ongkir" value="<?php echo $data[0]->shipping_cost; ?>" readonly="readonly">
                                                    <small class="form-text text-muted"><?php echo form_error('ongkir');  ?></small>
                                                </div>
                                            </div>
                                        </div>
										<p>
										<div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label>payment status</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
                                                    <select class="form-control" name="payment_status">
														<option value="1" <?php if($data[0]->payment_status == 1){ echo 'selected=" selected"';} ?>>Paid</option>
														<option value="2" <?php if($data[0]->payment_status == 2){ echo 'selected=" selected"';} ?>>unpaid</option>
													</select>
													<small class="form-text text-muted"><?php echo form_error('payment_status');  ?></small>
                                                </div>
												<input name="id" type="hidden" class="form-control" id="gross_revenue" value="<?php echo $data[0]->id; ?>">
                                                    
                                            </div>
                                        </div>
										
										
                                      
                                        <p>
                                        <p><p><br>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <div class="input-mask-title">
                                                    <label></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <div class="input-mark-inner mg-b-22">
												
                                                    <a href="<?php echo base_url('Transaksi') ?>" class="btn btn-danger" style="margin-left: 5px;">Batal</a>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
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
            
            $('#price_order').autoNumeric('init', {
                        decimalCharacterAlternative: '&',
                        aSep: '.', 
                        aDec: ',',
                        aForm: true,
                        vMax: '999999999',
                        vMin: '-999999999'
            });
            
            $('#qty').change(function() {
                if($('#qty').val() != '' && $('#qty').val() != '0' && $('#price_product').val() != '' && $('#price_product').val() != '0'){
                    $('#price_order').val(parseInt($('#price_product').val().replace(/\./g, '')) * parseInt($('#qty').val().replace(/\./g, '')));
                    $('#price_order').autoNumeric('update', {
                                decimalCharacterAlternative: '&',
                                aSep: '.', 
                                aDec: ',',
                                aForm: true,
                                vMax: '999999999',
                                vMin: '-999999999'
                    });
                }
            });
            
            $('#ongkir').autoNumeric('init', {
                        decimalCharacterAlternative: '&',
                        aSep: '.', 
                        aDec: ',',
                        aForm: true,
                        vMax: '999999999',
                        vMin: '-999999999'
                    });
            
            $('#price_product').autoNumeric('init', {
                        decimalCharacterAlternative: '&',
                        aSep: '.', 
                        aDec: ',',
                        aForm: true,
                        vMax: '999999999',
                        vMin: '-999999999'
                    });
                    
            $('#weight_product').autoNumeric('init', {
                        decimalCharacterAlternative: '&',
                        aSep: '.', 
                        aDec: ',',
                        aForm: true,
                        vMax: '999999999',
                        vMin: '-999999999'
                    });
            
            $.ajax({
                type: "GET",
                url: "<?php echo site_url('Transaksi/searchDataProductByCode');?>",
                cache: "false",
                dataType: "json",
                data: { data: $('#code_product').val() },
                success: function(data) {
                    $('[name="price_product"]').val(data.price);
                     $('[name="price_product"]').autoNumeric('update', {
                        decimalCharacterAlternative: '&',
                        aSep: '.', 
                        aDec: ',',
                        aForm: true,
                        vMax: '999999999',
                        vMin: '-999999999'
                    });
                    $('[name="weight_product"]').val(data.weight);
                    $('[name="weight_product"]').autoNumeric('update', {
                        decimalCharacterAlternative: '&',
                        aSep: '.', 
                        aDec: ',',
                        aForm: true,
                        vMax: '999999999',
                        vMin: '-999999999'
                    });
                }
            }); 

            $('#code_product').autocomplete({
                source: "<?php echo site_url('Transaksi/searchDataProduct');?>",
     
                select: function (event, ui) {
                    $('[name="code_product"]').val(ui.item.label);
                    $('[name="price_product"]').val(ui.item.price);
                    $('[name="price_product"]').autoNumeric('update', {
                        decimalCharacterAlternative: '&',
                        aSep: '.', 
                        aDec: ',',
                        aForm: true,
                        vMax: '999999999',
                        vMin: '-999999999'
                    });
                    $('[name="weight_product"]').val(ui.item.weight);
                    $('[name="weight_product"]').autoNumeric('update', {
                        decimalCharacterAlternative: '&',
                        aSep: '.', 
                        aDec: ',',
                        aForm: true,
                        vMax: '999999999',
                        vMin: '-999999999'
                    });
                    
                    if($('#qty').val() != '' && $('#qty').val() != '0' && $('#price_product').val() != '' && $('#price_product').val() != '0'){
                        $('#price_order').val(parseInt($('#price_product').val().replace(/\./g, '')) * parseInt($('#qty').val().replace(/\./g, '')));
                        $('#price_order').autoNumeric('update', {
                                    decimalCharacterAlternative: '&',
                                    aSep: '.', 
                                    aDec: ',',
                                    aForm: true,
                                    vMax: '999999999',
                                    vMin: '-999999999'
                        });
                    }
                    checkCost();
                }
            });

        $('#discount').autoNumeric('init', {
            decimalCharacterAlternative: '&',
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });
        
        $('#qty').autoNumeric('init', {
            decimalCharacterAlternative: '&',
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999',
            vMin: '-999'
        });
        
        $('#bump_price').autocomplete({
                source: "<?php echo site_url('Transaksi/searchDataProduct');?>",
     
                select: function (event, ui) {
                    $('[name="bump_price"]').val(ui.item.label);
                }
            });
        
        $('#cod_cost').autoNumeric('init', {
            decimalCharacterAlternative: '&',
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });
        
        $.ajax({
            type: "GET",
            url: "<?php echo site_url('Transaksi/getProvince');?>",
            cache: "false",
            dataType: "json",
            success: function(data) {
                $.each(data, function (key, entry) {
                    $('#state').append($('<option></option>').attr('value', entry.id+'+'+entry.name).text(entry.name));
                })
                
                $("#state option").filter(function() {
                    return this.text == "<?php echo $data[0]->state; ?>"; 
                }).attr('selected', true);
                
                callCity();
                
            }
        }); 
        
        function callCity(){
            $.ajax({
                    type: "GET",
                    url: "<?php echo site_url('Transaksi/getCityEdit');?>",
                    cache: "false",
                    dataType: "json",
                    data: { prov_id: "<?php echo $data[0]->state; ?>" },
                    success: function(data) {
                        $.each(data, function (key, entry) {
                            $('#city').append($('<option></option>').attr('value', entry.id+'+'+entry.name).text(entry.name));
                        })
                        
                        $("#city option").filter(function() {
                            return this.text == "<?php echo $data[0]->city; ?>"; 
                        }).attr('selected', true);
                        
                        callDistrict();
                    }
            });
        }
        
        function callDistrict(){
            if($('#city').val() != ''){
                var citys = $('#city').val().split("+");
                $.ajax({
                        type: "GET",
                        url: "<?php echo site_url('Transaksi/getDistrict');?>",
                        cache: "false",
                        dataType: "json",
                        data: { city_id: citys[0] },
                        success: function(data) {
                            $.each(data, function (key, entry) {
                                $('#district').append($('<option></option>').attr('value', entry.id+'+'+entry.name).text(entry.name));
                            })
                            
                            $("#district option").filter(function() {
                                return this.text == "<?php echo $data[0]->district; ?>"; 
                            }).attr('selected', true);
                        }
                });         
            }
        }
        
        $('#state').on('change', function() {
              if($(this).val() != ''){
                    var value = $(this).val().split("+");
                    $('#city').find('option').remove().end();
                    $('#district').find('option').remove().end();
                    $('#ongkir').val("");
                    
                     $.ajax({
                        type: "GET",
                        url: "<?php echo site_url('Transaksi/getCity');?>",
                        cache: "false",
                        dataType: "json",
                        data: { prov_id: value[0] },
                        success: function(data) {
                            $('#city').append($('<option></option>').attr('value', "").text("--pilih--"));
                            $.each(data, function (key, entry) {
                                $('#city').append($('<option></option>').attr('value', entry.id+'+'+entry.name).text(entry.name));
                            })
                        }
                  });       
              }
        });
        
        $('#city').on('change', function() {
              var value = $(this).val();
              if(value != ''){
                  
                    var value = $(this).val().split("+");
                    $('#district').find('option').remove().end();
                    $('#ongkir').val("");
                    
                     $.ajax({
                        type: "GET",
                        url: "<?php echo site_url('Transaksi/getDistrict');?>",
                        cache: "false",
                        dataType: "json",
                        data: { city_id: value[0] },
                        success: function(data) {
                            $('#district').append($('<option></option>').attr('value', "").text("--pilih--"));
                            $.each(data, function (key, entry) {
                                $('#district').append($('<option></option>').attr('value', entry.id+'+'+entry.name).text(entry.name));
                            })
                        }
                  });       
              }
        });
        
        $('#kurir').on('change', function() {
            checkCost();  
        });  
        
        $('#district').on('change', function() {
            checkCost(); 
        });  
        
        $('#qty').change(function(){
          checkCost();
        });
        
        function checkCost(){
            var courier = $('#kurir').val();
            var district = $('#district').val();
            var origin = 54;
            var weight = $('#weight_product').val().replace(/\./g, '');
            var qty = $('#qty').val();
            var state = $('#state').val();
            
            if(courier != '' && weight != '' && district != '' && state  != '' && qty  != '' && qty  != '0'){
                
                 $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Transaksi/getCost');?>",
                        cache: "false",
                        dataType: "json",
                        data :  {'destination' : $('#district').val().split("+")[0], 'courier' : courier, 'origin' : origin, 'weight' : parseInt(weight) * parseInt(qty), provinsi: $('#state').val().split("+")[1]},
                        success: function(data) {
                            if(data.code == '200'){
                                $('#ongkir').val(data.harga);
                                $('[name="ongkir"]').autoNumeric('update', {
                                    decimalCharacterAlternative: '&',
                                    aSep: '.', 
                                    aDec: ',',
                                    aForm: true,
                                    vMax: '999999999',
                                    vMin: '-999999999'
                                }); 
                            }else if(data.code == '500'){
                                alert('Shipper di provinsi '+$('#state').val().split("+")[1]+' tidak ada');
                            }else if(data.code == '400'){
                                alert('Gagal mengambil data ongkir');
                            }
                        },
                        error: function (request, status, error) {
                                // alert(request.responseText);
                        }
                  });   
                
                
            }
        }
        
    });
</script>