
var _componentSelect2Normal = function() {

$('.select').select2();
};

var _componentDatePicker = function() {
	 $('.date').datepicker({
      	format: "dd/mm/yyyy",
      	autoclose: true,
      	todayHighlight: true
      });

};


/*
 * Form Validation
 */

var _formValidation = function() {
    if ($('#content_form').length > 0) {
        $('#content_form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    }
    
    $('#content_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('#content_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
              if(data.status == 'danger'){
                 	toastr.error(data.message);
                   
                  }
            else {
            	toastr.success(data.message);
                $('#submit').show();
                $('#submiting').hide();
                if (data.goto) {
                   setTimeout(function(){

                     window.location.href=data.goto;
                   },2500);
                }
            }
            },
            error: function(data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i]
                        const message = errors[first_item][0];
                        $('#' + first_item).parsley().removeError('required', {
                            updateClass: true
                        });
                        $('#' + first_item).parsley().addError('required', {
                            message: value,
                            updateClass: true
                        });
                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        toastr.error(value);
                        i++;
                    });
                } else {
                	toastr.error(jsonValue.message);
             
                }
                _componentSelect2Normal();
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};

var _classformValidation = function() {
    if ($('.ajax_form').length > 0) {
        $('.ajax_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }

    $('.ajax_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('.ajax_form').attr('action');
        //Start Ajax
        var formData = new FormData($(".ajax_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'danger') {
                    toastr.error(data.message);

                } else {
                     toastr.success(data.message);
                    $('#submit').show();
                    $('#submiting').hide();
                    if (data.goto) {
                        setTimeout(function() {

                            window.location.href = data.goto;
                        }, 2500);
                    }
                    if (data.window) {
                        window.open(data.window, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=700,height=400");
                        setTimeout(function() {
                            window.location.href = '';
                        }, 1000);
                    }
                }
            },
            error: function(data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i]
                        const message = errors[first_item][0];
                        $('#' + first_item).parsley().removeError('required', {
                            updateClass: true
                        });
                        $('#' + first_item).parsley().addError('required', {
                            message: value,
                            updateClass: true
                        });
                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                       
                         toastr.error(value);
                        i++;
                    });
                } else {
                     toastr.error(jsonValue.message);
                   
                }
                _componentSelect2Normal();
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};


var _modalFormValidation = function() {
    if ($('#content_form').length > 0) {
        $('#content_form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    }
    $('#content_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('#content_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                  if(data.status == 'danger'){
                  	toastr.error(data.message);
                   
                   
                  }
              else{
                toastr.success(data.message);
                $('#submit').show();
                $('#submiting').hide();
                $('#modal_remote').modal('toggle');
                 if (data.goto) {
                   setTimeout(function(){

                     window.location.href=data.goto;
                   },2500);
                }
                
            }
            },
            error: function(data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#' + first_item).parsley().addError('required', {
                                message: value,
                                updateClass: true
                            });
                        }

                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        toastr.error(value);
                        i++;
                    });
                } else {
                	toastr.error(jsonValue.message);
                    
                }
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};

$(document).ready(function() {
    /*
     * For Logout
     */
    $(document).on('click', '#logout', function(e) {
        e.preventDefault();
         $("#loader").show('fade');
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'Post',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
            	toastr.success(data.message);
               
                setTimeout(function() {
                    window.location.href = data.goto;
                }, 2000);
            },
            error: function(data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors
                var i = 0;
                $.each(errors, function(key, value) {
                	toastr.success(value);
                    i++;
                });
            }
        });
    });
});

    /*
     * For Delete Item
     */
    $(document).on('click', '#delete_item', function(e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        $('#action_menu_' + row).hide();
        $('#delete_loading_' + row).show();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                 $.ajax({
                        url: url,
                        method: 'Delete',
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        dataType: 'JSON',
                        success: function(data) {
                            toastr.success(data.message);
                             if (typeof(emran) != "undefined" && emran !== null) {
                                emran.ajax.reload(null, false);
                            }
                            if (data.goto) {
                                setTimeout(function() {

                                    window.location.href = data.goto;
                                }, 2500);
                            }

                            if (data.load) {
                                setTimeout(function() {

                                    window.location.href = "";
                                }, 2500);
                            }
                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        },
                        error: function(data) {
                            var jsonValue = $.parseJSON(data.responseText);
                            const errors = jsonValue.errors
                            var i = 0;
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                                i++;
                            });
                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        }
                    });
                } else {
                 $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    });



    /*
     * For Status Change
     */
    $(document).on('click', '#change_status', function(e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        var status = $(this).data('status');
        if (status == 1) {
            msg = 'Change Status Form Online To Offline';
        } else {
            msg = 'Change Status Form Offline To Online';
        }
        $('#status_' + row).hide();
        $('#status_loading_' + row).show();
        swal({
            title: "Are you sure?",
            text: msg,
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Change it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: true,
            closeOnCancel: true
          }, function(isConfirm) {
            if (isConfirm) {
                    $.ajax({
                        url: url,
                        method: 'Put',
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        dataType: 'JSON',
                        success: function(data) {
                            toastr.success(data.message);
                            if (typeof(emran) != "undefined" && emran !== null) {
                                emran.ajax.reload(null, false);
                            }
                           
                        },
                        error: function(data) {
                            var jsonValue = $.parseJSON(data.responseText);
                            const errors = jsonValue.errors
                            if (errors) {
                                var i = 0;
                                $.each(errors, function(key, value) {
                                     toastr.error(value);
                                    i++;
                                });
                            } else {
                                 toastr.error(data.message);
                            }
                            $('#status_loading_' + row).hide();
                            $('#status_' + row).show();
                        }
                    });
                } else {
                    $('#status_loading_' + row).hide();
                    $('#status_' + row).show();
                }
            });
    });
//  toastr.options = {
//   "closeButton": true,
//   "debug": true,
//   "newestOnTop": false,
//   "progressBar": true,
//   "positionClass": "toast-top-right",
//   "preventDuplicates": false,
//   "onclick": null,
//   "showDuration": "300",
//   "hideDuration": "1000",
//   "timeOut": "5000",
//   "extendedTimeOut": "1000",
//   "showEasing": "swing",
//   "hideEasing": "linear",
//   "showMethod": "fadeIn",
//   "hideMethod": "fadeOut"
// }



