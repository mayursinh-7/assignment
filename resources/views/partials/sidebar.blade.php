<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="/" class="simple-text logo-mini">
            <x-application-logo class="fill-current text-gray-500" />
        </a>
        <a href="/" class="simple-text logo-normal">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="nc-icon nc-layout-11"></i>{{ __('Dashboard') }}</a>
            </li>
            <li class="{{ request()->routeIs('tasks*') ? 'active' : '' }}">
                <a href="{{ route('tasks.index') }}"><i class="nc-icon nc-bullet-list-67"></i></i>{{ __('My Tasks') }}</a>
            </li>
        </ul>
    </div>
</div>