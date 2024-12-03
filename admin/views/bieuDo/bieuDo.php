<?php include './views/layout/header.php' ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php' ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php' ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Biểu đồ</h1>
                </div>
            </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div id="chart_div" style="width:100%; height:600px;">
                        <div id="chart" style="width:600px;height:400px;"></div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--footer-->
<?php include './views/layout/footer.php'; ?>

<!-- /.control-sidebar -->
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart', 'line']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Chuyển dữ liệu từ PHP sang JavaScript
        const data = google.visualization.arrayToDataTable([
            ['Ngày', 'Doanh thu sản phẩm', 'Giá thấp nhất', 'Giá cao nhất', 'Giá trung bình'],
            <?php
            foreach ($listTongKetTheoNgay as $row) {
                echo "['" . $row['ngay'] . "', " . $row['doanh_thu_san_pham'] . ", " . $row['minPrice'] . ", " . $row['maxPrice'] . ", " . $row['avgPrice'] . "],";
            }
            ?>
        ]);

        const options = {
            title: 'Thống kê doanh thu và giá theo ngày',
            curveType: 'function',
            legend: { position: 'top', alignment: 'center' },
            hAxis: {
                title: 'Ngày',
                titleTextStyle: { color: '#333', fontSize: 16, fontName: 'Arial', bold: true },
                gridlines: { count: 15 },
                textStyle: { color: '#333', fontSize: 14 },
                slantedText: true,
                slantedTextAngle: 45, // Góc nghiêng của nhãn trục hoành
            },
            vAxis: {
                title: 'Giá trị',
                minValue: 0,
                titleTextStyle: { color: '#333', fontSize: 16, fontName: 'Arial', bold: true },
                gridlines: { color: '#e0e0e0' },
                textStyle: { color: '#FF5722' },
            },
            series: {
                0: { 
                    color: '#4CAF50', 
                    lineWidth: 4, 
                    pointSize: 8, 
                    pointShape: 'circle', 
                    tooltip: { isHtml: true },
                    curveType: 'function',
                    opacity: 0.8, // Làm cho đường cong mờ đi một chút
                }, 
                1: { 
                    color: '#FF9800', 
                    lineWidth: 4, 
                    pointSize: 8, 
                    pointShape: 'square',
                    tooltip: { isHtml: true },
                    curveType: 'function',
                    opacity: 0.8,
                }, 
                2: { 
                    color: '#2196F3', 
                    lineWidth: 4, 
                    pointSize: 8, 
                    pointShape: 'triangle',
                    tooltip: { isHtml: true },
                    curveType: 'function',
                    opacity: 0.8,
                },
                3: { 
                    color: '#FF5722', 
                    lineWidth: 4, 
                    pointSize: 8, 
                    pointShape: 'star',
                    tooltip: { isHtml: true },
                    curveType: 'function',
                    opacity: 0.8,
                }, 
                4: { 
                    color: '#9C27B0', 
                    lineWidth: 4, 
                    pointSize: 8, 
                    pointShape: 'diamond',
                    tooltip: { isHtml: true },
                    curveType: 'function',
                    opacity: 0.8,
                },
            },
            pointSize: 8, // Kích thước điểm trên đường
            tooltip: { 
                isHtml: true, 
                trigger: 'focus', 
                textStyle: { color: '#333', fontSize: 14 } 
            },
            animation: {
                startup: true,
                duration: 2000,  // Mượt mà hơn với thời gian lâu hơn
                easing: 'out',
            },
            chartArea: {
                backgroundColor: '#f5f5f5', // Màu nền biểu đồ
                left: 50,
                top: 50,
                width: '80%',
                height: '80%',
            },
            focusTarget: 'category',
            selectionMode: 'multiple', // Cho phép chọn nhiều điểm
            // Hiệu ứng bóng mờ cho các điểm
            crosshair: { trigger: 'both', orientation: 'both' },
            hAxis: { gridlines: { color: '#e0e0e0' } },
            vAxis: { gridlines: { color: '#e0e0e0' } },
            chartArea: {
                width: '75%',
                height: '75%',
            }
        };

        const chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>



</body>

</html>