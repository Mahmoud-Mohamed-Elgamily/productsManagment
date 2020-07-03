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
<section id="PricedContainer" class="form-group col-sm-6">

  <h3>Select Priced Criteria</h3>
  <div class="PricedCriteria">
    {!! Form::select('PricedCriteria_id[]', $criteriaItems, null, ['class' => 'form-control']) !!}
  </div>

  <button class="btn btn-primary" id="newPricedCriteria"> Add Priced Criteria</button>
  <button class="btn btn-primary" id="ShowPricedAddForm"> Done</button>

</section>

<section id="PricelessContainer" class="form-group col-sm-6">

  <h3>Select Priceless Criteria</h3>
  <div class="PricelessCriteria">
    {!! Form::select('PricelessCriteria_id[]', $criteriaItems, null, ['class' => 'form-control']) !!}
  </div>

  <button class="btn btn-primary" id="newPricelessCriteria"> Add Priceless Criteria</button>
  <button class="btn btn-primary" id="ShowPricelessAddForm"> Done</button>

</section>

<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
</div>

<script src="/js/product.js"></script>
