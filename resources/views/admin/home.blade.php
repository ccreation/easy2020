@extends("admin.parts.app")

@section("content")

    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <a href="{{route("admin.clients.index")}}" class="widget__item_information">
                            <div class="widget__item_icon">
                                <i class="fa fa-users fa-3x" style="color: #543c93;"></i>
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">{{$clients}}</h3>
                                <h3 class="widget__item_title">عدد العملاء</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget__item_information">
                            <a href="{{route("admin.websites.index")}}" class="widget__item_icon">
                                <i class="fa fa-globe fa-3x" style="color: #543c93;"></i>
                            </a>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">{{$websites}}</h3>
                                <h3 class="widget__item_title">عدد المواقع</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{route("admin.templates.index")}}" class="widget__item_information">
                            <div class="widget__item_icon">
                                <i class="fa fa-brush fa-3x" style="color: #543c93;"></i>
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">{{$templates}}</h3>
                                <h3 class="widget__item_title">عدد القوالب</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{route("admin.payments.index")}}" class="widget__item_information">
                            <div class="widget__item_icon">
                                <i class="fa fa-money-bill-wave fa-3x" style="color: #543c93;"></i>
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">{{$payments}} <small>ريال</small></h3>
                                <h3 class="widget__item_title">عدد المبالغ المالية</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{route("admin.websites.index")}}" class="widget__item_information">
                            <div class="widget__item_icon">
                                <i class="fa fa-user fa-3x" style="color: #543c93;"></i>
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">{{$visits}}</h3>
                                <h3 class="widget__item_title">عدد الزوار</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{route("admin.users.index")}}" class="widget__item_information">
                            <div class="widget__item_icon">
                                <i class="fa fa-user-secret fa-3x" style="color: #543c93;"></i>
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">{{$users}}</h3>
                                <h3 class="widget__item_title">عدد المستخدمين</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{route("admin.documentations.index")}}" class="widget__item_information">
                            <div class="widget__item_icon">
                                <i class="fa fa-question-circle fa-3x" style="color: #543c93;"></i>
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">{{$documentations}}</h3>
                                <h3 class="widget__item_title">عدد الشروحات</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{route("admin.promocodes.index")}}" class="widget__item_information">
                            <div class="widget__item_icon">
                                <i class="fa fa-question-circle fa-3x" style="color: #543c93;"></i>
                            </div>
                            <div class="widget__item_desc">
                                <h3 class="widget__item_number">{{$coupons}}</h3>
                                <h3 class="widget__item_title">عدد الكوبونات</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header bg-primary text-center"><strong class="text-white">أعلى 10 مواقع من ناحية الزيارة</strong></div>
                    <div class="card-body" style="min-height: 200px;">
                        <ul class="p-0 m-0" style="list-style: none">
                            @foreach($visitlogs1y as $w)
                                <li class="mb-8">
                                    <div class="float-left"><a target="_blank" href="{{route("website.index", $w->slug)}}">{{$w->name_ar}}</a></div>
                                    <div class="float-right">{{$w->visilog}} زائر</div>
                                    <div class="clearfix"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header bg-primary text-center"><strong class="text-white">أعلى 10 قوالب مستخدمة</strong></div>
                    <div class="card-body" style="min-height: 200px;">
                        <ul class="p-0 m-0" style="list-style: none">
                            @foreach($templatess as $w)
                                <li class="mb-8">
                                    <div class="float-left"><a target="_blank" href="{{route("template.website.index2", $w->slug)}}">{{$w->name_ar}}</a></div>
                                    <div class="float-right">{{$w->used}} موقع</div>
                                    <div class="clearfix"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header bg-primary text-center"><strong class="text-white">أعلى 10 كوبونات مستخدمة</strong></div>
                    <div class="card-body" style="min-height: 200px;">
                        <ul class="p-0 m-0" style="list-style: none">
                            @foreach($promocodess as $pr)
                                <li class="mb-8">
                                    <div class="float-left">{{$pr->data["name"]}}</div>
                                    <div class="float-right">{{$pr->paymnt}} دفعة</div>
                                    <div class="clearfix"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header bg-primary text-center"><strong class="text-white"> أعلى 10 عملاء دفعوا مبالغ</strong></div>
                    <div class="card-body" style="min-height: 200px;">
                        <ul class="p-0 m-0" style="list-style: none">
                            @foreach($clientsss as $c)
                                <li class="mb-8">
                                    <div class="float-left"><a target="_blank" href="{{route("admin.clients.show", $c->id)}}">{{$c->name}}</a></div>
                                    <div class="float-right">{{$c->total}} ريال</div>
                                    <div class="clearfix"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-4">

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header bg-primary text-center"><strong class="text-white">اخر 10 عملاء ينتهي اشتراكهم</strong></div>
                    <div class="card-body" style="min-height: 200px;">
                        <ul class="p-0 m-0" style="list-style: none">
                            @foreach($subscription_days_clients as $c)
                                <li class="mb-8">
                                    <div class="float-left"><a target="_blank" href="{{route("admin.clients.show", $c->id)}}">{{$c->name}}</a></div>
                                    <div class="float-right">{{$c->days}} يوم</div>
                                    <div class="clearfix"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header bg-primary text-center"><strong class="text-white">احدث 10 عملاء مشتركين</strong></div>
                    <div class="card-body" style="min-height: 200px;">
                        <ul class="p-0 m-0" style="list-style: none">
                            @foreach($subscription_created_at_clients as $c)
                                <li class="mb-8">
                                    <div class="float-left"><a target="_blank" href="{{route("admin.clients.show", $c->id)}}">{{$c->name}}</a></div>
                                    <div class="float-right">منذ {{$c->dayss}} يوم</div>
                                    <div class="clearfix"></div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-primary text-center"><strong class="text-white">تصنيف العملاء حسب الباقات</strong></div>
                    <div class="card-body" style="">
                        <canvas id="myChart_2" height="100" dir="ltr"></canvas>
                    </div>
                </div>

            </div>

        </div>

        <div class="row mt-4">

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header bg-primary text-center"><strong class="text-white">مساحة جميع العملاء الافتراضية و المستهلكة</strong></div>
                    <div class="card-body" style="min-height: 200px;">
                        <canvas id="myChart_3" height="100" dir="ltr"></canvas>
                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="container-table-ticket">

                    <h4 class="mb-3">اخر 5 تذاكر الدعم الفني</h4>

                    <table class="table table-ticket">
                        <thead>
                            <tr class="ticketlistheaderrow">
                                <th width="50" class="text-center">#</th>
                                <th>العميل</th>
                                <th>عنوان التذكرة</th>
                                <th>نوع التذكرة</th>
                                <th>الموقع</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tickets as $ticket)
                            <tr class="ticketlistproperties">
                                <td  width="50" class="text-center"><strong>{{$ticket->id+1000}}</strong></td>
                                <td><a target="_blank" href="{{route("admin.clients.edit", @$ticket->client_id)}}">{{@$ticket->client->name}}</a></td>
                                <td>{{$ticket->name}}</td>
                                <td>{{@$ticket->type->name}}</td>
                                <td>
                                    @if(@$ticket->website)
                                        <a target="_blank" href="{{--route("website.index2", [@$ticket->website->slug, "ar"])--}}">{{@$ticket->website->{"name_".app()->getLocale()} }}</a>
                                    @else
                                        <span>عام</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($ticket->status == 0)
                                        <span class="status-prj enabled">مفتوح</span>
                                    @else
                                        <span class="status-prj unacceptable">مغلق</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="text-left">
                        <a href="{{route("admin.tickets.index")}}">الذهاب لجميع التذاكر</a>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@section("scripts")

    <style>
        .bg-primary{
            background-color: #543c93 !important;
        }
        .card{
            border: 1px solid #543c93;
        }
    </style>

    <script>

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

        // Doughnut chart
        var ctx = document.getElementById('myChart_2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [ @foreach($plans as $plan) "{{$plan->name_ar}}", @endforeach ],
                datasets: [{
                    data: [ @foreach($plans as $plan) {{$plan->clients_count}} , @endforeach ],
                    backgroundColor: [ @foreach($plans as $plan) '{{$plan->color}}', @endforeach ],
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
                    text: 'تصنيف العملاء حسب الباقات',
                    position: 'top',
                    fontSize: 16,
                    fontColor: '#111',
                    padding: 10
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 11,
                        fontColor: '#111',
                        padding: 10
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

        // Doughnut chart 2
        var val = parseInt( {{@$my_size}} / {{@$total_space}} * 100);
        var value1 = "{{intval($total_space/(intval($total_space+$my_size))*100)}}";
        var value2 = "{{intval($my_size/(intval($total_space+$my_size))*100)}}";
        var ctx2 = document.getElementById('myChart_3').getContext('2d');
        var myChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: [ "MB {{@$total_space}} {{__("l.available_space")}}", "MB {{@$my_size}} {{__("l.available_used")}}" ],
                datasets: [{
                    data: [ parseInt(100-val), val ],
                    backgroundColor: [ "lightgray", "#246bdc" ],
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
                    text: 'تصنيف العملاء حسب الباقات',
                    position: 'top',
                    fontSize: 16,
                    fontColor: '#111',
                    padding: 10
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 11,
                        fontColor: '#111',
                        padding: 10
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

        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });

    </script>

@endsection


