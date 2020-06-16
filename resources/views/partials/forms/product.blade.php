<div class="form-group">
    {!! Form::label('product_code', 'Code Produit:') !!}
    <div class="form-controls">
        {!! Form::text('product_code', ( isset($product) ? $product->product_code : null ), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('product_label', 'Label Produit:') !!}
    <div class="form-controls">
        {!! Form::text('product_label', ( isset($product) ? $product->product_label : null ), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('rafael_product_code', 'Rafael Code Produit:') !!}
    <div class="form-controls">
        {!! Form::text('rafael_product_code', ( isset($product) ? $product->rafael_product_code : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('rafael_product_label', 'Rafael Label Produit:') !!}
    <div class="form-controls">
        {!! Form::text('rafael_product_label', ( isset($product) ? $product->rafael_product_label : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('supplier_code', 'Code Fournisseur:') !!}
    <div class="form-controls">
        {!! Form::text('supplier_code', ( isset($product) ? $product->supplier_code : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('refinery_code', 'Code Rafinerie:') !!}
    <div class="form-controls">
        {!! Form::text('refinery_code', ( isset($product) ? $product->refinery_code : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('refinery_label', 'Label Rafinerie:') !!}
    <div class="form-controls">
        {!! Form::text('refinery_label', ( isset($product) ? $product->refinery_label : null ), ['class' => 'form-control']) !!}
    </div>
</div>