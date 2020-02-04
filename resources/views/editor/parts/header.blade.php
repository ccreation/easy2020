<header class="main-header" id="header1">
    <div class="main_header_option" id="header2">
        <div class="container">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <div class="widget__item-list">
                    <ul class="widget__item-option list_screen">
                        <li class="widget__item-option-item">
                            @if(Auth::guard("web")->check())
                                <a href="{{route("admin.templates.index")}}" class="nav-item nav-link px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                            @elseif(Auth::guard("client")->check())
                                <a href="{{route("client.websites.index")}}" class="nav-item nav-link px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="widget__item-list">
                    <ul class="widget__item-option list_screen">
                        <li class="widget__item-option-item list-toggle-display-web">
                            <a class="nav-item nav-link preview-btn preview-laptop active"><span class="widget__item-option-icon"><i class="fas fa-desktop"></i></span></a>
                            <a class="nav-item nav-link rounded-0 preview-btn preview-ipad"><span class="widget__item-option-icon"><i class="fas fa-tablet-alt"></i></span></a>
                            <a class="nav-item nav-link preview-btn preview-mobile"><span class="widget__item-option-icon"><i class="fas fa-mobile-alt"></i></span></a>
                        </li>
                    </ul>
                </div>
                <div class="widget__item-list">
                    <ul class="widget__item-option list-nav">
                        <!-- websites -->
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link "><span class="widget__item-option-icon"><img src="{{asset("public/dashboard/images/cpanel/website-2.png")}}" alt=""/></span><span class="widget__item-option-text">{{__("l.websites")}}</span></a>
                            <div class="dropdown_widget  ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <h5>{{__("l.websites")}} ({{$website->{"name_".app()->getLocale()} }})</h5>
                                            <h6>{{__("l.websites_note")}}</h6>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content scroll">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <a href="@if(Auth::guard("client")->check()) {{route("client.websites.add")}} @elseif(Auth::guard("web")->check()) {{route("admin.templates.add")}} @endif" class="widget__item_dropdown-link  link-active">
                                                                    <div class="widget__item_dropdown-icon"><i class="fas fa-plus fa-lg"></i></div>
                                                                    <h3 class="widget__item_dropdown-title">{{__("l.add_new_website")}}</h3>
                                                                </a>
                                                            </div>
                                                            @foreach($websites as $w)
                                                                <div class="col-lg-3">
                                                                    <a href="{{route("editor.edit", $w->id)}}" class="widget__item_dropdown-link position-relative" style="overflow: hidden;">
                                                                        <div style="width: 120px; background: {{($w->status == 0) ? "red" : "green"}}; height: 24px; font-weight: bold; color: #fff; text-align: center; padding-top: 2px; transform: rotate(-45deg); position: absolute; left: -34px; top: 13px;">{{($w->status == 0) ? __("l.draft") : __("l.published")}}</div>
                                                                        <div class="widget__item_dropdown-icon">
                                                                            @if($w->logo)
                                                                                <img src="{{$w->logo}}" alt="" style="border-radius: 100px;">
                                                                            @else
                                                                                <img src="{{asset("public/no-image2.png")}}" alt="" style="border-radius: 100px;">
                                                                            @endif
                                                                        </div>
                                                                        <h3 class="widget__item_dropdown-title">{{$w->{"name_".app()->getLocale()} }}</h3>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- pages -->
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link"><span class="widget__item-option-icon"><img src="{{asset("public/dashboard/images/cpanel/three-layers.png")}}" alt="" /></span><span class="widget__item-option-text">{{__("l.pages")}}</span></a>
                            <div class="dropdown_widget ">
                                <div class="container pages">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <h5>{{__("l.pages")}} ({{(app()->getLocale() == "ar") ? $page->name : $page->name_en }})</h5>
                                            <h6>{{__("l.pages_note")}}</h6>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content scroll">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <a class="widget__item_dropdown-link link-lg link-active add_new_page">
                                                                    <div class="widget__item_dropdown-icon">
                                                                        <i class="fas fa-plus fa-lg"></i>
                                                                    </div>
                                                                    <h3 class="widget__item_dropdown-title">{{__("l.add_new_page")}}</h3>
                                                                </a>
                                                            </div>
                                                            @foreach($pages as $p)
                                                                <div class="col-lg-4">
                                                                    <div class="widget__item-page position-relative">
                                                                        <div style="width: 120px; background: {{($p->status == 0) ? "red" : "green"}}; height: 24px; font-weight: bold; color: #fff; text-align: center; padding-top: 2px; transform: rotate(-45deg); position: absolute; left: -34px; top: 13px;">{{($p->status == 0) ? __("l.draft") : __("l.published")}}</div>
                                                                        <div class="widget__item-page-header">{{(app()->getLocale() == "ar") ? $p->name : $p->name_en }}</div>
                                                                        <div class="widget__item-page-body">
                                                                            @if($p->id != $page->id)
                                                                                <div class="">
                                                                                    <a href="{{route("editor.edit", [$website->id, $p->id])}}" class="widget__item-page-link">
                                                                                        <div class="widget__item-page-link-icon">
                                                                                            <i class="fas fa-eye"></i>
                                                                                        </div>
                                                                                    </a>
                                                                                    <a href="#" class="widget__item-page-link edit_page_link" data-id="{{$p->id}}">
                                                                                        <div class="widget__item-page-link-icon">
                                                                                            <i class="fas fa-pencil-alt"></i>
                                                                                        </div>
                                                                                    </a>
                                                                                    @if($p->id != $website->homepage)
                                                                                        <a href="{{route("editor.delete_page", $p->id)}}" onclick="return confirm('{{__("l.are_you_sure")}}')" class="widget__item-page-link">
                                                                                            <div class="widget__item-page-link-icon">
                                                                                                <i class="far fa-trash-alt"></i>
                                                                                            </div>
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            @else
                                                                                <div style="height: 33px;"></div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container add_page">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="show_pages px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content scroll">
                                                        <form action="{{route("editor.save_page")}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="website_id" value="{{$website->id}}">
                                                            <div class="row">
                                                                <div class="col-lg-10">
                                                                    <div class="row">
                                                                        @if($website->multi_lang == 1)
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <input type="text" name="name" class="form-control rounded bg-control" placeholder="{{__("l.page_name")}} ({{__("l.arabic")}})">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <input type="text" name="name_en" class="form-control rounded bg-control" placeholder="{{__("l.page_name")}} ({{__("l.english")}})">
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            @if($website->default_lang == "en")
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <input type="text" name="name_en" class="form-control rounded bg-control" placeholder="{{__("l.page_name")}} {{__("l.english")}}">
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <input type="text" name="name" class="form-control rounded bg-control" placeholder="{{__("l.page_name")}} {{__("l.arabic")}}">
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group text-left ">
                                                                        <button type="submit" class="btn general-btn-sm-blue rounded">{{__("l.save")}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($pages as $p)
                                    <div class="container edit_page edit_page_{{$p->id}}">
                                        <div class="dropdown_widget-grid">
                                            <div class="dropdown_widget-sidebar">
                                                <a href="#" class="show_pages px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            </div>
                                            <div class="dropdown_widget-content">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="widget__item_dropdown_inner_content scroll">
                                                            <form action="{{route("editor.update_page")}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="page_id" value="{{$p->id}}">
                                                                <div class="row">
                                                                    <div class="col-lg-10">
                                                                        <div class="row">
                                                                            @if($website->multi_lang == 1)
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <input type="text" value="{{$p->name}}" name="name" class="form-control rounded bg-control" placeholder="{{__("l.page_name")}} ({{__("l.arabic")}})">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="form-group">
                                                                                        <input type="text" value="{{$p->name_en}}" name="name_en" class="form-control rounded bg-control" placeholder="{{__("l.page_name")}} ({{__("l.english")}})">
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                @if($website->default_lang == "en")
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <input type="text" value="{{$p->name_en}}" name="name_en" class="form-control rounded bg-control" placeholder="{{__("l.page_name")}} {{__("l.english")}}">
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group">
                                                                                            <input type="text" value="{{$p->name}}" name="name" class="form-control rounded bg-control" placeholder="{{__("l.page_name")}} {{__("l.arabic")}}">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-2">
                                                                        <div class="form-group text-left ">
                                                                            <button type="submit" class="btn general-btn-sm-blue rounded">{{__("l.edit")}}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                        <!-- blocks -->
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link blocks_list"><span class="widget__item-option-icon"><img src="{{asset("public/dashboard/images/cpanel/pc.png")}}" alt="" /></span><span class="widget__item-option-text">{{__("l.blocks")}}</span></a>
                            <div class="dropdown_widget">
                                <div class="container-fluid p-0">
                                    <div class="dropdown_widget-grid">
                                        {{--
                                        <div class="dropdown_widget-sidebar p-4">
                                            <h5>{{__("l.blocks")}}</h5>
                                            <h6>{{__("l.blocks_note")}}</h6>
                                        </div>
                                        --}}
                                        <div class="dropdown_widget-content p-0" style="max-width: 100%; flex: auto;">
                                            <div class="row">
                                                @php
                                                    $dirs_path = base_path("public/easy/blocks/");
                                                    $dirs = new \DirectoryIterator($dirs_path);
                                                @endphp
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-pills mb-3 tab_dropdown_section scroll p-0 pt-2 pb-2" id="pills-tab" role="tablist">
                                                        <li class="nav-item" style="margin: 0px 5px;">
                                                            <a class="nav-link active" data-toggle="pill" href="#tabSection-all" role="tab">{{__("l.all")}}</a>
                                                        </li>
                                                        <?php $x = 0;?>
                                                        @foreach ($dirs as $dir)
                                                            @if($dir->isDir() and !$dir->isDot())
                                                                <?php $type = $dir->getBasename(); ?>
                                                                <li class="nav-item" style="margin: 0px 5px;">
                                                                    <a class="nav-link" data-toggle="pill" href="#tabSection-{{$type}}" role="tab">{{__("l.a.".$type)}}</a>
                                                                </li>
                                                            @endif
                                                            <?php $x++; ?>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row py-3 px-4">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content scroll" style="height: 260px;">
                                                        <div class="tab-content " id="pills-tabContent">
                                                            <div class="tab-pane fade show active" id="tabSection-all" role="tabpanel"
                                                                 aria-labelledby="pills-home-tab">
                                                                <div class="row">
                                                                    @foreach ($dirs as $dir)
                                                                        @if($dir->isDir() and !$dir->isDot())
                                                                            @php
                                                                                $type = $dir->getBasename();
                                                                                $files_path = base_path("public/easy/blocks/".$type."/");
                                                                                $files = new \DirectoryIterator($files_path);
                                                                            @endphp
                                                                            @foreach ($files as $file)
                                                                                @if(!$file->isDir() and !$file->isDot())
                                                                                    @if($file->getExtension() == "png")
                                                                                        <?php $image = $file->getBasename(); ?>
                                                                                        <div class="col-lg-2">
                                                                                            <div class="block widget__item widget__item-price" data-url="{{asset("public/easy/blocks/".$type."/".str_replace(".png", "", $image).".html")}}">
                                                                                                <div class="widget__item-price-body p-1" style="display: block;">
                                                                                                    <img src="{{asset("public/easy/blocks/".$type."/".$image)}}" alt="" class="image-price" style="height: 110px; width: 100%; max-width: inherit; border: 1px solid #eee;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            @foreach ($dirs as $dir)
                                                                @if($dir->isDir() and !$dir->isDot())
                                                                    @php
                                                                        $type = $dir->getBasename();
                                                                        $files_path = base_path("public/easy/blocks/".$type."/");
                                                                        $files = new \DirectoryIterator($files_path);
                                                                    @endphp
                                                                    <div class="tab-pane fade show" id="tabSection-{{$type}}" role="tabpanel"
                                                                         aria-labelledby="pills-home-tab">
                                                                        <div class="row">
                                                                            @foreach ($files as $file)
                                                                                @if(!$file->isDir() and !$file->isDot())
                                                                                    @if($file->getExtension() == "png")
                                                                                        <?php $image = $file->getBasename(); ?>
                                                                                        <div class="col-lg-2">
                                                                                            <div class="block widget__item widget__item-price" data-url="{{asset("public/easy/blocks/".$type."/".str_replace(".png", "", $image).".html")}}">
                                                                                                <div class="widget__item-price-body p-1" style="display: block;">
                                                                                                    <img src="{{asset("public/easy/blocks/".$type."/".$image)}}" alt="" class="image-price" style="height: 110px; width: 100%; max-width: inherit; border: 1px solid #eee;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- fonts -->
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link fonts_link"><span class="widget__item-option-icon">
                        <img src="{{asset("public/dashboard/images/cpanel/type.png")}}" alt=""></span><span class="widget__item-option-text">{{__("l.fonts")}}</span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <h5>{{__("l.fonts")}}</h5>
                                            <h6>{{__("l.fonts_note")}} </h6>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content scroll">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if(!$website->font) active @endif" data-font="">
                                                                    <div class="widget__item--text-header preview_font_title">الخط الإفتراضي</div>
                                                                    <div class="widget__item--text-body preview_font"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Amiri") active @endif" data-font="Amiri">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Amiri' !important;">أميري</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Amiri' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Cairo") active @endif" data-font="Cairo">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Cairo' !important;">كايرو</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Cairo' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Tajawal") active @endif" data-font="Tajawal">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Tajawal' !important;">Tajawal</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Tajawal' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Changa") active @endif" data-font="Changa">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Changa' !important;">Changa</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Changa' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Lalezar") active @endif" data-font="Lalezar">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Lalezar' !important;">Lalezar</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Lalezar' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "El Messiri") active @endif" data-font="El Messiri">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'El Messiri' !important;">المصيري</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'El Messiri' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Reem Kufi") active @endif" data-font="Reem Kufi">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Reem Kufi' !important;">ريم كوفي</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Reem Kufi' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Lateef") active @endif" data-font="Lateef">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Lateef' !important;">لطيف</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Lateef' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Scheherazade") active @endif" data-font="Scheherazade">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Scheherazade' !important;">Scheherazade</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Scheherazade' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Lemonada") active @endif" data-font="Lemonada">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Lemonada' !important;">ليموناضة</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Lemonada' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Markazi Text") active @endif" data-font="Markazi Text">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Markazi Text' !important;">مركزي تكست</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Markazi Text' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Mada") active @endif" data-font="Mada">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Mada' !important;">Mada</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Mada' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Baloo Bhaijaan") active @endif" data-font="Baloo Bhaijaan">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Baloo Bhaijaan' !important;">Baloo Bhaijaan</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Baloo Bhaijaan' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Mirza") active @endif" data-font="Mirza">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Mirza' !important;">Mirza</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Mirza' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Aref Ruqaa") active @endif" data-font="Aref Ruqaa">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Aref Ruqaa' !important;">رافع الرقعة</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Aref Ruqaa' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Harmattan") active @endif" data-font="Harmattan">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Harmattan' !important;">Harmattan</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Harmattan' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Katibeh") active @endif" data-font="Katibeh">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Katibeh' !important;">كتيبة</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Katibeh' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Rakkas") active @endif" data-font="Rakkas">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Rakkas' !important;">Rakkas</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Rakkas' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text change_font @if($website->font == "Jomhuria") active @endif" data-font="Jomhuria">
                                                                    <div class="widget__item--text-header preview_font_title" style="font-family: 'Jomhuria' !important;">Jomhuria</div>
                                                                    <div class="widget__item--text-body preview_font" style="font-family: 'Jomhuria' !important;">كلام مرسل بنمط أخر يعبر عن استخدامات متعددة</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- block settings -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_block_btn_nav_link hidden"><span class="widget__item-option-text"></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_block_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            <h4 class="text-white mt-3"><b>{{__("l.block_settings")}}</b></h4>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="settings ModalPannel">
                                                <ul class="nav nav-pills tab-setting" id="pills-tab" role="tablist" style="border-bottom: 1px solid #af96d3;">
                                                    <li class="nav-item">
                                                        <a class="nav-link active"  data-toggle="pill" href="#pills-tab-color" role="tab" >{{__("l.background_color")}}</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#pills-tab-margin" role="tab" >{{__("l.paddings")}}</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="pills-tabContent" style="min-height: 200px;">
                                                    <div class="tab-pane fade show active" id="pills-tab-color" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <input type="text" class="form-control colorpicker colorpicker1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-tab-margin" role="tabpanel">
                                                        <div class="slideInputContainer-2">
                                                            <input type="range" min="1" max="120" class="sliderInput_2">
                                                            <p class="text-white mt-2 text-right">{{__("l.up")}}</p>
                                                            <p class="text-white mt-2 text-left">{{__("l.down")}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- icons -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_icon_btn_nav_link hidden"><span class="widget__item-option-text"></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_icons_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            <h4 class="text-white mt-3"><b>{{__("l.icons")}}</b></h4>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <input class='iconpicker_element form-control' id="iconpicker_element" style=" height: 1px; opacity: 0; margin-top: -20px;" autocomplete="off"/>
                                            <div class="iconpicker_container" style="width: 874px; height: 340px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- buttons -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_btn_btn_nav_link hidden"><span class="widget__item-option-text"></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_btn_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            <h4 class="text-white mt-3"><b>{{__("l.buttons")}}</b></h4>
                                        </div>
                                        <div class="dropdown_widget-content ModalPannel">
                                            <ul class="nav nav-pills tab-setting" id="pills-tab" style="border-bottom: 1px solid #af96d3;" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active"  data-toggle="pill" href="#pills-tab-1" role="tab" >{{__("l.text")}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link"  data-toggle="pill" href="#pills-tab-2" role="tab" >{{__("l.link")}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#pills-tab-3" role="tab" >{{__("l.button_type")}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link"  data-toggle="pill" href="#pills-tab-4" role="tab" >{{__("l.color")}}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent" style="min-height: 250px;">
                                                <div class="tab-pane fade show active" id="pills-tab-1" role="tabpanel" >
                                                    <div class="input-group container-group-option">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{__("l.button_text")}}</div>
                                                        </div>
                                                        <input placeholder="{{__("l.button_text")}}" id="button_text" type="text" class="form-control" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="input-group flex-nowrap container-group-option container-group-select">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">{{__("l.font_family")}}</div>
                                                                </div>
                                                                <select id="font_family" class="form-control selectpaicker">
                                                                    <option value="">{{__("l.no_font")}}</option>
                                                                    <option value="Droid Arabic Kufi">درويد كوفي</option>
                                                                    <option value="Amiri">أميري</option>
                                                                    <option value="Cairo">كايرو</option>
                                                                    <option value="Tajawal">Tajawal</option>
                                                                    <option value="Changa">Changa</option>
                                                                    <option value="Lalezar">Lalezar</option>
                                                                    <option value="El Messiri">المصيري</option>
                                                                    <option value="Reem Kufi">ريم كوفي</option>
                                                                    <option value="Lateef">لطيف</option>
                                                                    <option value="Scheherazade">Scheherazade</option>
                                                                    <option value="Lemonada">ليموناضة</option>
                                                                    <option value="Markazi Text">مركزي تكست</option>
                                                                    <option value="Mada">Mada</option>
                                                                    <option value="Baloo Bhaijaan">Baloo Bhaijaan</option>
                                                                    <option value="Mirza">Mirza</option>
                                                                    <option value="Aref Ruqaa">رافع الرقعة</option>
                                                                    <option value="Harmattan">Harmattan</option>
                                                                    <option value="Katibeh">كتيبة</option>
                                                                    <option value="Rakkas">Rakkas</option>
                                                                    <option value="Jomhuria">Jomhuria</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="input-group flex-nowrap container-group-option container-group-select">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">{{__("l.font_size")}}</div>
                                                                </div>
                                                                <select id="font_size" class="form-control selectpaicker selectNunmber">
                                                                    @for($i=8; $i<=100; $i++)
                                                                        <option value="{{$i}}">{{$i}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="input-group container-group-option container-group-select">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">{{__("l.font_weight")}}</div>
                                                                </div>
                                                                <select id="font_weight" class="form-control selectpaicker">
                                                                    <option value="normal">{{__("l.normal")}}</option>
                                                                    <option value="bold">{{__("l.bold")}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="input-group container-group-option container-group-select">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">{{__("l.color")}}</div>
                                                                </div>
                                                                <input class="form-control colorpicker" id="colorpicker2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-option-text">
                                                        <div class="widgth-item-option-text text_align text_align_justify" data-align="justify" title="{{__("l.justify")}}">
                                                            <div class="widgth-item-image">
                                                                <img src="{{asset("public/dashboard/images/cpanel/option-text-1.png")}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widgth-item-option-text text_align text_align_right" data-align="right" title="{{__("l.right")}}">
                                                            <div class="widgth-item-image">
                                                                <img src="{{asset("public/dashboard/images/cpanel/option-text-2.png")}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widgth-item-option-text text_align text_align_center" data-align="center" title="{{__("l.center")}}">
                                                            <div class="widgth-item-image">
                                                                <img src="{{asset("public/dashboard/images/cpanel/option-text-3.png")}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widgth-item-option-text text_align text_align_left" data-align="left" title="{{__("l.left")}}">
                                                            <div class="widgth-item-image">
                                                                <img src="{{asset("public/dashboard/images/cpanel/option-text-4.png")}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-tab-2" role="tabpanel">
                                                    <div class="form-group container-group-option container-group-select">
                                                        <select id="url_type" class="form-control selectpaicker" title="{{__("l.url_type")}}">
                                                            <option value="0" selected>{{__("l.external_link")}}</option>
                                                            <option value="1">{{__("l.url_to_other_pages")}}</option>
                                                            <option value="2">{{__("l.an_email")}}</option>
                                                            <option value="3">{{__("l.mobile_phone")}}</option>
                                                            <option value="4">{{__("l.video_url_youtube_or_vimeo")}}</option>
                                                        </select>
                                                    </div>
                                                    <div id="url_type_0">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.external_link")}}</div>
                                                            </div>
                                                            <input type="text" id="external_link" class="form-control" placeholder="{{__("l.external_link")}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div id="url_type_1" style="display: none">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.url_to_other_pages")}}</div>
                                                            </div>
                                                            <select id="url_to_other_pages" class="form-control">
                                                                <option value="#" selected>{{__("l.choose")}} {{__("l.link")}}</option>
                                                                @foreach ($pages as $p)
                                                                    <option value="{{route("website.page", [@$p->website->slug, $lang, $p->id])}}">{{(app()->getLocale()=="ar")?$p->name:$p->name_en}}</option>
                                                                @endforeach;
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="url_type_2" style="display: none">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.an_email")}}</div>
                                                            </div>
                                                            <input type="email" id="an_email" class="form-control" placeholder="{{__("l.an_email")}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div id="url_type_3" style="display: none">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.mobile_phone")}}</div>
                                                            </div>
                                                            <input type="text" id="mobile_phone" class="form-control" placeholder="{{__("l.mobile_phone")}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div id="url_type_4" style="display: none">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.video_url_youtube_or_vimeo")}}</div>
                                                            </div>
                                                            <input type="text" id="video_url_youtube_or_vimeo" class="form-control" placeholder="{{__("l.video_url_youtube_or_vimeo")}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <label style="margin-top: 5px;">
                                                        <input type="checkbox" id="open_in_other_window">
                                                        <b style="color: #543c93">{{__("l.open_in_other_window")}}</b>
                                                    </label>
                                                    <div class="form-group mb-0 text-center">
                                                        <button class="button_shape" id="save_button_link">{{__("l.save")}}</button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-tab-3" role="tabpanel">
                                                    <div class="input-group container-group-option">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{__("l.button_type")}}</div>
                                                        </div>
                                                        <select class="form-control" id="button_type">
                                                            <optgroup label="{{__("l.colored")}}">
                                                                <option value="btn-1">{{__("l.sharp_edges")}}</option>
                                                                <option value="btn-2">{{__("l.semi_sharp_edges")}}</option>
                                                                <option value="btn-3">{{__("l.polished_edges")}}</option>
                                                                <option value="btn-4">{{__("l.rounded_edges")}}</option>
                                                                <option value="btn-5">{{__("l.trapezoid")}}</option>
                                                            </optgroup>
                                                            <optgroup label="{{__("l.transperacy")}}">
                                                                <option value="btn-6">{{__("l.sharp_edges")}}</option>
                                                                <option value="btn-7">{{__("l.semi_sharp_edges")}}</option>
                                                                <option value="btn-8">{{__("l.polished_edges")}}</option>
                                                                <option value="btn-9">{{__("l.rounded_edges")}}</option>
                                                                <option value="btn-10">{{__("l.trapezoid")}}</option>
                                                            </optgroup>
                                                            <optgroup label="{{__("l.atext")}}">
                                                                <option value="btn-11">{{__("l.only_text")}}</option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <div class="input-group container-group-option">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{__("l.border_width")}}</div>
                                                        </div>
                                                        <select id="border_width" class="form-control">
                                                            @for($i=0; $i<=100; $i++)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <label style="margin-top: 5px;">
                                                        <input type="checkbox" id="dispay_block">
                                                        <b style="color: #543c93;">زر كامل العرض</b>
                                                    </label>
                                                </div>
                                                <div class="tab-pane fade" id="pills-tab-4" role="tabpanel">
                                                    <div class="input-group container-group-option container-group-select">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{__("l.button_bg_color")}}</div>
                                                        </div>
                                                        <input type="text" id="colorpicker3" class="form-control colorpicker" placeholder="{{__("l.button_bg_color")}}">
                                                    </div>
                                                    <div class="input-group container-group-option container-group-select">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{__("l.border_color")}}</div>
                                                        </div>
                                                        <input type="text" id="colorpicker4" class="form-control colorpicker" placeholder="{{__("l.button_bg_color")}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- links -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_link_btn_nav_link hidden"><span class="widget__item-option-text"></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_link_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            <h4 class="text-white mt-3"><b>{{__("l.links")}}</b></h4>
                                        </div>
                                        <div class="dropdown_widget-content ModalPannel">
                                            <ul class="nav nav-pills tab-setting" id="pills-tab" style="border-bottom: 1px solid #af96d3;" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active"  data-toggle="pill" href="#pills-tab-10" role="tab" >{{__("l.text")}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link"  data-toggle="pill" href="#pills-tab-20" role="tab" >{{__("l.link")}}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent" style="min-height: 250px;">
                                                <div class="tab-pane fade show active" id="pills-tab-10" role="tabpanel" >
                                                    <div class="input-group container-group-option">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">{{__("l.button_text")}}</div>
                                                        </div>
                                                        <input placeholder="{{__("l.link_text")}}" id="link_text" type="text" class="form-control" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="input-group flex-nowrap container-group-option container-group-select">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">{{__("l.font_family")}}</div>
                                                                </div>
                                                                <select id="font_family2" class="form-control selectpaicker">
                                                                    <option value="">{{__("l.no_font")}}</option>
                                                                    <option value="Droid Arabic Kufi">درويد كوفي</option>
                                                                    <option value="Amiri">أميري</option>
                                                                    <option value="Cairo">كايرو</option>
                                                                    <option value="Tajawal">Tajawal</option>
                                                                    <option value="Changa">Changa</option>
                                                                    <option value="Lalezar">Lalezar</option>
                                                                    <option value="El Messiri">المصيري</option>
                                                                    <option value="Reem Kufi">ريم كوفي</option>
                                                                    <option value="Lateef">لطيف</option>
                                                                    <option value="Scheherazade">Scheherazade</option>
                                                                    <option value="Lemonada">ليموناضة</option>
                                                                    <option value="Markazi Text">مركزي تكست</option>
                                                                    <option value="Mada">Mada</option>
                                                                    <option value="Baloo Bhaijaan">Baloo Bhaijaan</option>
                                                                    <option value="Mirza">Mirza</option>
                                                                    <option value="Aref Ruqaa">رافع الرقعة</option>
                                                                    <option value="Harmattan">Harmattan</option>
                                                                    <option value="Katibeh">كتيبة</option>
                                                                    <option value="Rakkas">Rakkas</option>
                                                                    <option value="Jomhuria">Jomhuria</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="input-group flex-nowrap container-group-option container-group-select">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">{{__("l.font_size")}}</div>
                                                                </div>
                                                                <select id="font_size2" class="form-control selectpaicker selectNunmber">
                                                                    @for($i=8; $i<=100; $i++)
                                                                        <option value="{{$i}}">{{$i}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="input-group container-group-option container-group-select">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">{{__("l.font_weight")}}</div>
                                                                </div>
                                                                <select id="font_weight2" class="form-control selectpaicker">
                                                                    <option value="normal">{{__("l.normal")}}</option>
                                                                    <option value="bold">{{__("l.bold")}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="input-group container-group-option container-group-select">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">{{__("l.color")}}</div>
                                                                </div>
                                                                <input class="form-control colorpicker" id="colorpicker5">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="list-option-text">
                                                        <div class="widgth-item-option-text text_align2 text_align2_justify" data-align="justify" title="{{__("l.justify")}}">
                                                            <div class="widgth-item-image">
                                                                <img src="{{asset("public/dashboard/images/cpanel/option-text-1.png")}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widgth-item-option-text text_align2 text_align2_right" data-align="right" title="{{__("l.right")}}">
                                                            <div class="widgth-item-image">
                                                                <img src="{{asset("public/dashboard/images/cpanel/option-text-2.png")}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widgth-item-option-text text_align2 text_align2_center" data-align="center" title="{{__("l.center")}}">
                                                            <div class="widgth-item-image">
                                                                <img src="{{asset("public/dashboard/images/cpanel/option-text-3.png")}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widgth-item-option-text text_align2 text_align2_left" data-align="left" title="{{__("l.left")}}">
                                                            <div class="widgth-item-image">
                                                                <img src="{{asset("public/dashboard/images/cpanel/option-text-4.png")}}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-tab-20" role="tabpanel">
                                                    <div class="form-group container-group-option container-group-select">
                                                        <select id="url_type2" class="form-control selectpaicker" title="{{__("l.url_type")}}">
                                                            <option value="0" selected>{{__("l.external_link")}}</option>
                                                            <option value="1">{{__("l.url_to_other_pages")}}</option>
                                                            <option value="2">{{__("l.an_email")}}</option>
                                                            <option value="3">{{__("l.mobile_phone")}}</option>
                                                            <option value="4">{{__("l.video_url_youtube_or_vimeo")}}</option>
                                                        </select>
                                                    </div>
                                                    <div id="url_type_02">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.external_link")}}</div>
                                                            </div>
                                                            <input type="text" id="external_link2" class="form-control" placeholder="{{__("l.external_link")}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div id="url_type_12" style="display: none">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.url_to_other_pages")}}</div>
                                                            </div>
                                                            <select id="url_to_other_pages2" class="form-control">
                                                                <option value="#" selected>{{__("l.choose")}} {{__("l.link")}}</option>
                                                                @foreach ($pages as $p)
                                                                    <option value="{{route("website.page", [@$p->website->slug, $lang, $p->id])}}">{{(app()->getLocale()=="ar")?$p->name:$p->name_en}}</option>
                                                                @endforeach;
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="url_type_22" style="display: none">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.an_email")}}</div>
                                                            </div>
                                                            <input type="email" id="an_email2" class="form-control" placeholder="{{__("l.an_email")}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div id="url_type_32" style="display: none">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.mobile_phone")}}</div>
                                                            </div>
                                                            <input type="text" id="mobile_phone2" class="form-control" placeholder="{{__("l.mobile_phone")}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div id="url_type_42" style="display: none">
                                                        <div class="input-group container-group-option">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">{{__("l.video_url_youtube_or_vimeo")}}</div>
                                                            </div>
                                                            <input type="text" id="video_url_youtube_or_vimeo2" class="form-control" placeholder="{{__("l.video_url_youtube_or_vimeo")}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <label style="margin-top: 5px;">
                                                        <input type="checkbox" id="open_in_other_window2">
                                                        <b style="color: #543c93">{{__("l.open_in_other_window")}}</b>
                                                    </label>
                                                    <div class="form-group mb-0 text-center">
                                                        <button class="button_shape" id="save_button_link2">{{__("l.save")}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- link icons -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_linkicon_btn_nav_link hidden"><span class="widget__item-option-text"></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_linkicons_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            <h4 class="text-white mt-3"><b>{{__("l.icons")}}</b></h4>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <input class='iconpicker_element2 form-control' id="iconpicker_element2" style=" height: 1px; opacity: 0; margin-top: -20px;" autocomplete="off"/>
                                            <div class="iconpicker_container2" style="width: 874px; height: 340px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- forms -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_form_btn_nav_link hidden"><span class="widget__item-option-text"></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_form_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            <h4 class="text-white mt-3"><b>{{__("l.form")}}</b></h4>
                                        </div>
                                        <div class="dropdown_widget-content ModalPannel" style="min-height: 180px;">
                                            <div class="input-group container-group-option">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">{{__("l.choose_form")}}</div>
                                                </div>
                                                <select id="custom_form" class="form-control">
                                                    <option value="0">{{__("l.default_form")}}</option>
                                                    @foreach($forms as $form)
                                                        <option value="{{$form->id}}">{{$form->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-0 text-center">
                                                <button class="button_shape" id="save_button_form">{{__("l.save")}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- image -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_image_btn_nav_link hidden"><span class="widget__item-option-text"></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_image_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            <h4 class="text-white mt-3"><b>{{__("l.images")}}</b></h4>
                                        </div>
                                        <div class="dropdown_widget-content ModalLiberia ModalPannel">
                                            <div class="main-gallery-image">
                                                <div class="aside-gallery-image">
                                                    <h4 class="title-aside-gallery-image">{{__("l.images")}}</h4>
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active" data-toggle="pill" href="#tab-gallery-1" role="tab"><i class="fas fa-sort-up"></i>{{__("l.image_popup")}}</a>
                                                        <a class="nav-link" data-toggle="pill" href="#tab-gallery-2" role="tab"><i class="fas fa-sort-up"></i>{{__("l.upload_file_from_computer")}}</a>
                                                    </div>
                                                </div>
                                                <div class="content-gallery-image">
                                                    <div class="body-gallery-image">
                                                        <div class="wrapper-gallery-image">
                                                            <div class="tab-content" id="v-pills-tabContent">

                                                                <div class="tab-pane fade show active" id="tab-gallery-1" role="tabpanel">
                                                                    <div class="header-gallery-image">
                                                                        <div class="row">
                                                                            <div class="col-lg-4"></div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group mb-0 container-group-option">
                                                                                    <select class="form-control" id="image_categories"></select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group mb-0 container-group-option">
                                                                                    <input type="text" class="form-control" id="image_search" placeholder="{{__("l.search")}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-gallery-image" id="list-gallery-image1"></div>
                                                                    <div class="form-group mb-2 mt-5 text-center">
                                                                        <button class="button_shape save_button disabled" id="image_popup_save">{{__("l.confirmation")}}</button>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="tab-gallery-2" role="tabpanel">

                                                                    <form action="{{route("editor.images_upload_save")}}" method="post" id="images_upload_form">
                                                                        <div class="input-group mb-3 mt-2">
                                                                            <input type="file" accept="image/*" class="form-control file" required style="color: #543c93;">
                                                                            <div class="input-group-append">
                                                                                <button class="general-btn-md btn rounded" type="submit" style="background: #543c93;"><i class="fa fa-upload"></i> <span>{{__("l.upload")}}</span></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                    <div id="my_images_wrapper">
                                                                        <div id="my_images_div">
                                                                            <div class="list-gallery-image">
                                                                                @foreach($my_images as $my_image)
                                                                                    <div class="col-single-image">
                                                                                        <div class="widght-single-image widght-single-image1">
                                                                                            <a title="{{__("l.delete")}}" href="#" class="remove_image" data-image="{{$my_image->url}}"><i class="fa fa-trash"></i></a>
                                                                                            <img src="{{$my_image->url}}" alt="" >
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mb-2 mt-5 text-center">
                                                                        <button class="button_shape save_button disabled" id="image_popup_save2">{{__("l.confirmation")}}</button>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- video -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_video_btn_nav_link hidden"><span class="widget__item-option-text"></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_video_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            <h4 class="text-white mt-3"><b>{{__("l.videos")}}</b></h4>
                                        </div>
                                        <div class="dropdown_widget-content ModalLiberia ModalPannel">
                                            <div class="main-gallery-image">
                                                <div class="aside-gallery-image">
                                                    <h4 class="title-aside-gallery-image">{{__("l.videos")}}</h4>
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active" data-toggle="pill" href="#tab-gallery-3" role="tab"><i class="fas fa-sort-up"></i>{{__("l.video_popup")}}</a>
                                                        <a class="nav-link" data-toggle="pill" href="#tab-gallery-4" role="tab"><i class="fas fa-sort-up"></i>{{__("l.my_videos")}}</a>
                                                    </div>
                                                </div>
                                                <div class="content-gallery-image">
                                                    <div class="body-gallery-image">
                                                        <div class="wrapper-gallery-image">
                                                            <div class="tab-content" id="v-pills-tabContent2">

                                                                <div class="tab-pane fade show active" id="tab-gallery-3" role="tabpanel">
                                                                    <div class="header-gallery-image">
                                                                        <div class="row">
                                                                            <div class="col-lg-4"></div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group mb-0 container-group-option">
                                                                                    <select class="form-control" id="video_categories"></select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group mb-0 container-group-option">
                                                                                    <input type="text" class="form-control" id="video_search" placeholder="{{__("l.search")}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-gallery-image" id="list-gallery-video1"></div>
                                                                    <div class="form-group mb-2 mt-5 text-center">
                                                                        <button class="button_shape save_button disabled" id="video_popup_save">{{__("l.confirmation")}}</button>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="tab-gallery-4" role="tabpanel">

                                                                    <form action="{{route("editor.videos_upload_save")}}" method="post" id="videos_upload_form">
                                                                        <div class="input-group mb-3 mt-2">
                                                                            <input type="url" placeholder="{{__("l.video_url_youtube_or_vimeo")}}" class="form-control" id="video_url_youtube_or_vimeo" required style="color: #543c93;">
                                                                            <div class="input-group-append">
                                                                                <button class="general-btn-md btn rounded" type="submit" style="background: #543c93;"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                                                                            </div>
                                                                            <div id="video_preview" style="width: 100%;"></div>
                                                                        </div>
                                                                    </form>

                                                                    <div id="my_videos_wrapper">
                                                                        <div id="my_videos_div">
                                                                            <div class="list-gallery-image">
                                                                                @foreach($my_videos as $my_video)
                                                                                    <div class="col-single-image" style="flex: 0 0 25%;max-width: 25%; height: 160px;">
                                                                                        <div class="widght-single-image widght-single-video1" style="height: 100%; width: 100%;">
                                                                                            <iframe style="width: 100%; height: 100%; background: #000;" src="{{$my_video->url}}" allow=""></iframe>
                                                                                            <div style="position: absolute; top:0px; bottom: 0px; left: 0px; right: 0px; background: transparent;"></div>
                                                                                            <a title="{{__("l.delete")}}" href="#" class="remove_video" data-id="{{$my_video->id}}"><i class="fa fa-trash"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mb-2 mt-5 text-center">
                                                                        <button class="button_shape save_button disabled" id="video_popup_save2">{{__("l.confirmation")}}</button>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- image -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_gmap_btn_nav_link hidden"><span class="widget__item-option-text"></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_gmap_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                                            <h4 class="text-white mt-3"><b>{{__("l.google_map")}}</b></h4>
                                        </div>
                                        <div class="dropdown_widget-content ModalPannel" style="min-height: 180px;">
                                            <div class="input-group container-group-option">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">{{__("l.choose")}} {{__("l.google_map_link")}}</div>
                                                </div>
                                                <input id="google_map_link" class="form-control">
                                            </div>
                                            <div class="form-group mb-0 text-center">
                                                <button class="button_shape" id="save_button_gmap">{{__("l.save")}}</button>
                                            </div>

                                            <div class="mt-2">
                                                <a class="text-white" target="_blank" href="https://authoritynw.com/blog/how-to-add-a-google-map-to-your-website/">{{__("l.how_to_get_google_map_code")}} ?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- colors -->
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link colors_link"><span class="widget__item-option-icon"><img src="{{asset("public/dashboard/images/cpanel/art-and-design.png")}}" alt=""></span><span
                                        class="widget__item-option-text"> {{__("l.colors")}}</span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <h5>{{__("l.colors")}}</h5>
                                            <h6>{{__("l.colors_notes")}}</h6>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="row">
                                                <div class="col-lg-12">

                                                    <div class="widget__item_dropdown_inner_content height-scroll-115 scroll colors_widget colors_list">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <a class="widget__item_dropdown-link link-active add_new_color">
                                                                    <div class="widget__item_dropdown-icon">
                                                                        <i class="fas fa-plus fa-lg"></i>
                                                                    </div>
                                                                    <h3 class="widget__item_dropdown-title"> أضف لون جديد
                                                                    </h3>
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item-color @if(!$website->color_id) active @endif change_color_default">
                                                                    <div class="widget__item-color-header">{{__("l.default_color")}}</div>
                                                                    <div class="widget__item-color-body">
                                                                        <div class="widget__item-color-option" style="background: #551B74;">
                                                                        </div>
                                                                        <div class="widget__item-color-option" style="background: #994bc2;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @foreach($colors as $color)
                                                                <div class="col-lg-3">
                                                                    <div class="widget__item-color @if($website->color_id == $color->id) active @endif colors_edit_btn" data-id="{{$color->id}}">
                                                                        <div class="widget__item-color-header">{{$color->name}}</div>
                                                                        <div class="widget__item-color-body">
                                                                            <div class="widget__item-color-option" style="background: {{$color->color1}};">
                                                                            </div>
                                                                            <div class="widget__item-color-option" style="background: {{$color->color2}};">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="widget__item_dropdown_inner_content height-scroll-115 scroll colors_widget colors_add">
                                                        <form action="{{route("editor.save_color")}}" class="row save_color" method="post">
                                                            <div class="col-lg-10">
                                                                <div class="row">
                                                                    <div class="col-sm-3"><label class="text-white">{{__("l.color_name")}}</label></div>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control name" name="name" required style="height: 40px !important; color: #543c93 !important;">
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-1">
                                                                    <div class="col-sm-3"><label class="text-white">{{__("l.color1")}}</label></div>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control colorpicker color1" name="color1" value="#763a96" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-1">
                                                                    <div class="col-sm-3"><label class="text-white">{{__("l.color2")}}</label></div>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control colorpicker color2" name="color2" value="#551B74" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <button type="submit" class="btn general-btn-sm-blue rounded btn-block">{{__("l.save")}}</button>
                                                                <button type="button" class="btn general-btn-sm-blue rounded btn-block show_colors_list">{{__("l.reset")}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    @foreach($colors as $color)
                                                        <div class="widget__item_dropdown_inner_content height-scroll-115 scroll colors_widget colors_edit colors_edit{{$color->id}}">
                                                            <form action="{{route("editor.update_color")}}" class="row update_color" method="post">
                                                                <input type="hidden" name="id" class="color_id" value="{{$color->id}}">
                                                                <div class="col-lg-8">
                                                                    <div class="row">
                                                                        <div class="col-sm-3"><label class="text-white">{{__("l.color_name")}}</label></div>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" value="{{$color->name}}" class="form-control name" name="name" required style="height: 40px !important; color: #543c93 !important;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1">
                                                                        <div class="col-sm-3"><label class="text-white">{{__("l.color1")}}</label></div>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control colorpicker color1" name="color1" value="{{$color->color1}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-1">
                                                                        <div class="col-sm-3"><label class="text-white">{{__("l.color2")}}</label></div>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control colorpicker color2" name="color2" value="{{$color->color2}}" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <button type="submit" class="btn general-btn-sm-blue rounded btn-block">{{__("l.save")}}</button>
                                                                    <button type="button" class="btn general-btn-sm-blue rounded btn-block show_colors_list">{{__("l.reset")}}</button>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <button type="button" class="btn general-btn-sm-blue rounded btn-block change_color_default" data-id="{{$color->id}}">{{__("l.default")}}</button>
                                                                    <button type="button" class="btn general-btn-sm-blue rounded btn-block remove_color" data-id="{{$color->id}}">{{__("l.delete")}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--
                            <div class="dropdown_widget dropdown_widget_second">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <h5>الألوان</h5>
                                            <h6>اختر لون يناسب موقعك، أو أنشأ لون خاص بك </h6>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content scroll">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="widget__item-color">
                                                                    <div class="widget__item-color-header">
                                                                        اللون الرئيسي
                                                                    </div>
                                                                    <div class="widget__item-color-body">
                                                                        <div class="widget__item-color-option w-100 bg-white">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item-color">
                                                                    <div class="widget__item-color-header">
                                                                        كود اللون
                                                                    </div>
                                                                    <div class="widget__item-color-body">
                                                                        <div class="widget__item-color-option w-100 text-dark d-flex align-items-center justify-content-center bg-info"> #43255
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <p class=" text-light">اللون</p>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="slideInputContainer">
                                                                            <input type="range" min="1" max="100" value="50" class="sliderInput">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row align-items-center">
                                                                    <div class="col-lg-3">
                                                                        <p class="mt-2 text-light">الشفافية</p>
                                                                    </div>
                                                                    <div class="col-lg-9">
                                                                        <div class="rangeSlider w-100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <div class="form-group text-right ">
                                                                    <button type="submit" class="btn general-btn-sm-blue rounded">{{__("l.save")}}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            -->
                        </li>
                        <!-- lang -->
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link nav_lang single-item lang_{{$website_lang}}"><span class="widget__item-option-icon text-uppercase">{{$website_lang}}</span></a>
                        </li>
                        <!-- slug -->
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link single-item"><span class="widget__item-option-icon"><img src="{{asset("public/dashboard/images/cpanel/unlink.png")}}" alt=""></span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <h5>{{__("l.link")}}</h5>
                                            <h6>{{__("l.link_note")}}</h6>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="row ">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content scroll">
                                                        <form action="{{route("editor.update_slug")}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="page_id" value="{{$page->id}}">
                                                            <div class="row">
                                                                <div class="col-lg-10">
                                                                    <div class="yourDomain">
                                                                        <div class="form-group der">
                                                                            <div class="input-group align-items-center">
                                                                                <input name="slug" class="form-control slug_input rounded bg-control text-right" value="{{$page->slug}}" type="text" required>
                                                                                <label class="yourDomainText">{{urldecode(route("website.page", [$website->slug, "ar"]))}}/</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <div class="form-group text-center ">
                                                                        <button type="submit" class="btn general-btn-sm-blue rounded">{{__("l.update")}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- preview -->
                        <li class="widget__item-option-item">
                            <a href="{{$real_page_url}}" target="_blank" class="nav-item nav-link single-item btn-preview">
                                <span class="widget__item-option-icon"><img src="{{asset("public/dashboard/images/eye.png")}}" alt=""></span>
                            </a>
                        </li>
                        <!-- save -->
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link save_page draft" href="#">
                                <span class="widget__item-option-icon"><img src="{{asset("public/dashboard/images/cpanel/copy.png")}}" alt=""></span><span class="widget__item-option-text">{{__("l.save")}} </span>
                            </a>
                        </li>
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link btn-publis save_page public">
                                <span class="widget__item-option-icon"><img src="{{asset("public/dashboard/images/cpanel/start.png")}}" alt=""></span><span class="widget__item-option-text"> {{__("l.publish")}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
