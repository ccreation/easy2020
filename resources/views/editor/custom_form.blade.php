<form action="{{route("website.save_custom_form", [$website->slug, $lang])}}" class="custom_form mb-0" role="form" method="post" id="contactForm" name="contact-form" data-toggle="validator" ENCTYPE="multipart/form-data">
    @csrf

    <div class="heading-block nobottomborder bottommargin-sm">
        <div class="easy_text text-center">
            <h3>{{$form->name}}</h3>
        </div>
    </div>

    <input type="hidden" name="form_id" value="{{$form->id}}">
    <div class="row">
        @foreach($form->fields as $f)
            <div class="col-sm-{{($f->space == "1") ? "12" : (($f->space == "2") ? "6" : "4" ) }}" style="margin-bottom: 20px;">
                <?php $required = ($f->required==1)?'required':''; ?>
                <?php $placeholder = ($form->placeholder == 1) ? $f->placeholder : $f->name ; ?>
                <?php $options = ($f->options)?explode(";", $f->options):[]; ?>
                <?php $radius = ($form->form == "1") ? "0px" : (($form->form == "2") ? "7px" : "20px"); ?>
                <div class="form-group mb-0">
                    @if($form->placeholder == 1)
                        <label style="margin-top: 15px; margin-bottom: 0px;">{{$f->name}} @if($f->required==1)<span class="text-danger">*</span>@endif</label>
                    @endif
                    @if($f->type=="text")
                        <input style="height: 40px; border-radius: {{$radius}} !important;" type="text" name="field_{{$f->id}}" class="form-control mb-0" {{$required}} placeholder="{{$placeholder}}">
                    @elseif($f->type=="date")
                        <input style="height: 40px; border-radius: {{$radius}} !important;" type="text" name="field_{{$f->id}}" class="form-control mb-0 datee" {{$required}} placeholder="{{$placeholder}}" autocomplete="off">
                    @elseif($f->type=="number")
                        <input style="height: 40px; border-radius: {{$radius}} !important;" type="number" name="field_{{$f->id}}" class="form-control mb-0" {{$required}} placeholder="{{$placeholder}}">
                    @elseif($f->type=="textarea")
                        <textarea style="border-radius: {{$radius}} !important;" type="text" name="field_{{$f->id}}" class="form-control mb-0" rows="5" {{$required}} placeholder="{{$placeholder}}"></textarea>
                    @elseif($f->type=="select" or $f->type=="selectmultiple")
                        <div id="select-{{$f->id}}">
                            <select type="text"  @if($f->type=="selectmultiple") multiple name="field_{{$f->id}}[]" @else name="field_{{$f->id}}" @endif class="form-control mb-0 select2" {{$required}} @if($f->type=="selectmultiple") multiple @endif>
                                <?php $x=0; ?>
                                @foreach($options as $o)
                                    <option value="{{$x++}}">{{$o}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($placeholder)<small>{{$placeholder}}</small>@endif
                        <style>
                            #select-{{$f->id}} .select2, #select-{{$f->id}} .select2-selection{
                                border-radius: {{$radius}} !important;
                            }
                            #select-{{$f->id}} .select2-selection{
                                border: 1px solid #ced4da;
                            }
                        </style>
                    @elseif($f->type=="attachement")
                        <input style="height: 40px; border-radius: {{$radius}} !important;" name="field_{{$f->id}}[]" type="file" accept="image/*" class="form-control" {{$required}} multiple>
                        @if($placeholder)<small>{{$placeholder}}</small>@endif
                    @endif
                </div>
            </div>
        @endforeach

        <style>
            .select2-selection{
                height: 40px;
            }
        </style>

    </div>

    <div class="col_full nobottommargin easy_btn nomargin">
        <button type="submit" class="btn btn-2 btn-block" style="color: #fff;" value="submit">إرسال</button>
    </div>

</form>
