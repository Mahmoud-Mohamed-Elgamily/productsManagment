<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $product->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $product->description }}</p>
</div>

<!-- Vendor Field -->
<div class="form-group">
    {!! Form::label('vendor', 'Vendor:') !!}
    <p>{{ $product->vendor }}</p>
</div>

<!-- Sale Field -->
<div class="form-group">
    {!! Form::label('sale', 'Sale:') !!}
    <p>{{ $product->sale }}</p>
</div>

<!-- Mainimagepath Field -->
<div class="form-group">
    {!! Form::label('mainImagePath', 'Mainimagepath:') !!}
    <p>{{ $product->mainImagePath }}</p>
</div>

<!-- Criteria Id Field -->
<div class="form-group">
    {!! Form::label('criteria_id', 'Criteria Id:') !!}
    <p>{{ $product->criteria_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $product->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $product->updated_at }}</p>
</div>

