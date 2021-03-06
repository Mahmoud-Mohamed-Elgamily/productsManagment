<style>
  p {
    width: 150px;
    height: 100px;
    overflow: auto;
    margin: 0;
  }
</style>

<div class="table-responsive">
  <table class="table" id="products-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Vendor</th>
        <th>Sale</th>
        <th>Mainimagepath</th>
        <th>Priced</th>
        <th>Priceless</th>
        <th colspan="3">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->vendor }}</td>
        <td>{{ $product->sale }}</td>
        <td> <img src="{{ $product->mainImagePath }}" height="50"> </td>
        <td>
          <p> {{ $product->priced }} </p>
        </td>
        <td>
          <p> {{ $product->priceless }} </p>
        </td>
        <td>
          {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
          <div class='btn-group'>
            <a href="{{ route('products.show', [$product->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{{ route('products.edit', [$product->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
          </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
