jQuery('#add-grievance').submit(function (event) {
   
    event.preventDefault();
    bindElement = jQuery('#add-grievance');
    var action = bindElement.attr('action');
    arg = bindElement.serialize();
    AjaxCall( bindElement, action, arg, function(data) {
       
        //bindElement.after("<div class='ajax_result'>"+data+"</div>");   
        sweetalert(data);
    }); 
});
