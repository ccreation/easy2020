<header class="main-header" id="header1">
    <div class="main_header_option" id="header2">
        <div class="container">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <div class="widget__item-list">
                    <ul class="widget__item-option list_screen">
                        <li class="widget__item-option-item">
                            @if(Auth::guard("client")->check())
                                <a href="{{route("client.websites.index")}}" class="nav-item nav-link px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
                            @elseif(Auth::guard("web")->check())
                                <a href="{{route("admin.templates.index")}}" class="nav-item nav-link px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
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
                            <a class="nav-item nav-link"><span class="widget__item-option-icon"><img src="{{asset("public/dashboard/images/cpanel/pc.png")}}" alt="" /></span><span class="widget__item-option-text">{{__("l.blocks")}}</span></a>
                            <div class="dropdown_widget">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar p-4">
                                            <h5>{{__("l.blocks")}}</h5>
                                            <h6>{{__("l.blocks_note")}}</h6>
                                        </div>
                                        <div class="dropdown_widget-content p-0">
                                            <div class="row">
                                                @php
                                                    $dirs_path = base_path("public/easy/blocks/");
                                                    $dirs = new \DirectoryIterator($dirs_path);
                                                @endphp
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-pills mb-3 tab_dropdown_section" id="pills-tab" role="tablist">
                                                        <?php $x = 0;?>
                                                        @foreach ($dirs as $dir)
                                                            @if($dir->isDir() and !$dir->isDot())
                                                                <?php $type = $dir->getBasename(); ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link @if($x == 0) active @endif" data-toggle="pill" href="#tabSection-{{$type}}" role="tab">{{__("l.a.".$type)}}</a>
                                                                </li>
                                                            @endif
                                                            <?php $x++; ?>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row py-3 px-4">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content scroll">
                                                        <div class="tab-content " id="pills-tabContent">
                                                            <?php $x = 0;?>
                                                            @foreach ($dirs as $dir)
                                                                @if($dir->isDir() and !$dir->isDot())
                                                                    @php
                                                                        $type = $dir->getBasename();
                                                                        $files_path = base_path("public/easy/blocks/".$type."/");
                                                                        $files = new \DirectoryIterator($files_path);
                                                                    @endphp
                                                                    <div class="tab-pane fade show @if($x == 0) active @endif" id="tabSection-{{$type}}" role="tabpanel"
                                                                         aria-labelledby="pills-home-tab">
                                                                        <div class="row">
                                                                            @foreach ($files as $file)
                                                                                @if(!$file->isDir() and !$file->isDot())
                                                                                    @if($file->getExtension() == "png")
                                                                                        <?php $image = $file->getBasename(); ?>
                                                                                        <div class="col-lg-3">
                                                                                            <div class="block widget__item widget__item-price" data-url="{{asset("public/easy/blocks/".$type."/".str_replace(".png", "", $image).".html")}}">
                                                                                                <div class="widget__item-price-header">{{__("l.a.".$type)}}</div>
                                                                                                <div class="widget__item-price-body p-1">
                                                                                                    <img src="{{asset("public/easy/blocks/".$type."/".$image)}}" alt="" class="image-price" style="height: 80px;">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <?php $x++; ?>
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
                            <a class="nav-item nav-link"><span class="widget__item-option-icon">
                        <img src="../images/cpanel/type.png" alt=""></span><span class="widget__item-option-text">الخطوط
                      </span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <h5>الخطوط</h5>
                                            <h6>يمكنك اختيار الخط الذي سيظهر في كامل الموقع </h6>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content scroll">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text">
                                                                    <div class="widget__item--text-header">
                                                                        Droid Sans Arabic
                                                                    </div>
                                                                    <div class="widget__item--text-body">
                                                                        كلام مرسل بنمط أخر يعبر عن استخدامات متعددة
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text">
                                                                    <div class="widget__item--text-header">
                                                                        Droid Sans Arabic
                                                                    </div>
                                                                    <div class="widget__item--text-body">
                                                                        كلام مرسل بنمط أخر يعبر عن استخدامات متعددة
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text">
                                                                    <div class="widget__item--text-header">
                                                                        Droid Sans Arabic
                                                                    </div>
                                                                    <div class="widget__item--text-body">
                                                                        كلام مرسل بنمط أخر يعبر عن استخدامات متعددة
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text">
                                                                    <div class="widget__item--text-header">
                                                                        Droid Sans Arabic
                                                                    </div>
                                                                    <div class="widget__item--text-body">
                                                                        كلام مرسل بنمط أخر يعبر عن استخدامات متعددة
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item--text">
                                                                    <div class="widget__item--text-header">
                                                                        Droid Sans Arabic
                                                                    </div>
                                                                    <div class="widget__item--text-body">
                                                                        كلام مرسل بنمط أخر يعبر عن استخدامات متعددة
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
                        <!-- block settings -->
                        <li class="widget__item-option-item m-0">
                            <a class="nav-item nav-link settings_block_btn_nav_link hidden"><span class="widget__item-option-text">fghjk</span></a>
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
                                                        <a class="nav-link active"  data-toggle="pill" href="#pills-tab-color" role="tab" >لون الخلفية</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link"  data-toggle="pill" href="#pills-tab-image" role="tab" >صورة الخلفية</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#pills-tab-margin" role="tab" >الهوامش</a>
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
                                                    <div class="tab-pane fade" id="pills-tab-image" role="tabpanel">
                                                        <div class="backgroundImageSetting">
                                                            <h4 class="text-center text-white">Coming soon...</h4>
                                                            <img src="" alt="">
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
                            <a class="nav-item nav-link settings_icon_btn_nav_link hidden"><span class="widget__item-option-text">fghjk</span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <a href="#" class="close_block_settings px-3 px-lg-2"><span class="widget__item-option-icon"><i class="fa fa-chevron-right fa-2x"></i></span></a>
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
                        <!-- colors -->
                        <li class="widget__item-option-item">
                            <a class="nav-item nav-link"><span class="widget__item-option-icon">
                        <img src="../images/cpanel/art-and-design.png" alt=""></span><span
                                        class="widget__item-option-text"> الألوان</span></a>
                            <div class="dropdown_widget ">
                                <div class="container">
                                    <div class="dropdown_widget-grid">
                                        <div class="dropdown_widget-sidebar">
                                            <h5>الألوان</h5>
                                            <h6>اختر لون يناسب موقعك، أو أنشأ لون خاص بك </h6>
                                        </div>
                                        <div class="dropdown_widget-content">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="widget__item_dropdown_inner_content height-scroll-115 scroll">
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
                                                                <div class="widget__item-color">
                                                                    <div class="widget__item-color-header">
                                                                        اسم تركيبة اللون
                                                                    </div>
                                                                    <div class="widget__item-color-body">
                                                                        <div class="widget__item-color-option bg-danger">
                                                                        </div>
                                                                        <div class="widget__item-color-option bg-warning">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item-color">
                                                                    <div class="widget__item-color-header">
                                                                        اسم تركيبة اللون
                                                                    </div>
                                                                    <div class="widget__item-color-body">
                                                                        <div class="widget__item-color-option bg-danger">
                                                                        </div>
                                                                        <div class="widget__item-color-option bg-warning">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item-color">
                                                                    <div class="widget__item-color-header">
                                                                        اسم تركيبة اللون
                                                                    </div>
                                                                    <div class="widget__item-color-body">
                                                                        <div class="widget__item-color-option bg-white">
                                                                        </div>
                                                                        <div class="widget__item-color-option bg-dark">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="widget__item-color">
                                                                    <div class="widget__item-color-header">
                                                                        اسم تركيبة اللون
                                                                    </div>
                                                                    <div class="widget__item-color-body">
                                                                        <div class="widget__item-color-option bg-info">
                                                                        </div>
                                                                        <div class="widget__item-color-option bg-secondary">
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
                            </div>
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
