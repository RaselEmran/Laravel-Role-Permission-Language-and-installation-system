 $('#login').on('submit', function(e){
   e.preventDefault();
   $("#loader").show();
   $(".ajax_error").remove();
   var form = $(this).serialize();
   var url = $(this).attr('action');

              $.ajax({
              method:'POST',
              url: url,
              data :form,
              dateType: 'json',
              success: function(data){
                $("#loader").hide();
              toastr.success(data.message);

              setTimeout(function(){

              window.location.href=data.goto;
              },2500);
               },
               error:function (data) {
                $("#loader").hide();
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors;
                var i = 0;
                $.each(errors, function(key, value) {
                    const first_item = Object.keys(errors)[i]
                    const message = errors[first_item][0]
                    $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                     toastr.error(value);
                  
                    i++;
                });
               }

         });
  });

 toastr.options = {
  "closeButton": true,
  "debug": true,
  "newestOnTop": false,
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
