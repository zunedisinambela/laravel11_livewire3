<div class="container pt-5">
  <div class="row">
    <div class="col-8 m-auto">
      <form wire:submit="savePost">
        <div class="card shadow">
          <div class="card-header">
            <div class="row">
              <div class="col-xl-6">
                <h5 class="font-weight-bold">{{ $isView ? 'View': 'Create' }} Post</h5>
              </div>
              <div class="col-xl-6 text-end">
                <a wire:navigate href="{{ route('posts') }}" class="btn btn-primary btn-sm">Back to Posts</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group mb-2">
              <label for="title">Title <span class="text-danger">*</span></label>
              <input type="text" {{ $isView ? 'disabled' : '' }} wire:model.blur="title" class="form-control" id="title" placeholder="Post Title">

              @error('title')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group mb-4">
              <label for="content">Content <span class="text-danger">*</span></label>
              <input type="text" {{ $isView ? 'disabled' : '' }} wire:model="content" class="form-control" id="content" placeholder="Post Content">

              @error('content')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>

            @if($post)
            <label>Uploaded Featured Image</label>
            <div class="my-2">
              <img src="{{ Storage::url($post->featured_image) }}" class="img-fluid" width="250px">
            </div>
            @endif

            @if(!$isView)
            <div class="form-group mb-2">
              <label for="featuredImage">Featured Image <span class="text-danger">*</span></label>
              <input type="file" wire:model="featuredImage" class="form-control" id="featuredImage">

              @if($featuredImage)
              <div class="my-2">
                <img src="{{ $featuredImage->temporaryUrl() }}" class="img-fluid" width="200px" alt="Gambar">
              </div>
              @endif

              @error('featuredImage')
              <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
            @endif
          </div>
          <div class="card-footer">
            <div class="form-group mb-2">
              @if(!$isView)
              <button type="submit" class="btn btn-success">Save</button>
              @endif
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
