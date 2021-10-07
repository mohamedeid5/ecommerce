@extends('dashboard.layouts.admin')

@section('title')
    add new images
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">add new product</h5>
            <div class="card-content">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.products.images.store.db') }}" enctype="multipart/form-data" class="dropzone" id="dropzoneForm">
                        @csrf
                        @method('POST')
                        @include('dashboard.includes.alerts.errors')
                        @include('dashboard.includes.alerts.success')

                        <input type="hidden" name="product_id" value="{{ $product->id }}">


                            @foreach ($product->images as $image)
                            <div class="dz-preview dz-image-preview dz-complete">
                                <div class="dz-image">
                                    <img src="{{ Storage::url('admin/images/products/' . $id . '/' . $image->image) }}" alt="">
                                </div>
                            </div>
                            @endforeach



                        <button class="btn btn-primary">{{ __('general.save') }}</button>
                    </form>
                </div>
          </div>
        </div>
    </div>
@endsection




@push('js')

<script>

var uploadedDocumentMap = [];

Dropzone.options.dropzoneForm = {
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
        console.log(file.name, response.name);
        uploadedDocumentMap[file.name] = response.name
    },
    url: "{{ route('admin.products.images.store') }}",
    removedfile: function(file) {
        file.previewElement.remove();
        console.log(file.file_name);
        var name = '';
        if (typeof file.file_name != 'undefined') {
            name = file.file_name;
        } else {
            name = uploadedDocumentMap[file.name]
        }

        $('form').find('input[name="images[]"][value="' + name + '"]').remove();

    }
}

</script>
@endpush
