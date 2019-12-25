@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        @if(intval($number_phone_newsletter_subscribers + $number_email_newsletter_subscribers) > 0)
            <div class="row">
                <div class="col-sm-6">
                    <div class="kt-widget14__header">
                        <h3 class="kt-widget14__title">{{__("l.newsletter_subscribers_number")}}</h3>
                    </div>
                    <div class="kt-widget14__content">
                        <div class="kt-widget14__chart">
                            <div id="kt_chart_revenue_change_newsletter" style="height: 150px; width: 150px;"></div>
                        </div>
                        <div class="kt-widget14__legends">
                            <div class="kt-widget14__legend">
                                <span class="kt-widget14__bullet kt-bg-success"></span>
                                <span class="kt-widget14__stats"><span>{{($number_phone_newsletter_subscribers + $number_email_newsletter_subscribers == 0) ? 0 : intval($number_phone_newsletter_subscribers / ($number_phone_newsletter_subscribers + $number_email_newsletter_subscribers) * 100)}} %</span> <span>{{__("l.number_phone_newsletter_subscribers")}}</span></span>
                            </div>
                            <div class="kt-widget14__legend">
                                <span class="kt-widget14__bullet kt-bg-warning"></span>
                                <span class="kt-widget14__stats"><span>{{($number_phone_newsletter_subscribers + $number_email_newsletter_subscribers == 0) ? 0 : intval($number_email_newsletter_subscribers / ($number_phone_newsletter_subscribers + $number_email_newsletter_subscribers) * 100)}} %</span> <span>{{__("l.number_email_newsletter_subscribers")}}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pt-10">
                    <a href="{{route("client.newsletter.newsletter_export_excel")}}" class="btn btn-success newsletter_export_excel"><i class="fas fa-file-excel"></i> <span>{{__("l.export_excel")}}</span></a>
                    <div id="newsletter_export_excel_wrapper">
                        <div id="newsletter_export_excel_div">
                            @if(@$settings["newsletter_export_excel_date"])
                                <h6 class="mt-20" style="font-size: 1.21em; line-height: 23px;">
                                    <span>آخر تصدير تم بواسطة</span> <span>"{{@$settings["newsletter_export_excel_nuser"]->value}}"</span>
                                    <span>بتاريخ</span> <span class="ib">{{@$settings["newsletter_export_excel_date"]->value}}</span>
                                    <span>و وقت</span> <span class="ib">{{@$settings["newsletter_export_excel_time"]->value}}</span>
                                    <span>وذلك ل</span> <span>{{@$settings["newsletter_export_excel_number"]->value}}</span> <span>مسجل في النشرة البريدية.</span>
                                </h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <h4 class="mb-3 mt-4" style="color: #543c93"><b>{{__("l.newsletter_list")}}</b></h4>

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="50">#</th>
                    <th>{{__("l.website")}}</th>
                    <th>{{__("l.name")}}</th>
                    <th>{{__("l.email")}}</th>
                    <th>{{__("l.phone")}}</th>
                    <th>{{__("l.date")}}</th>
                </tr>
            </thead>
            <tbody>
            @if(count($newsletters)>0)
                @foreach($newsletters as $newsletter)
                    <tr class="ticketlistproperties">
                        <td class="text-center" width="50"><strong>{{$loop->iteration}}</strong></td>
                        <td>{{@$newsletter->website->{"name_".app()->getLocale()} }}</td>
                        <td>{{$newsletter->name}}</td>
                        <td>{{$newsletter->email}}</td>
                        <td>{{$newsletter->phone}}</td>
                        <td>{{$newsletter->created_at}}</td>
                    </tr>
                @endforeach
            @else
                <tr class="ticketlistproperties">
                    <td colspan="7" class="text-center"><b>{{__("l.no_data")}}</b></td>
                </tr>
            @endif
            </tbody>
        </table>

    </div>

@endsection

@section("scripts")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js" integrity="sha256-TabprKdeNXbSesCWLMrcbWSDzUhpAdcNPe5Q53rn9Yg=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" integrity="sha256-szHusaozbQctTn4FX+3l5E0A5zoxz7+ne4fr8NgWJlw=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js" integrity="sha256-0rg2VtfJo3VUij/UY9X0HJP7NET6tgAY98aMOfwP0P8=" crossorigin="anonymous"></script>

    <script>

        $(function () {

            Morris.Donut({

                element: 'kt_chart_revenue_change_newsletter',
                data: [{
                            label: "{{__("l.number_phone_newsletter_subscribers")}}",
                            value: {{intval($number_phone_newsletter_subscribers)}}
                        },
                        {
                            label: "{{__("l.number_email_newsletter_subscribers")}}",
                            value: {{intval($number_email_newsletter_subscribers)}}
                        }
                    ],
                colors: ["#0abb87", "#ED5794"],
            });

            $(document).on("click", ".btn.newsletter_export_excel", function () {
                setTimeout(function () {
                    $("#newsletter_export_excel_wrapper").load(window.location + " #newsletter_export_excel_div");
                }, 2000);
            })

        });

    </script>

@endsection
