<div class="card">
    <div class="card-body">
        @if ($projects->count() == 0)
            @include('_partials.empty')
        @else
            <table class="table table-hover table-striped table-nowrap">
                <thead class="sticky-top">
                    <tr>
                        <th class="col-1" scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Owner (username)</th>
                        <th scope="col">Started at</th>
                        <th scope="col">Visibility</th>
                        <th style="width: 1%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $item)
                        <tr>
                            <th scope="row">{{ $item['id'] }}</th>
                            <th scope="row">{{ $item['name'] }}</th>
                            <th scope="row">{{ $item['slug'] }}</th>
                            <th scope="row">{{ $item->user->name . ' (' . $item->user->username . ')' ?? ' - ' }}
                            </th>
                            <th scope="row">{{ $item['started_at']->format('d/m/Y') }}</th>
                            <th scope="row"><span
                                    class="status status-{{ $item['visibility'] == 'Public' ? 'blue' : 'red' }}">
                                    <span class="status-dot status-dot-animated"></span>
                                    {{ $item['visibility'] }}
                                </span></th>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-icon btn-primary"
                                        href="{{ route('admin.project.show', $item) }}"><svg
                                            xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                            </path>
                                        </svg></a>

                                    @auth
                                        @if (auth()->user()->hasPermissionTo('Edit Projects') || auth()->id() == $item->user_id)
                                            @include('project._partials.edit_modal', [
                                                'project' => $item,
                                            ])
                                        @endif
                                        @if (auth()->user()->hasPermissionTo('Edit Projects') || auth()->id() == $item->user_id)
                                            <a class="btn btn-icon btn-warning" title="Edit describe"
                                                href="{{ route('project.edit', $item) }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-slideshow" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M15 6l.01 0"></path>
                                                    <path
                                                        d="M3 3m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                                    </path>
                                                    <path d="M3 13l4 -4a3 5 0 0 1 3 0l4 4"></path>
                                                    <path d="M13 12l2 -2a3 5 0 0 1 3 0l3 3"></path>
                                                    <path d="M8 21l.01 0"></path>
                                                    <path d="M12 21l.01 0"></path>
                                                    <path d="M16 21l.01 0"></path>
                                                </svg></a>
                                        @endif

                                        @if (auth()->user()->hasPermissionTo('Delete Projects') || auth()->id() == $item->user_id)
                                            <form id="form-{{ $item->id }}" method="post"
                                                class="btn btn-icon btn-danger"
                                                action="{{ route('admin.project.destroy', $item) }}">
                                                @csrf
                                                @method('delete')
                                                <svg onclick="$('#form-{{ $item->id }}').submit();" id="submit"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 7l16 0"></path>
                                                    <path d="M10 11l0 6"></path>
                                                    <path d="M14 11l0 6"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                </svg>
                                            </form>
                                        @endif
                                    @endauth

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @if ($projects->hasPages() != false)
        <div class="card-footer d-flex justify-content-center clearfix" style="padding-bottom: 0px;" ;>
            {{ $projects->links() }}
        </div>
    @endif
</div>
