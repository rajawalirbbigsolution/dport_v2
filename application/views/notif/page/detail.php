<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

<style>
    a.nav-link {

        color: #a5a5a5;

        text-decoration: none;

        background-color: transparent;

    }


    .card-secondary.card-outline-tabs > .card-header a.active {

        border-top: 3px solid #505254;

        color: #505254;

    }

    table tr td {
        padding: 0.4em 0.4em 0.4em 0.4em !important;
    }

    .data-collapse{
        padding-left: 2.5em !important;
    }

    .card-menu{
        border-color: transparent;
        box-shadow: none;
        background-color: transparent;
    }

    .tab-header{
        background-color: white;
        height: 50px;
        font-weight: bold;
        padding: 15px 25px;
        border-top-left-radius: 25px !important;
        border-top-right-radius: 25px !important;
        /*transform: skew(45deg);*/
        /*margin: 0 0 0 -20px;*/
        /*-webkit-transform: skew(20deg);*/
        /*-moz-transform: skew(20deg);*/
        /*-o-transform: skew(20deg);*/
        /*overflow: hidden;*/
        position: relative;
        /*margin-right: 5%;*/
    }

    .tab-header:hover{
        background-color: white !important;
    }

    .table th{
        border-top: none !important;
    }

    .search-input{
        border-radius: 15px;
    }

    label:not(.form-check-label):not(.custom-file-label){
        font-weight: normal;
    }

    .input-dws{
        background-color: #e9eef2;
    }
</style>

<section class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <?php echo $this->session->flashdata('notice'); ?>

                <?php echo $this->session->flashdata('successMessageInsert'); ?>

                <?php echo $this->session->flashdata('errorMessageInsert'); ?>

                <?php echo $this->session->flashdata('successMessageUpdate'); ?>

                <?php echo $this->session->flashdata('errorMessageUpdate'); ?>

                <?php echo $this->session->flashdata('errorMessageDataNotfound'); ?>

                <?php if ($this->session->flashdata('errorMessageDataNotfoundArray')) {

                    $errorMessageDataNotfound = $this->session->flashdata('errorMessageDataNotfoundArray');

                    echo '<div class="alert alert-danger alert-mg-b alert-success-style4 alert-st-bg3">

                                <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">

                                    <span class="icon-sc-cl" aria-hidden="true">&times;</span>

                                </button>

                                <i class="fa fa-times edu-danger-error admin-check-pro admin-check-pro-clr3" aria-hidden="true"></i>';

                    for ($i = 0; $i < count($errorMessageDataNotfound); $i++) {

                        echo '<p><strong>Danger! </strong> nama product <span style="color: red;">' . $errorMessageDataNotfound[$i]['name_product'] . '</span> dan variant <span style="color: red;">' . $errorMessageDataNotfound[$i]['variant'] . '</span> tidak ditemukan di Master Product.</p>';
                    }

                    echo '</div>';
                } ?>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            <!--            <div class="card card-menu mb-0" style="border-bottom: none;">-->
            <!--                <div class="card-body p-0" style="border-bottom: none;">-->
            <!--                    <div class="container-fluid p-0">-->
            <!--                        <div class="nav nav-tabs" id="nav-tab" role="tablist" style="padding: 0; border-bottom: none !important;">-->
            <!--                            <a class="nav-link tab-header --><?php //echo $page == 'stock_list' ? "active" : "" ;?><!--" id="nav-stock_list" href="--><?php //echo base_url('Storage')?><!--" role="tab" aria-controls="nav-home" aria-selected="true">Stock List</a>-->
            <!--                            <a class="nav-link tab-header --><?php //echo $page == 'add_stock' ? "active" : "" ;?><!--" id="nav-add_stock" href="--><?php //echo base_url('Storage/add_stock')?><!--" role="tab" aria-controls="nav-profile" aria-selected="false">Add Stock</a>-->
            <!--                            <a class="nav-link tab-header --><?php //echo $page == 'repack_stock' ? "active" : "" ;?><!--" id="nav-repack_stock" href="--><?php //echo base_url('Storage/repack_stock')?><!--" role="tab" aria-controls="nav-contact" aria-selected="false">Re-packing Stock</a>-->
            <!--                            <a class="nav-link tab-header --><?php //echo $page == 'storage' ? "active" : "" ;?><!--" id="nav-storage" href="--><?php //echo base_url('Storage/storage')?><!--" role="tab" aria-controls="nav-contact" aria-selected="false">Storage</a>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="card mt-0" style="border-top: none;border-radius: 25px;--><?php //echo ($page == 'stock_list' ? 'border-top-left-radius:0px' : '')?><!--">-->
            <div class="card mt-0" style="border-top: none;border-radius: 25px">
                <div class="card-body p-0">
                    <div class="table-responsive" style="border-top: none;">

                        <table class="table projects" id="data" style="border-top: none">

                            <thead>

                            <tr>
                                <th colspan="11">
                                    <div class="row p-2">
                                        <!--                <div class="col-md-2">-->
                                        <!--                    <input class="form-control search-input" type="text" placeholder="Promo Name" style="height: 100%">-->
                                        <!--                </div>-->
                                        <!--                <div class="col-md-2">-->
                                        <!--                    <select class="form-control search-input" type="text" placeholder="Promo Name" style="height: 100%">-->
                                        <!--                        <option>PRODUCT NAME</option>-->
                                        <!--                        <option>CATEGORY</option>-->
                                        <!--                        <option>BATCH NUMBER</option>-->
                                        <!--                        <option>EXPIRED DATE</option>-->
                                        <!--                        <option>LOCATION</option>-->
                                        <!--                    </select>-->
                                        <!--                </div>-->
                                        <!--                <div class="col-md-2">-->
                                        <!--                    <button class="btn btn-info btn-block btn-dws-add" style="background-color: #17a2b8 !important;">Search</button>-->
                                        <!--                </div>-->
                                        <!--                <div class="col-md-4">-->
                                        <!--                </div>-->
                                        <div class="col-md-2">
                                            <input type="text" class="form-control form-control-sm" id="parameter" name="code_manifest" placeholder="Parameter">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" name="status" id="filter-params">
                                                    <option value="">--Filter--</option>
                                                    <option value="1">SKU NUMBER</option>
                                                    <option value="2">UPC NUMBER</option>
                                                    <!--                                                    <option value="2">Active Date</option>-->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-default btn-sm" id="filter-promo">
                                                <i class="fa fa-filter" aria-hidden="true"></i> Search
                                            </button>
                                        </div>
                                        <div class="col-md-2"> </div>
