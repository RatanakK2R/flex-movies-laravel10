@extends('layouts.sibar')

@section('content')
<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Movie Details</h2>
                </div>
            </div>
            <!-- end main title -->

            <div class="col-12">
                <div class="movie-details">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="movie-cover">
                                <img src="{{ asset('storage/' . $movie->cover) }}" alt="{{ $movie->title }}" class="img-fluid">
                            </div>
                        </div>

                        <div class="col-12 col-md-7">
                            <div class="movie-info">
                                <h3>{{ $movie->title }}</h3>
                                <p><strong>Description:</strong> {{ $movie->description }}</p>
                                <p><strong>Release Year:</strong> {{ $movie->release_year }}</p>
                                <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
                                <p><strong>Quality:</strong> {{ $movie->quality }}</p>
                                <p><strong>Language:</strong> {{ implode(', ', $movie->languages) }}</p>
                                <p><strong>Categories:</strong> {{ implode(', ', $movie->categories->pluck('name')->toArray()) }}</p>
                                <p><strong>Type:</strong> {{ $movie->type }}</p>
                                <p><strong>Watch Link:</strong> <a href="{{ $movie->watch_link }}" target="_blank">{{ $movie->watch_link }}</a></p>

                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-primary">Edit</a>

                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- end main content -->
@endsection