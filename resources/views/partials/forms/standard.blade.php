<table id="standardImportedResults" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
        <tr>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Bon de Livraison</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Bon de Commande</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Fournisseur</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Rafinerie</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Installation</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Filiale</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Produit</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Date de Chargement</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Transporteur</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Transport Inclus</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Quantité</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Prix Achat</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Taux Transport</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Filiale à Facturer</b></td>
          <td colspan=3 class="text-center" style="color: white;background: #9c9b9b;">Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $result)
          <tr>
              <td class="text-center">{{ $result->delivery_note }}</td>
              <td class="text-center">{{ $result->purchase_order }}</td>
              <td class="text-center">{{ $result->supplier_label }}</td>
              <td class="text-center">{{ $result->refinery_label }}</td>
              <td class="text-center">{{ $result->installation_label }}</td>
              <td class="text-center">{{ $result->customer_label }}</td>
              <td class="text-center">{{ $result->product_label }}</td>
              <td class="text-center">{{ $result->loadin_date }}</td>
              <td class="text-center">{{ $result->transporter_label }}</td>
              <td class="text-center">
                @if($result->transport_include == '0')
                  Non
                @else
                  Oui
                @endif
              </td>
              <td class="text-center">{{ $result->quantity }}</td>
              <td class="text-center">{{ $result->buying_price }}</td>
              <td class="text-center">{{ $result->transport_rate }}</td>
              <td class="text-center">{{ $result->code_customer_to_invoce }}</td>
              <td class="text-center">
                <a href="{{ url('delivery-process/imports/standard',$result->id)}}" class="btn btn-sm btn-primary">Modifier</a>
              </td>
          </tr>
        @endforeach
    </tbody>
</table>
{!! $results->links() !!}