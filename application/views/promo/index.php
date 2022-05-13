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

    .table th {
        border-top: none !important;
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

            <div class="card" style="border-radius: 25px">

                <div class="card-body p-0">

                    <div class="table-responsive" style="border-top: none">

                        <table class="table projects" id="data" style="border-top: none">

                            <thead>

                                <tr>
                                    <th colspan="6">
                                        <div class="row pt-1">
                                            <div class="col-md-2">
                                                <input type="text" class="form-control form-control-sm" id="parameter" name="code_manifest" placeholder="Parameter">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <select class="form-control form-control-sm" name="status" id="filter-params">
                                                        <option value="">--Filter--</option>
                                                        <option value="1">Promo Name</option>
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
                                            <div class="col-lg-2 text-right">
                                                <button type="button" class="btn btn-primary btn-dws-add btn-block" id="add-promo-but">
                                                    <i class="fas fa-plus"></i> Add Promo
                                                </button>
                                            </div>
                                            <div class="col-md-12 pl-3">
                                                <!-- <input type="checkbox" id="check-all" style="vertical-align: middle;position: relative;"> &nbsp;&nbsp;&nbsp;
                                            <a href="#" id="delete-btn" style="color: black"><i class="fas fa-trash"></i></a> -->
                                            </div>
                                        </div>
                                    </th>
                                </tr>

                                <tr>

                                    <th data-field="id" class="no module_name" align="center"> No </th>
                                    <th data-field="module_name" data-editable="true" class="module_name">PROMO NAME</th>
                                    <th data-field="module_name" data-editable="true" class="module_name">PROMO START DATE</th>
                                    <th data-field="module_name" data-editable="true" class="module_name">PROMO END DATE</th>
                                    <th data-field="module_name" data-editable="true" class="module_name">CALCULATION</th>
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


    <div id="add-promo" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 30px">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                <div class="modal-body">
                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
                    <div class="row" style="padding: 2% 6% 4% 6%">
                        <div class="col-md-12">
                            <form method="post" action="<?php echo base_url('Promo/insert') ?>" enctype="multipart/form-data" id="form-add-promo">
                                <div class="row mb-3">
                                    <h3 class="modal-title" style="font-weight: bold; color: #0565af">ADD PROMO</h3>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label style="font-weight: normal; color:lightgrey">Promo Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input maxlength="200" class="form-control" name="add_promo_name" id="add_promo_name">
                                        <span id="add_promo_name_error_text" class="text-error"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 p-1">
                                        <label style="font-weight: normal; color:lightgrey">Promo Period</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" name="add_promo_start" id="add_promo_start">
                                        <span id="add_promo_start_error_text" class="text-error"></span>
                                    </div>
                                    <div class="col-md-1 p-1">
                                        <label style="font-weight: normal; color:lightgrey">To</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" name="add_promo_end" id="add_promo_end">
                                        <span id="add_promo_end_error_text" class="text-error"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label style="font-weight: normal; color:lightgrey">Calculation</label>
                                    </div>
                                    <div class="col-md-9" id="add_calculation_selected">
                                        <select class="form-control" name="add_calculation" id="add_calculation">
                                            <option value="BERTINGKAT">BERTINGKAT</option>
                                            <option value="KOMBINASI">KOMBINASI</option>
                                        </select>
                                        <span id="add_calculation_error_text" class="text-error"></span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <label style="font-weight: normal; color:lightgrey">Customer Type</label>
                                    </div>
                                    <div class="col-md-9" id="add_customer_type_selected">
                                        <select class="form-control" name="add_customer_type" id="add_customer_type">
                                            <?php foreach ($customer_type_list as $cust) {
                                                echo "<option value='" . $cust->customer_type_id . "'>" . $cust->customer_type_name . "</option>";
                                            } ?>
                                        </select>
                                        <span id="add_customer_type_error_text" class="text-error"></span>
                                    </div>
                                </div>
                                <input class="form-control" type="hidden" name="promo_id" id="promo_id">

                                <div class="row mt-3">
                                    <div class="col-md-9">
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        <button type="button" id="btn-add-submit" class="btn btn-primary" style="background-color: #FF7F00; border: none"> SAVE</button>
                                        <button type="submit" class="btn btn-primary" style="background-color: #FF7F00; border: none; display: none"> SAVE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-promo" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 30px">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url('Promo/delete') ?>" enctype="multipart/form-data">
                        <div class="row mb-3 text-center">
                            <h3 class="col-12" style="font-weight: bold;" align="center">DELETE PROMO</h3>
                        </div>
                        <div class="row mb-3 text-center">
                            <h5 class="col-12">Do you want to DELETE this Promo data?</h5>
                        </div>
                        <div class="row mt-3 mb-3">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="delete_id" id="delete_id" value="">
                                <button type="submit" id="btn-edit-submit" class="btn btn-primary" style="background-color: #ed6e00; border: none"> DELETE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="konfirmasi_hapus" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#" style="margin: 1rem 1rem 0 0;"><i class="fa fa-times"></i></a>
                </div>
                <div class="modal-body">
                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
                    <h2>Warning</h2>
                    <p style="font-size: 18px;">
                        <span id="modal-message"></span><b id="modal-name"></b><span>?</span>
                    </p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger btn-ok" style="background-color: red; cursor:pointer;" id="hapus_data">Submit</a>
                    <a class="btn btn-primary" style=" cursor:pointer;" data-dismiss="modal">Cancel</a>
                </div>
            </div>
        </div>
    </div>

    <div id="konfirmasi_hapus_aktif" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#" style="margin: 1rem 1rem 0 0;"><i class="fa fa-times"></i></a>
                </div>
                <div class="modal-body">
                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
                    <h2>Warning</h2>
                    <p style="font-size: 18px;">
                        <span id="modal-message_aktif"></span><b id="modal-name_aktif"></b><span>?</span>
                    </p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger btn-ok" style="background-color: red; cursor:pointer;" id="hapus_data_aktif">Submit</a>
                    <a class="btn btn-primary" style=" cursor:pointer;" data-dismiss="modal">Cancel</a>
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
    $("#add_promo_start").pickadate({
        format: 'd mmmm yyyy',
        min: true
    });
    $("#add_promo_end").pickadate({
        format: 'd mmmm yyyy',
        min: true
    });
</script>
<script src="<?php echo base_url(); ?>assets/js-data/promo/get-index.js" id="date"></script>