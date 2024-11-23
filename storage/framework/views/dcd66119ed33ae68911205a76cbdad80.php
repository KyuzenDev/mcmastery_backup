
<?php $__env->startSection('admin'); ?>
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                    <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i
                            data-feather="calendar" class="text-primary"></i></span>
                    <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date"
                        data-input>
                </div>
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="printer"></i>
                    Print
                </button>
                <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                    Download Report
                </button>
            </div>
        </div>

        

        <div class="row">
            <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Monthly User</h6>
                        </div>
                        <div id="monthlyUserChart"></div> <!-- Tempat Chart akan tampil -->
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->

        

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(function() {
            'use strict';

            var colors = {
                primary: "#6571ff",
                secondary: "#7987a1",
                success: "#05a34a",
                info: "#66d1d1",
                warning: "#fbbc06",
                danger: "#ff3366",
                light: "#e9ecef",
                dark: "#060c17",
                muted: "#7987a1",
                gridBorder: "rgba(77, 138, 240, .15)",
                bodyColor: "#b8c3d9",
                cardBg: "#0c1427"
            };

            var fontFamily = "'Roboto', Helvetica, sans-serif";

            // Monthly User Chart
            if ($('#monthlyUserChart').length) {
                var options = {
                    chart: {
                        type: 'bar',
                        height: '318',
                        parentHeightOffset: 0,
                        foreColor: colors.bodyColor,
                        background: colors.cardBg,
                        toolbar: {
                            show: false
                        },
                    },
                    theme: {
                        mode: 'light' // Sesuaikan dengan tema tampilan Anda
                    },
                    tooltip: {
                        theme: 'light' // Sesuaikan dengan tema tampilan Anda
                    },
                    colors: [colors.primary],
                    fill: {
                        opacity: .9
                    },
                    grid: {
                        padding: {
                            bottom: -4
                        },
                        borderColor: colors.gridBorder,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    series: [{
                        name: 'Users',
                        data: <?php echo json_encode($counts, 15, 512) ?>
                    }],
                    xaxis: {
                        type: 'category',
                        categories: <?php echo json_encode($months, 15, 512) ?>, 
                        axisBorder: {
                            color: colors.gridBorder,
                        },
                        axisTicks: {
                            color: colors.gridBorder,
                        },
                        labels: {
                            format: 'MMM yyyy'
                        },
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Users',
                            style: {
                                size: 9,
                                color: colors.muted
                            }
                        },
                    },
                    legend: {
                        show: true,
                        position: "top",
                        horizontalAlign: 'center',
                        fontFamily: fontFamily,
                        itemMargin: {
                            horizontal: 8,
                            vertical: 0
                        },
                    },
                    stroke: {
                        width: 0
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontSize: '10px',
                            fontFamily: fontFamily,
                        },
                        offsetY: -27
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "50%",
                            borderRadius: 4,
                            dataLabels: {
                                position: 'top',
                                orientation: 'vertical',
                            }
                        },
                    },
                };

                var apexBarChart = new ApexCharts(document.querySelector("#monthlyUserChart"), options);
                apexBarChart.render();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\mcmastery\resources\views\admin\index.blade.php ENDPATH**/ ?>