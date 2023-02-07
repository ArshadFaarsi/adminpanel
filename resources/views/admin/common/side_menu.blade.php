<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="{{ asset('public/admin/assets/images/logo1.png') }}"
                    class="header-logo" /> <span class="logo-name">Typing center</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}" class="nav-link"><i
                        data-feather="home"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown {{ request()->is('admin/company*') ? 'active' : '' }}">
                <a href="{{ route('company.index') }}" class="nav-link"><i data-feather="users"></i><span>Company</span></a>
            </li>
            <li class="dropdown {{ request()->is('admin/officer*') ? 'active' : '' }}">
                <a href="{{ route('officer.index') }}" class="nav-link"><i data-feather="users"></i><span>Officer</span></a>
            </li>
            <li class="dropdown {{ request()->is('admin/about*') ? 'active' : '' }}">
                <a href="{{ route('about.index') }}" class="nav-link"><i data-feather="monitor"></i><span>About
                        Us</span></a>
            </li>
            <li class="dropdown {{ request()->is('admin/policy*') ? 'active' : '' }}">
                <a href="{{ route('policy.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Privacy
                        Policy</span></a>
            </li>
            <li class="dropdown {{ request()->is('admin/terms*') ? 'active' : '' }}">
                <a href="{{ route('terms.index') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Term&Condition</span></a>
            <li class="dropdown {{ request()->is('admin/faq*') ? 'active' : '' }}">
                <a href="{{ route('faq.index') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>FAQ's</span></a>
            </li>
            </li>
        </ul>
    </aside>
</div>
