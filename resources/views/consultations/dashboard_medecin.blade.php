@extends('consultations.base_cons')

@section('cons_menu')
<div class="col-sm-6"> 
    <div class="btn-group float-right" role="group" aria-label="medecinMenu">
        <button class="btn btn-primary" type="button">Diagnostic</button>
        <button class="btn btn-primary" type="button">Ordonnances</button>
        <button class="btn btn-primary" type="button">Examens</button>
        <button class="btn btn-primary" type="button">Rédiger un avis</button>
    </div>            
</div>
@endsection



@section('section_agent')
<div class="col-sm-5 border border-primary mb-2">
    <div class="diagnostic">
        <h5 class="font-weight-bold p-2 border border-bottom-2">Attribuer un médecin</h5>
        <div class="form-group">
            <label for="medecin">Text</label>
            <select id="medecin" class="form-control" name="">
                <option>Text</option>
            </select>
        </div>
    </div>
    <div class="diagnostic">
        <h5 class="font-weight-bold p-2 border border-bottom-2">Attribuer un infirmier</h5>
        <div class="form-group">
            <label for="medecin">Text</label>
            <select id="medecin" class="form-control" name="">
                <option>Text</option>
            </select>
        </div>
    </div>
</div>

@endsection




@section('section_medecin')
            
        <div class="col-sm-5 border border-primary mb-2">
            <div class="diagnostic">
                <h5 class="font-weight-bold p-2 border border-bottom-2">Diagnostic</h5>
                <div class="diagnostic p-2 border border-2">
                    <div class="form-group">
                        <textarea id="diagnostic-content" class="form-control" name="diagnostic" rows="15"></textarea>
                    </div>
                    <button class="btn btn-primary" type="button">Enregistrer</button>
                </div>
            </div>
        </div>
        <div class="col-sm-4 border border-primary">

        </div>
            
@endsection

