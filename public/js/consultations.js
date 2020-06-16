jQuery(function () {

    //Save credit invoice item
    $(document).on('click', '#update_infirmier', function () {
        $('#update_infirmier_div').fadeTo(1000, 0.3);
        var infirmier = $('#infirmier').val();
        var href = $(this).attr('data-href');
        var method = $(this).attr('data-method');
        var resdiv = $('span.infirmier');

        if( (infirmier==''))
        {
            alert('Assurez-vous d\'avoir sélectionné un infirmier');
        }
        else{
            $.ajax({
                type: method,
                data: 'infirmier='+infirmier,
                url: href,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'html',
                success:function(data, statut){
                    //var msg = 'Vous avez choisi le Dr '+data+' pour cette consultation';
                    var msg = 'Vous avez choisi l\'infirmier '+data+' pour les constantes';
                    alert(data);
                    $('#update_infirmier_div').fadeTo(1000, 1);
                    $('span.infirmier').html(data);
                }, 
            });
        }
    });

    //Save credit invoice item
    $(document).on('click', '#update_medecin', function () {
        $('#update_medecin_div').fadeTo(1000, 0.3);
        var medecin = $('#medecin').val();
        var href = $(this).attr('data-href');
        var method = $(this).attr('data-method');

        if( (medecin==''))
        {
            alert('Assurez-vous d\'avoir sélectionné un medecin');
        }
        else{
            $.ajax({
                type: method,
                data: 'medecin='+medecin,
                url: href,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'html',
                success:function(data, statut){
                    var msg = 'Vous avez choisi le Dr '+data+' pour cette consultation';
                    alert(msg);
                    $('#update_medecin_div').fadeTo(1000, 1);
                    $('span.medecin').html(data);
                }, 
            });
        }
    });

    $(document).on('click', '#add_diagnostic', function () {
        $('#diagnostic').fadeTo(1000, 0.3);
        var diagnostic_content = $('#diagnostic_content').val();
        var href = $(this).attr('data-href');
        var method = $(this).attr('data-method');
        var diagnostic_id = $(this).attr('data-id');

        if( (diagnostic_content==''))
        {
            alert('Assurez-vous d\'avoir saisi votre avis.');
        }
        else{
            $.ajax({
                type: method,
                data: 'content='+diagnostic_content+'diagnostic_id='+diagnostic_id,
                url: href,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'html',
                success:function(data, statut){
                    alert(data);
                    $('#diagnostic').fadeTo(1000, 1);
                    $('#add_diagnostic').html('Mettre à jour');
                }, 
            });
        }
    });


    /*
     * ORDONNANCE
     */

    $(document).on('click', '#ord_add_product', function () {
        var pid = '1';//$('#produit').val();
        var pname = 'Chloroquine';//$('#produit option:selected').html();
        var qte = $('#quantite').val();
        var pos = $('#posologie').val();
        var href = $(this).attr('data-href');
        var method = $(this).attr('data-method');
        var diagnostic_id = $(this).attr('data-id');

        if( (pid=='0'))
        {
            alert('Assurez-vous d\'avoir choisi un produit.');
        }
        else{
            var json_produits = $('button#save_ordonnance').attr('data-produits');
            jsonObj = [];
            var item = {'pid':pid, 'qte':qte, 'pos':pos};
            /*item = {};
            item["pid"] = pid;
            item["qte"] = qte;
            item["pos"] = pos;*/

            if(json_produits==''){
                jsonObj.push(item);
                $('button#save_ordonnance').attr('data-produits', JSON.stringify(jsonObj));
            }
            else{
                var produits_obj = JSON.parse(json_produits);
                produits_obj.push(item);
                $('button#save_ordonnance').attr('data-produits', JSON.stringify(produits_obj));                
            }

            var append_produit = '<div class="row pl-2 pr-2"><div class="col-sm-6 pt-1 pb-1" style="border-bottom:1px dashed #ccc;">'+pname+'</div><div class="col-sm-2 pt-1 pb-1" style="border-bottom:1px dashed #ccc;">'+qte+'</div><div class="col-sm-4 pt-1 pb-1" style="border-bottom:1px dashed #ccc;">'+pos+'</div></div>';
            $("#produits_list").append(append_produit);
            /*$.ajax({
                type: method,
                data: 'pid='+pid+'&qte='+qte+'&pos='+pos,
                url: href,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'html',
                success:function(data, statut){
                    alert(data);
                    jsonObj = [];
                    item = {}
                    item ["pid"] = pid;
                    item ["qte"] = qte;
                    item ["pos"] = pos;
                    jsonObj.push(item);
                    $('button#save_ordonnance').attr('data-produits', jsonObj);
                
                    console.log(jsonObj);
                }, 
            });*/
        }
    });

    
    $(document).on('click', '#save_ordonnance', function () {

        $('#ordonnance').fadeTo(1000, 0.3);

        var produits = $(this).attr('data-produits');
        var pvv = $(this).attr('data-pvv');
        var medecin = $(this).attr('data-medecin');
        var cons = $(this).attr('data-cons');
        var href = $(this).attr('data-href');
        var method = $(this).attr('data-method');

        if( (produits==''))
        {
            alert('Assurez-vous d\'avoir choisi renseigner les produits sur l\'ordonnance.');
        }
        else{
            $.ajax({
                type: method,
                data: 'pvv='+pvv+'&medecin='+medecin+'&consultation='+cons+'&produits='+produits,
                url: href,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'html',
                success:function(data, statut){
                    if(data=='true'){
                        alert(data);
                    }
                    //$('button#save_ordonnance').fadeOut();
                    //$('#ord_content').fadeOut(); 
                }, 
            });
        }
        
        $('#ordonnance').fadeTo(1000, 1);
    });

});