<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>609-31</title>
</head>
<body>
<div class="container">
    @error('errorAccess')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @error('successLogin')
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @enderror

    @error('success')
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @enderror

    @error('error')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror

    @error('email')
    <div class="alert alert-warning" role="alert">
        {{ $message }}
    </div>
    @enderror

    @error('password')
    <div class="alert alert-warning" role="alert">
        {{ $message }}
    </div>
    @enderror
</div>
</body>
</html>
