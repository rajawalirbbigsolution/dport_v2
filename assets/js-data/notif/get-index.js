(function ($) {
    "use strict";
  
    $("#label").autocomplete({
      source: "Driver/search",
  
      select: function (event, ui) {
        $('[name="label"]').val(ui.item.label);
      },
    });
  
    var linkUrl = "Notification/getIndex/";
  
    var param = "";
  
    var role = "";
  
    callIndex();
  
    function callIndex() {
      $("#overlay").fadeIn();
  
      loadPagination(0);
    }
  
    $("#search-code-order").on("click", function (e) {
      if ($("#label").val() != "") {
        $("#overlay").fadeIn();
  
        linkUrl = "Product/search_data/";
  
        param = "label=" + $("#label").val();
  
        loadPagination(0);
      }
    });
  
    $("#filter-manifest").on("click", function (e) {
      if ($("#date_schedule").val() != "" && $("#id_filter").val() != "") {
        $("#overlay").fadeIn();
  
        linkUrl = "ReportNon/filterManifest/";
  
        //param = 'payment_status=' + $('#payment_status').val() + '&payment_method=' + $('#payment_method').val();
        param =
          "value=" +
          $("#date_schedule").val();
  
        loadPagination(0);
      }
    });
  
  
    
  
    function loadPagination(pagno) {
      $.ajax({
        url: linkUrl + pagno,
  
        type: "get",
  
        dataType: "json",
  
        data: param,
  
        success: function (response) {
          linkUrl = response.url;
  
          param = response.params;
  
          role = response.role;
  
          $("#overlay").fadeOut().delay(400);
  
          setTimeout(function () {
            $("#pagination").html(response.pagination);
  
            createTable(response.result, response.row);
          }, 500);
        },
  
        error: function (jqXHR, exception) {
          $("#overlay").fadeOut().delay(400);
  
          setTimeout(function () {
            $("#data tbody").empty();
  
            var tr = "";
  
            if (jqXHR.status === 0) {
              tr = "<tr>";
  
              tr +=
                "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Not connect, Verify Network.</span></i></td>";
  
              tr += "</tr>";
            } else if (jqXHR.status == 404) {
              tr = "<tr>";
  
              tr +=
                "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Requested page not found. [404]</span></i></td>";
  
              tr += "</tr>";
            } else if (jqXHR.status == 500) {
              tr = "<tr>";
  
              tr +=
                "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Internal Server Error [500].</span></i></td>";
  
              tr += "</tr>";
            } else if (exception === "parsererror") {
              tr = "<tr>";
  
              tr +=
                "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Requested JSON parse failed.</span></i></td>";
  
              tr += "</tr>";
            } else if (exception === "timeout") {
              tr = "<tr>";
  
              tr +=
                "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Time out error.</span></i></td>";
  
              tr += "</tr>";
            } else if (exception === "abort") {
              tr = "<tr>";
  
              tr +=
                "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Ajax request aborted.</span></i></td>";
  
              tr += "</tr>";
            } else {
              tr = "<tr>";
  
              tr +=
                "<td colspan='10' class='text-center'><i class='fa fa-exclamation-circle fa-lg text-danger' style='margin-top: 15px;'><span class='errorFound'>Uncaught Error. " +
                jqXHR.responseText +
                "</span></i></td>";
  
              tr += "</tr>";
            }
  
            $("#data tbody").append(tr);
          }, 500);
        },
      });
    }
    function createTable(result, sno) {
      if (result.length > 0) {
        sno = Number(sno);
  
        $("#data tbody").empty();
  
        var index;
  
        for (index in result) {
        var id = result[index].id;
        var number = result[index].number;
        var rt_date = result[index].rt_date;
        var status_transfer = result[index].status_transfer;
        var rt_dateline = result[index].rt_dateline;
        var status = result[index].status;
        var warehouse = result[index].warehouse;
        var intrans_date = result[index].intrans_date;
        var exp_date = result[index].exp_date;
        var qty = result[index].qty;
        var uom = result[index].uom;
  
          var button_edit = '<a href="#" style="margin-left: 5px;" class="view-toggle" data-open="0" data-target="#collapse-'+id+'" aria-expanded="false">\n' +
              '<button data-toggle="tooltip" title="edit" class="btn btn-default btn-sm"><i class="nav-icon fas fa-edit" style="color: black;"></i></button>\n' +
              '</a>';
          
  
          // var button_detail = '<a href="'+baseUrl+'Storage/detail?id='+product_d_supplier_id+'&plt='+loc_type_id+'" ' +
          //     'style="margin-left: 5px;" >\n' +
          //     '<button data-toggle="tooltip" title="edit" class="btn btn-default btn-sm"><i class="fas fa-eye"></i></button>\n' +
          //     '</a>';
  
          var button_up = '<a href="#" style="margin-left: 5px;" class="view-toggle collapsed" data-toggle="collapse" data-open="0" data-target="#collapse-'+sno+'" ' +
              'id="'+id+'" ' +
              'aria-expanded="false">\n' +
              '<button data-toggle="tooltip" title="edit" class="btn btn-default btn-sm"><i class="fas fa-sort-down"></i></button>\n' +
              '</a>';
  
          // var button_up =
          //     '<a class="btn btn-sm btn-default collapsed" type="button" data-toggle="collapse" data-target="#collapse-'+sno+'" aria-controls="collapseOne" title="show"><i class="fas fa-sort-down"></i></a>';
          
  
          var detail_stock =
              '<a class="card-link collapsed" type="button" data-toggle="collapse" data-target="#collapseO" href="collapseOnes" id="collapseO">Mencoba</a>'
              
  
           var button_drop = 
            '<a class="card-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><div class="card-header" id="headingOne">Accordion Group 1</a>'
          //   sno +=1;
  
          // sno += 1;
  
          var checkbox = '<input class="check-promo" type="checkbox" name="check_promo['+id+']">';
  
          var tr = "<tr >";
  
          // tr += "<td data-field='id' class='no' style='padding-left: 2.5em !important;'>" + checkbox + "</td>";
  
          tr += "<td style='padding-left: 2.5em !important;'>" + number + "</td>";
          tr += "<td>" + rt_date + "</td>";
          tr += "<td>" + warehouse + "</td>";
          tr += "<td>" + rt_dateline + "</td>";
          tr += "<td>" + qty + "</td>";
          tr += "<td>" + exp_date + "</td>";
          tr += "<td>" + status_transfer + "</td>";
          // tr += "<td>" + batch_number + "</td>";
          // tr += "<td>" + exp_date + "</td>";
          // tr += "<td>" + location_name + "</td>";
          // tr += "<td>" + button_up + "</td>";
  
          tr += "</tr>";
  
          // tr += "<td>" + detail_stock + "</td>";
          tr += "</tr>";
  
          tr += '<tr class="collapse" id="collapse-'+sno+'">\n' +
              '<td colspan="11" class="data-collapse" style="padding: 3em 3em 3em 7em !important; background-color: #f8f8f8; color: #c0c0c0">\n' +
                  '</td>\n' +
                '</tr>';
  
  
          //
          // tr += '<tr class="collapse" id="collapse-'+id+'">\n' +
          //     '<td colspan="9" class="data-collapse" style="padding: 3em 3em 3em 7em !important; background-color: #f8f8f8; color: #c0c0c0">\n' +
          //     '</td>\n' +
          //     '</tr>';
  
          $("#data tbody").append(tr);
        }
      } else {
        $("#data tbody").empty();
  
        var tr = "<tr>";
  
        tr +=
            "<td colspan='10' class='text-center'><i class='fa fa-search-minus fa-lg text-secondary' style='margin-top: 15px;'><span class='errorFound'>Data kosong</span></i></td>";
  
        tr += "</tr>";
  
        $("#data tbody").append(tr);
      }
    }
  
    // function createTable(result, sno) {
    //   if (result.length > 0) {
    //     sno = Number(sno);
  
    //     $("#data tbody").empty();
  
    //     var index;
  
    //     for (index in result) {
    //     var id = result[index].id;
    //       var create_date = result[index].create_date;
    //       var update_date = result[index].update_date;
    //       var create_user = result[index].create_user;
    //       var update_user = result[index].update_user;
    //       var awb_number = result[index].awb_number;
    //       var product = result[index].product;
    //       var qty = result[index].qty;
    //       var is_damage = result[index].is_damage;
    //       var is_minus = result[index].is_minus;
    //       var difference = result[index].difference;
    //       var weight = result[index].weight;
    //       var kabupaten = result[index].kabupaten;
    //       var kecamatan = result[index].kecamatan;
    //       var kelurahan = result[index].kelurahan;
    //       var driver = result[index].driver;

    //       var ket = '';
    //       if(is_damage == 0 && is_minus == 1){
    //             ket = 'Kurang';
    //       }else if(is_damage == 1 && is_minus == 0){
    //             ket = 'Rusak';
    //       }else{
    //             ket = 'Oke';
    //       }
          
    //       var button_delete =
    //       '<a data-toggle="modal" data-target="#konfirmasi_hapus" data-href="Notification/kirimUlang/?id=' +
    //       id +
    //       '" data-message="'+awb_number+' ( '+ product +' )  ?" data-name="' +
    //       awb_number +
    //       '" style="margin-left: 5px;" >' +
    //       '<button data-toggle="tooltip" title="delete" class="btn btn-default btn-sm">' +
    //       'SEND' +
    //       "</button>" +
    //       "</a>";
  
          
  
    //       sno += 1;
           
    //       var tr = "<tr>";
  
    //       tr += "<td data-field='id' class='no'>" + sno + "</td>";
  
    //       tr += "<td>" + create_date + "</td>";
    //       tr += "<td>" + awb_number + "</td>";
    //       tr += "<td>" + product + "</td>";
    //       tr += "<td>" + kabupaten + "</td>";
    //       tr += "<td>" + kecamatan + "</td>";
    //       tr += "<td>" + kelurahan + "</td>";
    //       tr += "<td>" + qty + "</td>";
    //       tr += "<td>" + ket + "</td>";
    //       tr += "<td>" + difference + "</td>";
    //       tr += "<td>" + driver + "</td>";
    //       tr += "<td>" + button_delete + "</td>";
         
         
  
    //       tr += "</tr>";
  
    //       $("#data tbody").append(tr);
    //     }
    //   } else {
    //     $("#data tbody").empty();
  
    //     var tr = "<tr>";
  
    //     tr +=
    //       "<td colspan='11' class='text-center'><i class='fa fa-search-minus fa-lg text-secondary' style='margin-top: 15px;'><span class='errorFound'>Data kosong</span></i></td>";
  
    //     tr += "</tr>";
  
    //     $("#data tbody").append(tr);
    //   }
    // }
  
    $("#pagination").on("click", "a", function (e) {
      $("#overlay").fadeIn();
  
      e.preventDefault();
  
      var pageno = $(this).attr("data-ci-pagination-page");
  
      loadPagination(pageno);
    });
  
    function rupiah(angka) {
      var reverse = angka.toString().split("").reverse().join(""),
        ribuan = reverse.match(/\d{1,3}/g);
  
      ribuan = ribuan.join(".").split("").reverse().join("");
  
      return ribuan;
    }
  })(jQuery);
  