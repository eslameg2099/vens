@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.venues.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.venue.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.venue.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Venue">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.slug') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.event_types') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.latitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.longitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.features') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.people_minimum') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.people_maximum') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.price_per_hour') }}
                        </th>
                        <th>
                            {{ trans('cruds.venue.fields.main_photo') }}
                        </th>
                     
                        <th>
                            {{ trans('cruds.venue.fields.is_featured') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venues as $key => $venue)
                        <tr data-entry-id="{{ $venue->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $venue->id ?? '' }}
                            </td>
                            <td>
                                {{ $venue->name ?? '' }}
                            </td>
                            <td>
                                {{ $venue->slug ?? '' }}
                            </td>
                            <td>
                                {{ $venue->location->name ?? '' }}
                            </td>
                            <td>
                                @foreach($venue->event_types as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $venue->address ?? '' }}
                            </td>
                            <td>
                                {{ $venue->latitude ?? '' }}
                            </td>
                            <td>
                                {{ $venue->longitude ?? '' }}
                            </td>
                            <td>
                                {{ $venue->description ?? '' }}
                            </td>
                            <td>
                                {{ $venue->features ?? '' }}
                            </td>
                            <td>
                                {{ $venue->people_minimum ?? '' }}
                            </td>
                            <td>
                                {{ $venue->people_maximum ?? '' }}
                            </td>
                            <td>
                                {{ $venue->price_per_hour ?? '' }}
                            </td>
                            <td><img src=" /uploads/ven_images/{{ $venue->image }} " style="width: 100px"  class="img-thumbnail" alt=""></td>


                            <td>
                                {{ $venue->is_featured ? trans('global.yes') : trans('global.no') }}
                            </td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.venues.show', $venue->id) }}">
                                        {{ trans('global.view') }}
                                    </a>

                                    <a class="btn btn-xs btn-info" href="{{ route('admin.venues.edit', $venue->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>

                                    <form action="{{ route('admin.venues.destroy', $venue->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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