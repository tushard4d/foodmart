@extends('layouts.frontend')
@section('title', 'Home')

@section('content')
    <!-- Hero Banner Section -->
    <section class="py-3"
        style="background-image: url('images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-blocks">
                        <!-- Your existing main slider + 2 side ads code here -->
                        <div class="banner-ad large bg-info block-1">
                            <div class="swiper main-swiper">
                                <!-- ... your slider slides ... -->
                            </div>
                        </div>
                        <div class="banner-ad bg-success-subtle block-2" style="background:url('images/ad-image-1.png') no-repeat;background-position: right bottom">
                            <!-- ... 20% off Fruits & Vegetables ... -->
                        </div>
                        <div class="banner-ad bg-danger block-3" style="background:url('images/ad-image-2.png') no-repeat;background-position: right bottom">
                            <!-- ... 15% off Baked Products ... -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content with Full-Page Sticky Sidebar -->
    <div class="container-fluid py-5">
        <div class="row">
            <!-- Left Sidebar Filters - Full Page Sticky -->
            <div class="col-lg-3 col-xl-2 d-none d-lg-block">
                <div class="filters-sidebar sticky-top" style="top: 80px; height: calc(100vh - 80px); overflow-y: auto;">
                    @include('partials.filters-sidebar')
                </div>
            </div>

            <!-- Right Content Area (scrollable) -->
            <div class="col-lg-9 col-xl-10">
                <!-- Mobile Filters Button -->
                <button class="btn btn-primary d-lg-none mb-3 w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtersOffcanvas">
                    Open Filters
                </button>

                <!-- Mobile Offcanvas -->
                <div class="offcanvas offcanvas-start" tabindex="-1" id="filtersOffcanvas" aria-labelledby="filtersOffcanvasLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="filtersOffcanvasLabel">Filters</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        @include('partials.filters-sidebar')
                    </div>
                </div>

                <!-- All Products Section -->
                <h2 class="mb-4 text-center">All Products</h2>
                <div id="products-container">
                    <div class="row g-4">
                        @forelse($products as $product)
                            <div class="col-6 col-md-6 col-lg-4">
                                <div class="card h-100 shadow-sm">
                                    <figure>
                                        <img src="{{ asset('images/' . $product->image) }}" class="tab-image" alt="{{ $product->name }}">
                                    </figure>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-success fw-bold">₹{{ number_format($product->price, 2) }}</p>
                                        <p class="card-text">
                                            Rating: {{ $product->rating ?? 'N/A' }} ★
                                        </p>
                                        <button class="btn btn-success w-100 add-to-cart" data-product-id="{{ $product->id }}">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted py-5 col-12">No products found. Try different filters.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>

                <!-- Category Carousel -->
                <section class="py-5 overflow-hidden">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                                    <h2 class="section-title">Category</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="category-carousel swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($categories as $category)
                                            <a href="#" class="nav-link category-item swiper-slide">
                                                <img src="{{ asset('images/' . $category->icon) }}" alt="{{ $category->name }}">
                                                <h3 class="category-title">{{ $category->name }}</h3>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Subscriptions, Newly Arrived Brands, Trending Products, Blog, etc. -->
                <!-- Your remaining sections remain unchanged -->
                <!-- ... paste all your other sections here ... -->

            </div>
        </div>
    </div>
@endsection
