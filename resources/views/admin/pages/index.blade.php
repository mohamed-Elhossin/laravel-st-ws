@extends('admin.layouts.app')



@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">


            <!-- Right side columns -->
            <div class="col-lg-6">

                <!-- Recent Activity -->
                <div class="card">


                    <div class="card-body">
                        <h5 class="card-title">Recent News <span> </span></h5>

                        <div class="activity">

                            @foreach ($news as $item)
                                <div class="activity-item d-flex w-100">
                                    <div class="activite-label">{{ $item->created_at->diffForHumans() }}</div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content  w-100">
                                        <strong> {{ $item->title }}</strong>
                                        <p>{{ $item->description }} <span class="float-end text-muted">{{$item->created_at}}</span> </p>
                                    </div>
                                </div><!-- End activity item-->
                            @endforeach


                        </div>

                    </div>
                </div><!-- End Recent Activity -->


            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection
