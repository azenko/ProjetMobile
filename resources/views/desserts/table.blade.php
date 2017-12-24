<table class="table table-responsive" id="desserts-table">
    <thead>
        <tr>
            <th>Label</th>
        <th>Price</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($desserts as $dessert)
        <tr>
            <td>{!! $dessert->label !!}</td>
            <td>{!! $dessert->price !!}</td>
            <td>
                {!! Form::open(['route' => ['desserts.destroy', $dessert->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('desserts.show', [$dessert->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('desserts.edit', [$dessert->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>