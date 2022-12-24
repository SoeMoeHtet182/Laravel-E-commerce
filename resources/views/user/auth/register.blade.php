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
            width: 35%;
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
            background: #e0e5e1;
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
            display: inline-block;
            background: #FFF;
            color: #353030;
            height: 38px;
            border-radius: 8px;
            border: 1px solid transparent;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            border-left-color: transparent;
            transition: 0.3s;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .input .form-control {
            border: none;
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

        .login-off {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="banner">
        <div class="row">
            <div class="col-lg-5">
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
            <div class="col-lg-7">
                <div class="right-login-container">
                    <div class="auth-form">
                        @if (app()->getLocale() === 'en')
                            <h2>Sign in to <span style="color: #f56e07">One PIECE</span></h2>
                        @else
                            <div class="mb-4">
                                <h2 class="d-inline me-2 mb-5" style="color: #f56e07">One PIECE</h2><span>သို့
                                    စာရင်းသွင်းရန်</span>
                            </div>
                        @endif

                        <form action="{{ url('/register') }}" method='POST' enctype="multipart/form-data">
                            @csrf
                            <div class="input me-4">
                                <input type="text" name="display_name" class="form-control"
                                    placeholder="{{ __('site.d_name') }}" />
                            </div>
                            <div class="input">
                                <input type="text" name="full_name" class="form-control"
                                    placeholder="{{ __('site.name') }}" />
                            </div>
                            <div class="image pe-1">
                                <small>{{ __('site.image') }}</small>
                                <input type="file" name="image" class="form-control" />
                            </div>
                            <div class="input me-4">
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ __('site.email') }}" />
                            </div>
                            <div class="input">
                                <input type="tel" name="phone" class="form-control"
                                    pattern="[0-9]{2}-[0-9]{3}}-[0-9]{3}}-[0-9]{3}" placeholder="{{ __('site.phone') }}" />
                            </div>
                            <div class="input me-4">
                                <input type="text" name="city" class="form-control"
                                    placeholder="{{ __('site.city') }}" />
                            </div>
                            <div class="input">
                                <input type="text" inputmode="numeric" name="postal_code" class="form-control"
                                    placeholder="{{ __('site.postal') }} " />
                            </div>
                            <div class="form-group mb-2 pe-1">
                                <textarea name="address" class="form-control" cols="30" rows="3" placeholder="{{ __('site.address') }}"></textarea>
                            </div>
                            <div class="input me-4">
                                <input type="password" name="confirmPassword" class="form-control"
                                    placeholder="{{ __('site.password') }}" />
                            </div>
                            <div class="input">
                                <input type="password" name="password" class="form-control"
                                    placeholder="{{ __('site.c_password') }} " />
                            </div>
                            <div class="submit">
                                <div class="error-flashing-box">
                                    @if ($errors->any())
                                        <div class="error-text">{{ $errors->first() }}</div>
                                    @endif
                                </div>
                                <div class="submit-btn"><input type="submit" value="{{ __('site.sign in') }}"
                                        class="btn w-100"></div>
                            </div>
                        </form>
                        <div class="mt-2">
                            <small>{{ __('site.AhaveAccount') }}<a
                                    href="{{ url('/login') }}">{{ __('site.log in') }}</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
