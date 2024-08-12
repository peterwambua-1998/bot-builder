@extends('layouts.master2')
@push('plugin-styles')
<style>

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
<div class="row w-100">
    <div class="col-md-5 d-none d-md-block">
      <img src="{{asset('images/register.png')}}" alt="login-bg" style="width: 100%;">
    </div>
    <div class="col-md-7 col-sm-12" style="display: flex; justify-content:center; padding-top: 5%;">
      <div style="width: 60%" >
        <div class="text-center mb-3">
          <h3>Create Account!</h3>
          <p>Continue with google or enter your details</p>
        </div>
  
        {{-- google area --}}
        <a href="{{url('/signin/google')}}"><button class="mb-5" style="font-weight:bold; padding: 10px; width: 100%; border: 1px solid #8EC5FC; background: transparent; border-radius: 10px;">
          
          <?xml version="1.0" ?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
          <svg width="20px" height="20px" viewBox="0 0 32 32" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"><path d="M23.75,16A7.7446,7.7446,0,0,1,8.7177,18.6259L4.2849,22.1721A13.244,13.244,0,0,0,29.25,16" fill="#00ac47"/><path d="M23.75,16a7.7387,7.7387,0,0,1-3.2516,6.2987l4.3824,3.5059A13.2042,13.2042,0,0,0,29.25,16" fill="#4285f4"/><path d="M8.25,16a7.698,7.698,0,0,1,.4677-2.6259L4.2849,9.8279a13.177,13.177,0,0,0,0,12.3442l4.4328-3.5462A7.698,7.698,0,0,1,8.25,16Z" fill="#ffba00"/><polygon fill="#2ab2db" points="8.718 13.374 8.718 13.374 8.718 13.374 8.718 13.374"/><path d="M16,8.25a7.699,7.699,0,0,1,4.558,1.4958l4.06-3.7893A13.2152,13.2152,0,0,0,4.2849,9.8279l4.4328,3.5462A7.756,7.756,0,0,1,16,8.25Z" fill="#ea4435"/><polygon fill="#2ab2db" points="8.718 18.626 8.718 18.626 8.718 18.626 8.718 18.626"/><path d="M29.25,15v1L27,19.5H16.5V14H28.25A1,1,0,0,1,29.25,15Z" fill="#4285f4"/></svg>
          Sign up with Google
        </button></a>
        {{-- google area --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf
          <div class=" mb-3">
            <label for="name" class="form-label text-md-end">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class=" mb-3">
            <label for="email" class="form-label text-md-end">{{ __('Email Address') }}</label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class=" mb-3">
            <label for="password" class="form-label text-md-end">{{ __('Password') }}</label>
            <div class="password-input">
                <input id="myInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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

        <div class=" mb-5">
            <label for="password-confirm" class="form-label text-md-end">{{ __('Confirm Password') }}</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
  
        <div>
          <button type="submit" style="background: #43a1ff; color: black; font-weight:bold; width: 100%;" class="btn me-2 mb-2 mb-md-0"><ion-icon name="log-in-outline" style="font-size: 16px;  position: relative; top: 3px; right: 5px; "></ion-icon> Sign up</a>
          
        </div>
        <div class="text-center">
          <p>Already have an account? <a href="{{url('/login')}}" style="color: #1389fe; font-wight: bold">Click here</a></p>
        </div>
        </form>
      </div>
    </div>
  </div>
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
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-0">

                            <div class="col-md-6 offset-md-4">
                                <a href="{{url('/signin/google')}}" class="btn btn-primary">
                                    Google Register
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}