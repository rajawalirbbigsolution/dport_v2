(function ($) {
    "use strict";
  
    $("#label").autocomplete({
      source: "Driver/search",
  
      select: function (event, ui) {
        $('[name="label"]').val(ui.item.label);
      },
    });
  
    var linkUrl = "getSafe/";
  
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
          var no =0;
          var product_d_id = result[index].product_d_id;
          var stock = result[index].stock;
          var location_name = result[index].location_name;
          var product_h_name = result[index].product_h_name;
          var sku_number = result[index].sku_number;
          var safety_stock = result[index].safety_stock;
  
         
  
          var checkbox = '<input class="check-promo" type="checkbox" name="check_promo['+product_d_id+']">';
  
          var tr = "<tr >";
  
          tr += "<td style='padding-left: 2.5em !important;'>" + checkbox + "</td>";
          tr += "<td>" + sku_number + "</td>";
          tr += "<td>" + product_h_name + "</td>";
          tr += "<td>" + safety_stock + "</td>";
          tr += "<td>" + stock + "</td>";
          tr += "<td>" + location_name + "</td>";
          tr += "</tr>";
  
          tr += '<tr class="collapse" id="collapse-'+sno+'">\n' +
              '<td colspan="11" class="data-collapse" style="padding: 3em 3em 3em 7em !important; background-color: #f8f8f8; color: #c0c0c0">\n' +
                  '</td>\n' +
                '</tr>';
  
  
  
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
  