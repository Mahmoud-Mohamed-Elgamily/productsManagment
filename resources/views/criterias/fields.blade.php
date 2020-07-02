<!-- Name Field -->
<div class="form-group col-sm-6">
	{!! Form::label('name', 'Name:') !!}
	{!! Form::text('name', null, ['class' => 'form-control','minlength' => 3]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-12">
	{!! Form::label('type', 'Type:') !!}
	<label class="radio-inline">
		{!! Form::radio('type', "normal", null) !!} normal
	</label>

	<label class="radio-inline">
		{!! Form::radio('type', "nested", null) !!} nested
	</label>

	<label class="radio-inline">
		{!! Form::radio('type', "options", null) !!} options
	</label>

	<label class="radio-inline">
		{!! Form::radio('type', "color", null) !!} color
	</label>

</div>

<div id="extraContent" class="form-group col-sm-3" style="display:none">

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
	{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
	<a href="{{ route('criterias.index') }}" class="btn btn-default">Cancel</a>
</div>

<script src="/js/criteria.js"></script>
