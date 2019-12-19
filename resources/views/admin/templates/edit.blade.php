@extends("admin.parts.app")

@section("content")

    <div class="container mt-2">

        <form action="{{route("admin.templates.update")}}" method="post" id="save_template" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$website->id}}">

            <div class="row">

                <div class="col-lg-4 mx-auto">

                    <div class="form-group">
                        <label><span>تصنيف القالب</span> <span class="text-danger">*</span></label>
                        <select name="category_id" value="{{old('category_id')}}" class="form-control" required>
                            <option value="">إختر</option>
                            @foreach($catgeories as $category)
                                <option value="{{$category->id}}" @if($website->category_id==$category->id) selected @endif>{{$category->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label><span>رابط القالب</span> <span class="text-danger">*</span></label>
                        <input type="text" name="slug" id="slug" value="{{$website->slug}}" class="form-control" autocomplete="off" required>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                        <small>{{__("l.website_slug_note")}}</small>
                    </div>

                    <div class="form-group">
                        <label><span>إسم القالب</span> <small>(عربي)</small> <span class="text-danger">*</span></label>
                        <input type="text" name="name_ar" value="{{$website->name_ar}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span>إسم القالب</span> <small>(إنجليزي)</small>  <span class="text-danger">*</span></label>
                        <input type="text" name="name_en" value="{{$website->name_en}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span>وصف القالب</span> <small>(عربي)</small></label>
                        <textarea name="description_ar" rows="5" class="form-control">{{$website->description_ar}}</textarea>
                    </div>

                    <div class="form-group">
                        <label><span>وصف القالب</span> <small>(إنجليزي)</small></label>
                        <textarea name="description_en" rows="5" class="form-control">{{$website->description_en}}</textarea>
                    </div>

                    <div class="form-group">
                        <label><span>مجاني</span> <span class="text-danger">*</span></label>
                        <select name="price" class="form-control price" required>
                            <option value="1" @if(!$website->price) selected @endif>نعم</option>
                            <option value="0" @if($website->price) selected @endif>لا</option>
                        </select>
                    </div>

                    <div id="div-wrapper" style="width: 100%;">
                        @if($website->price)
                            <div id="price">
                                <div class="form-group">
                                    <label><span>السعر</span> <span class="text-danger">*</span></label>
                                    <input type="number" step="0.1" min="0" max="10000000" name="the_price" value="{{$website->price}}" class="form-control" required>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label><span>شعار القالب</span></label>
                        <input type="file" name="logo" class="form-control" />
                        <br>
                        @if($website->logo)
                            <img src="{{asset("storage/app/".$website->logo)}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @else
                            <img src="{{asset("public/no-image2.png")}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @endif
                    </div>

                    <div class="form-group">
                        <label><span>صورة الحاسوب</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*" />
                        <br>
                        @if($website->image)
                            <img src="{{asset("storage/app/".$website->image)}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @else
                            <img src="{{asset("public/no-image2.png")}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @endif
                    </div>

                    <div class="form-group">
                        <label><span>صورة الآيباد</span></label>
                        <input type="file" name="image_ipad" class="form-control" accept="image/*" />
                        <br>
                        @if($website->image_ipad)
                            <img src="{{asset("storage/app/".$website->image_ipad)}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @else
                            <img src="{{asset("public/no-image2.png")}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @endif
                    </div>

                    <div class="form-group">
                        <label><span>صورة الجوال</span></label>
                        <input type="file" name="image_mobile" class="form-control" accept="image/*" />
                        <br>
                        @if($website->image_mobile)
                            <img src="{{asset("storage/app/".$website->image_mobile)}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @else
                            <img src="{{asset("public/no-image2.png")}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @endif
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="form-group text-center mt-4 mb-5">
                        <button type="submit" class="btn general-btn-sm-blue rounded">حفظ</button>
                    </div>
                </div>
            </div>

        </form>

    </div>

    <div style="display: none;" id="price-wrapper">
        <div id="price">
            <div class="form-group">
                <label><span>السعر</span> <span class="text-danger">*</span></label>
                <input type="number" step="0.1" min="0" max="10000000" name="the_price" value="0" class="form-control" required>
            </div>
        </div>
    </div>

@endsection

@section("scripts")

    <script>

        $(function () {

            $(document).on("change", ".price", function () {
                if($(this).val()==1)
                    $("#div-wrapper").html("");
                else
                    $("#div-wrapper").html($("#price-wrapper").html());
            });

            $(document).on("submit", "#save_template", function () {
                if(!sluggable){
                    goNotif("error", "{{__("l.slug_note_bad")}}");
                    return false;
                }
                else{
                    $(this).find('button[type="submit"]').prop("disabled", true);
                }
            });

            var sluggable = true;

            $(document).on("keyup change paste", "#slug", function () {
                var slug  = $(this).val();
                var input = $(this);
                var url = "{{route("admin.templates.sluggable")}}";
                $(".valid-feedback, .invalid-feedback").html("");
                if(slug != ""){
                    $.post(url,
                        { "_token": "{{ csrf_token() }}", "id" : "{{$website->id}}", slug : slug},
                        function (data) {
                            if(data=="OK"){
                                sluggable =true;
                                $(input).removeClass("is-invalid");
                                $(input).addClass("is-valid");
                                $(".valid-feedback").html("{{__("l.slug_note_ok")}}");
                            }else{
                                sluggable =false;
                                $(input).removeClass("is-valid");
                                $(input).addClass("is-invalid");
                                $(".invalid-feedback").html("{{__("l.slug_note_bad")}}");
                            }
                        });
                }else{
                    sluggable =false;
                    $(input).removeClass("is-valid");
                    $(input).removeClass("is-invalid");
                }
            });

        });

    </script>

@endsection
