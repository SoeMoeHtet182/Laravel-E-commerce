@extends('user.layout.master')
@section('style')
    <style>
        .banner {
            padding: 50px 0;
            background-size: unset;
        }

        .banner .caption {
            background-color: unset;
            max-width: 48%;
        }

        .left-container-text {
            position: absolute;
            left: 8%;
            top: 62%;
            z-index: 2;
        }

        .banner h2 {
            font-size: 32px;
            line-height: 40px;
        }

        .banner p {
            color: #FFF;
            font-size: 16px;
            line-height: 24px;
            margin: 14px 0 0;
            max-width: 595px;
        }

        .right-login-container {
            top: 0px;
            padding: 0 90px;

            opacity: 0.9;
        }

        .auth-form {
            background: #FFF;
            border-radius: 32px;
            -webkit-box-shadow: 0 16px 32px 0 rgba(0, 0, 0, 0.08);
            box-shadow: 0 16px 32px 0 rgba(0, 0, 0, 0.08);
            padding: 64px;
            margin: 0 auto;
        }

        .auth-form h2 {
            margin-bottom: 32px;
        }

        .input {
            background: #FFF;
            color: #353030;
            height: 48px;
            border-radius: 8px;
            border: 1px solid transparent;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            border-left-color: transparent;
            transition: 0.3s;
            font-size: 16px;
        }

        .image {
            margin-bottom: 10px;
        }

        .submit {
            position: relative;
        }

        .error-flashing-box {
            position: absolute;
            left: 0;
            top: -44px;
            right: 0;
            height: 40px;
            display: flex;
            align-items: center;
        }

        .error-text {
            color: #FE4066;
            line-height: 16px;
            font-size: 12px;
        }

        .submit-btn {
            margin-top: 48px;
            border-radius: 6px;
            color: #FFF;
            background: #3A8BCD;
            transition: 0.3s;
            line-height: 48px;
            text-align: center;
            display: block;
        }

        .other-text a {
            color: #FE4066;
        }

        .login-off {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="banner">
        <div class="row">
            <div class="col-lg-6">
                <div class="caption">
                    <div class="left-container-text">
                        <h2>Morden Design + Electronic, all in One Place</h2>
                        <p class="text-white">A place for all, where you can see a lot of good quality prodcuts,
                            and be served excellent customer service, like refund policy.</p>
                        <div class="main-button">
                            <a href="{{ url('/') }}">{{ __('site.shop') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-login-container">
                    <div class="auth-form">
                        @if (app()->getLocale() === 'en')
                            <h2>Log in to <span style="color: #f56e07">One PIECE</span></h2>
                        @else
                            <h2 class="d-inline me-2" style="color: #f56e07">One PIECE</h2><span
                                style="line-height: 50px">သို့
                                လက်မှတ်ထိုးဝင်ရန်</span>
                        @endif

                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="input">
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ __('site.email') }}" />
                            </div>
                            <div class="input">
                                <input type="password" name="password" class="form-control"
                                    placeholder="{{ __('site.password') }}" />
                            </div>
                            <div class="submit">
                                <div class="error-flashing-box">
                                    @if ($errors->any())
                                        <div class="error-text">{{ $errors->first() }}</div>
                                    @endif
                                </div>
                                <div class="submit-btn mx-auto"><input type="submit" value="{{ __('site.log in') }}"
                                        class="btn w-100">
                                </div>
                            </div>
                        </form>
                        <div class="other-text mt-2">
                            <small>{{ __('site.haveAccount') }} <a
                                    href="{{ url('/register') }}">{{ __('site.sign in') }}</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
