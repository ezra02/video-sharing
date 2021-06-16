<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4e/Open_Source_Initiative_keyhole.svg/1200px-Open_Source_Initiative_keyhole.svg.png">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
            <nav class="bg-red-700 text-white shadow-sm flex justify-between p-1">
                <div class="flex flex-auto">
                    <a class="text-xl mr-10 hover:text-green-500" href="{{ url('/') }}">
                        Home
                    </a>
                        <form action="{{route('video.search')}}" method="post" class="flex">
                            @csrf
                            <input type="text" name="searchQuery" placeholder="search" required
                            class="w-4/5 h-10 rounded border-2 my-auto text-xl placeholder-search text-bold text-green-900">
                            <input type="submit" value="search"
                            class=" text-xl text-white bg-red-700 -pt-1">
                        </form>
                          <a href="{{route('video.create')}}"
                          class="no-underline text-xl mr-10 ml-10 hover:text-green-500 hover:no-underline">upload video
                        </a>
                          <a href="{{route('channel.create')}}"
                          class="no-underline text-xl mr-10 ml-10 hover:text-green-500 hover:no-underline">create channel
                        </a>
                        @auth
                        <div class="dropdown">
                            <a class="dropdown-toggle flex hover:no-underline hover:text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                </svg>
                                @if(auth()->user()->unreadNotifications->count())
                                <span class="text-3xl ">({{auth()->user()->unreadNotifications->count()}})</span>   
                                @endif  
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <ul>
                               @foreach (auth()->user()->unreadNotifications as $notification)
                               @isset($notification->data['href'])
                               <li><a class="dropdown-item text-xl" href="/video/watch/{{$notification->data['href']}}">{{$notification->data['data']}}</a></li>
                               @else
                                 <li><a class="dropdown-item text-xl" href="#">{{$notification->data['data']}}</a></li>                              
                               @endisset
                               @endforeach  
                              </ul>
                            </div>
                        </div>
                        @endauth
                </div>
                <div class="flex flex-auto justify-end" id="navbarSupportedContent">
                    <ul class="flex mx-2 p-x2">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="flext-auto nav-item">
                                    <a class="px-2 text-lg" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="flex-auto nav-item">
                                    <a class="px-2 text-lg" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                          {{-- <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                          </button> --}}
                            <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-lg" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right bg-gray-200" aria-labelledby="navbarDropdown">
                                    <div>
                                     <ul class="list-style-none">
                                      <li class="m-auto text-center text-xl"><a href="#">liked videos</a></li>
                                      <li class="m-auto text-center text-xl"><a href="#">my comments</a> </li>     
                                     </ul>   
                                    </div>
                                    <a class="dropdown-item text-xl text-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
            </div>
        </nav>
        <main class="lg:py-4 xl:py-4 2xl:py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
