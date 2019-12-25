@extends("client.parts.app")

@section("content")

    <div class="container-fluid pt-2 pb-5" style="position: relative; min-height: 500px;">

        @if(cpermissions("my_websites_add"))
            @if(($my_websites < @$my_plan->website_numbers and @$my_plan->website_numbers!=0) or @$my_plan->website_numbers==0)
                <a href="{{route("client.websites.add")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>{{__("l.add_new_website")}}</span></a>
            @endif
        @endif
        <a href="javascript:void(0)" onclick="$('#websites_filter').slideToggle();" class="btn general-btn-sm-blue float-left" style="margin-left: 15px;"> <i class="fa fa-filter"></i> <span>{{__("l.filters")}}</span> </a>

        <form id="websites_filter" class="row" action="javascript:void(0);">

            <div class="col-sm-12"><h4 class="mb-2" style="color: #543C93;">{{__("l.filters")}} : </h4></div>

            <div class="col-sm-12 mb-2">
                <select class="user form-control">
                    <option value="all">{{__("l.user")}}</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-12 mb-2">
                <input type="text" class="name_ar form-control" placeholder="{{__("l.name")}} ({{__("l.arabic")}})">
            </div>

            <div class="col-sm-12 mb-2">
                <input type="text" class="name_en form-control" placeholder="{{__("l.name")}} ({{__("l.english")}})">
            </div>

            <div class="col-sm-12 mb-2">
                <input type="text" class="website_slug form-control" placeholder="{{__("l.website_slug")}}">
            </div>

            <div class="col-sm-12 mb-2">
                <select class="status form-control">
                    <option value="all">{{__("l.status")}}</option>
                    <option value="1">{{__("l.open")}}</option>
                    <option value="0">{{__("l.blocked")}}</option>
                </select>
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="text-center col-sm-6" style="padding-top: 5px">
                        <button type="submit" class="btn general-btn-sm-blue">{{__("l.filter")}}</button>
                    </div>

                    <div class="text-center col-sm-6" style="padding-top: 5px">
                        <button type="reset" class="btn general-btn-sm-black">{{__("l.reset")}}</button>
                    </div>
                </div>
            </div>

        </form>

        <div class="clearfix pb-3"></div>

        <table class="table table-ticket" id="websites_table">
            <thead style="background: #fafafa;">
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="30">#</th>
                    <th width="42">{{__("l.logo")}}</th>
                    <th>{{__("l.user")}}</th>
                    <th><span>{{__("l.name")}}</span> <small>({{__("l.arabic")}})</small></th>
                    <th><span>{{__("l.name")}}</span> <small>({{__("l.english")}})</small></th>
                    <th><span>{{__("l.website_slug")}}</span></th>
                    @if($plan->root_domain==1)
                        <th><span>{{__("l.domain")}}</span></th>
                    @endif
                    <th><span>{{__("l.page_numbers")}}</span></th>
                    <th><span>{{__("l.status")}}</span></th>
                    <th width="270">{{__("l.actions")}}</th>
                </tr>
            </thead>
            <tbody>
            @if(count($websites)>0)
                @foreach($websites as $website)
                    <tr class="ticketlistproperties" data-user0="{{$website->user_id}}" data-name_ar0="{{$website->name_ar}}" data-name_en0="{{$website->name_en}}"
                        data-website_slug0="{{@$website->slug}}" data-status0="{{$website->status}}">
                        <td class="text-center" width="30"><b>{{$loop->iteration}}</b></td>
                        <td width="42" style="padding: 10px;">
                            @if($website->logo)
                                <img src="{{$website->logo}}" style="width: 40px; display: block; margin: 0px auto; height: 40px; border: 1px solid #eee; border-radius: 2px;">
                            @else
                                <img src="{{asset("public/no-image2.png")}}" style="width: 40px; display: block; margin: 0px auto; height: 40px; border: 1px solid #eee; border-radius: 2px;">
                            @endif
                        </td>
                        <td>{{@$website->user->name}}</td>
                        <td>{{$website->name_ar}}</td>
                        <td style="text-align: left;direction: ltr;">{{$website->name_en}}</td>
                        <td class="text-center">
                            @if($website->slug)
                                <a href="{{--route("website.index2", [$website->slug])--}}" class="text-primary" target="_blank">{{$website->slug}}</a>
                            @endif
                        </td>
                        @if($plan->root_domain==1)
                            <td class="text-center">
                                @if($website->domain)
                                    <a href="https://{{$website->domain}}" class="text-primary" target="_blank">{{$website->domain}}</a>
                                @endif
                            </td>
                        @endif
                        <td class="text-center">{{$website->pages_count}}</td>
                        <td class="text-center">
                            @if($website->status == 1)
                                <span class="status-prj enabled">{{__("l.open")}}</span>
                            @else
                                <span class="status-prj unacceptable">{{__("l.blocked")}}</span>
                                <a href="#" data-toggle="modal" data-target="#block_reason_modal{{$website->id}}" class="btn btn-danger btn-block text-center" style="margin: 0px auto;">{{__("l.block_reason")}}</a>
                            @endif
                        </td>
                        <td class="text-center" width="270" style="padding: 10px;">
                            <div class="action">
                                @if($website->slug)
                                    <a href="{{--route("website.index2", [$website->slug])--}}" target="_blank"><i class="fa fa-eye"></i></a>
                                @endif
                                @if($my_plan->root_domain == 1 and $website->status == 1)
                                    <a href="{{route("client.websites.add_domain_step_1", $website->id)}}" title="{{__("l.change_domain")}}"><i class="fa fa-link"></i></a>
                                @endif
                                @if(cpermissions("my_websites_pages"))
                                    <a href="{{--route("pages.indexbywebsite", $website->id)--}}" title="{{__("l.website_pages_list")}}"><i class="fa fa-list"></i></a>
                                @endif
                                @if(cpermissions("my_websites_choose_template"))
                                    <a href="{{route("client.websites.choose_template_by_id", $website->id)}}" title="{{__("l.change_website_template")}}"><i class="fa fa-brush"></i></a>
                                @endif
                                @if(cpermissions("my_websites_update"))
                                    <a href="{{route("client.websites.edit", $website->id)}}" title="{{__("l.edit_website")}}"><i class="fa fa-edit"></i></a>
                                @endif
                                @if(cpermissions("my_websites_delete"))
                                    <a href="{{route("client.websites.delete", $website->id)}}" onclick="return confirm('{{__("l.are_you_sure")}}')" title="{{__("l.delete")}}"><i class="fa fa-trash"></i></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="ticketlistproperties"><td colspan="@if($plan->root_domain==1)10 @else 9 @endif" class="text-center"><b>{{__("l.no_data")}}</b></td></tr>
            @endif
            </tbody>
        </table>

        {{$websites->links()}}

        @foreach($websites as $website)
            @if($website->status == 0)
                <div class="modal" id="block_reason_modal{{$website->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{__("l.block_reason")}}</h4>
                            </div>
                            <div class="modal-body text-justify">
                                {{$website->block_reason}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>

@endsection

@section("scripts")

    <style>
        .action{
            flex-wrap: wrap;
        }
        .table-ticket .action a{
            margin: 0px 0px 5px 5px;
        }
        #websites_filter{
            display: none;
            padding: 10px 10px 20px;
            width: 300px;
            background: #E4D8F0;
            border: 1px solid #543C93;
            position: absolute;
            top: 54px;
            left: 112px;
            z-index: 333;
        }
    </style>

    <script>

        $(function () {

            $(document).on("submit", "#websites_filter", function (e) {
                e.preventDefault();
                var user            = $("#websites_filter .user").val()+"";
                var name_ar         = $("#websites_filter .name_ar").val()+"";
                var name_en         = $("#websites_filter .name_en").val()+"";
                var website_slug    = $("#websites_filter .website_slug").val()+"";
                var status          = $("#websites_filter .status").val()+"";

                $("#websites_table tbody tr").hide();
                $("#websites_table tbody tr").filter(function () {

                    var userx = true;
                    var user0 = $(this).data('user0')+"";
                    if(user != "all"){
                        if(user0 != user)
                            userx = false;
                    }

                    var name_arx = true;
                    var name_ar0 = $(this).data('name_ar0')+"";
                    if(name_ar != ""){
                        if(!name_ar0.includes(name_ar))
                            name_arx = false;
                    }

                    var name_enx = true;
                    var name_en0 = $(this).data('name_en0')+"";
                    if(name_en != ""){
                        if(!name_en0.includes(name_en))
                            name_enx = false;
                    }

                    var website_slugx = true;
                    var website_slug0 = $(this).data('website_slug0')+"";
                    if(website_slug != ""){
                        if(!website_slug0.includes(website_slug))
                            website_slugx = false;
                    }

                    var statusx = true;
                    var status0 = $(this).data('status0')+"";
                    if(status!="all"){
                        if(status0!=status)
                            statusx = false;
                    }

                    console.log(status);
                    console.log(status0);
                    console.log(statusx);
                    console.log("--------------");

                    return ( userx && name_arx && name_enx && website_slugx && statusx);

                }).show();
                $('#websites_filter').slideUp();

            });

            $(document).on("reset", "#websites_filter", function (e) {
                e.preventDefault();
                $('#websites_filter .user').val("all");
                $('#websites_filter .name_ar').val("");
                $('#websites_filter .name_en').val("");
                $('#websites_filter .website_slug').val("");
                $('#websites_filter .status').val("all");
                $("#websites_table tbody tr").show();
                $('#websites_filter').slideUp();
            });

        });

    </script>

@endsection
