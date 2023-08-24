@extends('layouts.guest')

@section('content')
    <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('/images/logo.png') }}" style="width:10vw; height:auto" alt="Stock Manager"
                class="navbar-brand-image rounded-5">
        </a>
    </div>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Login to your account</h2>
            <form action="{{ route('login') }}" method="post">
                @method('post')
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="your@email.com" />
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Password
                        <span class="form-label-description">
                            <a href="./forgot-password.html">I forgot password</a>
                        </span>
                    </label>
                    <div class="input-group input-group-flat">
                        <input id="password" type="password" name="password" class="form-control"
                            placeholder="Your password" />
                        <span class="input-group-text" id="eye">
                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                <svg id="open-eye" xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path
                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                                <svg id="close-eye" xmlns="http://www.w3.org/2000/svg" style="display: none"
                                    class="icon icon-tabler icon-tabler-eye-closed" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4"></path>
                                    <path d="M3 15l2.5 -3.8"></path>
                                    <path d="M21 14.976l-2.492 -3.776"></path>
                                    <path d="M9 17l.5 -4"></path>
                                    <path d="M15 17l-.5 -4"></path>
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
            </form>
        </div>
    </div>

    <div class="hr-text">
        or
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col"><a href="{{ route('login.provider', ['provider' => 'github']) }}" class="btn w-100">
                    <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-github" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                    </svg>
                    Login with Github
                </a>
            </div>
        </div>
    </div>

    <script>
        $('#eye').on('click', function() {
            var type = $('#password').attr('type');
            if (type == 'password') {
                $('#password').attr('type', 'text');
                $('#open-eye').css('display', 'none');
                $('#close-eye').css('display', 'block');
            } else {
                $('#password').attr('type', 'password');
                $('#open-eye').css('display', 'block');
                $('#close-eye').css('display', 'none');
            }

        })
    </script>
@endsection
