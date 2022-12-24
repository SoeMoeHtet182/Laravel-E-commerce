@extends('user.layout.master')
@section('content')
    <div class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h1>{{ __('site.contact') }}</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d942.1917319427741!2d96.34418775743872!3d19.16167696856867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2smm!4v1671765502847!5m2!1sen!2smm"
                            width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-content">
                        <div class="container">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <input name="name" type="text" class="form-control" id="name"
                                                placeholder="{{ __('site.name') }}" required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset>
                                            <input name="email" type="text" class="form-control" id="email"
                                                placeholder="{{ __('site.email') }}" required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <fieldset>
                                            <input name="subject" type="text" class="form-control" id="subject"
                                                placeholder="{{ __('site.subject') }}" required="">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <fieldset>
                                            <textarea name="message" rows="6" class="form-control" id="message" placeholder="{{ __('site.message') }}"
                                                required=""></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit"
                                                class="button">{{ __('site.send_message') }}</button>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="share">
                                            <h6>You can also keep in touch on: <span><a href="#"><i
                                                            class="fa fa-facebook"></i></a><a href="#"><i
                                                            class="fa fa-linkedin"></i></a><a href="#"><i
                                                            class="fa fa-twitter"></i></a></span></h6>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
