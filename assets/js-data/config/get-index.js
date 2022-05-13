(function ($) {
  "use strict";

  var linkUrl = "Config/getIndex/";
  var param = "";
  var role = "";
  callIndex();

  function callIndex() {
    $("#overlay").fadeIn();
    loadPagination(0);
  }

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
        var company_name = result[index].company_name;
        var ip = result[index].ip;
        var api_key = result[index].api_key;
        var status = result[index].status;
        var created_date = result[index].created_date;
        var updated_date = result[index].updated_date;

        var button_edit =
          '<a href="Config/edit/?id=' +
          id +
          '" style="margin-left: 5px;" >' +
          '<button data-toggle="tooltip" title="edit" class="btn btn-default btn-sm">' +
          '<i class="nav-icon fas fa-edit" style="color: #5bb505;"></i>' +
          "</button>" +
          "</a>";

        var button_delete =
            '<a data-toggle="modal" data-target="#konfirmasi_hapus" data-href="Config/deleteConfig/?id=' +
            id +
            '" data-message="Are you sure you want to delete Company Name ' + company_name + '" data-company_name="' +
            company_name +
            '" style="margin-left: 5px;" >' +
            '<button data-toggle="tooltip" title="delete" class="btn btn-default btn-sm">' +
            '<i class="fa fa-times" style="color: red;"></i>' +
            "</button>" +
            "</a>";

        sno += 1;

        var tr = "<tr>";
        tr += "<td data-field='id' class='no'>" + sno + "</td>";
        tr += "<td>" + company_name + "</td>";
        tr += "<td>" + ip + "</td>";
        tr += "<td>" + api_key + "</td>";
        tr += "<td>" + created_date + "</td>";
        tr += "<td>" + button_edit + button_delete +"</td>";
        tr += "</tr>";
        $("#data tbody").append(tr);
      }
    } else {
      $("#data tbody").empty();
      var tr = "<tr>";
      tr +=
        "<td colspan='10' class='text-center'><i class='fa fa-search-minus fa-lg text-secondary' style='margin-top: 15px;'><span class='errorFound'>Data empty</span></i></td>";
      tr += "</tr>";
      $("#data tbody").append(tr);
    }
  }

  $("#konfirmasi_hapus").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var message = button.data("message");
    var name = button.data("name");
    var href = button.data("href");
    var modal = $(this);
    modal.find("#modal-message").text(message);
    modal.find("#modal-name").text(name);
    $("#hapus_data").attr("href", href);
  });

  $("#search-data-by-company-name").on("click", function (e) {
    if ($("#company_name").val() != "") {
      $("#overlay").fadeIn();
      linkUrl = "Config/search_data/";
      param = "company_name=" + $("#company_name").val();
      loadPagination(0);
    }
  });

  $("#pagination").on("click", "a", function (e) {
    $("#overlay").fadeIn();

    e.preventDefault();

    var pageno = $(this).attr("data-ci-pagination-page");

    loadPagination(pageno);
  });
})(jQuery);
