@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div style="border:1px solid #888; padding: 15px; margin: 10px;; background: #fff">
                    <h3 class="mb-3 mt-1 text-center" style="font-weight: bold">{{$form->name}}</h3>
                    <div class="row">
                        @foreach($form->fields as $f)
                            <div class="col-sm-{{($f->space == "1") ? "12" : (($f->space == "2") ? "6" : "4" ) }}">
                                <?php $required = ($f->required==1)?'required':''; ?>
                                <?php $placeholder = ($form->placeholder == 1) ? $f->placeholder : $f->name ; ?>
                                <?php $options = ($f->options)?explode(";", $f->options):[]; ?>
                                <?php $radius = ($form->form == "1") ? "0px" : (($form->form == "2") ? "7px" : "20px"); ?>
                                <div class="form-group">
                                    @if($form->placeholder == 1)
                                        <label><b>{{$f->name}}</b> @if($f->required==1)<span class="text-danger">*</span>@endif</label>
                                    @endif
                                    @if($f->type=="text")
                                        <input style="border-radius: {{$radius}} !important;" type="text" class="form-control" {{$required}} placeholder="{{$placeholder}}">
                                    @elseif($f->type=="date")
                                        <input style="border-radius: {{$radius}} !important;" type="text" class="form-control datee" {{$required}} placeholder="{{$placeholder}}">
                                    @elseif($f->type=="number")
                                        <input style="border-radius: {{$radius}} !important;" type="number" class="form-control" {{$required}} placeholder="{{$placeholder}}">
                                    @elseif($f->type=="textarea")
                                        <textarea style="border-radius: {{$radius}} !important;" type="text" class="form-control " rows="5" {{$required}} placeholder="{{$placeholder}}"></textarea>
                                    @elseif($f->type=="select" or $f->type=="selectmultiple")
                                        <div id="select-{{$f->id}}">
                                            <select class="form-control select2x"{{$required}} @if($f->type=="selectmultiple") multiple @endif>
                                                @foreach($options as $o)
                                                    <option>{{$o}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($placeholder)<small>{{$placeholder}}</small>@endif
                                        <style>
                                            #select-{{$f->id}} .select2, #select-{{$f->id}} .select2-selection{
                                                border-radius: {{$radius}} !important;
                                            }
                                        </style>
                                    @elseif($f->type=="attachement")
                                        <input style="border-radius: {{$radius}} !important;" type="file" accept="image/*" class="form-control" {{$required}} multiple>
                                        @if($placeholder)<small>{{$placeholder}}</small>@endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-21"></div>
        </div>

    </div>

@endsection

@section("scripts")

    <style>
        .input-group{
            width: 100%;
            margin-bottom: 20px;
        }
    </style>

    <script>

        $(function () {

            $('.datee').datepicker({
                format: "yyyy-mm-dd",
                language:"ar",
                autoclose: true,
                todayHighlight: true
            });

            $(".select2x").select2({
                placeholder : "{{__("l.choose")}}"
            });

        });

    </script>

@endsection
