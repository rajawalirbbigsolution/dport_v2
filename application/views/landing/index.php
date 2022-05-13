<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<style>
    ul{
        list-style-type: none;
        padding-left:  0;
    }
    ul li{
        margin-bottom: 5px;
    }
    /*.my-card {*/
    /*    border: 1px solid grey;*/
    /*}*/
</style>

<section class="content">
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-md-3">-->
<!--                <div class="card" style="border-left: solid 5px #f0892f;">-->
<!--                    <div class="card-body">-->
<!--                        TOTAL KSM PENEMERIMA BST <br>-->
<!--                        <h5><b>--><?php //echo $total_kpm ;?><!--</b></h5>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!--                <div class="card" style="border-left: solid 5px #8dca4e;">-->
<!--                    <div class="card-body">-->
<!--                        SUDAH MENERIMA BST <br>-->
<!--                        <h5><b>--><?php //echo $total_completed_kpm ;?><!--</b></h5>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!--                <div class="card" style="border-left: solid 5px #fad248;">-->
<!--                    <div class="card-body">-->
<!--                        DANA DIKIRIMKAN <br>-->
<!--                        <h5><b>RP --><?php //echo number_format($total_fund, 2, '.','.') ;?><!--</b></h5>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!--                <div class="card" style="border-left: solid 5px #41abe5;">-->
<!--                    <div class="card-body">-->
<!--                        DANA DISALURKAN <br>-->
<!--                        <h5><b>RP --><?php //echo number_format($total_distribute, 2, '.','.') ;?><!--</b></h5>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-6">-->
<!--                <div class="card my-card">-->
<!--                    <div class="card-body" style="">-->
<!--                        <div class="row">-->
<!--                            <div class="col-12">-->
<!--                                <h5><b>5 PROVINSI TERTINGGI KSM PENERIMA BST</b></h5>-->
<!--                            </div>-->
<!--                            <div class="col-12">-->
<!--                                --><?php //if($top_rank_ksm){
//                                    foreach ($top_rank_ksm as $key => $value){ ?>
<!--                                        <div class="row mt-2">-->
<!--                                            <div class="col-4">-->
<!--                                                --><?php //echo $value->provinsi; ?>
<!--                                            </div>-->
<!--                                            <div class="col-8">-->
<!--                                                <div class="progress">-->
<!--                                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="--><?php //echo $value->count; ?><!--" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                                                </div>-->
<!--                                                <span style="text-align: right">--><?php //echo $value->count; ?><!--</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    --><?php
//                                    }
//                                }?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-6">-->
<!--                <div class="card my-card">-->
<!--                    <div class="card-body" style="">-->
<!--                        <div class="row">-->
<!--                            <div class="col-12">-->
<!--                                <h5><b>5 PROVINSI TERENDAH KSM PENERIMA BST</b></h5>-->
<!--                            </div>-->
<!--                            <div class="col-12">-->
<!--                                --><?php //if($low_rank_ksm){
//                                    foreach ($low_rank_ksm as $key => $value){ ?>
<!--                                        <div class="row mt-2">-->
<!--                                            <div class="col-4">-->
<!--                                                --><?php //echo $value->provinsi; ?>
<!--                                            </div>-->
<!--                                            <div class="col-8">-->
<!--                                                <div class="progress">-->
<!--                                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="--><?php //echo $value->count; ?><!--" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--                                                </div>-->
<!--                                                <span style="text-align: right">--><?php //echo $value->count; ?><!--</span>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        --><?php
//                                    }
//                                }?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-6">-->
<!--                <div class="card" style="background-color: #ee7200;">-->
<!--                    <div class="card-body" style="color :white;">-->
<!--                        <div class="row">-->
<!--                            <div class="col-12">-->
<!--                                <h5>TOTAL DROP POIN <br>-->
<!--                                    <b> --><?php //echo $total_drop_point; ?><!--</b>-->
<!--                                </h5>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-6">-->
<!--                <div class="card" style="background-color: #72be22">-->
<!--                    <div class="card-body" style="color :white;">-->
<!--                        <h5>JUMLAH ANTRIAN<br>-->
<!--                            <b> --><?php //echo $total_queue; ?><!--</b>-->
<!--                        </h5>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</section>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>