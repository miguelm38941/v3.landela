<div class="form-group">
    {!! Form::label('vat_code', 'Code TVA:') !!}
    <div class="form-controls">
        {!! Form::text('vat_code', ( isset($vat) ? $vat->vat_code : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('vat_value', 'Valeur TVA:') !!}
    <div class="form-controls">
        {!! Form::text('vat_value', ( isset($vat) ? $vat->vat_value : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('refinery_code', 'Code Rafinerie:') !!}
    <div class="form-controls">
        {!! Form::text('refinery_code', ( isset($vat) ? $vat->refinery_code : null ), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('refinery_label', 'Label Rafinerie:') !!}
    <div class="form-controls">
        {!! Form::text('refinery_label', ( isset($vat) ? $vat->refinery_label : null ), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('supplier_code', 'Code Fournisseur:') !!}
    <div class="form-controls">
        {!! Form::text('supplier_code', ( isset($vat) ? $vat->supplier_code : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('rafael_vat_code', 'Rafael Code TVA:') !!}
    <div class="form-controls">
        {!! Form::text('rafael_vat_code', ( isset($vat) ? $vat->rafael_vat_code : null ), ['class' => 'form-control']) !!}
    </div>
</div>