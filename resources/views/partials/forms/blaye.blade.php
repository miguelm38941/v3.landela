<table id="standardImportedResults" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
        <tr>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Fournisseur</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Filiale</b></td>
          <td colspan=3 class="text-center" style="color: white;background: #9c9b9b;">Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($imported_file_results as $result)
          <tr>
              <td class="text-center">{{ $result->supplier_label }}</td>
              <td class="text-center">{{ $result->customer_label }}</td>
              <td class="text-center">
                  <a href="#" class="btn btn-primary">Modifierer</a>
              </td>
              {{-- <td>
                  <form action="{{ route('suppliers.destroy', $supplier->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                  </form>
              </td> --}}
          </tr>
        @endforeach
    </tbody>
</table>