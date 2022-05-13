<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pickadate/themes/classic.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pickadate/themes/classic.date.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pickadate/themes/classic.time.css">

<style>
    a.nav-link {

        color: #a5a5a5;

        text-decoration: none;

        background-color: transparent;

    }


    .card-secondary.card-outline-tabs>.card-header a.active {

        border-top: 3px solid #505254;

        color: #505254;

    }

    table tr td {
        padding: 0.4em 0.4em 0.4em 0.4em !important;
    }

    /*.row{*/
    /*    border-bottom: solid 2px black;*/
    /*}*/

    ul.ui-autocomplete {
        z-index: 1100;
    }

    .text-error {
        color: red;
        font-style: italic;
    }

    @media (min-width: 992px) {

        .modal-lg,
        .modal-xl {
            max-width: 1000px;
        }
    }

    .noscroll {
        position: fixed !important;
        overflow: scroll !important;
        width: 100%;
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
            <!-- <div style="float: left; width: 3%; margin-left: -1%; padding-top: 5px">
                <a href="<?php echo base_url('Product') ?>">
                    <i class="fas fa-arrow-left mb-4" style="color: #0565af !important; font-size: 25px"></i>
                </a>
            </div> -->

            <div class="card" style="width: 97%; float: left">

                <div class="card-body p-0">

                    <div class="table-responsive" style="border-top: none">

                        <table class="table projects" id="data" style="border-top: none">

                            <thead>

                                <tr>
                                    <th colspan="10">
                                        <div class="row p-1">
                                            <div class="col-md-12" style="float: left; width: 3%; margin-left: -1%; padding-top: 5px">
                                                <div class="row" style="color: #0565af !important; font-weight: bold; font-size: 1.1em">
                                                    <div class="col-md-2">
                                                        <p>Promo Name</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p>: <?php echo $promo_data->name ?></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <p>Customer Type</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p>: <?php echo $promo_data->customer_type_name ?></p>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <p>Start Date</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p>: <?php echo date('d F Y', strtotime($promo_data->start_date)) ?></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <p>End Date</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p>: <?php echo date('d F Y', strtotime($promo_data->end_date)) ?></p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <p>Calculation</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p>: <?php echo $promo_data->calculation ?></p>
                                                    </div>
                                                    <input type="hidden" name="promo_id" value="<?php echo $this->input->get('id'); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <!-- <button type="button" class="btn btn-primary btn-dws-add btn-block" data-toggle="modal" data-target="#add-promo">
                                                    <i class="fas fa-plus"></i> Add Detail
                                                </button> -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-promo" data-href="#" style="background-color: palevioletred; border: none"> Add Rules</button>

                                                <a href="<?php echo base_url('Promo'); ?>" class="btn btn-secondary" data-dismiss="modal">Back</a>

                                            </div>
                                        </div>
                                    </th>
                                </tr>

                                <tr>
                                    <th data-field="id" class="no module_name" align="center" style="width: 10%"> # </th>
                                    <th data-field="module_name" data-editable="true" class="module_name" style="width: 60%">PROMO RULES</th>
                                    <th data-field="action" class="module_name" style="width: 30%; text-align: center">ACTION</th>

                                </tr>

                            </thead>

                            <tbody id="body-data-table"></tbody>

                        </table>

                    </div>

                    <div class="card-tools text-center" id="pagination"></div>

                </div>

            </div>

        </div>

    </div>

    <div id="add-promo" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 30px">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                <div class="modal-body">
                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
                    <div class="row" style="padding: 0 2%">
                        <div class="col-md-12">
                            <form method="post" action="<?php echo base_url('Promo/insert_promo_detail') ?>" enctype="multipart/form-data" id="form-add-promo-detail">
                                <div id="page-1">
                                    <div class="row mb-3 p-1">
                                        <h3 style="font-weight: bold; color: #0565af">ADD PROMO PRODUCT VARIANT</h3>
                                    </div>
                                    <div class="row mb-2 p-1" id="add-product-promo-row">
                                        <div class="col-md-12">
                                            <label style="font-size: 16px;font-weight: bold; color: #0565af">Rules</label>
                                        </div>

                                        <div class="row col-md-12">
                                            <div class="col-md-3 pt-2">
                                                <label style="font-size: 14px;font-weight: normal; color:lightgrey">Choose a promo rules</label>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="add_promo_rules" id="add_promo_rules">
                                                    <option value="">-- select --</option>
                                                    <?php foreach ($promo_rules as $pr) {
                                                        echo "<option value='" . $pr->promo_rules_id . "'>" . $pr->promo_rules_name . "</option>";
                                                    } ?>
                                                </select>
                                                <span id="add_promo_rules_error_text" class="text-error"></span>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>

                                        <!-- BREAK -->

                                        <div class="col-md-12 mt-1">
                                            <label style="font-size: 16px;font-weight: bold; color: #0565af">Product Variant</label>
                                        </div>

                                        <!-- BREAK -->

                                        <div class="row col-md-12 mt-1">
                                            <div class="col-md-3 pt-2">
                                                <label style="font-size: 14px;font-weight: normal; color:lightgrey">Please Input SKU Number</label>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-6">
                                                <input class="form-control" id="sku_number">
                                                <span id="add_product_error_text" class="text-error"></span>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>

                                        <!-- BREAK -->

                                        <div class="row col-md-12 mt-1">
                                            <div class="col-md-3 pt-2">
                                                <label style="font-size: 14px;font-weight: normal; color:lightgrey">Product Name</label>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-6">
                                                <input class="form-control" id="product_name" readonly>
                                                <input class="form-control" type="hidden" id="product_id" disabled>
                                                <span id="add_percentage_error_text" class="text-error"></span>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>

                                        <!-- BREAK -->

                                        <div class="row col-md-12 mt-2">
                                            <table class="table" id="variant_product">
                                                <thead>
                                                    <tr>
                                                        <th style="padding-left: 1.2em; width: 5%"> <input type="checkbox" id="check-all-variant"></th>
                                                        <th>Product Description</th>
                                                        <th>Product Colour</th>
                                                        <th>Product Size</th>
                                                        <th>Product Weight</th>
                                                    </tr>
                                                    <tr id="no-row-input">
                                                        <td colspan="5" style="text-align: center">No Data</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="body-form-input">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row col-md-12 mt-5">
                                    <div class="col-md-10 text-right"></div>
                                    <div class="col-md-1 text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <input type="hidden" name="add_promo_header_id" value="<?php echo $this->input->get('id'); ?>">
                                        <input type="hidden" name="add_product_id" value="" id="add_product_id">
                                        <button type="button" id="btn-add-detail-submit" class="btn btn-primary" style="background-color: #FF7F00; border: none"> SAVE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/picker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/picker.date.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/picker.time.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/legacy.js" type="text/javascript"></script>

<script type="text/javascript">
    var baseUrl = "<?php echo base_url() ?>";
    var promoId = "<?php echo $this->input->get('id'); ?>";
    var promoProduct = 0;
    var promoProductCount = 0;
    var listPromoProduct = [];

    var $statusfilter = 0;
    $(document).ready(function() {
        $('.filterbtn').click(function() {
            if ($statusfilter == 0) {
                $('#formfilter').show(999);
                $statusfilter = 1;
            } else {
                $('#formfilter').hide(999);
                $statusfilter = 0;
            }
        });
    });
    setTimeout(function() {
        $("div.alert").remove();
    }, 5000);
</script>

<script src="<?php echo base_url(); ?>assets/js-data/promo/get-edit.js" id="date" </script>