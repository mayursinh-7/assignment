<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet"/>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .task-card{
                cursor: pointer;
            }
            .navbar.navbar-absolute {
                z-index: unset;
            }
            a.dropdown-item:hover{
                background-color: #ef8157!important;
            }
            .active{
                background-color: #fedac7;
                border-right: 5px solid #ef8157;
            }
            .bg-gray-800{
                background-color: #ca622d!important;
            }
            .drag{
                background-color: #fedac7;
            }
            .sidebar .sidebar-wrapper li.active > a:not([data-toggle="collapse"]):before,
            .sidebar .sidebar-wrapper li.active > a:not([data-toggle="collapse"]):after{
                content: unset;
            }
        </style>
        @yield('styles')
    </head>
    <body class="">
        <div class="wrapper">
            @include('partials.sidebar')
            <div class="main-panel" style="min-height: 100%;">
                <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse justify-content-end" id="navigation">
                            <ul class="navbar-nav">
                                <li class="nav-item btn-rotate dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="nc-icon nc-circle-10"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </a>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/gh/RubaXa/Sortable/Sortable.min.js"></script>
        <script>
        $(document).ready(function(){
            window.resetForm = function(){
                $('#task-form #form-title').text('Create task');
                $('#task-form #title').val('');
                $('#task-form #description').val('');
                $('#task-form').find('input[name="_method"]').remove();
                $('#task-form').attr('action', "{{ route('tasks.store') }}");
            }
        });
        </script>
        @yield('scripts')
    </body>
</html>