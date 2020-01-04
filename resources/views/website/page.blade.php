@extends("website.parts.app")

@section("content")

    @if(!$page->{"html_content_".$lang})
        <section id="default_section" class="section" style="width: 100%; height: 200px;background: #fffff5;">
            <h3 class="text-center" style="margin-top: 15px; font-size: 20px;">{{__("l.add_new_sections_to_this_page")}}</h3>
        </section>
    @endif

    {!! $page->{"html_content_".$lang} !!}

@endsection

