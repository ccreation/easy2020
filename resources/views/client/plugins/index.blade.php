@extends("client.parts.app")

@section("content")

    <div class="container pb-5 pt-2">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <form action="" class="form-search">
                    <div class="form-group">
                        <input type="text" placeholder="{{__("l.search")}}" class="form-control search">
                        <button class="btn-submit" type="submit"><i class="fas fa-search pl-2"></i>{{__("l.search")}}</button>
                        <button class="btn-submit btn-reset" type="reset"><i class="fas fa-times pl-2"></i>{{__("l.reset")}}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row plugins">
            @foreach($plugins as $plugin)
                <div class="col-lg-3 col-sm-6 plugin" data-name="{{$plugin->{"name_".app()->getLocale()} }}">
                    <div class="widget_item @if(@$plugin->status) @if(@$plugin->status=="accepted") deactivate @endif @endif widget__item_2 wow fadeInUp animate" data-wow-duration="1.5s" data-wow-delay=".1s">
                        <div class="widget__tooltip">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="widget__item--price">{{$plugin->price}}<span>{{__("l.rs")}}</span></h4>
                            </div>
                        </div>
                        <div class="widget__item-icon" style="overflow: hidden;">
                            <img src="{{asset("storage/app/".$plugin->image)}}" alt="" />
                        </div>
                        <div class="widget__item-title">
                            <h3>{{$plugin->{"name_".app()->getLocale()} }}</h3>
                        </div>
                        <div class="widget__item-info">
                            <h5>{{$plugin->{"description_".app()->getLocale()} }}</h5>
                        </div>
                        <div class="widget__item-action">
                            @if(@$plugin->status)
                                @if(@$plugin->status=="accepted")
                                    @if(cpermissions("plugins_settings_".$plugin->id))
                                        <a href="{{route("client.plugins.settings", $plugin->id)}}" class="genera-btn-outline btn px-3" style="color: #fff !important;"><span>{{__("l.plugin_settings")}}</span></a>
                                    @endif
                                @elseif(@$plugin->status=="pending")
                                    @if(cpermissions("plugins_purchase"))
                                        <a href="javascript:void(0)" class="genera-btn-outline btn px-3 disabled" disabled style="cursor: not-allowed; opacity: 1; color: #c8b9dc !important"><span>{{__("l.buy_this_plugin")}}</span></a>
                                    @endif
                                @endif
                            @else
                                @if(cpermissions("plugins_purchase"))
                                    <a href="{{route("client.payments.plugin_payment", $plugin->id)}}" class="genera-btn-outline btn px-3"><span>{{__("l.buy_this_plugin")}}</span></a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .form-search .btn-submit:not(.btn-reset){
            border-radius: 0px;
            border-left: 1px solid #7d58ae;
        }
        .form-search .btn-reset{
            left: -100px;
        }
        .sold{
            height: 27px;
            background: #21d232;
            padding: 3px 8px;
            font-weight: bold;
            color: #fff;
            width: 130px;
            transform: rotateZ(-45deg);
            z-index: 1;
            text-align: center;
            position: absolute;
            top: 20px;
            left: -30px;
            font-size: 1.2em;
        }
        .default_plan {
            height: 27px;
            background: #21d232;
            padding: 3px 8px;
            font-weight: bold;
            color: #fff;
            width: 180px;
            transform: rotateZ(45deg);
            text-align: center;
            position: absolute;
            top: 35px;
            right: -39px;
            font-size: 1.2em;
        }
        .pricing {
            background: #007bff;
            background: linear-gradient(to right, #0062E6, #33AEFF);
        }

        .pricing .card {
            border: none;
            border-radius: 1rem;
            transition: all 0.2s;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }

        .pricing hr {
            margin: 1.5rem 0;
        }

        .pricing .card-title {
            margin: 0.5rem 0;
            font-size: 0.9rem;
            letter-spacing: .1rem;
            font-weight: bold;
        }

        .pricing .card-price {
            font-size: 3rem;
            margin: 0;
        }

        .pricing .card-price .period {
            font-size: 0.8rem;
        }

        .pricing ul li {
            margin-bottom: 1rem;
        }

        .pricing .text-muted {
            opacity: 0.7;
        }

        .pricing .btn {
            font-size: 80%;
            border-radius: 5rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            opacity: 0.7;
            transition: all 0.2s;
        }

        /* Hover Effects on Card */

        @media (min-width: 992px) {
            .pricing .card:hover {
                margin-top: -.25rem;
                margin-bottom: .25rem;
                box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
            }
            .pricing .card:hover .btn {
                opacity: 1;
            }
        }
    </style>

@endsection

@section("scripts")

    <script>
        $(function () {

            $(document).on("submit", ".form-search", function (e) {
                e.preventDefault();
                var name = $(".search", this).val();
                $(".plugins .plugin").show();
                $(".plugins .plugin").filter(function (i) {
                    var namex = false;
                    if(name != ""){
                        var name0 = $(this).data("name");
                        if (name0.indexOf(name) >= 0)
                            namex = false;
                        else
                        namex = true;
                    }
                    return namex;
                }).hide();
            });

            $(document).on("reset", ".form-search", function (e) {
                $(".plugins .plugin").show();
            });
        });
    </script>

@endsection
