var base_url = "http://localhost:8080/upstore/wp-admin/admin-ajax.php";

$( document ).ready(function() {

    bindDataForSelect();
    $("#add").click(function () {
        var html = `<tr >
                    <td>

                    <select class="form-control category_all_class" name="category_percentage['category'][]">
                       `+category_html+`
                    </select>

                    </td>
                    <td>
                    <input
                        type="text"
                        name="category_percentage['percentage'][]"
                        class="form-control"
                    />
                    </td>
                    <td>
                    <input
                        type="submit"
                        id="remove"
                        name="add"
                        value="remove"
                        class="btn btn-danger"
                    />
                    </td>
                </tr>`;
      $("#table-weight").append(html);
     
    });

    $("#table-weight").on('click', '#remove', function () {
      $(this).closest('tr').remove();
    }); 
});

function bindDataForSelect(){
    
    var request_type = 'category_select';
     var data = {    
                 type : 'item_categories',
              
                 action : 'bind_data_for_select',
                 is_ajax : true 
             };
             
     processFromUrl(data,request_type);
 }
 function processFromUrl(data,request_type) {
    var action = data.action;
    
  /*   data = serialize(data); */
    var formdata =  {   formdata : data,
                        action : action
                    };
                    console.log('asdasd',JSON.stringify(formdata))
    getResult(formdata,request_type);
}
function getResult(formdata,request_type) {
   
    $.ajax({
      type: "POST",
      url: base_url,
      data: formdata, //only input
      dataType: "html",
      beforeSend: function () {
          console.log('sending ajax');
      },
      success: function (response) {
        response = JSON.parse(response);
       
      
      if(request_type == 'category_select'){
            createCategorySelect(response);
        }
        console.log('json response',response);
      },
    });
}
var category_html = '';
function createCategorySelect(category){
    $.each(category, function (index, value) {
        category_html += '<option value="'+index+'">'+value+'</option>';
    });
    $('.category_all_class').html(category_html);
}