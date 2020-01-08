@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">
        <h4 class="mb-3 float-right" style="color: #512293; line-height: 40px;"><b><i class="fab fa-wpforms"></i> <span>{{$form->name}}</span></b></h4>
        <div class="clearfix mb-3"></div>

        <table class="table table-ticket mt-3">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="50">#</th>
                    <th>{{__("l.website")}}</th>
                    @foreach($form->fields as $f)
                        <th>{{$f->name}}</th>
                    @endforeach
                    <th>{{__("l.date")}}</th>
                    <th>{{__("l.actions")}}</th>
                </tr>
            </thead>
            <tbody>
            @if(count(@$form->data)>0)
                @foreach($form->data as $data)
                    <tr class="ticketlistproperties">
                        <td class="text-center" width="50"><b>{{$loop->iteration}}</b></td>
                        <td>{{@$data->website->{"name_".app()->getLocale()} }}</td>
                        <?php $values = []; ?>
                        @foreach($form->fields as $f)
                            @php
                                $options = ($f->options)?explode(";", $f->options):[];
                                $values[$f->id] = "";
                                $datas = unserialize($data->values);
                                foreach ($datas as $value)
                                    foreach($value as $k => $v)
                                        $values[$k] = $v;
                            @endphp
                            <td>
                                @if($f->type=="text" or $f->type=="date" or $f->type=="number" or $f->type=="textarea")
                                    <div style="color: #333;">{{@$values[$f->id]}}</div>
                                @elseif($f->type=="select" or $f->type=="selectmultiple")
                                    @php
                                        $selectvalues = explode(";", @$values[$f->id]);
                                    @endphp
                                    @foreach($selectvalues as $s)
                                        <div style="color: #333;">{{@$options[$s]}}</div>
                                    @endforeach
                                @elseif($f->type=="attachement")
                                    @php
                                        $selectvalues = explode(";", @$values[$f->id]);
                                    @endphp
                                    @foreach($selectvalues as $s)
                                        <div style="color: #333;">
                                            <a target="_blank" href="{{asset("storage/app/".$s)}}" style="text-decoration: underline;">{{__("l.attachement")}} {{$loop->iteration}}</a>
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                        @endforeach
                        <td>{{$data->created_at}}</td>
                        <td class="text-center">
                            <div class="action">
                                <a href="#" data-toggle="modal" data-target="#dataModal{{$data->id}}" title="{{__("l.preview")}}"><i class="fa fa-eye"></i></a>
                                <a href="{{route("client.plugins.remove_app_data", $data->id)}}" onclick="return confirm('{{__("l.are_you_sure")}}');" title="{{__("l.delete")}}"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="ticketlistproperties">
                    <td class="text-center" colspan="{{count($form->fields) + 4}}"><b>{{__("l.no_data")}}</b></td>
                </tr>
            @endif
            </tbody>
        </table>

        @foreach($form->data as $data)
            <div class="modal fade" id="dataModal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h5 class="modal-title" id="exampleModalLabel">{{__("l.messages")}}</h5>
                        </div>
                        <div class="modal-body">
                            @php
                                $values = [];
                                foreach($form->fields as $f)
                                    $values[$f->id] = "";
                                $datas = unserialize($data->values);
                                foreach ($datas as $value)
                                    foreach($value as $k => $v)
                                        $values[$k] = $v;
                            @endphp
                            @foreach($form->fields as $f)
                                <?php $required = ($f->required==1)?'required':''; ?>
                                <?php $options = ($f->options)?explode(";", $f->options):[]; ?>
                                <div class="form-group">
                                    <label><b>{{$f->name}}</b> @if($f->required==1)<span class="text-danger">*</span>@endif</label>
                                    @if($f->type=="text" or $f->type=="date" or $f->type=="number" or $f->type=="textarea")
                                        <div style="color: #333;">{{@$values[$f->id]}}</div>
                                    @elseif($f->type=="select" or $f->type=="selectmultiple")
                                        @php
                                            $selectvalues = explode(";", @$values[$f->id]);
                                        @endphp
                                        @foreach($selectvalues as $s)
                                            <div style="color: #333;">{{@$options[$s]}}</div>
                                        @endforeach
                                    @elseif($f->type=="attachement")
                                        @php
                                            $selectvalues = explode(";", @$values[$f->id]);
                                        @endphp
                                        @foreach($selectvalues as $s)
                                            <div style="color: #333;">
                                                <a target="_blank" href="{{asset("storage/app/".$s)}}" style="text-decoration: underline;">{{__("l.attachement")}} {{$loop->iteration}}</a>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if($loop->iteration < count($form->fields)) <hr> @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

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
