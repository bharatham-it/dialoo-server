jQuery('#add-items').submit(function (event) {
 
event.preventDefault();
alert("data");
    var formData = new FormData();
    var data = $('#add-items').serialize();
    bindElement = $('#add-items');
    action = bindElement.attr('action');
    alert(action);
    formData.append('image_upload', $('#image_upload')[0].files[0]);
    formData.append('action', action);
    formData.append('formdata', data);
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        contentType: false,
        processData: false,
        data: formData,
        dataType: "json",
        success: function (data) {
           alert(data);
        }
    });
});

