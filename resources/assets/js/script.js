'use strict';
if(!APP) var APP = {};

APP.helpers = {};
APP.module = {};

APP.flash = function(message,submessage, type = 'success') {
    swal(
        message,
        submessage,
        type
      );
};

APP.loading = function (id, icon, action = 'on'){
    id = '#' + id;
    if(action == 'on')
        $(id).attr('disabled', 'disabled')
    else 
        $(id).removeAttr('disabled')      
}

function saveProduct(e){
    e.preventDefault();
    // --------------------------------
    // $.ajax({
    //     type: 'POST',
    //     url: '/',
    //     data: {
    //         _token:APP.token,
    //     }
    // })
    // .done(function(response){
        // APP.flash(
        //     'Good job!',
        //     'You clicked the button!',
        //     'success'
        //   );
    // })
    // .fail(function(response){
    //     APP.flash('Erro de processamento, tente novamente', 'warning');
    // })
    // .always(function(){
        // setInterval(function(){ alert("Hello"); }, 3000);
    // });

}

function listenings(){
    $('#id-form-save-product').on('submit',saveProduct);
}

function init(){
    listenings();
}

init();