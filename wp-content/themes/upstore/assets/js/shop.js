jQuery('#add-shops').submit(function (event) {
   
    event.preventDefault();
    bindElement = jQuery('#add-shops');
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

$('.shopdel').click(function(e){
    e.preventDefault; 
    var elemid =$(this).attr("id");
    var type_id = elemid.substring(elemid.lastIndexOf('_') + 1);
    var typename = $('#typename_'+type_id).val();
    var type    =   $('#type_'+type_id).val();
    var action= type+'_delete';
    var actionData={id:type_id};

    var sweet_data = {
        title : "Delete "+type+":"+typename,
        text : "are you sure want to delete?",
        icon :"warning",
    };
    sweetalertConfirm(sweet_data,function(data){
        if(data==true)
        {
            AjaxDangerCall(action,actionData, function(data){
    
                sweetalert(data);
            
            });
        }
     
    });
    
        
   
   

});


