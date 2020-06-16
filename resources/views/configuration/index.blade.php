@extends('base')

@section('main')
   <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'regulatory', 'tabcontent', 'tablinks')" id="defaultOpen">Regulatory</button>
    <button class="tablinks" onclick="openTab(event, 'referential', 'tabcontent', 'tablinks')">Referential</button>
   </div>
  
  <div id="regulatory" class="tabcontent">
    <div class="tab">
        <button class="tablinks2" onclick="openTab(event, 'buying_price', 'tabcontent2', 'tablinks2')" id="defaultOpen">Buying Price</button>
        <button class="tablinks2" onclick="openTab(event, 'selling_price', 'tabcontent2', 'tablinks2')">Selling Price</button>
        <button class="tablinks2" onclick="openTab(event, 'vat', 'tabcontent2', 'tablinks2')">TVA</button>
    </div>
    <div id="buying_price" class="tabcontent2">
       
    </div>
    <div id="selling_price" class="tabcontent2">
       
    </div>
    <div id="vat" class="tabcontent2">
       
    </div>
  </div>
  
  <div id="referential" class="tabcontent">
    <div class="tab">
        <button class="tablinks3" onclick="openTab(event, 'suppliers', 'tabcontent3', 'tablinks3')" id="defaultOpen">Suppliers</button>
        <button class="tablinks3" onclick="openTab(event, 'refinery', 'tabcontent3', 'tablinks3')">Refinery</button>
        <button class="tablinks3" onclick="openTab(event, 'products', 'tabcontent3', 'tablinks3')">Product</button>
        <button class="tablinks3" onclick="openTab(event, 'erts', 'tabcontent3', 'tablinks3')">ERT</button>
        <button class="tablinks3" onclick="openTab(event, 'installations', 'tabcontent3', 'tablinks3')">Installation</button>
    </div>
    <div id="suppliers" class="tabcontent3">
        @include('partials.suppliers.index')
    </div>
    <div id="refinery" class="tabcontent3"></div>
    <div id="products" class="tabcontent3"></div>

    <div id="erts" class="tabcontent3">
        @include('partials.erts.index')
    </div>
    <div id="installations" class="tabcontent3">
        @include('partials.installations.index')
    </div>
    </div>
  </div>

  <script>
    function openTab(evt, tabName, tabContentName, tabLinkName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName(tabContentName);
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName(tabLinkName);
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click(); 
  </script>
@endsection