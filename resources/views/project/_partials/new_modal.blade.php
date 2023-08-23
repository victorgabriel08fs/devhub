<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newModal">
    New
</button>

<div class="modal" id="newModal" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" placeholder="Project's name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Github</label>
                        <input type="url" class="form-control @error('github_link') is-invalid @enderror"
                            name="github_link" value="{{ old('github_link') }}" placeholder="Project's github link" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="url" class="form-control @error('url') is-invalid @enderror" name="url"
                            value="{{ old('url') }}" placeholder="Project's url" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Started at</label>
                        <input type="date" class="form-control @error('started_at') is-invalid @enderror"
                            name="started_at" value="{{ old('started_at') }}" placeholder="Project's started at" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ended at</label>
                        <input type="date" class="form-control @error('ended_at') is-invalid @enderror"
                            name="ended_at" value="{{ old('ended_at') }}" placeholder="Project's ended at" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Visibility</label>
                        <select name="visibility" class="form-control @error('visibility') is-invalid @enderror">
                            <option value="" selected hidden></option>
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                        </select>
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
                        New project
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
