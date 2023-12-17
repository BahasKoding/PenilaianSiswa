<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title" charset="utf-8">
    <title>Login Form</title>
</head>

<body>
    <section id="login">
        <div class="overlay"></div>
        <form action="{{ route('login') }}" method="post" class="box">
            <div class="header"></div>
            <div class="login-area">
                <h4>Login With Your Account</h4>
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        @error('name')
                            <div id="nameError" class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control mb-3" name="name">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        @error('password')
                            <div id="passwordError" class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="password" class="form-control mb-3" name="password">
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="submit" value="Login" class="btn btn-primary " />
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

<script>
    setTimeout(function() {
        document.getElementById('nameError').style.display = 'none';
        document.getElementById('passwordError').style.display = 'none';
    }, 5000); // 5000 milliseconds (5 seconds)
</script>

