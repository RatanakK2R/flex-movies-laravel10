@extends('layouts.sibar')

@section('content')
<!-- main content -->
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Add New Movies</h2>
                </div>
            </div>
            <!-- Display errors if any -->
            @if ($errors->any())
                <div class="alert alert-danger" style="color: red">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- form -->
            <div class="col-12">
                <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" class="form">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-5 form__cover">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-12">
                                    <div class="form__img">
                                        <label for="form__img-upload">Upload cover (190 x 270)</label>
                                        <input id="form__img-upload" name="cover_images" type="file" accept="jpeg,.png,.jpg,.webp,.svg">
                                        <img id="form__img" src="#" alt=" ">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__group">
                                        <input type="text" name="title" class="form__input" placeholder="Title" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form__group">
                                        <textarea id="text" name="description" class="form__textarea" placeholder="Description" required></textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="form__group">
                                        <input type="text" name="release_year" class="form__input" placeholder="Release year" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-6">
                                    <div class="form__group">
                                        <input type="text" name="duration" class="form__input" placeholder="Running time in Minute (0.00) as Second" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="form__group">
                                        <select name="quality" class="js-example-basic-single" id="quality" required>
                                            <option value="4K">4K</option>
                                            <option value="2K">2K</option>
                                            <option value="FullHD">FullHD</option>
                                            <option value="HD">HD</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="form__group">
                                        <input type="text" name="language[]" class="form__input" placeholder="language" multiple="multiple" required>
                                    </div>
                                </div> --}}

                                <div class="col-12 col-lg-6">
                                    <div class="form__group">
                                        <select type="text" name="language[]" class="js-example-basic-multiple" id="country" multiple="multiple">
                                            <option value="khmer" {{ in_array('khmer', old('language', $movie->language ?? [])) ? 'selected' : '' }}>Khmer</option>
                                            <option value="english" {{ in_array('english', old('language', $movie->language ?? [])) ? 'selected' : '' }}>English</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form__group">
                                        <select type="text" name="categories[]" class="js-example-basic-multiple" id="genre" id="categories" multiple="multiple" required>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form__gallery">
                                        <label id="gallery1" for="form__gallery-upload">Upload photos</label>
                                        <input data-name="#gallery1" id="form__gallery-upload" name="cover_image" class="form__gallery-upload" type="file" accept="jpeg,.png,.jpg,.webp,.svg" multiple>
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
                                    <input id="type1" type="radio" name="type" value="Movie" checked>
                                    <label for="type1">Movie</label>
                                </li>
                                <li>
                                    <input id="type2" type="radio" name="type" value="TV Show">
                                    <label for="type2">TV Show</label>
                                </li>
                                <li>
                                    <input id="type3" type="radio" name="type" value="3D">
                                    <label for="type3">3D</label>
                                </li>
                            </ul>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form__video">
                                        <label id="movie1" for="form__video-upload">Upload video</label>
                                        <input data-name="#movie1" id="form__video-upload" name="video_url" class="form__video-upload" type="file" accept="video/mp4,video/x-m4v,video/*">
                                    </div>
                                </div>

{{--                                <div class="col-12 col-lg-6">--}}
{{--                                    <div class="form__group form__group--link">--}}
{{--                                        <input type="text" name="video_url" class="form__input" placeholder="or add a link">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-12">
                                    <button type="submit" class="form__btn">publish</button>
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
                img.src = '#';
                img.style.display = 'none'; // Hide the image if no file is selected
            }
        }

        // Get references to the file inputs
        const galleryUpload = document.getElementById('form__gallery-upload');
        const coverUpload = document.getElementById('form__img-upload');

        // Add event listeners
        galleryUpload.addEventListener('change', handleFileSelect);
        coverUpload.addEventListener('change', handleFileSelect);


        function getImageSrc() {
            const imgElement = document.getElementById('form__img');
            if (imgElement) {
                imgElement.style.display = 'none';
            } else {
                imgElement.style.display = 'none';
                return null;
            }
        }
        const imageSrc = getImageSrc();
    });
</script>

<!-- end main content -->
@endsection
