<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('images/user.jpg') }}" class="img-circle" alt="{{ auth()->user()->name }}">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>{{ __('lang.online') }}</a>
            </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">{{ __('lang.navigation_bar') }}</li>

            <li class="@isset($slug) @if($slug == 'dashboard') active @endif @endisset">
                <a href="{{ route('admin.dashboard.index') }}">
                    <i class="fa fa-dashboard"></i> <span>{{ __('lang.dashboard') }}</span>
                </a>
            </li>

            <li class="@isset($slug) @if($slug == 'companies') active @endif @endisset">
                <a href="{{ route('companies.index') }}">
                    <i class="fa fa-building"></i> <span>{{ __('lang.companies') }}</span>
                </a>
            </li>

            <li class="@isset($slug) @if($slug == 'employees') active @endif @endisset">
                <a href="{{ route('employees.index') }}">
                    <i class="fa fa-users"></i> <span>{{ __('lang.employees') }}</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-globe"></i> <span>{{ __('lang.change_language') }}</span>
                    <i class="fa fa-angle-left pull-left"></i>
                </a>
                <ul class="treeview-menu">
                    @forelse(app_languages() as $key => $language)
                        <li><a href="{{ route('admin.language.set', $key) }}"><i class="fa fa-circle-o"></i>{{ $language }}</a></li>
                    @empty
                    @endforelse
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
