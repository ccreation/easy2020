@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="position: relative; min-height: 500px;">

        <form id="documentations_search" action="{{route("client.websites.documentations_search")}}" method="post" class="mb-20">

            <div class="input-group mb-3">
                <input type="text" class="form-control" name="q" placeholder="{{__("l.search")}} ..." required>
                <div class="input-group-prepend">
                    <button class="input-group-text"><i class="fa fa-search"></i></button>
                </div>
                <div class="input-group-prepend">
                    <button type="reset" class="input-group-text">{{__("l.reset")}}</button>
                </div>
            </div>

        </form>

        <div id="documentations">

            @foreach($categories as $category)

                <div class="card-group mb-2">
                    <div class="card card-default">
                        <div class="card-header">
                            <strong class="text-dark" style="cursor: pointer;" data-toggle="collapse" href="#collapse_category{{$category->id}}">{{$category->name}}</strong>
                        </div>
                        <div id="collapse_category{{$category->id}}" class="panel-collapse collapse">
                            <div class="card-body" @if(count($category->documentations)>0) style="padding-bottom: 5px;" @endif>

                                @if(count($category->documentations)>0)

                                    @foreach($category->documentations as $documentation)

                                        <div class="card-group mb-2" data-id="{{$documentation->id}}">
                                            <div class="card card-default">
                                                <div class="card-header">
                                                    <strong class="text-dark" style="cursor: pointer;" data-toggle="collapse" href="#collapse{{$documentation->id}}">{{$documentation->question}}</strong>
                                                </div>
                                                <div id="collapse{{$documentation->id}}" class="panel-collapse collapse">
                                                    <div class="card-body">
                                                        <div style="color: inherit; min-height: 300px; width: 100%; padding: 15px; border: 1px solid #eee;">{!! $documentation->answer !!}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                @else

                                    <h5 class="text-center"><b>{{__("l.no_data")}}</b></h5>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

    </div>

@endsection

@section("scripts")

    <script>

        $(function () {

            $(document).on("submit", "#documentations_search", function (e) {
                $("#documentations .collapse").collapse("hide");
                $("#documentations .collapse").closest(".card-group").fadeOut("fast");
               var url  = $(this).attr("action");
               var data = $(this).serialize();
               $.post(url, data, function (json) {
                   var result = [];
                   for(var i in json)
                       result.push([i, json [i]]);
                   console.log(result);
                  if(result.length > 1){
                      $.each(result, function (i, x) {
                          if(i != 0){
                              $("#collapse_category"+x[0]).collapse("show");
                              $("#collapse_category"+x[0]).closest(".card-group").fadeIn("slow");
                              $.each(x[1], function (j, y) {
                                  $("#collapse"+y).closest(".card-group").fadeIn("slow");
                              });
                          }
                      })
                  }else{
                      $("#documentations .collapse").collapse("hide");
                      $("#documentations .collapse").closest(".card-group").fadeOut("fast");
                  }
               });
               return false;
            });

            $(document).on("reset", "#documentations_search", function (e) {
                $("#documentations .collapse").collapse("hide");
                $("#documentations .collapse").closest(".card-group").fadeIn("fast");
            });

        });

    </script>

@endsection
