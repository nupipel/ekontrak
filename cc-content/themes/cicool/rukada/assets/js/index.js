$(function () {
  "use strict";
  // chart 2

  $.ajax({
    url: "web/donut_chart3",
    type: "get",
    dataType: "json",
    success: function (res) {
      // console.log(res.label);
      var ctx = document.getElementById("chart3pendapatan").getContext("2d");
      var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: res.label,
          datasets: [
            {
              backgroundColor: res.bgcolor,
              data: res.val,
              // borderWidth: [0, 0, 0, 0],
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          cutoutPercentage: 60,
          legend: {
            position: "bottom",
            display: false,
            labels: {
              fontColor: "#ddd",
              boxWidth: 15,
            },
          },
          tooltips: {
            displayColors: false,
          },
        },
      });

      // DONUT TABLE
      let data = res.label.length;
      var html = $("#donut_table3");
      for (let i = 0; i < data; i++) {
        var text =
          '<tr><td><i class="bx bxs-circle me-2" style="color: ' +
          res.bgcolor[i] +
          '"></i>' +
          res.label[i] +
          "</td><td>" +
          toRupiah(res.val[i], { useUnit: true }) +
          "</td></tr>";
        html.append(text);
      }
    },
  });

  $.ajax({
    url: "web/donut_chart",
    type: "get",
    dataType: "json",
    success: function (res) {
      // console.log(res.label);
      var ctx = document.getElementById("chart2").getContext("2d");
      var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: res.label,
          datasets: [
            {
              backgroundColor: res.bgcolor,
              data: res.val,
              // borderWidth: [0, 0, 0, 0],
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          cutoutPercentage: 60,
          legend: {
            position: "bottom",
            display: false,
            labels: {
              fontColor: "#ddd",
              boxWidth: 15,
            },
          },
          tooltips: {
            displayColors: false,
          },
        },
      });

      // DONUT TABLE
      let data = res.label.length;
      var html = $("#donut_table");
      for (let i = 0; i < data; i++) {
        var text =
          '<tr><td><i class="bx bxs-circle me-2" style="color: ' +
          res.bgcolor[i] +
          '"></i>' +
          res.label[i] +
          "</td><td>" +
          toRupiah(res.val[i], { useUnit: true }) +
          "</td></tr>";
        html.append(text);
      }
    },
  });

  $.ajax({
    url: "web/chartStatusEpur",
    type: "get",
    dataType: "json",
    success: function (res) {
      var temp;
      var labels = [];
      var values = [];
      // console.log(res);
      $.each(res, function (key, val) {
        if (key == "paket_selesai") {
          temp = "Paket Selesai";
        } else {
          temp = "Paket Proses";
        }
        labels.push(temp);
        values.push(parseInt(val));
      });

      console.log(labels, values);

      var ctx = document.getElementById("chartStatusEpur").getContext("2d");
      var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: labels,
          datasets: [
            {
              backgroundColor: ["#ff7f50", "#87cefa"],
              data: values,
              // borderWidth: [0, 0, 0, 0],
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          cutoutPercentage: 60,
          legend: {
            position: "bottom",
            display: false,
            labels: {
              fontColor: "#ddd",
              boxWidth: 15,
            },
          },
          tooltips: {
            displayColors: false,
          },
        },
      });

      // DONUT TABLE
      var html = $("#tableStatusEpur");
      var colors = ["#ff7f50", "#87cefa"];
      for (let i = 0; i < labels.length; i++) {
        var text =
          '<tr><td><i class="bx bxs-circle me-2" style="color: ' +
          colors[i] +
          '"></i>' +
          labels[i] +
          "</td><td><strong>" +
          values[i] +
          " %</strong></td></tr>";
        html.append(text);
      }
    },
  });
});
