@extends('dashboard.layouts.admin')

@section('title')
    add slider images
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">add new product</h5>
            <div class="card-content">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.slider.store.db') }}" enctype="multipart/form-data" class="dropzone" id="sliderImages">
                        @csrf
                        @method('POST')
                        @include('dashboard.includes.alerts.errors')
                        @include('dashboard.includes.alerts.success')


                        <button class="btn btn-primary">{{ __('general.save') }}</button>
                    </form>
                </div>
          </div>
        </div>

        <!-- Gallery -->
        <h1>Current Images</h1>

        <div class="row">
        @foreach($images as $image)

        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <img
            src="{{ Storage::url('/admin/images/slider/' . $image->image) }}"
            class="w-100 shadow-1-strong rounded mb-4"
            alt=""
            />


        </div>

        @endforeach
    </div>


    </div>
    <!-- Gallery -->
@endsection


@push('js')

<script>

    var uploadedDocumentMap = [];

    Dropzone.options.sliderImages = {
        paramName: 'dzfile',
        maxFileSize: 5,
        maxFiles: 5,
        clickable: true,
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        dictFallbackMessage: 'your browser not support this option',
        dictInvalidFileType: 'please upload images only',
        dictCancelUpload: 'cancel',
        dictCancelUploadConfirmation: 'are you sure?',
        dictRemoveFile: 'remove file',
        dictMaxFilesExceeded: 'please upload 10 photos only',
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
       },
       success: function(file, response) {
        $('form').append('<input type="hidden" name="images[]" value="' + response.name + '" >')
            uploadedDocumentMap[file.name] = response.name;
        },
        url: "{{ route('admin.slider.store') }}",
        removedfile: function(file) {
            file.previewElement.remove();
            var name = '';
            if (typeof file.file_name != 'undefined') {
                name = file.file_name;
            } else {
                name = uploadedDocumentMap[file.name];
            }

            $('form').find('input[name="images[]"][value="' + name + '"]').remove();

        }
    }

</script>

@endpush
