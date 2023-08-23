<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newModal">
    New
</button>

<div class="modal" id="newModal" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.project.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" value="{{ old('image') }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" placeholder="Product's name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Describe</label>
                        <input type="text" class="form-control @error('describe') is-invalid @enderror"
                            name="describe" value="{{ old('describe') }}" placeholder="Product's describe" />
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Update product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
