@extends('admin.auth.layout.app')
@section('title', 'Change Password    ')
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Reset Password</h4>
                        </div>
                        <div class="card-body">
                            @if(session()->has('error_message'))
                            <p class="text-danger">The password and confirmation password do not match</p>
                            @else
                                <p class="text-muted">Enter Your New Password</p>
                            @endif
                            <form method="POST" action="{{url('admin-reset-password')}}">
                                 @csrf
                                <input value="{{$user->email}}" type="hidden" name="email" >
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" >
                                    @error('password') <span class="text-danger">{{$errors->first('password')}}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="confirmed" tabindex="2" >
                                    @error('confirmed') <span class="text-danger">{{$errors->first('confirmed')}}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Reset Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    @if(\Illuminate\Support\Facades\Session::has('message'))
        <script>
            toastr.success('{{\Illuminate\Support\Facades\Session::get('message')}}');
        </script>
    @endif
@endsection
