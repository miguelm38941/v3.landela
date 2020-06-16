<form method="post" action="{{ url('/delivery-process/upload-file') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="row upload-file-form">
                <div class="row">
                    <div class="col-sm-3">
                        <select name="templates" id="templates" class="custom-select">
                            <option>Modèle</option>
                            @foreach($templates as $template)
                                <option value="{{ $template->name }}" {{ ($template->name == $selected_template) ? 'selected' : '' }}>
                                    {{ $template->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="custom-file col-sm-4">
                        <input type="file" class="custom-file-input" id="blfile" name="blfile">
                        <label class="custom-file-label" for="customfile">Parcourir</label>
                    </div>
                    <button type="submit" name="importFileBtn" id="importFileBtn" class="btn btn-primary" style="margin-left: 10px;">Importer</button>

                    <div class="delivery-process-nbr-imported-lines col-sm-4">
                        <div class="row" style="margin-left: 10px;">
                            <h5>Nombre de lignes importées: </h5> 
                            <h5 id="nbrOfResults" name="nbrOfResults">
                                {{ $nbr_imported_lines }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</form>