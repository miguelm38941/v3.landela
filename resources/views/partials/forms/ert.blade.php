<div class="form-group">    
  {!! Form::label('alternate_code', 'Code Alternatif:') !!}
  <div class="form-controls">
    {!! Form::text('alternate_code', ( isset($ert) ? $ert->alternate_code : null ), ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('identifier', 'Identifiant:') !!}
  <div class="form-controls">
    {!! Form::text('identifier', ( isset($ert) ? $ert->identifier : null ), ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('label', 'Label:') !!}
  <div class="form-controls">
    {!! Form::text('label', ( isset($ert) ? $ert->label : null ), ['class' => 'form-control']) !!}
  </div>
</div>           

<div class="form-group">
  {!! Form::label('customer_number', 'Numéro du client:') !!}
  <div class="form-controls">
    {!! Form::text('customer_number', ( isset($ert) ? $ert->customer_number : null ), ['class' => 'form-control']) !!}
  </div>
</div> 
            
<div class="form-group">
  {!! Form::label('address2', 'Adresse 1:') !!}
  <div class="form-controls">
    {!! Form::text('address2', ( isset($ert) ? $ert->address2 : null ), ['class' => 'form-control']) !!}
  </div>
</div>           

<div class="form-group">
  {!! Form::label('address2', 'Adresse 2:') !!}
  <div class="form-controls">
    {!! Form::text('address2', ( isset($ert) ? $ert->address2 : null ), ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('zip_code', 'Code postal:') !!}
  <div class="form-controls">
    {!! Form::text('zip_code', ( isset($ert) ? $ert->zip_code : null ), ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('city', 'Ville:') !!}
  <div class="form-controls">
    {!! Form::text('city', ( isset($ert) ? $ert->city : null ), ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('country', 'Pays:') !!}
  <div class="form-controls">
    {!! Form::text('country', ( isset($ert) ? $ert->country : null ), ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('payment_mode', 'Mode de paiement:') !!}
  <div class="form-controls">
    {!! Form::text('payment_mode', ( isset($ert) ? $ert->payment_mode : null ), ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('vat_number', 'Numéro TVA:') !!}
  <div class="form-controls">
    {!! Form::text('vat_number', ( isset($ert) ? $ert->vat_number : null ), ['class' => 'form-control']) !!}
  </div>
</div>