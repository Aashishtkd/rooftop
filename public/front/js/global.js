
$(document).ready( function () {


$('#lfm').filemanager('image');

    // toaster
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }



} );

$(".addCartBtn").on("click", function(e){
    e.preventDefault();
    var button = $(this);
    if (button.find('i').hasClass('fa-shopping-cart')) {
        // Update the button's HTML content to the desired icon (e.g., "fa-check-circle")
        button.html('<i class="fa fa-spinner"></i>');
        button.addClass('disabled-link');
      } else {
        // Revert the button's HTML content back to the original icon (e.g., "fa-shopping-cart")
        button.html('<i class="fa fa-shopping-cart"></i>');
      }
    var id = $(this).attr("data-id");
    var userAgent = navigator.userAgent;
    var addNewCartUrl = $(this).attr("data-route");
    $.ajax({
    url:addNewCartUrl,
    type : "POST",
    cache:false,
    data: jQuery.param({ id: id,userAgent:userAgent}) ,
    contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
    processData: false,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType: "json",
    error: function (response) {
        event.preventDefault();
        toastr["error"](response.message, "Error");
        button.html('<i class="fa fa-shopping-cart"></i>');
        button.removeClass('disabled-link');
    },
      success:function(data){
        $('.cartCount').text(data.totalcart)
        if(data.status === 200){
            toastr["success"](data.message, "Success");
            button.html('<i class="fa fa-shopping-cart"></i>');
            button.removeClass('disabled-link');
        }else{
            toastr["warning"](data.message, "Message");
            button.html('<i class="fa fa-shopping-cart"></i>');
            button.removeClass('disabled-link');
        }
    }
    });
  });
function showToast(){
    Command: toastr["success"]("iam himalayan pyramids", "Message");
}