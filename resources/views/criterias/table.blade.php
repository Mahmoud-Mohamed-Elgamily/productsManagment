<div class="table-responsive">
  <table class="table" id="criterias-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Details</th>
        <th colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($criterias as $criteria)
      <tr>
        <td>{{ $criteria->name }}</td>
        <td>{{ $criteria->type }}</td>
        <td>{{ implode(' , ',$criteria->details) }}</td>
        <td>
          {!! Form::open(['route' => ['criterias.destroy', $criteria->id], 'method' => 'delete']) !!}
          <div class='btn-group'>
            <a href="{{ route('criterias.show', [$criteria->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{{ route('criterias.edit', [$criteria->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
          </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
