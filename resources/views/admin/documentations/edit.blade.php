@extends("admin.parts.app")

@section("content")

    <div class="container">

        <form action="{{route("admin.documentations.update")}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$documentation->id}}">

            <div class="row">

                <div class="col-lg-8 mx-auto">

                    <div class="form-group">
                        <label><span>القسم</span> <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-control" required>
                            <option value="">إختر</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($documentation->category_id == $category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label><span>الباقات</span></label>
                        <?php $planss = ($documentation->plans) ? explode(";", $documentation->plans) : []; ?>
                        <select name="plans[]" multiple class="form-control select2x">
                            @foreach($plans as $plan)
                                <option value="{{$plan->id}}" @if(in_array($plan->id, $planss)) selected @endif>{{$plan->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label><span>السؤال</span> <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control" value="{{$documentation->question}}" required>
                    </div>

                    <div class="form-group">
                        <label><span>الجواب</span> <span class="text-danger">*</span></label>
                        <textarea name="answer" class="form-control summernote"rows="10" required>{{$documentation->answer}}</textarea>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="form-group text-center mt-4 mb-5">
                        <button type="submit" class="btn general-btn-sm-blue rounded">تعديل</button>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection

@section("scripts")

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/lang/summernote-ar-AR.min.js" integrity="sha256-q9MLAOH++5Xn68U2GKNu9ufu7FJ7NB1SN/U9eoI9uJ0=" crossorigin="anonymous"></script>

    <style>
        .select2-selection{
            border: 1px solid #ced4da !important;
            border-radius: 0px !important;
            padding: 8px;
        }
    </style>

    <script>

        $(function () {

            $(".select2x").select2({dir: "rtl"});

            $(".summernote").summernote({height: 300, lang: 'ar-AR'});

        });

    </script>

@endsection



