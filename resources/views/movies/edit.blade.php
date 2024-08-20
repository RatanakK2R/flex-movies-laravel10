@extends('layouts.sibar')

@section('content')
<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Edit Movie</h2>
                </div>
            </div>
            <!-- end main title -->

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- form -->
            <div class="col-12">
                <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-5 form__cover">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-12">
                                    <div class="form__img">
                                        <label for="form__img-upload">Upload cover (190 x 270)</label>
                                        <input id="form__img-upload" name="cover" type="file" accept=".png, .jpg, .jpeg">
                                        <img id="form__img" src="{{ asset('storage/' . $movie->cover) }}" alt=" ">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__group">
                                        <input type="text" name="title" class="form__input" placeholder="Title" value="{{ $movie->title }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form__group">
                                        <textarea id="text" name="description" class="form__textarea" placeholder="Description">{{ $movie->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="form__group">
                                        <input type="text" name="release_year" class="form__input" placeholder="Release year" value="{{ $movie->release_year }}">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="form__group">
                                        <input type="text" name="duration" class="form__input" placeholder="Running time in minutes" value="{{ $movie->duration }}">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="form__group">
                                        <select name="quality" class="js-example-basic-single" id="quality">
                                            <option value="FullHD" {{ $movie->quality == 'FullHD' ? 'selected' : '' }}>FullHD</option>
                                            <option value="HD" {{ $movie->quality == 'HD' ? 'selected' : '' }}>HD</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form__group">
                                        <select type="text" name="language[]" class="js-example-basic-multiple" id="country" multiple="multiple">
                                            <option value="khmer" {{ in_array('khmer', (array) $movie->languages) ? 'selected' : '' }}>Khmer</option>
                                            <option value="english" {{ in_array('english', (array) $movie->languages) ? 'selected' : '' }}>English</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form__group">
                                        <select type="text" name="categories[]" class="js-example-basic-multiple" id="genre" multiple="multiple">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $movie->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form__gallery">
                                        <label id="gallery1" for="form__gallery-upload">Upload photos</label>
                                        <input data-name="#gallery1" id="form__gallery-upload" name="photos[]" class="form__gallery-upload" type="file" accept=".png, .jpg, .jpeg" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <ul class="form__radio">
                                <li>
                                    <span>Item type:</span>
                                </li>
                                <li>
                                    <input id="type1" type="radio" name="type" value="Movie" {{ $movie->type == 'Movie' ? 'checked' : '' }}>
                                    <label for="type1">Movie</label>
                                </li>
                                <li>
                                    <input id="type2" type="radio" name="type" value="TV Show" {{ $movie->type == 'TV Show' ? 'checked' : '' }}>
                                    <label for="type2">TV Show</label>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form__video">
                                        <label id="movie1" for="form__video-upload">Upload video</label>
                                        <input data-name="#movie1" id="form__video-upload" name="video" class="form__video-upload" type="file" accept="video/mp4,video/x-m4v,video/*">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form__group form__group--link">
                                        <input type="text" name="watch_link" class="form__input" placeholder="or add a link" value="{{ $movie->watch_link }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="form__btn">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end form -->
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to handle file input change and preview images
        function handleFileSelect(event) {
            const files = event.target.files;
            const img = document.getElementById('form__img');
    
            if (files && files[0]) {
                const reader = new FileReader();
    
                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.style.display = 'block'; // Ensure the image is displayed
                };
    
                reader.readAsDataURL(files[0]);
            } else {
                img.src = '{{ asset('storage/' . $movie->cover) }}';
                img.style.display = 'block'; // Show existing image
            }
        }
    
        // Get references to the file inputs
        const coverUpload = document.getElementById('form__img-upload');
    
        // Add event listeners
        coverUpload.addEventListener('change', handleFileSelect);
    });
</script>
<!-- end main content -->
@endsection