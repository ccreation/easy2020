@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">
        <h4 class="mb-3 float-right" style="color: #512293; line-height: 40px;"><b><i class="fas fa-headset"></i> <span>{{$plugin->{"name_".app()->getLocale()} }}</span></b></h4>
        <a href="#" data-target="#save_plugin_data" class="btn btn-open general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>{{__("l.add_new")}}</span></a>
        <div class="clearfix mb-3"></div>

        <div class="mb-2"><span class="plix">1</span> <span>{{__("l.create_an_account_in_the_following_website")}} : </span> <a href="https://www.livechatinc.com" target="_blank">https://www.livechatinc.com</a>.</div>
        <div class="mb-2"><span class="plix">2</span> <span>{{__("l.copy_the_code_from_your_account_settings_and_paste_it_here")}} : </span> <small>(<a href="https://my.livechatinc.com/settings/code" target="_blank">https://my.livechatinc.com/settings/code</a>)</small></div>

        <form action="{{route("client.plugins.save_plugin_data")}}" id="save_plugin_data" class="formi" method="post">
            @csrf

            <input type="hidden" name="plugin_id" value="3">
            <input type="hidden" name="client_id" value="{{$client->id}}">

            <div class="form-group">
                <label><span>{{__("l.website")}}</span> <span class="text-danger">*</span></label>
                <select class="form-control" name="website_id">
                    <option value="">{{__("l.choose")}}</option>
                    @foreach($websites as $website)
                        <option value="{{$website->id}}">{{$website->{"name_".app()->getLocale()} }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label><span>{{__("l.code")}}</span> <span class="text-danger">*</span></label>
                <textarea class="form-control" name="code" required rows="6"></textarea>
            </div>

            <div class="form-group">
                <button class="btn general-btn-sm-blue" typeof="submit"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
            </div>

        </form>

        <table class="table table-ticket mt-3">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="60">#</th>
                    <th>الموقع</th>
                    <th>الحالة</th>
                    <th>الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach($plugin_datas as $plugin_data)
                <tr class="ticketlistproperties">
                    <td class="text-center" width="60"><b>{{$loop->iteration}}</b></td>
                    <td>{{$plugin_data->website->{"name_".app()->getLocale()} }}</td>
                    <td class="text-center">
                        @if($plugin_data->status == 0)
                            <span class="status-prj unacceptable">{{__("l.inactive")}}</span>
                        @else
                            <span class="status-prj enabled">{{__("l.active")}}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="action">
                            <a href="#" data-target="#update_plugin_data{{$plugin_data->id}}" class="btn-open" title="{{__("l.edit")}}"><i class="fa fa-edit"></i></a>
                            <a href="{{route("client.plugins.delete_plugin_data", $plugin_data->id)}}" onclick="return confirm('هل أنت متأكد ؟')" title="{{__("l.remove")}}"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-0" colspan="4" style="border: none;">
                        <form action="{{route("client.plugins.update_plugin_data")}}" id="update_plugin_data{{$plugin_data->id}}" class="formi" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$plugin_data->id}}">

                            <div class="form-group">
                                <label><span>{{__("l.status")}}</span></label>
                                <select class="form-control" name="status">
                                    <option value="1" @if($plugin_data->status == 1) selected @endif>{{__("l.active")}}</option>
                                    <option value="0" @if($plugin_data->status == 0) selected @endif>{{__("l.inactive")}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><span>{{__("l.website")}}</span> <span class="text-danger">*</span></label>
                                <select class="form-control" name="website_id">
                                    <option value="">{{__("l.choose")}}</option>
                                    @foreach($websites as $website)
                                        <option value="{{$website->id}}" @if($plugin_data->website_id == $website->id) selected @endif>{{$website->{"name_".app()->getLocale()} }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label><span>{{__("l.code")}}</span> <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="code" required rows="6">{{$plugin_data->code}}</textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn general-btn-sm-blue" typeof="submit"><i class="fa fa-save"></i> <span>{{__("l.update")}}</span></button>
                            </div>

                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection

@section("scripts")

    <style>
        .plix{
            width: 17px;
            height: 17px;
            background: #543c93;
            display: inline-block;
            line-height: 16px;
            text-align: center;
            border-radius: 50%;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            margin-left: 5px;
        }
    </style>

    <script>
        $(function () {
            $(".select2x").select2();
        })
    </script>

@endsection
