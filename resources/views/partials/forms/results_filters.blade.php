<form method="get" action="{{ url('/delivery-process/show-data') }}">
    <div class="row" style="margin-top: 30px;">
        <div class="col-sm-3">
            <select name="suppliers" id="suppliers" class="custom-select">
                <option>Fournisseurs</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->name }}" {{ ($supplier->name == $selected_supplier) ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <select name="refinery" class="custom-select">
                <option selected>Raffinerie </option>
            </select>
        </div>
        <div class="col-sm-3">
            <select name="process_type" class="custom-select">
                <option selected>Transport Inclus</option>
                <option value="Oui" {{ ('Oui'== $selected_process_type) ? 'selected' : ''  }}>Oui</option>
                <option value="Non" {{ ('Non'== $selected_process_type) ? 'selected' : ''  }}>Non</option>
            </select>
        </div>
        <div class="col-sm-3">
            {!! Form::text('account_period', ( isset($selected_account_period) ? $selected_account_period : null ), ['class' => 'form-control', 'placeholder' => "Période de compte", 'id'=> 'account_period']) !!}
            <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-sm-3">
            <select id="customers" name="customers" class="custom-select">
                <option selected>Filiale</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->customer_number }}" {{ ($customer->customer_number == $selected_customer) ? 'selected' : '' }}>
                        {{ $customer->label }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <select id="installations" name="installations" class="custom-select">
                <option selected>Installations</option>
                @foreach($installations as $installation)
                    <option value="{{ $installation->ue }}" {{ ($installation->ue == $selected_installation) ? 'selected' : '' }}>
                        {{ $installation->ue_lib_installation }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary" name="showDataBtn" id="showDataBtn">Afficher les données</button>
        </div>
        <div class="col-sm-3" style="margin-left: -10px;">
            <button type="button" class="btn btn-warning" name="refreshBtn" id="refreshBtn">Rafraîchir</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function(){
      var date_input=$('input[name="account_period"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/yyyy',
        container: container,
        todayHighlight: true,
        minViewMode: 'months',
        viewMode: 'months',
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>