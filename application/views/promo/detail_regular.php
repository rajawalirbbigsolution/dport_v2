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


    .card-secondary.card-outline-tabs > .card-header a.active {

        border-top: 3px solid #505254;

        color: #505254;

    }

    /*table tr td {*/
    /*    padding: 0.4em 0.4em 0.4em 0.4em !important;*/
    /*}*/
    /*.row{*/
    /*    border-bottom: solid 2px black;*/
    /*}*/

    ul.ui-autocomplete {
        z-index: 1100;
    }

    .text-error{
        color: red;
        font-style: italic;
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
            <div style="width: 3%; padding-top: 5px; padding-left: 5px">
                <a href="<?php echo base_url('Promo/edit?id=').$this->input->get('id'); ?>">
                    <i class="fas fa-arrow-left mb-4" style="color: #0565af !important; font-size: 25px"></i>
                </a>
            </div>

            <div class="card">

                <div class="card-body p-0">

                    <div class="table-responsive" style="border-top: none">

                        <table class="table projects" id="data" style="border-top: none">

                            <thead>

                            <tr>
                                <th colspan="10">
                                    <div class="row p-1">
                                        <div class="col-md-12">
                                            <div class="row" style="color: #0565af !important; font-weight: normal; font-size: 1.1em">
                                                <div class="col-md-2">
                                                    <p>Promo Name</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>: &nbsp; <?php echo $promo_data->name ;?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <p>Customer Type</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>: &nbsp; <?php echo $promo_data->customer_type_name?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <p>Promo Start Date</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>: &nbsp;<?php echo date('d F Y', strtotime($promo_data->start_date))?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <p>Promo End Date</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>: &nbsp; <?php echo date('d F Y', strtotime($promo_data->end_date))?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <p>Calculation</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>: &nbsp; <?php echo $promo_data->calculation?></p>
                                                </div>
                                                <div class="col-md-2">
                                                    <p>Promo Rules</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>: &nbsp; <?php echo $promo_rules_name?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                            </tr>

                            <tr>
                                <th data-field="module_name" data-editable="true" class="module_name">#</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT NAME</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT DESCRIPTION</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT COLOUR</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT WEIGHT</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT SIZE</th>
                                <th data-field="module_name" data-editable="true" class="module_name">DISCOUNT TYPE</th>
                                <th data-field="module_name" data-editable="true" class="module_name">VALUE</th>
                                <th data-field="module_name" data-editable="true" class="module_name">MAX VALUE PROMO</th>
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


</section>

<div id="edit-regular" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 30px">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>
                <div class="row" style="padding: 2% 6% 4% 6%">
                    <div class="col-md-12">
                        <form method="post" action="<?php echo base_url('Promo/updateRegularPromo')?>" enctype="multipart/form-data" id="form-edit-promo-regular">
                            <div class="row mb-3">
                                <h3 style="font-weight: bold; color: #0565af">REGULAR PROMO</h3>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label style="font-weight: normal; color:lightgrey">Discount Type</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" id="discount_type" name="discount_type">
                                        <option value="">--select--</option>
                                        <?php
                                            foreach ($discount_type as $type){ ?>
                                            <option value="<?php echo $type->type_discount_id;?>"><?php echo $type->discount_name;?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                    <span id="discount_type_error_text" class="text-error"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 p-1">
                                    <label style="font-weight: normal; color:lightgrey">Value</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" name="value" id="value">
                                    <span id="value_error_text" class="text-error"></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    <label style="font-weight: normal; color:lightgrey">Max Value</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" name="max_value" id="max_value">
                                    <span id="max_promo_value_error_text" class="text-error"></span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-9">
                                </div>
                                <div class="col-md-3 text-right">
                                    <input type="hidden" name="promo_d_id" id="promo_d_id" value="">
                                    <input type="hidden" name="redirect" id="redirect" value="<?php echo '?id='.$this->input->get('id').'&ri='.$this->input->get('ri')?>">
                                    <button type="button" id="btn-edit-submit" class="btn btn-primary" style="background-color: #6cbd45; border: none"> SAVE</button>
                                    <button type="submit" class="btn btn-primary" style="background-color: #6cbd45; border: none; display: none"> SAVE</button>
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
                <form method="post" action="<?php echo base_url('Promo/delete_promo_detail')?>" enctype="multipart/form-data">
                    <div class="row mb-3 text-center">
                        <h3 class="col-12" style="font-weight: bold;" align="center">DELETE PROMO DETAIL</h3>
                    </div>
                    <div class="row mb-3 text-center">
                        <h5 class="col-12" >Do you want to DELETE this Promo detail data?</h5>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-md-12 text-center">
                            <input type="hidden" name="redirect" value="<?php echo $this->input->get('id').'&ri=1';?>">
                            <input type="hidden" name="delete_id" id="delete_id" value="">
                            <button type="submit" id="btn-edit-submit" class="btn btn-primary" style="background-color: #ed6e00; border: none"> DELETE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
    var baseUrl = "<?php echo base_url()?>";
    var promoId = "<?php echo $this->input->get('id');?>";
    var promoRulesId = "<?php echo $this->input->get('ri');?>";
    var promoProduct = 0;
    var promoProductCount = 0;
    var listPromoProduct = [];

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

    $( "#add_promo_start" ).pickadate({
        // monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        format: 'd mmmm yyyy',
        min: true
    });


    $( "#add_promo_end" ).pickadate({
        // monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        format: 'd mmmm yyyy',
        min: true
    });
</script>

<script src="<?php echo base_url(); ?>assets/js-data/promo/get-edit-detail-regular.js" id="date"</script>