<!--                                        <div class="col-md-2 text -->
                                    </div>

                                    <!--            <div class="container-fluid pt-1 pb-1 pr-3 pl-1">-->
                                    <!--                <input type="checkbox" id="check-all" style="vertical-align: middle;position: relative;"> &nbsp;&nbsp;&nbsp;-->
                                    <!--                <a href="#" id="delete-btn" style="color: black"><i class="fas fa-trash"></i></a>-->
                                    <!--            </div>-->
                                </th>
                            </tr>

                            <tr>

                                <!--        <th data-field="id" class="no module_name" align="center"> # </th>-->
<!--                                <th data-field="module_name" data-editable="true" class="module_name">SKU NUMBER</th>-->
<!--                                <th data-field="module_name" data-editable="true" class="module_name">UPC NUMBER</th>-->
<!--                                <th data-field="module_name" data-editable="true" class="module_name">SUPPLIER</th>-->
<!--                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT NAME</th>-->
<!--                                <th data-field="module_name" data-editable="true" class="module_name">CATEGORY</th>-->
                                <th data-field="module_name" data-editable="true" class="module_name">RECEIPT DATE</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT COLOUR</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT SIZE</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT WEIGHT</th>
                                <th data-field="module_name" data-editable="true" class="module_name">QUANTITY</th>
                                <th data-field="module_name" data-editable="true" class="module_name">BATCH NUMBER</th>
                                <th data-field="module_name" data-editable="true" class="module_name">EXPIRED DATE</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT LOCATION</th>
                                <th data-field="action"></th>

                            </tr>

                            </thead>

                            <tbody></tbody>

                        </table>

                    </div>

                    <div class="card-tools text-center" id="pagination"></div>

                </div>

            </div>

        </div>

    </div>

</section>


<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript">
    var baseUrl = "<?php echo base_url()?>";
    var product_supplier_id = "<?php echo $this->input->get('id');?>"
    var product_location_type_id = "<?php echo $this->input->get('plt');?>"
    var $statusfilter = 0;
    $(document).ready(function () {
        $('.filterbtn').click(function () {
            if ($statusfilter == 0) {
                $('#formfilter').show(999);
                $statusfilter = 1;
            } else {
                $('#formfilter').hide(999);
                $statusfilter = 0;
            }
        });
    });
    setTimeout(function () {
        $("div.alert").remove();
    }, 5000);
    $('#collapse-test').click(function (){
        $('#test-append')
        $("<tr><td colspan='9'>TEST</td></tr>").insertAfter('#test-append');
    });
</script>

<script src="<?php echo base_url(); ?>assets/js-data/stock-transfer/get-detail.js" id="date"</script>