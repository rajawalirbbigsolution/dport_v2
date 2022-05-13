(function ($) {
    "use strict";
  
    $("#label").autocomplete({
      source: "ArkoArea/search",
  
      select: function (event, ui) {
        $('[name="label"]').val(ui.item.label);
      },
    });
  
    var linkUrl = "Audit/getIndex/";
  
    var param = "";
  
    var role = "";
  
    callIndex();
  
    function callIndex() {
      $("#overlay").fadeIn();
  
      loadPagination(0);
    }
  
    $("#filter-audit").on("click", function (e) {
      if ($("#keterangan").val() != "" || $("#user").val() != "") {
        $("#overlay").fadeIn();
        param = "user=" + $("#user").val() + "&keterangan=" + $("#keterangan").val();
        loadPagination(0);
      } else {
          $("#overlay").fadeIn();
          loadPagination(0);
      }

    });
  
    function loadPagination(pagno) {
      var tr = "";
      
      $.ajax({
        url: linkUrl + pagno,
  
        type: "get",
  
        dataType: "json",
  
        data: param,
  
        success: function (response) {
            if(response == "31"){
                $("#overlay").fadeOut().delay(400);
                    $("#data tbody").empty();
                    tr = "<tr>";
      
                    tr += "<td colspan='10' class='text-center'><i class='fa fa-search-minus fa-lg text-secondary' style='margin-top: 15px;'><span class='errorFound'>Data kosong</span></i></td>";
      
      
                    tr += "</tr>";
                  $("#data tbody").append(tr);
            }else{
                linkUrl = response.url;
  
                  param = response.params;
                  
                  $("#overlay").fadeOut().delay(400);
  
                  setTimeout(function () {
                    $("#pagination").html(response.pagination);
  
                    createTable(response.result, response.row);
                  }, 500);
            }
            
        },
  
        error: function (jqXHR, exception) {
          $("#overlay").fadeOut().delay(400);
  
          setTimeout(function () {
            $("#data tbody").empty();
  
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
  
          var user_id = result[index].user_id;
          
          var name = result[index].name;
  
          var message = result[index].message;
  
          var create_date = result[index].create_date;
  
          
  
          sno += 1;
  
          var tr = "<tr>";
  
          tr += "<td data-field='id' class='no'>" + sno + "</td>";
  
          tr += "<td>" + name + "</td>";
  
          tr += "<td>" + message + "</td>";
          
          tr += "<td>" + create_date + "</td>";
  
          tr += "</tr>";
  
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
  
  })(jQuery);
  