@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-4 text-center" style="color: #512293"><b>{{__("l.add_new_website")}}</b></h4>

        <form id="websites_save" action="{{route("client.websites.save")}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-md-11 mx-auto">
                    <div class="form-group row">
                        <label class="col-md-2"><span>{{__("l.website_slug")}}</span> <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="slug" id="slug" value="{{old('slug')}}" class="form-control" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                            <small>{{__("l.website_slug_note")}}</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 mx-auto">

                    <div class="form-group">
                        <label><span>{{__("l.website_category")}}</span> <span class="text-danger">*</span></label>
                        <select name="category_id" value="{{old('category_id')}}" class="form-control" required>
                            <option value="">إختر</option>
                            @foreach($catgeories as $category)
                                <option value="{{$category->id}}">{{$category->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="col-md-5 mx-auto">
                    <div class="form-group">
                        <label><span>{{__("l.logo")}}</span></label>
                        <input type="file" accept="image/*" name="logo" class="form-control" />
                    </div>
                </div>

                <div class="col-md-12 mt-2 mb-2"></div>

                <div class="col-md-5 mx-auto">

                    <div class="form-group">
                        <label><span>{{__("l.website_multi_lang")}}</span> <span class="text-danger">*</span></label>
                        <select name="multi_lang" id="multi_lang" class="form-control" required>
                            <option value="1">{{__("l.yes")}}</option>
                            <option value="0">{{__("l.no")}}</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-5 mx-auto">

                    <div class="form-group">
                        <label><span>{{__("l.website_default_lang")}}</span> <span class="text-danger">*</span></label>
                        <div class="kt-radio-list">
                            <label class="kt-radio mt-10">
                                <input type="radio" name="default_lang" class="default_lang" value="ar" checked> <strong>{{__("l.arabic")}}</strong>
                                <span style="background: #fff"></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="default_lang" class="default_lang" value="en"> <strong>{{__("l.english")}}</strong>
                                <span style="background: #fff"></span>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 mt-15 mb-15"></div>

                <div class="col-md-5 mx-auto" id="lang_ar">

                    <div class="form-group">
                        <label><span>{{__("l.website_name")}}</span> <small>({{__("l.arabic")}})</small></label>
                        <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label><span>{{__("l.website_brief")}}</span> <small>({{__("l.arabic")}})</small></label>
                        <textarea name="description_ar" rows="5" class="form-control">{{old('description_ar')}}</textarea>
                    </div>

                </div>

                <div class="col-md-5 mx-auto" id="lang_en">

                    <div class="form-group">
                        <label><span>{{__("l.website_name")}}</span> <small>({{__("l.english")}})</small></label>
                        <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label><span>{{__("l.website_brief")}}</span> <small>({{__("l.english")}})</small></label>
                        <textarea name="description_en" rows="5" class="form-control">{{old('description_en')}}</textarea>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="form-group text-center mt-4 mb-5">
                        <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa_save"></i> <span>{{__("l.save")}}</span></button>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection

@section("scripts")

    <script>

        $(function(){

            $(document).on("submit", "form", function () {
                $(this).find('button[type="submit"]').prop("disabled", true);
            });

            function define_lang_config(){
                var multi_lang      = $("#multi_lang").val();
                var default_lang    = $(".default_lang:checked").val();
                if(multi_lang==1){
                    $("#lang_en").show("slow");
                    $("#lang_ar").show("slow");
                }else{
                    if(default_lang=="ar"){
                        $("#lang_en").hide("fast");
                        $("#lang_ar").show("slow");
                    }else{
                        $("#lang_en").show("slow");
                        $("#lang_ar").hide("fast");
                    }

                }

            }

            var sluggable = true;

            $(document).on("keyup change paste", "#slug", function () {
                var slug  = $(this).val();
                var input = $(this);
                var url = "{{route("client.websites.sluggable")}}";
                $(".valid-feedback, .invalid-feedback").html("");
                if(slug != ""){
                    $.post(url,
                        { "_token": "{{ csrf_token() }}", slug : slug},
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

            $(document).on("change", "#multi_lang", function () {
                define_lang_config();
            });

            $(document).on("change", ".default_lang", function () {
                define_lang_config();
            });

            $(document).on("submit", "#websites_save", function () {
                if(!sluggable){
                    goNotif("error", "{{__("l.slug_note_bad")}}");
                    return false;
                }
                else{
                    $(this).find('button[type="submit"]').prop("disabled", true);
                }
            });

        });

    </script>

@endsection
