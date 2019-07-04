<!DOCTYPE html>
<html lang="en">

<head>
    <title>LaravelTodo</title>

</head>

<body>

    <nav class="navbar navbar-default">
        <div class="container">
            <!-- navbar  -->
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/')  }}">
                    Task List
                </a>
            </div>
        </div>
    </nav>
    @yield('content')

    <!--この部分に、子ページの内容が挿入される-->
    <!-- JavaScripts -->
</body>

</html>