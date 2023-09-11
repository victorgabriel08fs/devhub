<button type="button" class="btn btn-icon btn-secondary" data-bs-toggle="modal"
    data-bs-target="#editModal{{ $project->id }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24"
        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
        </path>
        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
        </path>
        <path d="M16 5l3 3"></path>
    </svg>
</button>

<div class="modal" id="editModal{{ $project->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.project.update', $project->id) }}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name', $project->name) }}" placeholder="Project's name" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Github</label>
                        <input type="url" class="form-control @error('repository_link') is-invalid @enderror"
                            name="repository_link" value="{{ old('repository_link', $project->repository_link) }}"
                            placeholder="Project's github link" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="url" class="form-control @error('url') is-invalid @enderror" name="url"
                            value="{{ old('url', $project->url) }}" placeholder="Project's url" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Started at</label>
                        <input type="date" class="form-control @error('started_at') is-invalid @enderror"
                            name="started_at" value="{{ old('started_at', $project->started_at->format('Y-m-d')) }}"
                            placeholder="Project's started at" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ended at</label>
                        <input type="date" class="form-control @error('ended_at') is-invalid @enderror"
                            name="ended_at" value="{{ old('ended_at', optional($project->ended_at)->format('Y-m-d')) }}"
                            placeholder="Project's ended at" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Visibility</label>
                        <select name="visibility" class="form-control @error('visibility') is-invalid @enderror">
                            <option value="" selected hidden></option>
                            <option value="Public" @selected($project->visibility == 'Public')>Public</option>
                            <option value="Private" @selected($project->visibility == 'Private')>Private</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                         </svg>
                        Update project
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
