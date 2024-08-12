@extends('layouts.master2')


@push('plugin-styles')
<style>
  .my-alerts {
    width: 50vw;
    margin: 0 auto;
  }

  .password-input {
  position: relative;
}

.password-input .eye-icon {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  cursor: pointer;
}

.password-input .eye-icon ion-icon {
  font-size: 20px;
}

</style>
@endpush

@section('content')


@if (Session::has('errors'))
<div class="my-alerts mt-2">
  <div class="alert alert-danger" role="alert" id="danger">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
</div>  
@endif

@error('email')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror

@error('password')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror

<div class="row w-100">
  <div class="col-md-5 d-none d-md-block">
    <img src="{{asset('images/login.png')}}" alt="login-bg" style="width: 100%;">
  </div>
  <div class="col-md-7" style="display: flex; justify-content:center; padding-top: 5%;">
    <div style="width: 60%" >
      <div class="text-center mb-3">
        <h3>Welcome Back!</h3>
        <p>Continue with google or enter your details</p>
      </div>

      {{-- google area --}}
      <a href="{{url('/signin/google')}}"><button class="mb-5" style="font-weight:bold; padding: 10px; width: 100%; border: 1px solid #8EC5FC; background: transparent; border-radius: 10px;">
        
        <?xml version="1.0" ?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
        <svg width="20px" height="20px" viewBox="0 0 32 32" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"><path d="M23.75,16A7.7446,7.7446,0,0,1,8.7177,18.6259L4.2849,22.1721A13.244,13.244,0,0,0,29.25,16" fill="#00ac47"/><path d="M23.75,16a7.7387,7.7387,0,0,1-3.2516,6.2987l4.3824,3.5059A13.2042,13.2042,0,0,0,29.25,16" fill="#4285f4"/><path d="M8.25,16a7.698,7.698,0,0,1,.4677-2.6259L4.2849,9.8279a13.177,13.177,0,0,0,0,12.3442l4.4328-3.5462A7.698,7.698,0,0,1,8.25,16Z" fill="#ffba00"/><polygon fill="#2ab2db" points="8.718 13.374 8.718 13.374 8.718 13.374 8.718 13.374"/><path d="M16,8.25a7.699,7.699,0,0,1,4.558,1.4958l4.06-3.7893A13.2152,13.2152,0,0,0,4.2849,9.8279l4.4328,3.5462A7.756,7.756,0,0,1,16,8.25Z" fill="#ea4435"/><polygon fill="#2ab2db" points="8.718 18.626 8.718 18.626 8.718 18.626 8.718 18.626"/><path d="M29.25,15v1L27,19.5H16.5V14H28.25A1,1,0,0,1,29.25,15Z" fill="#4285f4"/></svg>
        Sign in with Google
      </button></a>
      {{-- google area --}}
      <form class="forms-sample" method="POST" action="{{ route('login') }}">
        @csrf
      <div class="mb-3">
        <label for="userEmail" class="form-label">Email address</label>
        <input type="email" class="form-control" id="userEmail" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="mb-4">
        <label for="userPassword" class="form-label">Password</label>
        <div class="password-input">
          <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="current-password" id="myInput">
          <span class="eye-icon">
            <ion-icon name="eye" id="view-password"></ion-icon>
            <ion-icon name="eye-off-outline" id="hide-password"></ion-icon>
          </span>
        </div>
        
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div>
        <button type="submit" style="background: #43a1ff; color: black; font-weight:bold; width: 100%;" class="btn me-2 mb-2 mb-md-0"><ion-icon name="log-in-outline" style="font-size: 16px;  position: relative; top: 3px; right: 5px; "></ion-icon> Login</a>
        
      </div>
      <div class="text-center">
        <p>Don't have an account? <a href="{{url('/register')}}" style="color: #1389fe; font-wight: bold">Click here</a></p>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- <div class="page-content d-flex align-items-center justify-content-center">
  
  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ asset('images/new-back.jpeg') }})">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">
                <span style="color:green;font-weight:bold">Kisimani Eco Resort & Spa Ltd</span>
              </a>
              <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
              <form class="forms-sample" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                  <label for="userEmail" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="userEmail" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Password</label>
                  <div class="password-input">
                    <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="current-password" id="myInput">
                    <span class="eye-icon">
                      <ion-icon name="eye" id="view-password"></ion-icon>
                      <ion-icon name="eye-off-outline" id="hide-password"></ion-icon>
                    </span>
                  </div>
                  
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div>
                  <button type="submit" style="background:green; color: white;" class="btn me-2 mb-2 mb-md-0"><ion-icon name="log-in-outline" style="font-size: 16px;  position: relative; top: 3px; right: 5px;"></ion-icon> Login</a>
                 
                </div>
                <a href="{{ url('/password/reset') }}" class="d-block mt-3 text-muted">Forgot Password?</a>

                <a href="{{url('/signin/google')}}">Google Login</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}

{{-- @include('layouts.footer') --}}
@endsection

@push('custom-scripts')
  <script defer>

    $(function() {
      $('#hide-password').hide();
      $('#view-password').on('click',myFunction);
      $('#hide-password').on('click',myFunction);

      function myFunction() {
          var x = document.getElementById("myInput");
          if (x.type === "password") {
              x.type = "text";
              $('#view-password').hide();
              $('#hide-password').show();
          } else {
              x.type = "password";
              $('#view-password').show();
              $('#hide-password').hide();
          }
      }
    })
    
  </script>
@endpush