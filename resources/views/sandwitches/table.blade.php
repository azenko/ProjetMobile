<table class="table table-responsive" id="sandwitches-table">
    <thead>
        <tr>
            <th>Label</th>
        <th>Price</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sandwitches as $sandwitch)
        <tr>
            <td>{!! $sandwitch->label !!}</td>
            <td>{!! $sandwitch->price !!}</td>
            <td>
                {!! Form::open(['route' => ['sandwitches.destroy', $sandwitch->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sandwitches.show', [$sandwitch->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sandwitches.edit', [$sandwitch->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>