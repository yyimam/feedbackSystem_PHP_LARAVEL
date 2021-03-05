@if(Session::has('role'))
    <script>window.location = "/main";</script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="login-wrapper">
        <form action="/login" method="post">
            @csrf
            <h1>LOGIN</h1>
            @if(Session::has('status'))
                <p style="color: red;text-align:center">"{{ Session::get('status') }}"</p>
            @endif
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Password" name="password">
            <input type="submit">
        </form>
    </div>
</body>
</html>