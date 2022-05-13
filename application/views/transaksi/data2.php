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
</style>

<div class="content-header">

  <div class="container-fluid" style="margin-top: 8px;">

    <div class="row mb-2">

      <div class="col-lg-2">

        <ol class="breadcrumb">

          <li class="breadcrumbs-joy"><a style="font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'; font-size: 32px;  font-weight: bold;" href="#"><?php echo $title; ?></a></li>

        </ol>

      </div>

      <div class="col-lg-10">

        <div class="row float-right">

          <!-- <a href="<?php echo base_url('Transaksi/addOrder') ?>">

                        <button type="button" class="btn btn-default btn-sm">

                            <i class="fa fa-add" aria-hidden="true"></i> Tambah

                        </button>

                    </a> -->

        </div>

      </div>

    </div>

  </div>

</div>



<section class="content">

  <div class="container-fluid">

    <div class="row">

      <div class="col-md-12">

        <div class="card card-secondary card-outline card-outline-tabs">

          <div class="card-header p-0 border-bottom-0">

            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

              <!--  <li class="nav-item">

                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><i class="fas fa-chart-pie"></i></a>

                  </li>

                  <li class="nav-item">

                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="far fa-credit-card"></i></a>

                  </li> -->

              <li class="nav-item">

                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false"><i class="fas fa-city"></i></a>

              </li>

              <!-- <li class="nav-item">

                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false"><i class="fas fa-cogs"></i></a>

                  </li> -->

              <li class="nav-item">

                <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-uploads" role="tab" aria-controls="custom-tabs-one-uploads" aria-selected="false"><i class="fas fa-upload"></i></a>

              </li>

              <li class="nav-item">

                <!--  <a href="#" class="nav-link" id="custom-tabs-one-settings-tab" role="tab" data-toggle="modal" data-target="#modal-add-order" aria-controls="custom-tabs-one-export" aria-selected="false"><i class="fas fa-cart-plus"></i></a> -->



                <!-- <button style="margin-top: 6px;  margin-left: 10px;" type="button" class="btn btn-outline-secondary btn-sm" id="custom-tabs-one-settings-tab" data-toggle="modal" data-target="#modal-add-order">Tambah Order</button> -->

              </li>

            </ul>

          </div>

          <div class="card-body">

            <div class="tab-content" id="custom-tabs-one-tabContent">

              <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                <div class="col-lg-12">

                  <div class="row">

                    <div class="col-md-2">

                      <div class="form-group">

                        <input name="date_shipping" id="date_shipping" type="date" class="form-control form-control-sm">

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <select class="form-control form-control-sm" name="name_korlap" id="name_korlap">
                          <option value="0">-select-</option>

                        </select>

                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="row float-center">

                        <!-- <div class="col-md-4 col-6">

                          <div class="form-group">

                            <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="search-data-by-date">

                              <i class="fa fa-filter" aria-hidden="true"></i> Search

                            </button>

                          </div>

                        </div> -->

                        <div class="col-md-4 col-6">

                          <div class="form-group">

                            <!-- <a href="<?php echo base_url(); ?>Order/bansosPdf" target="_blank" class="btn btn-custon-four btn-default btn-sm"> -->
                            <a href='#' id="download-pendahuluan" class="btn btn-custon-four btn-default btn-sm">

                              <i class="fa fa-download" aria-hidden="true"></i> Download

                            </a>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

              <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

                <div class="col-lg-12">

                  <div class="row">

                    <div class="col-md-3 col-6">

                      <div class="form-group">

                        <select class="form-control form-control-sm" name="payment_status" id="payment_status">

                          <option value="">--Payment Status--</option>

                          <option value="1">Paid</option>

                          <option value="2">Unpaid</option>

                        </select>

                      </div>

                    </div>

                    <div class="col-md-3 col-6">

                      <div class="form-group">

                        <select class="form-control form-control-sm" name="payment_method" id="payment_method">

                          <option value="">--Payment Method--</option>

                          <option value="cod">COD</option>

                          <option value="hutang">Hutang</option>

                          <option value="bank_transfer">Bank Transfer</option>

                        </select>

                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="row float-center">

                        <div class="col-md-4 col-6">

                          <div class="form-group">

                            <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="search-payment">

                              <i class="fa fa-filter" aria-hidden="true"></i> Search

                            </button>

                          </div>

                        </div>

                        <div class="col-md-4 col-6">

                          <div class="form-group">

                            <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="download-payment">

                              <i class="fa fa-download" aria-hidden="true"></i> Download

                            </button>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

              <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">

                <div class="col-lg-12">

                  <div class="row">

                    <div class="col-md-2">

                      <div class="form-group">

                        <select class="form-control form-control-sm" name="state" id="state"></select>

                      </div>

                    </div>

                    <div class="col-md-3 col-6">

                      <div class="form-group">

                        <select class="form-control form-control-sm" name="city" id="city">

                        </select>

                      </div>

                    </div>

                    <div class="col-md-3 col-6">

                      <div class="form-group">

                        <select class="form-control form-control-sm" name="district" id="district"></select>

                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="row float-center">

                        <div class="col-md-4 col-6">

                          <div class="form-group">

                            <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="search-area">

                              <i class="fa fa-filter" aria-hidden="true"></i> Search

                            </button>

                          </div>

                        </div>

                        <div class="col-md-4 col-6">

                          <div class="form-group">

                            <button type="submit" class="btn btn-custon-four btn-default btn-sm" id="download-area">

                              <i class="fa fa-download" aria-hidden="true"></i> Download

                            </button>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

              <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">

                <div class="row">

                  <div class="col-sm-3 col-6">

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="no" id="label_no" class="custom-control-input no" checked="checked" />

                      <label for="label_no" class="custom-control-label">No</label>

                    </div>

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="bump" id="label_bump" checked="checked" class="custom-control-input no" />

                      <label for="label_bump" class="custom-control-label">Bump</label>

                    </div>

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="handle" id="label_handle" checked="checked" class="custom-control-input no" />

                      <label for="label_handle" class="custom-control-label">Handle</label>

                    </div>

                  </div>

                  <div class="col-sm-3 col-6">

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="id_order" id="label_id_order" checked="checked" class="custom-control-input no" />

                      <label for="label_id_order" class="custom-control-label">Id Order</label>

                    </div>

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="status" id="label_status" checked="checked" class="custom-control-input no" />

                      <label for="label_status" class="custom-control-label">Status</label>

                    </div>

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="order_date" id="label_order_date" checked="checked" class="custom-control-input no" />

                      <label for="label_order_date" class="custom-control-label">Order Date</label>

                    </div>

                  </div>

                  <div class="col-sm-3 col-6">

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="name_user" id="label_name_user" checked="checked" class="custom-control-input no" />

                      <label for="label_name_user" class="custom-control-label">Name User</label>

                    </div>

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="coupon" id="label_coupon" checked="checked" class="custom-control-input no" />

                      <label for="label_coupon" class="custom-control-label">Coupon</label>

                    </div>

                  </div>

                  <div class="col-sm-3 col-6">

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="name_product" id="label_name_product" checked="checked" class="custom-control-input no" />

                      <label for="label_name_product" class="custom-control-label">Name Product</label>

                    </div>

                    <div class="custom-control custom-checkbox checkbox">

                      <input type="checkbox" name="payment_status" id="label_payment_status" checked="checked" class="custom-control-input no" />

                      <label for="label_payment_status" class="custom-control-label">Payment Status</label>

                    </div>

                  </div>

                </div>

              </div>

              <div class="tab-pane fade" id="custom-tabs-one-uploads" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">

                <div class="row">

                  <div class="col-md-4 col-12">

                    <div class="input-group mb-3">

                      <input type="file" class="form-control form-control-sm" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" name="data_order" id="fileUpload">

                      <div class="input-group-append">

                        <button class="btn btn-outline-secondary btn-sm" type="button" id="btn-upload">

                          <i class="fa fa-upload fa-lg" aria-hidden="true"></i>

                        </button>

                      </div>

                    </div>

                  </div>

                </div>

              </div>



            </div>

          </div>

        </div>

        <!-- /.card -->

      </div>

    </div>

    <!-- </div> -->

    <?php echo $this->session->flashdata('notice'); ?>

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

        <div class="product-status-wrap shadow">





        </div>

      </div>

    </div>

    <div class="row">

      <div class="col-md-12">

        <div class="row">

          <div class="col-md-12">

            <div class="card">

              <div class="card-body p-0">

                <div class="table-responsive">

                  <table class="table table-striped projects" id="data">

                    <thead>

                      <tr>

                        <th data-field="id" class="no">No</th>

                        <th data-field="name" data-editable="true" class="id_order">Kabupaten </th>

                        <th data-field="email" data-editable="true" class="name_user">Kecamatan</th>

                        <th data-field="email" data-editable="true" class="name_product">Kelurahan</th>

                        <th data-field="email" data-editable="true" class="bump">RW</th>

                        <th data-field="email" data-editable="true" class="status">RT</th>

                        <th data-field="email" data-editable="true" class="coupon">NIK</th>
                        <th data-field="email" data-editable="true" class="coupon">Kepala Keluarga</th>

                        <th data-field="email" data-editable="true" class="payment_status">Alamat</th>

                        <th data-field="email" data-editable="true" class="handle">Kode Pos</th>



                      </tr>

                    </thead>

                    <tbody></tbody>

                  </table>

                </div>

                <br>

                <div class="card-tools text-center" id="pagination"></div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>



  <div class="modal fade" id="modal-add-order" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-xl">

      <form role="form" id="quickForm">

        <div class="modal-content">

          <div class="modal-header">

            <h4 class="modal-title">Tambah Order</h4>

          </div>

          <div class="modal-body">

            <div class="row" id="loading_add_order">

              <div class="col-sm-12 text-center">

                <div class="d-flex justify-content-center">

                  <div class="spinner-grow" id="loading-spinner-order" style="width: 5rem; height: 5rem;" role="status">

                    <span class="sr-only">Loading...</span>

                  </div>

                </div>

                <span class="text-secondary" style="text-align: center;" id="text-message-add-order">Mohon Tunggu</span>

              </div>

            </div>

            <div id="content-form">

              <div class="row">

                <div class="col-sm-4">

                  <div class="form-group">

                    <textarea id="new_order" name="new_order" class="form-control " rows="12" placeholder="Masukkan transaksi disini ..."></textarea>

                  </div>

                </div>

                <div class="col-sm-8">

                  <div class="row">

                    <div class="col-sm-6">

                      <div class="form-group">

                        <small>Nama</small>

                        <input type="text" class="form-control" id="nama_order" name="nama_order" readonly="readonly" data-type="text">

                      </div>

                    </div>

                    <div class="col-sm-6">

                      <div class="form-group">

                        <small>Produk</small>

                        <input type="text" class="form-control" id="produk_order" name="produk_order" readonly="readonly" data-type="text">

                      </div>

                    </div>

                  </div>



                  <div class="row">

                    <div class="col-sm-4">

                      <div class="form-group">

                        <small>Payment</small>

                        <input type="text" class="form-control" id="payment_order" name="payment_order" readonly="readonly" data-type="text">

                      </div>

                    </div>

                    <div class="col-sm-4">

                      <div class="form-group">

                        <small>Kurir</small>

                        <input type="text" class="form-control" id="kurir_order" name="kurir_order" readonly="readonly" data-type="text">

                      </div>

                    </div>

                    <div class="col-sm-4">

                      <div class="form-group">

                        <small>Diskon</small>

                        <input type="text" class="form-control" id="diskon_order" name="diskon_order" readonly="readonly" data-type="number">

                      </div>

                    </div>

                  </div>



                  <div class="row">

                    <div class="col-sm-8">

                      <div class="form-group">

                        <small>Alamat</small>

                        <textarea class="form-control" rows="2" id="alamat_order" name="alamat_order" readonly="readonly" data-type="text"></textarea>

                      </div>

                      <div class="form-group" id="pilih_kecamatan">

                        <select class="form-control" id="select-subdistrict"></select>

                      </div>

                    </div>

                    <div class="col-sm-4">

                      <div class="form-group">

                        <small>Kecamatan</small>

                        <input type="text" class="form-control" id="kecamatan_order" name="kecamatan_order" readonly="readonly" data-type="text">

                      </div>

                      <div class="form-group">

                        <small>Ongkir</small>

                        <div class="input-group input-group-sm mb-3">

                          <div class="input-group-prepend" id="loading-ongkir">

                            <span class="input-group-text" id="inputGroup-sizing-sm">

                              <div class="spinner-border spinner-border-sm" role="status">

                                <span class="sr-only">Loading...</span>

                              </div>

                            </span>

                          </div>

                          <input type="text" class="form-control" id="ongkir_data_order" name="ongkir_data_order" readonly="readonly">



                        </div>

                        <input type="hidden" id="code_product">

                        <input type="hidden" id="price_product">

                      </div>

                    </div>

                  </div>



                </div>

              </div>

            </div>

          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

            <button type="submit" class="btn btn-primary" id="simpan-order">Simpan</button>

          </div>

        </div>

      </form>

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

          <h2>Peringatan</h2>

          <p style="font-size: 18px;"></p>

          <b style="margin-left: 5px; margin-right: 5px; font-size: 18px; color: red;"></b> <span style="font-size: 18px;">?</span>

        </div>

        <div class="modal-footer">

          <a class="btn btn-danger btn-ok" style="background-color: red;"> Ya</a>

          <a class="btn btn-primary" data-dismiss="modal"> Tidak</a>

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



<div class="modal fade" id="modal-upload-excel" data-backdrop="static" data-keyboard="false">

  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">Upload Data</h5>

      </div>

      <div class="modal-body">

        <p>

          <div class="d-flex justify-content-center">

            <div class="spinner-border" role="status" id="loading-upload"></div>

            <i class="fa fa-check text-green fa-lg" id="success-upload" style="padding-top: 5px;"></i>

            <i class="fa fa-times text-red fa-lg" id="failed-upload" style="padding-top: 5px;"></i>

            <span id="message-upload" align="center" style="font-size: 16px; margin-left: 20px;"></span>

          </div>

          <p>

      </div>

      <div class="modal-footer" id="modal-footer-upload" style="display: none;">

        <button type="button" class="btn btn-default btn-upload" data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div>



<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js-data/order/js-data-3.js" id="date" data-start="<?php echo date('d-m-Y', strtotime($start)); ?>" data-end="<?php echo date('d-m-Y', strtotime($end)); ?>"></script>

<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery-validation/jquery.validate.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>

<script src="<?php echo base_url(); ?>assets/js/FileSaver.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jhxlsx.js"></script>