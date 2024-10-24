@extends('layouts.master')
@section('content')

@include('frontend.inc.hero')

<div class="categories mt-5">
    <h2>
        Browse our most popular categories
    </h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="categories col-8">
                <div class="categories-list slick-carousel">
                    @foreach ($categories as $category)
                        <div class="slick-slide-item">
                            <a href="{{ route('category.show', $category->slug) }}" class="category card">
                                @if ($category->image)
                                    <img src="{{ asset('images/category/' . $category->image) }}" alt="{{ $category->name }}" class="category-image">
                                @endif
                                <p>{{ $category->name }}</p>
                            </a> 
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="info-section">
    <div class="info-box">
        <i class="fas fa-check-circle">
        </i>
        <p>
            Every Checkatrade tradesperson has passed up to 12 rigorous checks
        </p>
    </div>
    <div class="info-box">
        <i class="fas fa-star">
        </i>
        <p>
            Over 6.2 million reviews have been published on Checkatrade
        </p>
    </div>
    <div class="info-box">
        <i class="fas fa-shield-alt">
        </i>
        <p>
            We guarantee Checkatrade tradespeople's work, claim up to £1000 - 10000
        </p>
    </div>
</div>

<div class="info-section">
    <div class="info-box">
        <img alt="Leave a Review" src="{{ asset('frontend/images/review.jpg') }}"/>
        <p>Have you completed a project recently? Let your tradesperson know how they did.</p>
        <a href="{{ route('review') }}">Leave A Review</a>
    </div>
    <div class="info-box">
        <img alt="Tradesperson Sign Up Image" height="200" src="{{ asset('frontend/images/join-with-us.jpg') }}"/>
        <p>
            Over 1 million homeowners visit our site looking for approved and quality tradespeople like you.
        </p>
        <a href="{{ Auth::check() ? (auth()->user()->is_type == '1' ? route('admin.dashboard') : (auth()->user()->is_type == '0' ? route('user.profile') : route('staff.home'))) : route('register') }}">
            {{ Auth::check() ? 'Dashboard' : 'Join Today' }}
        </a>
    </div>
    <div class="info-box">
        <img alt="Request a Quote Image" height="200" src="{{ asset('frontend/images/Request-for-Quotation.jpg') }}"/>
        <p>
            Tell us what you're looking for and we'll pass your request on to three approved tradespeople.
        </p>
        <a href="{{ route('quote.form') }}">
            Request A Quote
        </a>
    </div>
</div>

@endsection

@section('script')

@endsection