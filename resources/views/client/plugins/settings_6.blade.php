@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">
        <h4 class="mb-3 float-right" style="color: #512293; line-height: 40px;"><b><i class="fab fa-mailchimp"></i> <span>{{$plugin->{"name_".app()->getLocale()} }}</span></b></h4>
        <div class="clearfix mb-3"></div>

        <div class="row">

            <div class="col-sm-6">

                <form action="{{route("client.plugins.save_settings6")}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label><span class="plix">1</span> <span>{{__("l.create_an_account_in_the_following_website")}} : </span>
                            <a href="https://mailchimp.com/" target="_blank">https://mailchimp.com</a>.</label>
                    </div>

                    <div class="form-group mb-10">
                        <label><span class="plix">2</span> <span>{{__("l.enable_the_plugin")}} : </span></label>
                        <div>
                            <span class="kt-switch kt-switch--icon">
                                <label>
                                    <input type="checkbox" @if(@$settings["enable_mailchimp"]->value=="1") checked @endif name="enable_mailchimp" value="1">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>

                    @if(@$settings["enable_mailchimp"]->value=="1")

                        <div class="form-group">
                            <label class="mb-10"><span class="plix">3</span> <span> انسخ ال api key من إعدادات حسابك و قم بلصقه هنا : </span> </label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="mailchimp_api_key" required value="{{@$settings["mailchimp_api_key"]->value}}" />
                                </div>
                            </div>
                        </div>

                    @endif

                    <div class="form-group">
                        <button class="btn general-btn-sm-blue" typeof="submit"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                    </div>


                </form>

            </div>

            <div class="col-sm-6">
                <form action="{{route("client.plugins.export_to_mailchimp")}}" method="post">
                    @csrf
                    @if(count($mailchimp_lists)>0 and @$settings["enable_mailchimp"]->value=="1")
                        <div class="form-group">
                            <label class="mb-10"><span class="plix">4</span> <span> إختر القائمة التي تريد ان تصدر لها المشتركين في النشرة البريدية (<span>{{$newsletter_count}}</span> <span>مشترك</span>) : </span> </label>
                            <div class="row">
                                <div class="col-md-10">
                                    <select class="form-control" name="list" required>
                                        <option value="">{{__("l.choose")}}</option>
                                        @foreach($mailchimp_lists as $list)
                                            <option value="{{$list["id"]}}">{{$list["name"]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="mb-10"><span class="plix">5</span> <span> تصدير المشتركين في النشرة البريدية إلى قائمة مايلشيمب : </span> </label>
                            <button type="submit" class="btn btn-success btn-block w120"><i class="fa fa-upload"></i><span>تصدير</span></button>
                        </div>
                    @endif
                </form>
            </div>

        </div>

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

@endsection
