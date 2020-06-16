jQuery(function () {

    var process_invoice = {

        // Define the name of the hidden input field for method submission
        methodInputName: '_method',
        // Define the name of the hidden input field for token submission
        tokenInputName: '_token',
        suppliersInputName: '_suppliers',
        ertInputName: '_ert',
        installationsInputName: '_installations',
        account_periodInputName: '_account_period',
        // Define the name of the meta tag from where we can get the csrf-token
        metaNameToken: 'csrf-token',

        initialize: function()
        {
            $('#summarypdf').on('click', this.handleMethod);
            $('#summaryxls').on('click', this.handleMethod);
            $('#exportpdf').on('click', this.handleMethod);
            $('#refresh_bl').on('click', this.handleMethod);
            $('#display_invoice').on('click', this.handleMethod);
        },

        handleMethod: function(e)
        {
            e.preventDefault();
            $('.loader').show();
            $('.container').fadeTo("slow", 0.3);

            var link = $(this),
                httpMethod = link.data('method').toUpperCase(),
                //confirmMessage = link.data('confirm'),
                form;

            // Exit out if there is no data-methods of PUT, PATCH or DELETE.
            if ($.inArray(httpMethod, ['POST', 'PUT', 'PATCH', 'DELETE']) === -1)
            {
                return;
            }

            // Allow user to optionally provide data-confirm="Are you sure?"
            aform = process_invoice.createForm(link);
            aform.submit();
            $('.loader').hide();
            $('.container').fadeTo("slow", 1);

        },

        createForm: function(link)
        {
            var form = $('<form>',
                {
                    'method': 'POST',
                    'action': link.prop('href')
                });

            var suppliers =	$('<input>',
                {
                    'type': 'hidden',
                    'name': process_invoice.suppliersInputName,
                    'value': $('select[name=suppliers]').val()
                });

            var ert =	$('<input>',
                {
                    'type': 'hidden',
                    'name': process_invoice.ertInputName,
                    'value': $('select[name=ert]').val()
                });

            var installations =	$('<input>',
                {
                    'type': 'hidden',
                    'name': process_invoice.installationsInputName,
                    'value': $('select[name=installations]').val()
                });

            var account_period =	$('<input>',
                    {
                        'type': 'hidden',
                        'name': process_invoice.account_periodInputName,
                        'value': $('select[name=account_period]').val()
                    });

            var token =	$('<input>',
                {
                    'type': 'hidden',
                    'name': process_invoice.tokenInputName,
                    'value': $('meta[name=' + process_invoice.metaNameToken + ']').prop('content')
                });

            var method = $('<input>',
                {
                    'type': 'hidden',
                    'name': process_invoice.methodInputName,
                    'value': link.data('method')
                });

            return form.append(suppliers, ert, installations, account_period, token, method).appendTo('body');
        }
    };

    process_invoice.initialize();

    
    var process_credit_invoice = {

        // Define the name of the hidden input field for method submission
        methodInputName: '_method',
        // Define the name of the hidden input field for token submission
        tokenInputName: '_token',
        invoicesInputName: '_invoice',
        invoiceDetailsInputName: '_invoice_details',
        installationsInputName: '_installations',
        account_periodInputName: '_account_period',
        // Define the name of the meta tag from where we can get the csrf-token
        metaNameToken: 'csrf-token',

        initialize: function()
        {
            $('#creditsummarypdf').on('click', this.handleMethod);
            $('#creditsummaryxls').on('click', this.handleMethod);
            $('#refreshcredit_bl').on('click', this.handleMethod);
            $('#display_credit_invoice').on('click', this.handleMethod);
        },

        handleMethod: function(e)
        {
            e.preventDefault();
            $('.loader').show();
            $('.container').fadeTo("slow", 0.3);

            var link = $(this),
                httpMethod = link.data('method').toUpperCase(),
                //confirmMessage = link.data('confirm'),
                form;

            // Exit out if there is no data-methods of PUT, PATCH or DELETE.
            if ($.inArray(httpMethod, ['POST', 'PUT', 'PATCH', 'DELETE']) === -1)
            {
                return;
            }

            // Allow user to optionally provide data-confirm="Are you sure?"
            aform = process_credit_invoice.createForm(link);
            aform.submit();
            $('.loader').hide();
            $('.container').fadeTo("slow", 1);


        },

        createForm: function(link)
        {
            var form = $('<form>',
                {
                    'method': 'POST',
                    'action': link.prop('href')
                });

            var invoices =	$('<input>',
                {
                    'type': 'hidden',
                    'name': process_credit_invoice.invoicesInputName,
                    'value': $('select[name=invoice]').val()
                });

            var invoice_details =	$('<input>',
                {
                    'type': 'hidden',
                    'name': process_credit_invoice.invoiceDetailsInputName,
                    'value': $('select[name=invoice_details]').val()
                });

            var installations =	$('<input>',
                {
                    'type': 'hidden',
                    'name': process_credit_invoice.installationsInputName,
                    'value': $('select[name=installations_cr]').val()
                });

            var account_period =	$('<input>',
                    {
                        'type': 'hidden',
                        'name': process_credit_invoice.account_periodInputName,
                        'value': $('select[name=account_period_cr]').val()
                    });

            var token =	$('<input>',
                {
                    'type': 'hidden',
                    'name': process_credit_invoice.tokenInputName,
                    'value': $('meta[name=' + process_credit_invoice.metaNameToken + ']').prop('content')
                });

            var method = $('<input>',
                {
                    'type': 'hidden',
                    'name': process_credit_invoice.methodInputName,
                    'value': link.data('method')
                });

            return form.append(invoices, invoice_details, installations, account_period, token, method).appendTo('body');
        }
    };

    process_credit_invoice.initialize();

});