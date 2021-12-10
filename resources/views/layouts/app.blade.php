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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .btn-info , .badge-info  {
            color: #FFF
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        <li class="nav-item">
                            <a href="{{ route('users.notifications') }}" class="nav-link">
                                <span class="badge badge-info py-2">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                    Unread notifications
                                </span>
                            </a>
                        </li>

                        @endauth

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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


        @if(!in_array(request()->path(), ['register', 'login', 'password/email', 'password/reset']))

        <main class="container py-4">




            <div class="row">

                <div class="col-md-4">

                    @auth

                    <button type="button" class="btn btn-info form-control mb-2" style="color: #FFF" data-toggle="modal" data-target="#modelId">
                        Add Discussion
                      </button>
                      <br>

                    @else
                    <a href="{{ route('login') }}" class="btn btn-info form-control mb-2" style="color: #FFF" >
                        Sign in to add discussion
                    </a>
                    @endauth
                   


                    <ul class="list-group">
                        <li class="list-group-item"><a href="/discussions" style="text-decoration: none">Home page</a></li>
                    </ul>
                    <br>

                    <div class="card">
                        <div class="card-header">
                            Channels
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($channels as $channel)
                                    <li class="list-group-item">
                                     <a style="text-decoration: none" href="{{ route('discussions.index') }}?channel={{ $channel->slug }}">{{ $channel->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <main class="">
                        @yield('content')
                    </main>
                </div>
        @else
        <div class="container py-4">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <main class="">
                        @yield('content')
                    </main>

                </div>
            </div>
        </div>
        @endif
            </div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">Create a Discussion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                  <form action="{{ route('discussions.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="content">Content</label>
                      <textarea name="content" id="content" class="form-control" cols="5" rows="5"></textarea>
                    </div>
                    <div class="form-group">

                      <label for="Channel">Channel</label>
                      <select name="channel_id" id="channel_id" class="form-control">

                        @foreach($channels as $channel)

                          <option value="{{ $channel->id }}">{{ $channel->name }}</option>

                        @endforeach

                      </select>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-info" type="submit">Create Discussion</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
