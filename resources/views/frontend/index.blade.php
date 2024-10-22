@extends('layouts.master')
@section('content')

<div class="hero">
    <h1>
        Find a guaranteed tradesperson
    </h1>
    <p>
        Recommendations you can rely on
    </p>
    <div class="search-bar">
        <input placeholder="Trade (e.g. Electrician)" type="text" />
        <button>
            Search
        </button>
    </div>
</div>
<div class="categories">
    <h2>
        Browse our most popular categories
    </h2>
    <div class="category">
        <i class="fas fa-wrench">
        </i>
        <p>
            Plumber
        </p>
    </div>
    <div class="category">
        <i class="fas fa-bolt">
        </i>
        <p>
            Electrician
        </p>
    </div>
    <div class="category">
        <i class="fas fa-home">
        </i>
        <p>
            Roofer
        </p>
    </div>
    <div class="category">
        <i class="fas fa-hammer">
        </i>
        <p>
            Builder
        </p>
    </div>
    <div class="category">
        <i class="fas fa-leaf">
        </i>
        <p>
            Gardener
        </p>
    </div>
    <div class="category">
        <i class="fas fa-paint-roller">
        </i>
        <p>
            Painter
        </p>
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
        <img alt="Leave a Review Image" height="200" src="https://placehold.co/300x200" width="300" />
        <p>
            Have you completed a project recently? Let your tradesperson know how they did.
        </p>
        <a href="#">
            Leave a Review
        </a>
    </div>
    <div class="info-box">
        <img alt="Tradesperson Sign Up Image" height="200" src="https://placehold.co/300x200" width="300" />
        <p>
            Over 1 million homeowners visit our site looking for approved and quality tradespeople like you.
        </p>
        <a href="#">
            Join today
        </a>
    </div>
    <div class="info-box">
        <img alt="Request a Quote Image" height="200" src="https://placehold.co/300x200" width="300" />
        <p>
            Tell us what you're looking for and we'll pass your request on to three approved tradespeople.
        </p>
        <a href="#">
            Request a quote
        </a>
    </div>
</div>

@endsection