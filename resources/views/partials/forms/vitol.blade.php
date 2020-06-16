<table id="vitolImportedResults" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
        <tr>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Client</b></td>
          <td scope="col" class="text-center" style="color: white;background: #9c9b9b;"><b>Product</b></td>
          <td colspan=3 class="text-center" style="color: white;background: #9c9b9b;">Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $result)
          <tr>
              <td class="text-center">{{ $result->client }}</td>
              <td class="text-center">{{ $result->product }}</td>
              <td class="text-center">
                  <a href="#" class="btn btn-primary">Modifierer</a>
              </td>
          </tr>
        @endforeach
    </tbody>
</table>