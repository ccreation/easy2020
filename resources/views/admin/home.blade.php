@extends("admin.parts.app")

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget__item_information">
                            <div class="widget__item_icon">
                                <img src="{{asset("public/dashboard/images/Icon-info.png")}}" alt="">
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">14</h3>
                                <h3 class="widget__item_title">إجمالي المواقع</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget__item_information">
                            <div class="widget__item_icon">
                                <img src="{{asset("public/dashboard/images/Icon-info.png")}}" alt="">
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">12</h3>
                                <h3 class="widget__item_title">إجمالي الأعضاء</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget__item_information">
                            <div class="widget__item_icon">
                                <img src="{{asset("public/dashboard/images/Icon-info.png")}}" alt="">
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">222</h3>
                                <h3 class="widget__item_title">إجمالي المستخدمين</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget__item_information">
                            <div class="widget__item_icon">
                                <img src="{{asset("public/dashboard/images/Icon-info.png")}}" alt="">
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">514</h3>
                                <h3 class="widget__item_title">إجمالي الزيارات</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget__item_information">
                            <div class="widget__item_icon">
                                <img src="{{asset("public/dashboard/images/Icon-info.png")}}" alt="">
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">33</h3>
                                <h3 class="widget__item_title">إجمالي الزوار</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget__item_information">
                            <div class="widget__item_icon">
                                <img src="{{asset("public/dashboard/images/Icon-info.png")}}" alt="">
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">31</h3>
                                <h3 class="widget__item_title">إجمالي التعليقات</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget__item_information flex-column">
                    <div class="widget__item_chart">
                        <canvas id="myChart_1" dir="ltr"></canvas>
                    </div>
                    <div class="widget__item_desc pr-0 pt-3">
                        <h3 class="widget__item_title">الباقة الأساسية</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mr-auto">
                <div class="continer-chart">
                    <canvas id="myChart_2" height="350" dir="ltr"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="continer-chart mt-4">
                    <canvas id="myChart_3" ></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="container-table-ticket">
                    <h4 class="mb-3">اخر تذا؛ر الدعم الفني</h4>
                    <table class="table table-ticket">
                        <thead>
                        <tr class="ticketlistheaderrow">
                            <th width="25%">Budget</th>
                            <th width="25%">Quantity</th>
                            <th width="25%">Place</th>
                            <th width="25%">Materials</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="ticketlistproperties clickable-row" data-href="https://google.com">
                            <td data-title="#" class="number">$34,185.00</td>
                            <td data-title="$34,185.00">5 Quantity</td>
                            <td data-title="الدور">Washington, USA</td>
                            <td data-title="الجوال" class="number">Cement</td>
                        </tr>
                        <tr class="ticketlistproperties clickable-row" data-href="https://google.com">
                            <td data-title="#" class="number">$34,185.00</td>
                            <td data-title="$34,185.00">5 Quantity</td>
                            <td data-title="الدور">Washington, USA</td>
                            <td data-title="الجوال" class="number">Cement</td>
                        </tr>
                        <tr class="ticketlistproperties clickable-row" data-href="https://google.com">
                            <td data-title="#" class="number">$34,185.00</td>
                            <td data-title="$34,185.00">5 Quantity</td>
                            <td data-title="الدور">Washington, USA</td>
                            <td data-title="الجوال" class="number">Cement</td>
                        </tr>
                        <tr class="ticketlistproperties clickable-row" data-href="https://google.com">
                            <td data-title="#" class="number">$34,185.00</td>
                            <td data-title="$34,185.00">5 Quantity</td>
                            <td data-title="الدور">Washington, USA</td>
                            <td data-title="الجوال" class="number">Cement</td>
                        </tr>
                        <tr class="ticketlistproperties clickable-row" data-href="https://google.com">
                            <td data-title="#" class="number">$34,185.00</td>
                            <td data-title="$34,185.00">5 Quantity</td>
                            <td data-title="الدور">Washington, USA</td>
                            <td data-title="الجوال" class="number">Cement</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-left">
                        <a href="">الذهاب لجميع التذاكر</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")

    <script>
        var value = 75;
        var data = {
            labels: [
                "My val",
                ""
            ],
            datasets: [
                {
                    data: [value, 100-value],
                    backgroundColor: [
                        "#f1f1f1",
                        "#AAAAAA"
                    ],
                }]
        };

        var myChart_1 = new Chart(document.getElementById('myChart_1'), {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
                tooltips: {
                    filter: function(item, data) {
                        var label = data.labels[item.index];
                        if (label) return item;
                    }
                }
            }
        });

        textCenter(value);

        function textCenter(val) {
            Chart.pluginService.register({
                beforeDraw: function(chart) {
                    var width = myChart_1.chart.width,
                        height = myChart_1.chart.height,
                        ctx = myChart_1.chart.ctx;
                    ctx.fillStyle = '#fff';

                    ctx.restore();
                    var fontSize = (height / 114).toFixed(2);
                    ctx.font = fontSize + "em sans-serif";
                    ctx.textBaseline = "middle";

                    var text = val+"%",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            });
        }

    </script>
    <script>
        // Doughnut chart
        var ctx = document.getElementById('myChart_2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['html','css','js','jquery','pugjs'],
                datasets: [{
                    data: [27.92, 17.53, 14.94, 26.62, 12.99],
                    backgroundColor: ['#512293', '#81B234', '#512293', '#E4D8F0', '#AB92D0'],
                    borderWidth: 0.5 ,
                    borderColor: '#ddd'
                }]
            },
            options: {
                labels:{
                    display:false
                },
                cutoutPercentage: 60,
                title: {
                    display: true,
                    text: 'احصائية الزوار',
                    position: 'top',
                    fontSize: 16,
                    fontColor: '#111',
                    padding: 20
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 11,
                        fontColor: '#111',
                        padding: 11
                    }
                },
                tooltips: {
                    enabled: false
                },
                plugins: {
                    datalabels: {
                        color: '#111',
                        textAlign: 'center',
                        font: {
                            lineHeight: 1.2,
                            size:12
                        },
                        labels:{
                            display:false
                        },
                        formatter: function(value, ctx) {
                            return ctx.chart.data.labels[ctx.dataIndex] + '\n' + value + '%';
                        }
                    }
                }
            }
        });
    </script>
    <script>
        // Bar chart
        var ctx = document.getElementById('myChart_3').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [   "1" , "2", "3" , "4","1" , "2", "3" , "4","1" , "2", "3" , "4","1" , "2", "3" , "4","1" , "2", "3" , "4","1" , "2", "3" , "4"],
                datasets: [
                    {
                        label: "المتقدمين",
                        backgroundColor: "#81B234",
                        data: [19,12,19,35,19,35,19,35,19,35,19,35,19,35,19,35,19,35,19,35,19,35,19,35]
                    },
                    {
                        label: "الناجحين",
                        backgroundColor: "#512293",
                        data: [16,26,16,26,16,26,16,26,16,26,16,26,16,26,16,26,16,26,16,26,16,26,16,26]
                    },
                ]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 11,
                        fontColor: '#111',
                        padding: 11
                    }
                },
                title: {
                    display: true,
                    text: 'Population growth (millions): Europe & Africa'
                },
                scales: {
                    xAxes: [{
                        categoryPercentage: .5,
                        barPercentage: 0.9,

                    }],
                }
            }
        });

        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });

    </script>

@endsection


