@extends('layouts.app')
@section('content')
    <div class="col">
        @method('get')
        <div class="card mb-5">
            <div class="card-header">
                <h2>Projects</h2>
            </div>
            <form action="{{ route('admin.project.index') }}">
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">Name</div>
                            <div class="datagrid-content"><input type="search" name="name" value="{{ old('name') }}"
                                    class="form-control " />
                            </div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Owner Name</div>
                            <div class="datagrid-content"><input type="search" name="owner_name"
                                    value="{{ old('owner_name') }}" class="form-control " />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div>
                        <a href="{{ route('admin.project.index') }}" class="btn btn-outline-secondary">Clear fields</a>
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </div>
            </form>
            <div>
                @if ($owner)
                    @include('project._partials.new_modal')
                @endif
            </div>
        </div>
    </div>
    @include('_partials.projects_table')
@endsection
