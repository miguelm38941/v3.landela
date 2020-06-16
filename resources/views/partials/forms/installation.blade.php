<div class="form-group">
    {!! Form::label('ue', 'UE:') !!}
    <div class="form-controls">
        {!! Form::text('ue', ( isset($installation) ? $installation->ue : null ), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('ue_mnemo', 'UE Mnemo:') !!}
    <div class="form-controls">
        {!! Form::text('ue_mnemo', ( isset($installation) ? $installation->ue_mnemo : null ), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('ue_lib_installation', 'UE Lib Installation:') !!}
    <div class="form-controls">
        {!! Form::text('ue_lib_installation', ( isset($installation) ? $installation->ue_lib_installation : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('dossier_zephyr', 'Dossier Zephyr:') !!}
    <div class="form-controls">
        {!! Form::text('dossier_zephyr', ( isset($installation) ? $installation->dossier_zephyr : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('up', 'UP:') !!}
    <div class="form-controls">
        {!! Form::text('up', ( isset($installation) ? $installation->up : null ), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('up_mnemo', 'UP Mnemo:') !!}
    <div class="form-controls">
        {!! Form::text('up_mnemo', ( isset($installation) ? $installation->up_mnemo : null ), ['class' => 'form-control']) !!}
    </div>
</div>