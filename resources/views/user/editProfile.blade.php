@extends('user.layout.master')
@section('style')
    <style>
        #edit-display {
            margin-top: 50px;
            padding-top: 30px;
            background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid" id='edit-display'>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <div class="nt-2">
                                <img src="{{ $user->image_url }}" width='150px' height='150px' class="rounded-circle" />
                            </div>
                            <div id='updateUserName'>
                                <div id='userName'>
                                    <h5 class="my-3 position-relative">{{ $user->display_name }} </h5>
                                </div>
                            </div>
                            <b class="text-muted mb-4">{{ $user->level->level }}</b>
                            <div class="d-flex justify-content-center m-2" id='change-password'>
                                <button class="btn btn-outline-primary" disabled>
                                    <a to='/change-password'>{{ __('site.change_psw') }}</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form action="{{ url('/update-user_info/' . $user->id) }}" method="post">
                        @csrf
                        @if ($errors->any())
                            @foreach ($errors->all() as $e)
                                <div class="alert alert-danger">{{ $e }}</div>
                            @endforeach
                        @endif
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ __('site.name') }}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="full_name" value='{{ $user->full_name }}' />
                                        </p>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ __('site.d_name') }} </p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="display_name" value='{{ $user->display_name }}' />
                                        </p>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ __('site.email') }}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="email" name="email" value='{{ $user->email }}' />
                                        </p>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ __('site.phone') }}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="phone" name="phone" value='{{ $user->phone }}' />
                                        </p>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ __('site.address') }}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="address" value='{{ $user->address }}' />
                                        </p>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ __('site.city') }}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="city" value='{{ $user->city }}' />
                                        </p>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{ __('site.postal') }} </p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="postal_code" value='{{ $user->postal_code }}' />
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="{{ __('site.update') }}" class="btn btn-primary float-end" />
                        <a href={{ url()->previous() }} class="btn btn-dark float-end me-3">{{ __('site.back') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
