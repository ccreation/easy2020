@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-3 text-center" style="color: #512293"><b>{{__("l.comments")}}</b></h4>

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="35">#</th>
                    <th>{{__("l.website")}}</th>
                    <th>{{__("l.page_name")}}</th>
                    <th>{{__("l.post")}}</th>
                    <th>{{__("l.author")}}</th>
                    <th>{{__("l.last_modified")}}</th>
                    <th width="20%">{{__("l.excerpt")}}</th>
                    <th>{{__("l.status")}}</th>
                    <th width="140">{{__("l.actions")}}</th>
                </tr>
            </thead>
            <tbody>
                @if(count($comments) > 0)
                    @foreach($comments as $comment)
                        <tr class="ticketlistproperties">
                            <td class="text-center" width="35"><b>{{$loop->iteration}}</b></td>
                            <td style="vertical-align: middle"><a target="_blank" href="{{--route("pages.indexbywebsite", $comment->website_id)--}}">{{@$comment->website->name_ar}}</a></td>
                            <td style="vertical-align: middle"><a target="_blank" href="{{--route("pages.edit", $comment->page_id)--}}">{{@$comment->page->name}}</a></td>
                            <td style="vertical-align: middle">

                            </td>
                            <td>{{($comment->author) ? @$comment->author->name : $comment->name}} @if(!$comment->author) <small>(زائر)</small> @endif</td>
                            <td class="text-center">{{$comment->updated_at}}</td>
                            <td>{{getExcerpt($comment->message, 100)}}</td>
                            <td class="text-center">
                                @if($comment->status == 0)
                                    <div class="status-prj unacceptable">{{__("l.draft")}}</div>
                                @else
                                    <div class="status-prj enabled">{{__("l.published")}}</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="action">
                                    @if(cpermissions("comments_publish_draft"))
                                        @if($comment->status == 0)
                                            <a title="{{__("l.publish")}}" href="{{route("client.comments.change_comment_status", [$comment->id, 1])}}"
                                               onclick="return confirm('{{__("l.are_you_sure")}}')"><i class="fa fa-thumbs-up"></i></a>
                                        @else
                                            <a title="{{__("l.draft")}}" href="{{route("client.comments.change_comment_status", [$comment->id, 0])}}"
                                               onclick="return confirm('{{__("l.are_you_sure")}}')"><i class="fa fa-thumbs-down text-white"></i></a>
                                        @endif
                                    @endif
                                    <a data-toggle="modal" data-target="#show_comment{{$comment->id}}" title="{{__("l.details")}}" href=""><i class="fa fa-eye"></i></a>
                                    @if(cpermissions("comments_update"))
                                        <a data-toggle="modal" data-target="#update_comment{{$comment->id}}" title="{{__("l.edit")}}" href=""><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if(cpermissions("comments_delete"))
                                        <a data-toggle="tooltip" title="{{__("l.delete")}}" href="{{route("client.comments.delete_comment", [$comment->id, 1])}}"
                                           onclick="return confirm('{{__("l.are_you_sure")}}')"><i class="fa fa-trash"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="ticketlistproperties">
                        <td colspan="9" class="text-center"><b>{{__("l.no_data")}}</b></td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>

    @foreach($comments as $comment)

        <div id="show_comment{{$comment->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{__("l.comment")}}</h4>
                        <button type="button" class="close" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{__("l.page_name")}}</label>
                            <div><a target="_blank" href="{{--route("pages.edit", $comment->page_id)--}}">{{@$comment->page->name}}</a> <small>({{@$comment->website->name_ar}})</small></div>
                        </div>
                        <div class="form-group">
                            <label>{{__("l.author")}}</label>
                            <div>{{($comment->author) ? @$comment->author->name : $comment->name}}</div>
                        </div>
                        <div class="form-group">
                            <label>{{__("l.last_modified")}}</label>
                            <div>{{$comment->updated_at}}</div>
                        </div>
                        <div class="form-group">
                            <label>{{__("l.last_modified")}}</label>
                            <div>{{$comment->updated_at}}</div>
                        </div>
                        <div class="form-group">
                            <label>{{__("l.status")}}</label>
                            <div>@if($comment->status == 0) {{__("l.draft")}} @else {{__("l.published")}} @endif
                            </div>
                            <div class="form-group">
                                <label>{{__("l.comment_text")}}</label>
                                <div>{{$comment->message}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(cpermissions("comments_update"))
            <div id="update_comment{{$comment->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"></button>
                            <h4 class="modal-title">{{__("l.comment")}}</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{route("client.comments.update_comment")}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$comment->id}}">
                                <div class="form-group">
                                    <label><span>{{__("l.comment_text")}}</span> <span class="text-danger">*</span></label>
                                    <textarea name="message" class="form-control" required rows="7">{{$comment->message}}</textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block general-btn-sm-blue">{{__("l.edit")}}</button>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
            </div>
        @endif

    @endforeach

@endsection
