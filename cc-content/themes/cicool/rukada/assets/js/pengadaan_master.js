// CSRF TOKEN {GLOBAL VARIABLES}
const csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

function gotoTable(id) {
    let goto;
    if (id == 'tender') {
        goto = $("#dataTableTender");
    } else if (id == 'nontender') {
        goto = $("#dataTableNonTender");
    } else if (id == 'epurchasing') {
        goto = $("#dataTableEpur");
    }
    $([document.documentElement, document.body]).animate({
        scrollTop: goto.offset().top - 220
    }, 1200);
}

function closeModal() {
    $('#dataTableDetailStatus').DataTable().destroy();
    $('#tableDetailStatus').empty();
    $("#modalDetailStatus").modal('hide');
};

function redraw(id) {

}

function refresh() {
    const opd = $("#fileterInstansi").val();
    const year = $("#filterTahun").val();
    getAngkaDepan(opd, year);
    getDataTable(opd, year);

    // Load Chart 
    chartTender(opd, year);
    chartNonTender(opd, year);
    chartEpurc(opd, year);

}

function getAngkaDepan(opd, year) {
    $.ajax({
        url: "web/getAngkaPelelangan",
        type: "POST",
        dataType: "JSON",
        data: {
            [csrfName]: csrfHash,
            opd: opd,
            year: year
        },
        beforeSend: function () {
            $(".angkaTotal").LoadingOverlay('show');
        },
        success: function (res) {
            console.log(res);
            $.each(res.nilai, function (i, val) {
                $("." + i).text(toRupiah(val, {
                    useUnit: true,
                    symbol: null,
                    floatingPoint: 0,
                }));
            });
            $.each(res.paket, function (i, val) {
                $("." + i).text(val);
            });
        }
    }).always(function () {
        $(".angkaTotal").LoadingOverlay('hide', true);
    });
}

function getDataTable(opd, year) {
    $('#dataTableTender').DataTable().destroy();
    $('#dataTableNonTender').DataTable().destroy();
    $('#dataTableEpur').DataTable().destroy();


    $('#dataTableTender').DataTable({
        processing: true,
        serverSide: true,
        // searchable: true,
        ajax: {
            url: 'web/dataTableTender',
            type: 'POST',
            data: {
                [csrfName]: csrfHash,
                opd: opd,
                year: year
            },
            "dataSrc": function (json) {
                $('.spinnerDataTableTender').hide();
                return json.data;
            },
            beforeSend: function () {
                $('.spinnerDataTableTender').show();
            },

        },
    });

    $('#dataTableNonTender').DataTable({
        processing: true,
        serverSide: true,
        // searchable: true,
        ajax: {
            url: 'web/dataTableNonTender',
            type: 'POST',
            data: {
                [csrfName]: csrfHash,
                opd: opd,
                year: year
            },
            "dataSrc": function (json) {
                $('.spinnerDataTableNonTender').hide();
                return json.data;
            },
            beforeSend: function () {
                $('.spinnerDataTableNonTender').show();
            },
        },
    });

    $('#dataTableEpur').DataTable({
        processing: true,
        serverSide: true,
        // searchable: true,
        ajax: {
            url: 'web/dataTableEpur',
            type: 'POST',
            data: {
                [csrfName]: csrfHash,
                opd: opd,
                year: year
            },
            "dataSrc": function (json) {
                $('.spinnerEpurchasing').hide();
                return json.data;
            },
            beforeSend: function () {
                $('.spinnerEpurchasing').show();
            },
        },
    });
}

