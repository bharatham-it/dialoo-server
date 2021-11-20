function sweetalert(response){
    //swal(response.title, response.subtitle, response.class);
    swal({
        title: sentenceCase(response.title),
        text: sentenceCase(response.subtitle),
        icon: response.class,
        //button: "Logging in",
        className : "bg-light",
        closeModal: false,
        buttons: false,
        timer: 13000,
      });
    if(response.status === 1) {
        jQuery('.swal-overlay').attr('style','opacity:0.4');
        jQuery('.swal-overlay').addClass('bg-'+response.class);
        if(response.redirecturl === undefined || response.redirecturl == ''){           
            location.reload(true);
        }else{
            location.href = response.redirecturl;
        }
    }
}
function sweetalertConfirm(sweet_data,handle)
{
    swal({
        title: sentenceCase(sweet_data.title),
        text: sentenceCase(sweet_data.text),
        icon: sweet_data.icon,
        buttons:true,
        dangerMode:true,
      
      }).then((willDelete)=>{
          if(willDelete)
          {
            handle(true);
          }
          else
          {
            handle(false)
          }
        });
    

}
function toTitleCase(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}

function sentenceCase (str) { 
    return str.replace(/[a-z]/i, function (letter) { return letter.toUpperCase(); }).trim(); 
}