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

            <div class="card card-menu mb-0" style="border-bottom: none;">
                <div class="card-body p-0" style="border-bottom: none;">
                    <div class="container-fluid p-0">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist" style="padding: 0; border-bottom: none !important;">
                            <a class="nav-link tab-header <?php echo $page == 'min' ? "active" : "" ;?>" id="nav-stock_list" href="<?php echo base_url('Notification')?>" role="tab" aria-controls="nav-home" aria-selected="true">Minimum Stock</a>
                            <a class="nav-link tab-header <?php echo $page == 'safe' ? "active" : "" ;?>" id="nav-add_stock" href="<?php echo base_url('Notification/safeNotif')?>" role="tab" aria-controls="nav-profile" aria-selected="false">Safety Stock</a>
                            <a class="nav-link tab-header <?php echo $page == 'max' ? "active" : "" ;?>" id="nav-repack_stock" href="<?php echo base_url('Notification/maxNotif')?>" role="tab" aria-controls="nav-contact" aria-selected="false">Maximum Stock</a>
                            <a class="nav-link tab-header <?php echo $page == 'exp' ? "active" : "" ;?>" id="nav-add_stock" href="<?php echo base_url('Notification/expNotif')?>" role="tab" aria-controls="nav-profile" aria-selected="false">Expired Date</a>
<!--                            <a class="nav-link tab-header --><?php //echo $page == 'storage' ? "active" : "" ;?><!--" id="nav-storage" href="--><?php //echo base_url('Storage/storage')?><!--" role="tab" aria-controls="nav-contact" aria-selected="false">Storage</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-0" style="border-top: none;border-radius: 25px;<?php echo ($page == 'min' ? 'border-top-left-radius:0px' : '')?>">
<!--            <div class="card mt-0" style="border-top: none;border-radius: 25px">-->
                <div class="card-body p-0">

                    <?php $this->load->view('notif/page/'.$page); ?>

                </div>

            </div>

        </div>

    </div>

</section>

<?php
    if(isset($modals) && !empty($modals)){
        foreach ($modals as $modal){
            $this->load->view('notif/modals/'.$modal);
        }
    }
?>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript">
    var baseUrl = "<?php echo base_url()?>";
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

