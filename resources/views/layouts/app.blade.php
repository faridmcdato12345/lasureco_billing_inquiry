<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LASURECO - Online Billing Inquiry') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <!-- Sidebar (hidden by default) -->
    <nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:1000;width:30%;min-width:300px" id="mySidebar">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item x-button" style="text-align:right;">X</a>
        <div class="user-info">
            <div class="flex-none sm:flex text-sm sm:text-base">
                <div class="" style="">
                    <img src="{{asset('images/default-profile.png')}}" class="profile-pic"/>
                </div>
                <div class="flex-none mt-3 sm:items-center ...">
                    <div class="flex sm:py-4">
                        <label for="">Account Name:</label>
                        <p style="text-transform: uppercase">{{Auth::user()->name}}</p>
                    </div>
                    <div class="flex">
                        <label for="">Account Number:</label>
                        <p>{{Auth::user()->account_no}}</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="setting text-sm sm:text-base md:text-base">
            <p onclick="change_pass_open(true)"><i class="fa fa-cogs fa-fw"></i> Change Password</p>
            <a class="logout" 
            href="{{ route('logout') }}" 
            onclick="event.preventDefault();
            document.getElementById('logout-form')
            .submit();">
            <i class="fa fa-sign-out fa-fw"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>
    <div id="app">
        <!-- Top menu -->
        <div class="w3-top">
            <div class="w3-white w3-xlarge" style="margin:auto">
            <div class="w3-padding-16 w3-left menu-line" onclick="w3_open()">☰</div>
            <div class="w3-center w3-padding-16 title-header" style="background-image: url('{{asset('images/logo.png')}}')">
                <p style="text-decoration: underline;font-weight:bold">LASURECO</p>
                <p style="font-size: 12px;margin-top: -5px;">Online Billing Inquiry</p>
            </div>
            </div>
        </div>
        <main class="pt-24">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
    <script>
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            var backdropEl = document.createElement('div');
            backdropEl.setAttribute('modal-backdrop', '');
            backdropEl.classList.add('bg-gray-900', 'bg-opacity-50', 'dark:bg-opacity-80', 'fixed', 'inset-0', 'z-40');
            document.querySelector('body').append(backdropEl);
        }
        function w3_close() {
          document.getElementById("mySidebar").style.display = "none";
          document.querySelector('[modal-backdrop]').remove();
        }
        function change_pass_open(show = true) {
            const modalEl = document.getElementById("change-pass-modal");
                if (show) {
                    modalEl.classList.add('flex');
                    modalEl.classList.remove('hidden');
                    modalEl.setAttribute('aria-modal', 'true');
                    modalEl.setAttribute('role', 'dialog');
                    modalEl.removeAttribute('aria-hidden'); // create backdrop element
                
                    var backdropEl = document.createElement('div');
                    backdropEl.setAttribute('modal-backdrop', '');
                    backdropEl.classList.add('bg-gray-900', 'bg-opacity-50', 'dark:bg-opacity-80', 'fixed', 'inset-0', 'z-40');
                    document.querySelector('body').append(backdropEl);
                    w3_close()
                } 
                else {
                    modalEl.classList.add('hidden');
                    modalEl.classList.remove('flex');
                    modalEl.setAttribute('aria-hidden', 'true');
                    modalEl.removeAttribute('aria-modal');
                    modalEl.removeAttribute('role');
                    document.querySelector('[modal-backdrop]').remove();
                }
        }
    </script>
</body>
<footer class="main-footer text-xs flex">
    <div>
        <strong>Copyright © 2022 <span>LASURECO - ICT Division</span>.</strong>
        All rights reserved.
    </div>
    <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0.0
    </div>
</footer>
</html>
