@extends('frontend.layouts.main')
@section('body')
    <section class="cms-section pb-150 pt-lg-20 pt-sm-10">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    <h2 class="pb-4 ps-10 container-lg" style="color:white;">{{ $cms->title }}</h2>
                    <div class="content ps-5 pb-5" style="color:white;">
                        {!! $cms->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


