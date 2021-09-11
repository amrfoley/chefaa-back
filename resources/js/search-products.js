$('#searching').select2();
$('#searching').select2({
    ajax: {
        url: '/admin/products/search',
        dataType: 'json',
        method: "GET",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                search: params.term,
                type: 'public'
            };
        },
        processResults: function (products) {
            return {
                results: $.map(products, function (product) {
                    return {
                        text: product.title,
                        id: product.id
                    }
                })   
            };
        }
    }
  });