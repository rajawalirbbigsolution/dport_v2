<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

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
    table tr td{
        padding: 0.4em 0.4em 0.4em 0.4em !important;
    }
</style>

<div class="content-header" style="padding: 0;">
    <div class="container-fluid" >
<!--        <div class="row mb-3" style="padding: 0">-->
<!--            <div class="col-lg-12">-->
<!--                <ol class="breadcrumb">-->
<!--                    <li class=""><a style="font-size: 32px;  font-weight: bold; color: #0565af"-->
<!--                                                   href="#">--><?php //echo $title; ?><!--</a></li>-->
<!--                </ol>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row mb-3" style="padding: 0">-->
<!--            <div class="col-lg-12 text-right">-->
<!--                <a href="--><?php //echo base_url('Role/add') ?><!--">-->
<!--                    <button type="button" class="btn btn-primary btn-sm" style="background-color: #0565af !important;">-->
<!--                        <i class="fa fa-add" aria-hidden="true"></i> TAMBAH DATA-->
<!--                    </button>-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>

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

                    <div class="table-responsive">

                        <div class="container-fluid">
                            <div class="row p-3">
<!--                                <div class="col-md-2">-->
<!--                                    <input type="text" class="form-control form-control-sm" id="parameter" name="code_manifest" placeholder="Parameter">-->
<!--                                </div>-->
<!--                                <div class="col-md-2">-->
<!--                                    <div class="form-group">-->
<!--                                        <select class="form-control form-control-sm" name="status" id="id_filter">-->
<!--                                            <option value="0">--Filter--</option>-->
<!--                                            <option value="1">Name</option>-->
<!--                                            <option value="2">Role</option>-->
<!--                                            <option value="3">Email</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="col-md-4">-->
<!--                                    <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="filter-users">-->
<!--                                        <i class="fa fa-filter" aria-hidden="true"></i> Search-->
<!--                                    </button>-->
<!--                                </div>-->
                                <div class="col-md-10"></div>
                                <div class="col-md-2">
                                    <a href="<?php echo base_url('Role/add') ?>" type="button" class="btn btn-primary btn-dws-add btn-block">
                                        <i class="fas fa-plus"></i> Add Role
                                    </a>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped projects" id="data">

                            <thead>

                                <tr>

                                <tr>

                                    <th data-field="id" class="no" align="center">No</th>
                                    <th data-field="module_name" data-editable="true" class="module_name">Role</th>
<!--                                    <th data-field="module_name" data-editable="true" class="module_name">Deskripsi</th>-->
                                    <th data-field="action">Action</th>

                                </tr>

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



    <div id="konfirmasi_hapus" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-close-area modal-close-df">

                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>

                </div>

                <div class="modal-body">

                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>

                    <h2>Warning</h2>

                    <div class="modal-body">
                        <b class="message"></b><br>
                    </div>


                </div>

                <div class="modal-footer">

                    <a class="btn btn-danger btn-ok" style="background-color: red;"> Yes</a>

                    <a class="btn btn-primary" data-dismiss="modal"> No</a>

                </div>

            </div>

        </div>

    </div>



    <div id="konfirmasi_cancel" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-close-area modal-close-df">

                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>

                </div>

                <div class="modal-body">

                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>

                    <h2>Peringatan</h2>

                    <p>

                        <span class="message" style="font-size: 18px;"></span>

                        <b class="action" style="margin-left: 5px; margin-right: 5px; font-size: 18px; color: red;"></b> order

                        <b class="name" style="margin-left: 5px; margin-right: 5px; font-size: 18px;"></b><span style="font-size: 18px;">?</span>

                </div>

                <div class="modal-footer">

                    <a class="btn btn-danger btn-ok" style="background-color: red;"> Ya</a>

                    <a class="btn btn-primary" data-dismiss="modal"> Tidak</a>

                </div>

            </div>

        </div>

    </div>



    <div id="konfirmasi_success" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-close-area modal-close-df">

                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>

                </div>

                <div class="modal-body">

                    <span class="educate-icon educate-warning modal-check-pro information-icon-pro"></span>

                    <h2>Peringatan</h2>

                    <p>

                        <span class="message" style="font-size: 18px;"></span>

                        <b class="action" style="margin-left: 5px; margin-right: 5px; font-size: 18px; color: green;"></b>

                        <b class="name" style="margin-right: 5px; font-size: 18px;"></b><span style="font-size: 18px;">?</span>

                </div>

                <div class="modal-footer">

                    <a class="btn btn-danger btn-ok" style="background-color: red;"> Ya</a>

                    <a class="btn btn-primary" data-dismiss="modal"> Tidak</a>

                </div>

            </div>

        </div>

    </div>



</section>





<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js-data/role/get-index.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
<script type="text/javascript">
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
        $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
            var message = $(e.relatedTarget).data('message');
            $(e.currentTarget).find('.message').text(message);
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
    setTimeout(function() {
        $("div.alert").remove();
    }, 5000);
</script>