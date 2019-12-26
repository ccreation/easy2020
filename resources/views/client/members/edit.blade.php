@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-3 text-center" style="color: #512293"><b>{{__("l.edit_member")}}</b></h4>

        <form action="{{route("client.members.update")}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$visitor->id}}">

            <div class="row">

                <div class="col-lg-4 mx-auto">

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.name")}}</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{$visitor->name}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.website")}}</span> <span class="text-danger">*</span></label>
                        <select class="form-control" name="website_id" required>
                            <option value="">{{__("l.choose")}}</option>
                            @foreach($websites as $website)
                                <option value="{{$website->id}}" @if($website->id == $visitor->website_id) selected @endif>{{$website->{"name_".app()->getLocale()} }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.email")}}</span></label>
                        <input type="email"  value="{{$visitor->email}}" class="form-control" disabled autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.password")}}</span></label>
                        <input type="password" name="password" class="form-control" autocomplete="current-password">
                        <br><small>{{__("l.password_edit_note")}}</small>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.image")}}</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <br>
                        @if($visitor->image)
                            <img src="{{asset("storage/app/".$visitor->image)}}" style="width: 150px; height: 150px;  border: 1px solid #eee; border-radius: 4px;" />
                        @else
                            <img src="{{asset("public/no-image.png")}}" style="width: 150px; height: 150px; border: 1px solid #eee; border-radius: 4px;" />
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.status")}}</span></label>
                        <select name="status" class="form-control">
                            <option value="1" @if($visitor->status==1) selected @endif>{{__("l.active")}}</option>
                            <option value="0" @if($visitor->status==0) selected @endif>{{__("l.inactive")}}</option>
                        </select>
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
