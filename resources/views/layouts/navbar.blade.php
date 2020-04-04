<nav class="navbar navbar-expand-md  py-md-2 main-navbar main-nav">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
           <img src="/images/logo.png" alt="logo" width="50px"> {{ config('app.name', 'FK.DEVELOPMENT') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <img src="/ico/menu.svg" alt="menu" width="30px">
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li><router-link data-toggle="collapse" data-target="#navbarSupportedContent" to="/">Home</router-link></li>
                <li><router-link data-toggle="collapse" data-target="#navbarSupportedContent" to="/about">About Us</router-link></li>
                <li><router-link data-toggle="collapse" data-target="#navbarSupportedContent" to="/services">Services</router-link></li>
                <li><router-link data-toggle="collapse" data-target="#navbarSupportedContent" to="/contact">Contact</router-link></li>
                <li><router-link data-toggle="collapse" data-target="#navbarSupportedContent" to="/blog">Blog</router-link></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                     
                    <div class="dropdown">
                        <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login Or Register
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </div>
                      </div>

                @else
                    <li class="nav-item dropdown">
                        <a id="loginout" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img class="rounded " src="/users-photos/{{Auth::user()->src}}" alt="" width="25px"> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="loginout">

                            <!-- Button trigger modal -->
                            <a type="button" class="dropdown-item" data-toggle="modal" data-target="#user-photo-modal">
                                Edit your photo
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light  bg-white shadow-sm p-0 fixed-top second-nav" >
    <div class="container">
        <a class="navbar-brand ml-2" href="{{ url('/') }}">
            <img src="/images/logo.png" alt="logo" width="50px"> {{ config('app.name', 'FK.DEVELOPMENT') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <img src="/ico/menu.svg" alt="menu" width="30px">
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav m-auto">
                <li data-toggle="collapse" data-target="#navbarSupportedContent"><router-link to="/">Home</router-link></li>
                <li data-toggle="collapse" data-target="#navbarSupportedContent"><router-link to="/about">About Us</router-link></li>
                <li data-toggle="collapse" data-target="#navbarSupportedContent"><router-link to="/services">Services</router-link></li>
                <li data-toggle="collapse" data-target="#navbarSupportedContent"><router-link to="/contact">Contact</router-link></li>
                <li data-toggle="collapse" data-target="#navbarSupportedContent"><router-link to="/blog">Blog</router-link></li>
                <li data-toggle="collapse" data-target="#navbarSupportedContent"><router-link to="/pages">Page</router-link></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                     
                    <div class="dropdown">
                        <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login Or Register
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </div>
                      </div>

                @else
                    <li class="nav-item dropdown">
                        <a id="loginout" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                           <img class="rounded ml-2" src="/users-photos/{{Auth::user()->src}}" alt="" width="25px">  {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="loginout">

                            <!-- Button trigger modal -->
                            <a type="button" class="dropdown-item" data-toggle="modal" data-target="#user-photo-modal">
                                Edit your photo
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                @endguest
            </ul>
        </div>
    </div>
    
</nav>

@if(Auth::check())
<!-- Modal -->
<div class="modal fade" id="user-photo-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content border-0 rounded-0">
        <div class="modal-header border-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <Userphoto :auth-user="{{Auth::user()}}"></Userphoto>
        </div>       
    </div>
    </div>
</div>
<!-- end modal -->
@endif