function chartTender(opd, year) {
    // STATUS TENDER 
    $.ajax({
        url: "<?= base_url(); ?>web/tenderChart",
        type: "POST",
        dataType: "JSON",
        data: {
            [csrfName]: csrfHash,
            opd: opd,
            year: year
        },
        beforeSend: function () {
            $(".tenderChart").LoadingOverlay("show");
            $(".cardtender").LoadingOverlay("hide", true);
            $("#tenderTable").empty();
            if (window.tenderChartDraw) {
                window.tenderChartDraw.destroy();
            }

        },
        success: function (res) {
            if (!res.total) {
                $(".cardtender").LoadingOverlay("show", {
                    image: "",
                    text: "data kosong"
                });
                return;
            }

            let temp;
            let labels = [];
            let values = [];
            let persent = [];
            $.each(res, function (key, val) {
                if (key == "persen_selesai") {
                    temp = "Paket Selesai";
                    labels.push(temp);
                    persent.push(parseFloat(val.toFixed(2)));
                } else if (key == "persen_proses") {
                    temp = "Paket Proses";
                    labels.push(temp);
                    persent.push(parseFloat(val.toFixed(2)));
                }

                if (key == "selesai") {
                    values.push(parseInt(val));
                } else if (key == "proses") {
                    values.push(parseInt(val));
                }
            });

            const ctx = document.getElementById("tenderChart").getContext("2d");
            window.tenderChartDraw = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [{
                        backgroundColor: ["#ffcd56", "#4bc0c0"],
                        data: values,
                        // borderWidth: [0, 0, 0, 0],
                    },],
                },
                options: {
                    onClick: tenderClick,
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
                        events: ['click'],
                        displayColors: false,
                    },
                },
            });

            function tenderClick(e) {
                const activePoints = myChart.getElementsAtEvent(e);
                // console.log(this.data.labels[0]);
                const selectedIndex = activePoints[0]._index;
                const status = this.data.labels[selectedIndex];
                $.ajax({
                    url: "<?= base_url(); ?>web/detailStatus",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        [csrfName]: csrfHash,
                        status: status
                    },
                    success: function (res) {
                        const target = $('#tableDetailStatus');
                        let html;
                        let no = 1;

                        $.each(res, function (i, val) {
                            html = "<tr>" +
                                "<th>" + no + "</th>" +
                                "<td>" + val.nama_satker + "</td>" +
                                "<td>" + val.nama_paket + "</td>" +
                                "<td>" + val.kd_rup_paket + "</td>" +
                                "<td>" + val.kd_tender + "</td>" +
                                // "<td>" + val.no_kontrak + "</td>" +
                                // "<td>" + val.tgl_kontrak + "</td>" +
                                "<td>" + val.pagu + "</td>" +
                                "<td>" + val.nilai_kontrak + "</td>" +
                                "<td>" + val.nama_penyedia + "</td>" +
                                // "<td>" + val.tgl_mulai_kerja_spmk + "</td>" +
                                // "<td>" + val.tgl_selesai_kerja_spmk + "</td>" +
                                // "<td>" + val.no_bast + "</td>" +
                                // "<td>" + val.tgl_bast + "</td>" +
                                "</tr>";
                            target.append(html);
                            no++;
                        });
                        $('#dataTableDetailStatus').DataTable();
                    }
                })
                $("#titleDetailStatus").text("Detail Status " + status);
                $("#modalDetailStatus").modal('show');
            }

            // DONUT TABLE
            const html = $("#tenderTable");
            const colors = ["#ffcd56", "#4bc0c0"];
            for (let i = 0; i < labels.length; i++) {
                const text =
                    '<tr><td><i class="bx bxs-circle me-2" style="color: ' +
                    colors[i] +
                    '"></i>' +
                    labels[i] +
                    "</td><td><strong>" + values[i] + " (" +
                    persent[i] +
                    "%)</strong></td></tr>";
                html.append(text);
            }
        },
    }).always(function () {
        $(".tenderChart").LoadingOverlay("hide", true);
    });
}

