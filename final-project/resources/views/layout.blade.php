<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div class="container mt-3 web-wrapper" >
        <div class="nav navbar">
            @if(Auth::check())
            <div class="nav-top">
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link">🍒 Profile</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('task.quick') }}" class="nav-link">📄 Add Tasks</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('task.view') }}" class="nav-link">✏️ View Tasks</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('task.team') }}" class="nav-link">🤝 Team Tasks</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reddit.forum') }}" class="nav-link">🤝 Forum</a>
                </li>

            </div>
            <div class="nav-bottom">
                <li class="nav-item">
                    <form method="POST" action= "{{route('auth.logout')}}">
                        @csrf
                        <button type="submit" class="btn btn-link logoutbtn">Logout</button>
                    </form>
                </li>
            </div>
            
               
                
            @endif
            
        </div>
        <div>
</div>

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
            </div>
        @endif
        @yield('main')
    </div>
</body>
</html>