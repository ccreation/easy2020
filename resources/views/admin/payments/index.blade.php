@extends("admin.parts.app")

@section("content")

    <div class="container-fluid pb-5 pt-1">

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="30">#</th>
                    <th>العميل</th>
                    <th>التاريخ</th>
                    <th>طريقة الدفع</th>
                    <th>الباقة</th>
                    <th>القالب</th>
                    <th>الإضافة</th>
                    <th>السعر</th>
                    <th>الكوبون</th>
                    <th>السعر النهائي</th>
                    <th>الحالة</th>
                    <th width="150">الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @if(count($payments) >0)
                @foreach($payments as $payment)
                    <tr class="ticketlistproperties">
                        <td class="text-center" width="30"><strong>{{$loop->iteration}}</strong></td>
                        <td><a href="{{route("admin.clients.show", @$payment->client_id)}}">{{@$payment->client->name}}</a></td>
                        <td class="text-center">{{Carbon\Carbon::parse($payment->payment_date)->format("Y-m-d")}}</td>
                        <td>{{__("l.".$payment->payment_method)}}</td>
                        <td>
                            <div style="color: {{@$payment->plan->color}}">{{@$payment->plan->name_ar}}</div>
                            @if($payment->tamdid)
                                <div class="text-danger">تمديد الإشتراك</div>
                            @endif
                        </td>
                        <td>{{@$payment->template->name_ar}}</td>
                        <td>{{@$payment->plugin->name_ar}}</td>
                        <td>
                            @if(@$payment->plan)
                                <span>{{@$payment->plan->monthly_subscription}}</span> <span>رس/شهريا</span>
                            @elseif(@$payment->template)
                                <span>{{@$payment->template->price}}</span> <span>رس</span>
                            @elseif(@$payment->plugin)
                                <span>{{@$payment->plugin->price}}</span> <span>رس</span>
                            @endif
                        </td>
                        <td>
                            <span>{{@$payment->promocode->data["name"]}}</span>
                            @if(@$payment->promocode->data["name"])
                                <small>
                                    (
                                    @if(@$payment->promocode->data["reward_type"]==0)
                                        <span>{{@$payment->promocode->reward}}</span> <span>%</span>
                                    @else
                                        <span>{{@$payment->promocode->reward}}</span> <span>{{__("l.rs")}}</span>
                                    @endif
                                    )
                                </small>
                            @endif
                        </td>
                        <td><span>{{$payment->total}}</span> <span>رس</span></td>
                        <td class="text-center">
                            @if($payment->status=="pending")
                                <span class="status-prj pending">{{__("l.".$payment->status)}}</span>
                            @elseif($payment->status=="rejected")
                                <span class="status-prj unacceptable">{{__("l.".$payment->status)}}</span>
                            @else
                                <span class="status-prj enabled">{{__("l.".$payment->status)}}</span>
                            @endif
                        </td>
                        <td width="150" class="text-center">
                            <div class="action">
                                @if(permissions("payments_accept_reject"))
                                    @if($payment->status=="pending")
                                        <a onclick="return confirm('هل أنت متأكد ؟')" href="{{route("admin.payments.accept", $payment->id)}}" title="موافقة"><i class="fa fa-check"></i></a>
                                        <a onclick="return confirm('هل أنت متأكد ؟')" href="{{route("admin.payments.reject", $payment->id)}}" title="رفض"><i class="fa fa-times"></i></a>
                                    @else
                                        <a class="disabled" disabled href="#" title="موافقة"><i class="fa fa-check"></i></a>
                                        <a class="disabled" disabled href="#" title="رفض"><i class="fa fa-times"></i></a>
                                    @endif
                                @endif
                                @if(permissions("payments_details"))
                                    <a href="{{route("admin.payments.details", $payment->id)}}" title="التفاصيل"><i class="fa fa-eye"></i></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="ticketlistproperties">
                    <td colspan="12" class="text-center"><strong>{{__("l.no_data")}}</strong></td>
                </tr>
            @endif
            </tbody>
        </table>

    </div>

    <style>
        .action a.disabled{
            cursor: not-allowed !important;
            pointer-events: none !important;
            background-color: #7d58ae !important;

        }
    </style>

@endsection