function chartNonTender(opd, year) {
    // STATUS NONTENDER 
    $.ajax({
        url: "<?= base_url(); ?>web/nontenderChart",
        type: "POST",
        dataType: "JSON",
        data: {
            [csrfName]: csrfHash,
            opd: opd,
            year: year
        },
        beforeSend: function () {
            $(".nontenderChart").LoadingOverlay("show");
            $(".cardnontender").LoadingOverlay("hide", true);
            $("#nontenderTable").empty();
            if (window.nontenderChartDraw) {
                window.nontenderChartDraw.destroy();
            }
        },
        success: function (res) {
            if (!res.total) {
                $(".cardnontender").LoadingOverlay("show", {
                    image: "",
                    text: "data kosong"
                });
                return;
            }
            let temp;
            let labels = [];
            let values = [];
            let persent = [];
            $.each(res, function (key, val) {
                if (key == "persen_selesai") {
                    temp = "Paket Selesai";
                    labels.push(temp);
                    persent.push(parseFloat(val.toFixed(2)));
                } else if (key == "persen_proses") {
                    temp = "Paket Proses";
                    labels.push(temp);
                    persent.push(parseFloat(val.toFixed(2)));
                }

                if (key == "selesai") {
                    values.push(parseInt(val));
                } else if (key == "proses") {
                    values.push(parseInt(val));
                }
            });

            const ctx = document.getElementById("nontenderChart").getContext("2d");
            window.nontenderChartDraw = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [{
                        backgroundColor: ["#ffcd56", "#4bc0c0"],
                        data: values,
                        // borderWidth: [0, 0, 0, 0],
                    },],
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
            const html = $("#nontenderTable");
            const colors = ["#ffcd56", "#4bc0c0"];
            for (let i = 0; i < labels.length; i++) {
                const text =
                    '<tr><td><i class="bx bxs-circle me-2" style="color: ' +
                    colors[i] +
                    '"></i>' +
                    labels[i] +
                    "</td><td><strong>" + values[i] + " (" +
                    persent[i] +
                    "%)</strong></td></tr>";
                html.append(text);
            }
        },
    }).always(function () {
        $(".nontenderChart").LoadingOverlay("hide", true);
    });
}

function chartEpurc(opd, year) {
    // STATUS EPURCHASINGS 
    $.ajax({
        url: "web/chartStatusEpur",
        type: "POST",
        dataType: "JSON",
        data: {
            [csrfName]: csrfHash,
            opd: opd,
            year: year
        },
        beforeSend: function () {
            $(".chartStatusEpur").LoadingOverlay("show");
            $(".cardepurc").LoadingOverlay("hide", true);
            $("#tableStatusEpur").empty();
            if (window.chartStatusEpurDraw) {
                window.chartStatusEpurDraw.destroy();
            }
        },
        success: function (res) {
            if (!res.total) {
                $(".cardepurc").LoadingOverlay("show", {
                    image: "",
                    text: "data kosong"
                });
                return;
            }
            let temp;
            let labels = [];
            let values = [];
            let persent = [];
            $.each(res, function (key, val) {
                if (key == "persen_selesai") {
                    temp = "Paket Selesai";
                    labels.push(temp);
                    persent.push(parseFloat(val.toFixed(2)));
                } else if (key == "persen_proses") {
                    temp = "Paket Proses";
                    labels.push(temp);
                    persent.push(parseFloat(val.toFixed(2)));
                }

                if (key == "selesai") {
                    values.push(parseInt(val));
                } else if (key == "proses") {
                    values.push(parseInt(val));
                }
            });

            // console.log(labels, values);

            const ctx = document.getElementById("chartStatusEpur").getContext("2d");
            window.chartStatusEpurDraw = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [{
                        backgroundColor: ["#ffcd56", "#4bc0c0"],
                        data: values,
                        // borderWidth: [0, 0, 0, 0],
                    },],
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
            const html = $("#tableStatusEpur");
            const colors = ["#ffcd56", "#4bc0c0"];
            for (let i = 0; i < labels.length; i++) {
                const text =
                    '<tr><td><i class="bx bxs-circle me-2" style="color: ' +
                    colors[i] +
                    '"></i>' +
                    labels[i] +
                    "</td><td><strong>" + values[i] + " (" +
                    persent[i] +
                    "%)</strong></td></tr>";
                html.append(text);
            }
        },
    }).always(function () {
        $(".chartStatusEpur").LoadingOverlay("hide", true);
    });
}

// ready function 
$(function () {
    refresh();

})
