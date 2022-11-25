<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header font-medium-1">
                <i class="fa fa-minus" style="margin-left:5px;"></i>
                <span>@lang('global.dashboard')</span>
            </li>
            <li @if(Request::route()->getName()=='dashboard') class="active" @endif>
                <a href="{{route('dashboard')}}">
                    <i class="feather icon-home"></i><span class="menu-title" data-i18n="@lang('global.home')">@lang('global.home')</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-car"></i>
                    <span class="menu-title" data-i18n="@lang('global.bodyTypes')">@lang('global.bodyTypes')</span>
                </a>
                <ul class="menu-content">
                    <li @if(Request::route()->getName()=='bodytype.create') class="active" @endif>
                        <a class="menu-item" href="{{route('bodytype.create')}}" data-i18n="@lang('global.create') @lang('global.bodyType')">
                            <i class="fa fa-plus icon-menu"></i> @lang('global.create') @lang('global.bodyType')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='bodytype.index' || Request::route()->getName()=='bodytype.edit')
                        class="active"
                        @endif>
                        <a class="menu-item" href="{{route('bodytype.index')}}" data-i18n="@lang('global.bodyTypes')">
                            <i class="fa fa-table icon-menu" style="margin-top: 3.5px;"></i> @lang('global.bodyTypes')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='bodytype.trash') class="active" @endif>
                        <a class="menu-item" href="{{route('bodytype.trash')}}" data-i18n="@lang('global.trash')">
                            <i class="fa fa-trash icon-menu" style="margin-top: 2px;"></i> @lang('global.trash')
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span class="menu-title" data-i18n="@lang('global.users')">@lang('global.users')</span>
                </a>
                <ul class="menu-content">
                    <li @if(Request::route()->getName()=='user.index' || Request::route()->getName()=='user.edit')
                        class="active"
                        @endif>
                        <a class="menu-item" href="{{route('user.index')}}" data-i18n="@lang('global.users')">
                            <i class="fa fa-table icon-menu" style="margin-top: 3.5px;"></i> @lang('global.users')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='user.trash') class="active" @endif>
                        <a class="menu-item" href="{{route('user.trash')}}" data-i18n="@lang('global.trash')">
                            <i class="fa fa-trash icon-menu" style="margin-top: 2px;"></i> @lang('global.trash')
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span class="menu-title" data-i18n="@lang('global.posts')">@lang('global.posts')</span>
                </a>
                <ul class="menu-content">
                    <li @if(Request::route()->getName()=='post.index' || Request::route()->getName()=='post.edit')
                        class="active"
                        @endif>
                        <a class="menu-item" href="{{route('post.index')}}" data-i18n="@lang('global.posts')">
                            <i class="fa fa-table icon-menu" style="margin-top: 3.5px;"></i> @lang('global.posts')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='post.trash') class="active" @endif>
                        <a class="menu-item" href="{{route('post.trash')}}" data-i18n="@lang('global.trash')">
                            <i class="fa fa-trash icon-menu" style="margin-top: 2px;"></i> @lang('global.trash')
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
