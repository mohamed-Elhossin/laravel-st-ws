<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.shared.head')
</head>

<body>


    <main>
        <div class="container col-md-12">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Bridge-BFC </span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card w-100 mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your Email & password to login</p>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">email</label>
                                            <div class="input-group has-validation">
                                                 <input type="email" name="email" class="form-control"
                                                    id="yourUsername" required>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>
                                        <div class="col-12 my-3">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>

                                        <div class="col-12">
                                            <p class="small mb-0"> <a href="{{ route('password.request') }}">Forget My
                                                    password</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
        </div>
    </main><!-- End #main -->


    @include('admin.shared.script')
</body>

</html>
