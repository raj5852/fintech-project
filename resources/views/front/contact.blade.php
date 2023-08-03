@extends('layouts.front')
@section('title')
Contact Us
@endsection
@section('front_content')
@push('css')
@endpush

<div class="bredcrumb">
    <h2 class="bredcrumb__title">Contact Us</h2>
    <ul class="bredcrumb__items">
        <li><a href="{{route('home')}}">Home</a> <i class="bi bi-chevron-right"></i></li>
        <li>Contact Us</li>
    </ul>
</div>

<!-- contact form  -->
<div class="contact__form">
    <div class="container">
        <div class="contact__form-wrapper">
            <span class="contact__form-title">Contact Us</span>
            <p class="contact__form-dis">Please enter your details below to complete your purchase</p>
            <div class="contact__form-inner new_change-form">
                <div class="contact__form-left">
                    <form action="{{ url('contact-store') }}" method="post">
                        @csrf
                        <div class="contact__form-field">
                            <label>your name (required)</label>
                            <input class="input-control-ibx" type="text" name="name" required>
                        </div>
                        <div class="contact__form-field">
                            <label>your email (required)</label>
                            <input class="input-control-ibx" type="email" name="email" required>
                        </div>
                        <div class="contact__form-field">
                            <label>Subject</label>
                            <input class="input-control-ibx" type="text" name="subject" required>
                        </div>
                        <div class="contact__form-field">
                            <label>address</label>
                            <input class="input-control-ibx" type="text" name="address" required>
                        </div>
                        <div class="contact__form-field">
                            <label>your message</label>
                            <textarea class="input-control-ibx" name="description" required></textarea>
                        </div>
                        <div class="contact__form-field">
                            <button class="contact__form-submit" type="submit">send</button>
                        </div>
                    </form>
                </div>

@php
    $setting = DB::table('web_sites')->first();
@endphp
                <div class="contact__form-right">
                    <span class="contact__form-title2">{{ $setting->contact_page }}</span>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Lorem ipsum dolor sit amet consectetur
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                 <p class="faq-ans">Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur</p>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Lorem ipsum dolor sit amet consectetur
                            </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="faq-ans">Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur</p>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Lorem ipsum dolor sit amet consectetur
                            </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p class="faq-ans">Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet consectetur</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    <p class="contact__form-dis2">{!! $setting->contact_description !!}</p>

                    <span class="contact__form-title2">CONTACT US ALTERNATIVELY</span>
                    <div class="contact__form-bottom">
                        <div class="contact__form-item">
                            <img src="{{ asset('frontend/') }}/img/c1.png" alt="">
                            <span>Email:</span>
                            <a href="#">{{ $setting->email }}</a>
                        </div>
                        <div class="contact__form-item">
                            <img src="{{ asset('frontend/') }}/img/c2.png" alt="">
                            <span>Support forum for
                                over 24h</span>
                        </div>
                        <div class="contact__form-item">
                            <img src="{{ asset('frontend/') }}/img/c3.png" alt="">
                            <span>please note:</span>
                            <p>All products are available to download on your account once purchased.</p>
                        </div>
                        <div class="contact__form-item">
                            <img src="{{ asset('frontend/') }}/img/c4.png" alt="">
                            <span>socials:</span>
                            <p>Find and reply to us via social media platforms</p>
                        </div>
                    </div>

                </div>
            </div>
            <p class="contact__form-btitle">Do you have questions about how we can help your company? <br>
                <span>Send us an email and we’ll get in touch shortly.</span></p>
        </div>
    </div>
</div>


@endsection
