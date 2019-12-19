@extends("admin.parts.app")

@section("content")

    <div class="container pb-5">

        <a href="{{route("admin.videos.categories")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-list"></i> <span>تصنيفات الفيديوهات</span></a>
        <a href="#" class="btn general-btn-sm-blue float-left btn-open ml-2" data-target="#add_video"><i class="fa fa-plus"></i> <span>إضافة فيديو</span></a>
        <div class="clearfix mb-4"></div>

        <form action="{{route("admin.videos.video_save")}}" method="post" class="formi mb-3" id="add_video">
            @csrf

            <div class="row">

                <div class="col-sm-8">

                    <div class="form-group">
                        <label><span>الإسم عربي</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name_ar" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span>الإسم إنجليزي</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name_en" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span>التصنيف</span></label>
                        <select name="category_id" value="" class="form-control">
                            <option value="">إختر</option>
                            @foreach($video_categories as $video_category)
                                <option value="{{$video_category->id}}">{{$video_category->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label><span>الرابط</span> <span class="text-danger">*</span></label>
                        <input type="text" name="url" id="url" value="" class="form-control" required>
                        <small>رابط يوتيوب أو فيميو أو رابط مباشر</small>
                    </div>

                </div>

                <div class="col-sm-4">
                    <div id="video_preview"></div>
                </div>

            </div>

            <div class="form-group">
                <button type="submit" class="general-btn-sm-blue"><i class="fa fa-save"></i> <span>إضافة</span></button>
            </div>

        </form>

        <table class="table table-ticket mt-2">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="60">#</th>
                    <th width="50">الفيديو</th>
                    <th>الإسم عربي</th>
                    <th>الإسم إنجليزي</th>
                    <th>التصنيف</th>
                    <th width="120">الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach($videos as $video)
                <tr class="ticketlistproperties">
                    <td class="text-center"><strong>{{$loop->iteration}}</strong></td>
                    <td width="200" style="padding: 0.75rem;"><?php $iframe = createVideo($video->url, 200, 150); ?>{!! $iframe !!}</td>
                    <td>{{$video->name_ar}}</td>
                    <td>{{$video->name_en}}</td>
                    <td>{{@$video->category->name_ar}}</td>
                    <td class="text-center" width="120">
                        <div class="action">
                            <a href="{{$video->url}}" target="_blank" title="مشاهدة">
                                <img src="{{asset("public/dashboard/images/eye.png")}}" alt="">
                            </a>
                            <a href="#" data-target="#edit_video{{$video->id}}" class="btn-open" title="تعديل">
                                <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                            </a>
                            <a href="{{route("admin.videos.video_delete", $video->id)}}" onclick="return confirm('هل انت متأكد ؟')" title="حذف">
                                <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-0" colspan="6" style="border: none;">
                        <form action="{{route("admin.videos.video_update")}}" method="post" class="formi" id="edit_video{{$video->id}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$video->id}}">

                            <div class="row">

                                <div class="col-sm-8">

                                    <div class="form-group">
                                        <label><span>الإسم عربي</span> <span class="text-danger">*</span></label>
                                        <input type="text" name="name_ar" value="{{$video->name_ar}}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label><span>الإسم إنجليزي</span> <span class="text-danger">*</span></label>
                                        <input type="text" name="name_en" value="{{$video->name_en}}" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label><span>التصنيف</span></label>
                                        <select name="category_id" value="" class="form-control">
                                            <option value="">إختر</option>
                                            @foreach($video_categories as $video_category)
                                                <option value="{{$video_category->id}}" @if($video_category->id == $video->category_id) selected @endif>{{$video_category->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label><span>الرابط</span> <span class="text-danger">*</span></label>
                                        <input type="text" name="url" id="url" value="{{$video->url}}" class="form-control" required>
                                        <small>رابط يوتيوب أو فيميو أو رابط مباشر</small>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                    <div id="video_preview"></div>
                                </div>

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>إضافة</span></button>
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

    <script>

        $(function () {

            function parseVideo (url) {
                // - Supported YouTube URL formats:
                //   - http://www.youtube.com/watch?v=My2FRPA3Gf8
                //   - http://youtu.be/My2FRPA3Gf8
                //   - https://youtube.googleapis.com/v/My2FRPA3Gf8
                // - Supported Vimeo URL formats:
                //   - http://vimeo.com/25451551
                //   - http://player.vimeo.com/video/25451551
                // - Also supports relative URLs:
                //   - //player.vimeo.com/video/25451551

                url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

                if (RegExp.$3.indexOf('youtu') > -1) {
                    var type = 'youtube';
                } else if (RegExp.$3.indexOf('vimeo') > -1) {
                    var type = 'vimeo';
                }else{
                    return {
                        type : "video",
                        id : url
                    }
                }

                return {
                    type: type,
                    id: RegExp.$6
                };
            }

            function createVideo (url, width, height) {
                // Returns an iframe of the video with the specified URL.
                var videoObj = parseVideo(url);
                var $iframe = $('<iframe>', { width: width, height: height });
                $iframe.attr('frameborder', 0);
                if (videoObj.type == 'youtube') {
                    $iframe.attr('src', '//www.youtube.com/embed/' + videoObj.id);
                } else if (videoObj.type == 'vimeo') {
                    $iframe.attr('src', '//player.vimeo.com/video/' + videoObj.id);
                }else{
                    $iframe.attr('src', videoObj.id);
                }
                return $iframe;
            }

            $(document).on("change paste keyup blur", "#url", function () {
                var url     =  $(this).val();
                //var html    = '<img src="'+url+'" style="width: 100%; height: 100%;">';
                var html    = createVideo (url, "100%", "300")
                $(this).closest(".row").find("#video_preview").html(html);
            });

        });

    </script>

@endsection
