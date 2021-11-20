jQuery('#add-ownsellers').submit(function (event) {
   
    event.preventDefault();
    bindElement = jQuery('#add-ownsellers');
    var action = bindElement.attr('action');
    var arg1 = bindElement.serialize();
    var image = $('#profile_pic')[0];
    var formdata = new FormData();
    formdata.append('file', image.files[0]);
    formdata.append('action', action);
    formdata.append('formdata', arg1);
    var new_action = {action : action , new_data : formdata};
    for (var pair of formdata.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    arg = '';
     AjaxCall( bindElement, new_action, arg, function(data) {
     
        sweetalert(data);
   }); 
});
