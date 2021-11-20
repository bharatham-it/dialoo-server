var category_html = "";
$(document ).ready(function() {
    category_html = $("#shop_category_id").html();

});
$("#add").click(function () {
    var html = `<tr >
                <td>
<div class="form-floating">
                <select class="form-select form-select-sm my-3 success" aria-label=".form-select-sm" id="shop_category_id" name="category_percentage[category][]">
              
                   `+category_html+`
                </select>
                </div>

                </td>
                <td>
                <input
                    type="text"
                    name="category_percentage[percentage][]"
                    class="form-control"
                />
                </td>
                <td>
                <input
                    type="submit"
                    id="remove"
                    name="add"
                    value="-"
                    class="btn btn-danger"
                />
                </td>
            </tr>`;
  $("#table-weight").append(html);
 
});

$("#table-weight").on('click', '#remove', function () {
  $(this).closest('tr').remove();
}); 