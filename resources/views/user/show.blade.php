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
                        <div class="datagrid-content">{{ $category->slug ?? '-' }}</div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Created at</div>
                        <div class="datagrid-content">{{ $project->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.project.index') }}" class="btn btn-outline-secondary">Projects</a>
            </div>
        </div>
    @endsection
