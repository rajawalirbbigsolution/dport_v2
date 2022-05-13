<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
<style>
    table tr td{
        padding: 0.4em 0.75em 0.4em 0.75em !important;
        min-height: 42px !important;
        height: 42px !important;
    }
    page-title{
        font-family: ibastfont !important;
    }
</style>

<div class="content-header" style="padding: 0;">
    <div class="container-fluid" >
        <div class="row mb-3">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="page-title"><a style="font-size: 32px;  font-weight: bold; color: #0565af"
                                                   href="#"><?php echo $title; ?></a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
  <?php echo $this->session->flashdata('notice'); ?>
  <div class="row" style="padding: 1% 0">
      <div class="col-md-12" style="">
          <div class="row" style="padding: 0">
              <div class="col-sm-2">
                  <input type="text" name="provinsi" id="provinsi" class="form-control zonasi" placeholder="Provinsi">
              </div>
              <div class="col-sm-2">
                  <input type="text" name="kabupaten" id="kabupaten" class="form-control zonasi" placeholder="Kabupaten">
              </div>
              <div class="col-sm-2">
                  <input type="text" name="kecamatan" id="kecamatan" class="form-control zonasi" placeholder="Kecamatan">
              </div>
              <div class="col-sm-2">
                  <input type="text" name="kelurahan" id="kelurahan" class="form-control zonasi" placeholder="Kelurahan">
              </div>
              <div class="col-sm-2">
                  <select class="form-control" id="drop_point">
                      <option>Drop Point</option>
                  </select>
              </div>
              <div class="col-sm-2">
                  <button type="button" class="btn btn-block btn-primary" id="filter-schedule" style="background-color: #1263b4; border: none">Search</button>
              </div>
              <div class="col-sm-12 mt-1">
                  <span id="text-warning-export"></span>
              </div>
          </div>
      </div>
      <div class="col-md-12 mt-2">
          <div class="card">
              <div class="card-body p-0">
                  <div class="table-responsive">
                      <table class="table table-striped projects" id="data">
                          <thead>
                              <tr>
                                  <th data-field="id" class="no"colspan="3">
<!--                                      <input type="checkbox"> &nbsp;-->
<!--                                      <a href="#" style="color:black"><i class="fas fa-sync-alt"></i></a> &nbsp;-->
<!--                                      <a href="#" style="color:black"><i class="fas fa-trash-alt"></i></a>-->
<!--                                      <a href="--><?php //echo base_url('Schedule/add')?><!--" class="btn btn-primary" id="add-schedule" style="background-color: #1263b4; border: none">Add Schedule</a>-->
                                      <h6 id="drop_point_name"></h6>
                                      </th>
                                  <th data-field="module_name" data-editable="true" class="module_name" colspan="2" style="text-align: right;" valign="center" >
<!--                                      <p><span id="page-data"> 1</span> - <span id="data-per-page"> 50 </span> dari <span id="total-data">2000 </span>-->
<!--                                      &nbsp;-->
<!--                                      &nbsp;-->
<!--                                      <a href="#" id="prev-page" style="color:darkgray"><i class="fas fa-angle-left" style="font-size: 1.5em"></i></a>-->
<!--                                      &nbsp;-->
<!--                                      &nbsp;-->
<!--                                      <a href="#" id="next-page" style="color:darkgray"><i class="fas fa-angle-right" style="font-size: 1.5em"></i></a>-->
<!--                                      </p>-->
                                  </th>
                              </tr>
                              <tr>
                                  <th data-field="id" class="no"><input type="checkbox" id="check-all"></th>
                                  <th data-field="module_name" data-editable="true" class="module_name">NAMA</th>
                                  <th data-field="module_name" data-editable="true" class="module_name">NO ANTRIAN</th>
<!--                                  <th data-field="module_name" data-editable="true" class="module_name">PROVINSI</th>-->
<!--                                  <th data-field="module_name" data-editable="true" class="module_name">KABUPATEN</th>-->
<!--                                  <th data-field="module_name" data-editable="true" class="module_name">KECAMATAN</th>-->
<!--                                  <th data-field="module_name" data-editable="true" class="module_name">KELURAHAN</th>-->
                                  <th data-field="module_name" data-editable="true" class="module_name" style="">NO TELPON</th>
                                  <th data-field="module_name" data-editable="true" class="module_name">STATUS</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div>
                  <div class="card-tools text-center" id="pagination"></div>
              </div>
          </div>
      </div>
      <div class="col-md-12 text-right">
          <button type="submit" class="btn btn-primary" style="background-color: #6cbd45; border: none">Resend Message</button>
      </div>
  </div>
</section>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/testing/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
<script src="<?php echo base_url(); ?>assets/js-data/message/get-index.js"></script>
<script type="text/javascript">
  var baseUrl = "<?php echo base_url()?>";
  var provinsi = "";
  var kabupaten = "";
  var kecamatan = "";
  var kelurahan = "";
  var dropPoint = "";
  var dropPointText = "";
  setTimeout(function() {
    $("div.alert").remove();
  }, 5000);
  $("#provinsi").autocomplete({
      source: baseUrl + "Zonasi/filterProvinsi",
      minChars: 3,
      minLength: 3,
      matchContains: "word",
      autoFill: true,
      select: function (event, ui) {
          provinsi = ui.item.value;
          getDropPointData();
          document.valueSelectedForAutocomplete = ui.item.value
      }
  });

  $("#kabupaten").autocomplete({
      source: baseUrl + "Zonasi/filterKabupaten",
      minChars: 3,
      minLength: 3,
      matchContains: "word",
      autoFill: true,
      select: function (event, ui) {
          kabupaten = ui.item.value;
          getDropPointData();
          document.valueSelectedForAutocomplete = ui.item.value
      }
  });

  $("#kecamatan").autocomplete({
      source: baseUrl + "Zonasi/filterKecamatan",
      minChars: 3,
      minLength: 3,
      matchContains: "word",
      autoFill: true,
      select: function (event, ui) {
          kecamatan = ui.item.value;
          getDropPointData();
          document.valueSelectedForAutocomplete = ui.item.value
      }
  });

  $("#kelurahan").autocomplete({
      source: baseUrl + "Zonasi/filterKelurahan",
      minChars: 3,
      minLength: 3,
      matchContains: "word",
      autoFill: true,
      select: function (event, ui) {
          kelurahan = ui.item.value;
          getDropPointData();
          document.valueSelectedForAutocomplete = ui.item.value
      }
  });

  $('#drop_point').change(function (){
      if($(this).val() != ""){
          dropPoint = $(this).val();
          dropPointText = 'Drop poin : ' + $('#drop_point option:selected').text();
      } else {
          dropPoint = "";
          $('#drop_point_name').text("")
      }
  })

  function getDropPointData(){
      $.ajax({
          url : baseUrl + 'Schedule/getDropPoint',
          method : "post",
          data : {
              provinsi : provinsi,
              kabupaten : kabupaten,
              kecamatan : kecamatan,
              kelurahan : kelurahan
          },
          success : function (response){
              if(response.result.length > 0){
                  var data = response.result;
                  $('#drop_point').empty();
                  $('#drop_point').append("<option value=''>Drop Point</option>");
                  $.each(data, function (key, val){
                      $('#drop_point').append("<option value='"+val.id+"'>"+val.nama+"</option>");
                  });
              }
          }
      })
  }
</script>