'use strict';
if(!APP) var APP = {};

APP.helpers = {};
APP.module = {};

APP.messageError = function(response){
    return response.responseJSON.msg;
}

APP.flash = function(message,submessage, type = 'success') {
    swal(
        message,
        submessage,
        type
      );
};

APP.loading = function (id, action = 'on'){
    id = '#' + id;
    if(action == 'on'){
        $(id).attr('disabled', 'disabled')
        .addClass('btn-disabled');
    }
    else {
        $(id).removeAttr('disabled')
        .removeClass('btn-disabled');      
    }
}


function saveCategory(e){
    e.preventDefault();
    //---------------------------------------------------
    var code = $('#id-category-code').val();
    var name = $('#id-category-name').val();

    APP.loading('id-button-submit-category');

    $.ajax({
        type: 'POST',
        url: '/addCategory',
        data: {
            _token: 'teste',
            code: code,
            name:name
         }
     })
     .done(function(response){
         APP.flash(
             'Good job!',
             'You clicked the button!',
             'success'
           );
     })
     .fail(function(response){
        APP.flash(
            'Good job!',
            'You clicked the button!',
            'error'
          );
     })
     .always(function(){
        APP.loading('id-button-submit-category','off');
        // setInterval(function(){ alert("Hello"); }, 3000);
     });

}
function saveProduct(e){
    e.preventDefault();
    // --------------------------------

    var sku = $('#id-sku').val();
    var name = $('#id-name').val();
    var price = $('#id-price').val();
    var quantity = $('#id-quantity').val();

    var category = $('#id-category').val();
    var description = $('#id-description').val();

    APP.loading('id-button-submit-product');
    $.ajax({
        type: 'POST',
        url: '/addProduct',
        data: {
            _token: 'teste',
            sku: sku,
            name: name,
            price: price,
            quantity: quantity,
            category: category,
            description: description
         }
     })
     .done(function(response){
         APP.flash(
             'Salvo!',
             response.data.msg,
             'success'
           );
     })
     .fail(function(response){
         console.log(response);
        APP.flash(
            'Error',
            APP.messageError(response),
            'error'
          );
     })
     .always(function(){
        APP.loading('id-button-submit-product','off');
        // setInterval(function(){ alert("Hello"); }, 3000);
     });

}

function listenings(){
    $('#id-form-add-category').on('submit',saveCategory);
    $('#id-form-save-product').on('submit',saveProduct);
}

function init(){
    listenings();
}

init();