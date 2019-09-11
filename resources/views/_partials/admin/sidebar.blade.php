<aside class="app-sidebar">
      <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{auth()->user()->image? asset('storage/user/photo/'.auth()->user()->image):'https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg'}}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{auth()->user()->name?auth()->user()->name:'John Doe'}}</p>
          <p class="app-sidebar__user-designation">{{getUserRoleName(auth()->user()->id)?getUserRoleName(auth()->user()->id):'Admin'}}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item {{ Request::is('home') ? ' active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">{{_lang('dashboard')}}</span></a></li>

         <li><a class="app-menu__item {{ Request::is('admin/setting') ? ' active' : '' }}" href="{{ route('admin.setting') }}"><i class="app-menu__icon fa fa-cogs" aria-hidden="true"></i><span class="app-menu__label">{{_lang('setting')}}</span></a></li>

          <li><a class="app-menu__item {{ Request::is('admin/language*') ? ' active' : '' }}" href="{{ route('admin.language') }}"><i class="app-menu__icon fa fa-language" aria-hidden="true"></i><span class="app-menu__label">{{_lang('language')}}</span></a></li>

        <li class="treeview {{ Request::is('admin/user*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-times"></i><span class="app-menu__label">{{_lang('role_and_permission')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
            <li class="mt-1"><a class="treeview-item {{Request::is('admin/user/role*') ? 'active':''}}" href="{{ route('admin.user.role') }}"><i class="icon fa fa-circle-o"></i> {{_lang('role_permission')}}</a>
            </li>
            <li class="mt-1"><a class="treeview-item {{(Request::is('admin/user*') And !Request::is('admin/user/role*'))  ?'active':''}}" href="{{ route('admin.user.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('user')}}</a></li>
          </ul>
        </li>

           <li><a class="app-menu__item {{ Request::is('admin/backup') ? ' active' : '' }}" href="{{ route('admin.backup') }}"><i class="app-menu__icon fa fa-database"></i><span class="app-menu__label">{{_lang('backup')}}</span></a></li>
      </ul>
    </aside>