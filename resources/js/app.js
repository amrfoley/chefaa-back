require('./bootstrap');
require('./select2');
require('./search-products');

$(document).on('change', '#upload-image', function() {
    const img = this.files;
    if(img.length === 1)
    {
        let elm = document.getElementById('img-upload');
        let imgElm = document.createElement("img");
        imgElm.width = 200;
        imgElm.src = window.URL.createObjectURL(img[0]);
        elm.innerHTML = '';
        elm.append(imgElm);
    }
});

$(document).on('change', '#product-status', function () {
    $(this).is(':checked') ? $(this).attr('value', '1') : $(this).attr('value', '0');
});