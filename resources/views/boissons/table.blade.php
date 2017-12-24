<table class="table table-responsive" id="boissons-table">
    <thead>
        <tr>
            <th>Label</th>
        <th>Price</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($boissons as $boisson)
        <tr>
            <td>{!! $boisson->label !!}</td>
            <td>{!! $boisson->price !!}</td>
            <td>
                {!! Form::open(['route' => ['boissons.destroy', $boisson->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('boissons.show', [$boisson->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('boissons.edit', [$boisson->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>