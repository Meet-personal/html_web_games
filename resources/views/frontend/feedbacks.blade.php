@extends('frontend.layouts.main')
@section('body')
    <section class="feedback-section">
        <div class="call-to-action pt-120 pb-120 " id="cta">
            <div class="container">
                <!-- Title and description above the form -->
                <div class="row">
                    <div class="col-lg-12 text-center mb-5">
                        <span class="display-three tcn-1 cursor-scale growUp mb-8 d-block title-anim">
                            Stay up to date
                        </span>
                        <span class="fs-lg tcn-6">
                            Have questions or feedback? We'd love to hear from you. Reach out to our team by filling the
                            form below.
                        </span>
                    </div>
                </div>

                <!-- Feedback form below the description -->
                <div class="row justify-content-center container-lg">
                    <div class="col-xl-8 col-lg-10 col-md-12">
                        <form action="{{ route('feedbacks.store') }}" method="POST">
                            @csrf
                            <fieldset>
                                <legend class="visually-hidden">Feedback Form</legend>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="single-input">
                                            <label for="name" class="visually-hidden">Name</label>
                                            <input type="text" id="name" name="name"
                                                placeholder="Enter your name" required>
                                        </div>
                                    </div>

                                    <!-- Email Input -->
                                    <div class="col-md-6 mb-3">
                                        <div class="single-input">
                                            <label for="email" class="visually-hidden">Email</label>
                                            <input type="email" id="email" name="email"
                                                placeholder="Enter your email" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="single-input">
                                            <label for="subject" class="visually-hidden">Subject</label>
                                            <input type="text" id="subject" name="subject"
                                                placeholder="Enter the subject" required>
                                        </div>
                                    </div>

                                    <!-- Message Input -->
                                    <div class="col-md-12 mb-3">
                                        <div class="single-input">
                                            <label for="message" class="visually-hidden">Message</label>
                                            <textarea id="message" name="message" placeholder="Enter your message" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-flex align-items-center gap-6 mb-4">
                                        <label class="custom-checkbox">
                                            <input type="checkbox" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <span class="fs-base tcn-6">I agree with
                                            @foreach (get_cms() as $cms)
                                                and
                                                <a href="{{ route('frontend.cms', ['slug' => $cms->slug]) }}"
                                                    class="tcp-1">{{ $cms->title }}</a>
                                            @endforeach
                                        </span>

                                        <button type="submit"
                                            class="bttn py-sm-4 py-3 px-lg-10 px-sm-8 px-6 bgp-1 tcn-1 rounded-4">Submit</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
