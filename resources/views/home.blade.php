@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Student Dashboard</h3>
                <p class="text-subtitle text-muted">
                    Welcome to your academic dashboard.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Home
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <!-- Academic Summary Widget -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"><i class="bi bi-bookmark-star"></i> Academic Summary</h4>
                    </div>
                    <div class="card-body mt-3">
                        <p><i class="bi bi-award"></i> GPA: <strong>3.75</strong></p>
                        <p><i class="bi bi-calendar-check"></i> Next Semester: <strong>7th Semester</strong></p>
                        <a href="{{ route('academic.summary') }}" class="btn btn-primary mt-2">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Upcoming Classes Widget -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"><i class="bi bi-calendar-event"></i> Upcoming Classes</h4>
                    </div>
                    <div class="card-body mt-3">
                        <ul class="list-unstyled">
                            <li><i class="bi bi-clock"></i> Mon, 9:00 AM - Database Systems</li>
                            <li><i class="bi bi-clock"></i> Tue, 11:00 AM - Software Engineering</li>
                            <li><i class="bi bi-clock"></i> Wed, 1:00 PM - Web Development</li>
                        </ul>
                        <a href="{{ route('schedule') }}" class="btn btn-primary mt-2">View Full Schedule</a>
                    </div>
                </div>
            </div>

            <!-- Notifications Widget -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"><i class="bi bi-bell"></i> Notifications</h4>
                    </div>
                    <div class="card-body mt-3">
                        <ul class="list-unstyled">
                            <li><i class="bi bi-file-earmark-text"></i> New assignment in Database Systems</li>
                            <li><i class="bi bi-calendar2-check"></i> Exam schedule released</li>
                            <li><i class="bi bi-graph-up-arrow"></i> Upcoming project presentation</li>
                        </ul>
                        <a href="{{ route('notifications') }}" class="btn btn-primary mt-2">View All</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Latest News Widget -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"><i class="bi bi-newspaper"></i> Latest News</h4>
                    </div>
                    <div class="card-body mt-3">
                        <p>Stay updated with the latest news and announcements from the campus.</p>
                        <a href="{{ route('news') }}" class="btn btn-primary mt-2">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Quick Links Widget -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title"><i class="bi bi-link-45deg"></i> Quick Links</h4>
                    </div>
                    <div class="card-body mt-3">
                        <ul class="list-unstyled">
                            <li><a href="{{ route('profile') }}" class="text-decoration-none text-dark"><i class="bi bi-person-circle"></i> My Profile</a></li>
                            <li><a href="{{ route('courses') }}" class="text-decoration-none text-dark"><i class="bi bi-journal"></i> My Courses</a></li>
                            <li><a href="{{ route('grades') }}" class="text-decoration-none text-dark"><i class="bi bi-file-earmark-bar-graph"></i> My Grades</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
