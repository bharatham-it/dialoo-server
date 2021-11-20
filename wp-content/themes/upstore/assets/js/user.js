jQuery('#user-login').submit(function () {
    event.preventDefault();
    bindElement = jQuery('#user-login');
    var action = bindElement.attr('action');
    //bindElement.parent().children(".ajax_result").remove();
    arg = bindElement.serialize();
    AjaxCall( bindElement, action, arg, function(data) {
        //bindElement.after("<div class='ajax_result'>"+data+"</div>");   
        sweetalert(data);
    }); 
});
jQuery('#user-registration').submit(function () {
    event.preventDefault();
    bindElement = jQuery('#user-registration');
    var action = bindElement.attr('action');
    arg = bindElement.serialize();
    AjaxCall( bindElement, action, arg, function(data) {
        //bindElement.after("<div class='ajax_result'>"+data+"</div>");   
        sweetalert(data);
    }); 
});
jQuery('#customer-registration').submit(function (event) {
    event.preventDefault();
    var bindElement1 = jQuery('#customer-registration');   
    var action = bindElement1.attr('action');
    var arg1 = bindElement1.serialize();
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
     AjaxCall( bindElement1, new_action, arg, function(data) {
       
        //bindElement.after("<div class='ajax_result'>"+data+"</div>");   
        sweetalert(data);
   }); 
});
jQuery("#pincode").blur(function(){
var pincode = $("#pincode").val();
$.ajax({
    url:"https://api.postalpincode.in/pincode/"+pincode,
    type:"GET",
    dataType:"JSON",
    success:function(response){

        if(response[0].Status != "Error" && response[0].Status != "404"){
            $("#postoffice").val(response[0].PostOffice[0].Name);
            $("#district_id option:contains("+response[0].PostOffice[0].District+")").attr("selected",true);
            
            
        }
        else{
           swal("invalid zip code please recheck")
        }
      
  
  }
  });
  });
  var qrvalue="";
function open_qr_function(qrvalue){
    alert(qrvalue);
    $("#qrcode").html("");
    jQuery('#qrcode').qrcode(qrvalue);
}
   

