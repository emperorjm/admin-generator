{{'@'}}extends('brackets/admin::admin.layout.index')

{{'@'}}section('title')
    <h1>{{ ucfirst($objectNamePlural) }} listing</h1>

    <a class="btn btn-primary" href="{{'{{'}} url('admin/{{ $objectName }}/create') }}" role="button">Add new {{ $objectName }}</a>
{{'@'}}endsection

{{'@'}}section('table')

    <admin-listing id="admin-listing"
                   :data="{{'{{'}} $data->toJson() }}"
                   :url="'{{'{{'}} url('admin/{{ $objectName }}') }}'"
    >

        <template slot="filters" scope="props">

            <input @blur="props.filter('search', $event.target.value)" placeholder="Search" />

            @foreach($filters as $filter)@if($filter['type'] == 'boolean'){{ ucfirst($filter['name']) }}?
            <select @change="props.filter('{{ $filter['name'] }}', $event.target.value)">
                <option value="">Any</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @elseif($filter['type'] == 'date')Filter {{ ucfirst($filter['name']) }}
            <input type="date" @blur="props.filter('{{ $filter['name'] }}_from', $event.target.value)" />
            <input type="date" @blur="props.filter('{{ $filter['name'] }}_to', $event.target.value)" />
            @endif

            @endforeach

        </template>

        <template slot="thead" scope="props">
            <thead>
            <tr>
                @foreach($columns as $col)<th is='sortable-th' :parent-props="props" :column="'{{ $col }}'">{{ ucfirst($col) }}</th>
                @endforeach

                <th>Actions</th>
            </tr>
            </thead>
        </template>

        <template slot="row" scope="props">
            <tr>
                @foreach($columns as $col)<td>{{'@{{'}} props.item.{{ $col }} }}</td>
                @endforeach

                <td>
                    <div class="form-inline">
                        <a class="btn btn-info btn-xs" :href="'{{'{{'}} url('admin/{{ $objectName }}/edit') }}/' + props.item.id" role="button">Edit</a>
                        <form class="form-group" :action="'{{'{{'}} url('admin/{{ $objectName }}/destroy') }}/' + props.item.id" method="post">
                            <input name="_method" type="hidden" value="DELETE">
                            {{'{'}}!! csrf_field() !!{{'}'}}
                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        </template>

    </admin-listing>

{{'@'}}endsection