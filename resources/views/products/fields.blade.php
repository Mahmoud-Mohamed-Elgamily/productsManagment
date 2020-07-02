<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','minlength' => 3]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','minlength' => 25]) !!}
</div>

<!-- Vendor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vendor', 'Vendor:') !!}
    {!! Form::text('vendor', null, ['class' => 'form-control']) !!}
</div>

<!-- Sale Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sale', 'Sale:') !!}
    {!! Form::number('sale', null, ['class' => 'form-control']) !!}
</div>

<!-- Mainimagepath Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mainImagePath', 'Mainimagepath:') !!}
    {!! Form::file('mainImagePath') !!}
</div>
<div class="clearfix"></div>

<!-- Criteria Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('criteria_id', 'Criteria Id:') !!}
    {!! Form::select('criteria_id', $criteriaItems, null, ['class' => 'form-control']) !!}
</div>

<div id="extraContent" class="form-group col-sm-12" style="display:none">

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
</div>

<script src="/js/product.js"></script>
