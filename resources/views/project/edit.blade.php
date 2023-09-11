@extends('layouts.app')
@section('content')
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="datagrid">
                    <div class="datagrid-item">
                        <div class="datagrid-title">Name</div>
                        <div class="datagrid-content">{{ $project->name }}</div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Slug</div>
                        <div class="datagrid-content">{{ $project->slug ?? '-' }}</div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Owner (username)</div>
                        <div class="datagrid-content">
                            {{ $project->user->name . ' (' . $project->user->username . ')' ?? '-' }}</div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Provider</div>
                        <div class="datagrid-content">
                            <a {{ $project->provider ? 'target="_blank"' : '' }}
                                href="{{ $project->provider ?? '' }}">{{ $project->provider ?? '-' }}</a>
                        </div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Repository link</div>
                        <div class="datagrid-content">
                            <a {{ $project->repository_link ? 'target="_blank"' : '' }}
                                href="{{ $project->repository_link ?? '' }}">{{ $project->repository_link ?? '-' }}</a>
                        </div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">URL</div>
                        <div class="datagrid-content">
                            <a {{ $project->url ? 'target="_blank"' : '' }}
                                href="{{ $project->url ?? '' }}">{{ $project->url ?? '-' }}</a>
                        </div>
                    </div>

                    <div class="datagrid-item">
                        <div class="datagrid-title">Started at</div>
                        <div class="datagrid-content">{{ $project->started_at->format('d/m/Y') }}</div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Ended at</div>
                        <div class="datagrid-content">{{ optional($project->ended_at)->format('d/m/Y') ?? ' - ' }}</div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Created at</div>
                        <div class="datagrid-content">{{ $project->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header">
                <h4>New describe</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('project.storeDescribe', ['project' => $project->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" value="{{ old('image') }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ old('title') }}" placeholder="Describe's title" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <input type="text" class="form-control @error('content') is-invalid @enderror" name="content"
                            value="{{ old('content') }}" placeholder="Describe's content" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <select name="color" class="form-control @error('color') is-invalid @enderror">
                            <option value="" selected hidden></option>
                            <option value="black" @selected($project->color == 'black')>Black</option>
                            <option value="red" @selected($project->color == 'red')>Red</option>
                            <option value="blue" @selected($project->color == 'blue')>Blue</option>
                            <option value="green" @selected($project->color == 'green')>Green</option>
                            <option value="yellow" @selected($project->color == 'yellow')>Yellow</option>
                        </select>
                    </div>
                    <button class="btn btn-success" type="submit">Save</button>
                </form>
            </div>
        </div>
        @foreach ($project->describes as $describe)
            <div class="row">
                @include('project._partials.describe_item')
                <div class="col-1 d-flex align-items-center">
                    <div class="d-flex flex-column">
                        @if (!$loop->first)
                            <form method="post"
                                action="{{ route('describe.order', ['describe' => $describe->id, 'order' => $describe->order - 1]) }}">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-arrow-big-up-filled" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M10.586 3l-6.586 6.586a2 2 0 0 0 -.434 2.18l.068 .145a2 2 0 0 0 1.78 1.089h2.586v7a2 2 0 0 0 2 2h4l.15 -.005a2 2 0 0 0 1.85 -1.995l-.001 -7h2.587a2 2 0 0 0 1.414 -3.414l-6.586 -6.586a2 2 0 0 0 -2.828 0z"
                                            stroke-width="0" fill="currentColor"></path>
                                    </svg></button>
                            </form>
                        @endif
                        <form class="my-2" method="post"
                            action="{{ route('describe.destroy', ['describe' => $describe->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z"
                                        stroke-width="0" fill="currentColor"></path>
                                    <path
                                        d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z"
                                        stroke-width="0" fill="currentColor"></path>
                                </svg></button>
                        </form>
                        @if (!$loop->last)
                            <form method="post"
                                action="{{ route('describe.order', ['describe' => $describe->id, 'order' => $describe->order + 1]) }}">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-arrow-big-down-filled" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M10 2l-.15 .005a2 2 0 0 0 -1.85 1.995v6.999l-2.586 .001a2 2 0 0 0 -1.414 3.414l6.586 6.586a2 2 0 0 0 2.828 0l6.586 -6.586a2 2 0 0 0 .434 -2.18l-.068 -.145a2 2 0 0 0 -1.78 -1.089l-2.586 -.001v-6.999a2 2 0 0 0 -2 -2h-4z"
                                            stroke-width="0" fill="currentColor"></path>
                                    </svg></button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
