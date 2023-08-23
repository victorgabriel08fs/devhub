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
                        <div class="datagrid-content">{{ $project->user->name . ' (' . $project->user->username . ')' ?? '-' }}</div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Github</div>
                        <div class="datagrid-content">
                            <a {{ $project->github_link ? 'target="_blank"' : '' }}
                                href="{{ $project->github_link ?? '' }}">{{ $project->github_link ?? '-' }}</a>
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
            <div class="card-footer">
                <a href="{{ route('admin.project.index') }}" class="btn btn-outline-secondary">Projects</a>
            </div>
        </div>
    </div>
@endsection
