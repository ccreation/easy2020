@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-3 text-center" style="color: #512293"><b>{{__("l.add_member")}}</b></h4>

        <form action="{{route("client.members.store")}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-4 mx-auto">

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.name")}}</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{old("name")}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.website")}}</span> <span class="text-danger">*</span></label>
                        <select class="form-control" name="website_id" required>
                            <option value="">{{__("l.choose")}}</option>
                            @foreach($websites as $website)
                                <option value="{{$website->id}}" @if($website->id == old("website_id")) selected @endif>{{$website->{"name_".app()->getLocale()} }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.email")}}</span> <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{old("email")}}" class="form-control"  autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.password")}}</span> <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required autocomplete="current-password">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.image")}}</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.status")}}</span></label>
                        <select name="status" class="form-control">
                            <option value="1">{{__("l.active")}}</option>
                            <option value="0">{{__("l.inactive")}}</option>
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
