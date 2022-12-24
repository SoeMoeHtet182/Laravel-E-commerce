<style>
    .banner .caption {
        background-color: unset;
        max-width: 48%;
    }
</style>

<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="caption">
                    <div class="left-container-text">
                        <h2>Morden Design + Electronic, all in One Place</h2>
                        <p class="text-white">A place for all, where you can see a lot of good quality
                            prodcuts,
                            and be served excellent customer service, like refund policy.</p>
                    </div>
                    <div class="main-button">
                        <a href="{{ url('/') }}">{{ __('site.shop') }}</a>
                    </div>
                    <div class="mt-2">
                        <a class="btn btn-dark me-1" href="{{ url('/login') }}">{{ __('site.log in') }}</a>
                        <a class="btn btn-dark sign-in-btn" href="{{ url('/register') }}">{{ __('site.sign in') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
