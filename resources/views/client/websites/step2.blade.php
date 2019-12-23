@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-4 text-center" style="color: #512293"><b>{{__("l.website_data")}} "{{$website->{"name_".$website->default_lang} }}"</b></h4>

        <div class="row">

            <div class="col-md-6">
                <a href="{{--route("pages.indexbywebsite", $website->id)--}}" class="some_link">
                    <strong style="font-size: 1.3em;">{{__("l.continue_to_smart_editor")}}</strong>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{route("client.websites.choose_template_by_id", $website->id)}}" class="some_link">
                    <strong style="font-size: 1.3em;">{{__("l.choose_a_template_for_your_website")}}</strong>
                    <small class="text-danger db mt-10">{{__("l.choose_a_template_for_your_website_note")}}</small>
                </a>
            </div>

        </div>

    </div>

@endsection

@section("scripts")

    <style>

        .some_link{
            display: block;
            width: 100%;
            height: 140px;
            text-align: center;
            background: #e4d8f0;
            border: 1px solid #543c93;
            border-radius: 3px;
            padding-top: 54px;
        }

    </style>

@endsection
