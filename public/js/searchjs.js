jQuery(function () {
   
    $(document).on('click', '#search_users', function () {

        var searchparam = $('input[name=search]').val();
        var href = $(this).attr('data-href');

        if( (searchparam==''))
        {
            alert('Quel souhaitez-vous chercher ?');
        }
        else{
            $.ajax({
                type: 'GET',
                data: 'searchparam='+searchparam,
                url: href+'/'+searchparam,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'html',
                success:function(data, statut){
                    $('table.table tbody').html(data);
                }, 
            });
        }
        
        $('#ordonnance').fadeTo(1000, 1);
    });

});