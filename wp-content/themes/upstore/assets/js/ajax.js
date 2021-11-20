
function AjaxCall(element, action, arg, handle) {
    var fulldata = '';
    var flag_contentType_add = 0;
    if (typeof action == 'object') {
        flag_contentType_add = 1;
        fulldata = action.new_data;
        action = action.action;

    }
    else {
        if (typeof arg == 'object') {


            data = arg;
            if (action) data.action = action;
            //if (!data.nonce) data.nonce = nonce;
        } else if (typeof arg == 'string') {
            if (action) data = "action=" + action;
            if (arg) data = arg + "&action=" + action;
            if (arg && !action) data = arg;

            var n = data.search("nonce");
            if (n >= 0) {
                data = data + "&nonce=" + nonce;
            }
            data = data + "&is_ajax=true";
        }
        fulldata = { action: action, formdata: data };
    }

    if (typeof (ajaxurl) == 'undefined') ajaxurl = ajaxurl;

    var ajax_obj = {
        type: "post",
        dataType: 'json',
        url: ajaxurl,
        data: fulldata,
        beforeSend: function () {
            jQuery('.progress').removeClass('d-none');
        },
        success: function (data) {
            jQuery('.progress').addClass('d-none');
            handle(data);
        }
    }
    if (flag_contentType_add == 1) {
        ajax_obj.processData = false;
        ajax_obj.contentType = false;
    }
    AjaxRequest = jQuery.ajax(ajax_obj);
}
function AjaxDangerCall(action, actionData, handle) {
    var ajax_obj = {
        type: "post",
        dataType: 'json',
        url: ajaxurl,
        data: { action: action, actionData: actionData, is_ajax: true },
        beforeSend: function () {
            jQuery('.progress').removeClass('d-none');
        },
        success: function (data) {
            jQuery('.progress').addClass('d-none');
            handle(data);
        }

    }
    AjaxRequest = jQuery.ajax(ajax_obj);
}

// function AjaxRequest(element) {  
//     bindElement = jQuery(element);
//     bindElement.parent().children(".ajax_result").remove();
//     arg = jQuery( element ).serialize();
//     AjaxCall( bindElement, 'ajax_request', arg, function(data) {
//         bindElement.after("<div class='ajax_result'>"+data+"</div>");        
//     });    

// }

// $.ajax({
//     url    : ajaxurl,
//     method : 'POST',
//     data   : data,
//     success: function (result) {
//         var resultObj = $.parseJSON(result);
//         if (resultObj.success) {
//             // Redirect to the "Account" page and sync the license.
//             window.location.href = resultObj.next_page;
//         } else {
//             resetLoadingMode();
//             // Show error.
//             $('.fs-content').prepend('<p class="fs-error">' + (resultObj.error.message ?  resultObj.error.message : resultObj.error) + '</p>');
//         }
//     },
//     error: function () {
//         resetLoadingMode();
//     }
// });
