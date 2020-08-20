@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.event-types.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.eventType.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.eventType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-EventType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                           id
                        </th>
                        <th>
                            name
                        </th>
                        <th>
                           sulg
                        </th>
                        <th>
                         photo
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventTypes as $key => $eventType)
                        <tr data-entry-id="{{ $eventType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $eventType->id ?? '' }}
                            </td>
                            <td>
                                {{ $eventType->name ?? '' }}
                            </td>
                            <td>
                                {{ $eventType->slug ?? '' }}
                            </td>
                            
                            <td><img src=" /uploads/event_images/{{ $eventType->image }} " style="width: 100px"  class="img-thumbnail" alt=""></td>
                            
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.event-types.show', $eventType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>

                                    <a class="btn btn-xs btn-info" href="{{ route('admin.event-types.edit', $eventType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>

                                    <form action="{{ route('admin.event-types.destroy', $eventType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
