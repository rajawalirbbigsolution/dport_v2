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

            <div class="card">

                <div class="card-body p-0">

                    <div class="table-responsive" style="border-top: none">

                        <table class="table projects" id="data" style="border-top: none">

                            <thead>

                            <tr>
                                <th colspan="7">
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
                                            </div>
<!--                                            <table class="table table-borderless">-->
<!--                                                <thead style="font-weight: normal; font-size: 1.3em; color: #0565af">-->
<!--                                                <tr>-->
<!--                                                    <td colspan="2"><h1><u>PROMO DETAIL</u></h1></td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td style="width: 25%">Promo Name</td>-->
<!--                                                    <td>--><?php //echo $promo_data->name?><!--</td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td>Promo Start Date</td>-->
<!--                                                    <td>--><?php //echo date('d F Y', strtotime($promo_data->start_date))?><!--</td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td>Promo End Date</td>-->
<!--                                                    <td>--><?php //echo date('d F Y', strtotime($promo_data->end_date))?><!--</td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td>Calculation</td>-->
<!--                                                    <td>--><?php //echo $promo_data->calculation?><!--</td>-->
<!--                                                </tr>-->
<!--                                                <tr>-->
<!--                                                    <td>Customer Type</td>-->
<!--                                                    <td>--><?php //echo $promo_data->customer_type_name?><!--</td>-->
<!--                                                </tr>-->
<!--                                                </thead>-->
<!--                                            </table>-->
                                        </div>
<!--                                        <div class="col-lg-2 p-0">-->
<!--                                            <h4>Promo </h4>-->
<!--                                        </div>-->
<!--                                        <div class="col-lg-1 p-0">-->
<!--                                            <h4>:</h4>-->
<!--                                        </div>-->
<!--                                        <div class="col-lg-9 p-0">-->
<!--                                            <h4>--><?php //echo $promo_data->name?><!--</h4>-->
<!--                                        </div>-->
                                    </div>

<!--                                    <div class="container-fluid p-3">-->
<!--                                        <input type="checkbox" id="check-all" style="vertical-align: middle;position: relative;"> &nbsp;&nbsp;&nbsp;-->
<!--                                        <a href="#" id="delete-btn" style="color: black"><i class="fas fa-trash"></i></a>-->
<!--                                    </div>-->
                                </th>
                            </tr>

                            <tr>
                                <th data-field="module_name" data-editable="true" class="module_name">PROMO RULES</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT UOM NAME</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT COLOUR</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT WEIGHT</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PRODUCT SIZE</th>
                                <th data-field="module_name" data-editable="true" class="module_name">PERCENTAGE</th>
                                <th data-field="module_name" data-editable="true" class="module_name">MAX VALUE PROMO</th>
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

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/picker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/picker.date.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/picker.time.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/pickadate/legacy.js" type="text/javascript"></script>

<script type="text/javascript">
    var baseUrl = "<?php echo base_url()?>";
    var promoId = "<?php echo $this->input->get('id');?>";
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

<script src="<?php echo base_url(); ?>assets/js-data/promo/get-view.js" id="date"</script>
