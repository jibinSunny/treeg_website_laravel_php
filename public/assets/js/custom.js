
$(function () {
            var i = -1;
            var toastCount = 0;
            var $toastlast;
            var getMessage = function () {
                var msg = `@if(session('success')){{ session('success') }}@endif`;
                return msg;
            };

            $('#showsimple').click(function (){
                // Display a success toast, with a title
                toastr.success('Without any options','Simple notification!')
            });
            $('#showtoast').click(function () {
                var shortCutFunction = $("#toastTypeGroup input:radio:checked").val();
                var msg = $('#message').val();
                var title = $('#title').val() || '';
                var $showDuration = $('#showDuration');
                var $hideDuration = $('#hideDuration');
                var $timeOut = $('#timeOut');
                var $extendedTimeOut = $('#extendedTimeOut');
                var $showEasing = $('#showEasing');
                var $hideEasing = $('#hideEasing');
                var $showMethod = $('#showMethod');
                var $hideMethod = $('#hideMethod');
                var toastIndex = toastCount++;
                toastr.options = {
                    closeButton: $('#closeButton').prop('checked'),
                    debug: $('#debugInfo').prop('checked'),
                    progressBar: $('#progressBar').prop('checked'),
                    preventDuplicates: $('#preventDuplicates').prop('checked'),
                    positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
                    onclick: null
                };
                if ($('#addBehaviorOnToastClick').prop('checked')) {
                    toastr.options.onclick = function () {
                        alert('You can perform some custom action after a toast goes away');
                    };
                }
                if ($showDuration.val().length) {
                    toastr.options.showDuration = $showDuration.val();
                }
                if ($hideDuration.val().length) {
                    toastr.options.hideDuration = $hideDuration.val();
                }
                if ($timeOut.val().length) {
                    toastr.options.timeOut = $timeOut.val();
                }
                if ($extendedTimeOut.val().length) {
                    toastr.options.extendedTimeOut = $extendedTimeOut.val();
                }
                if ($showEasing.val().length) {
                    toastr.options.showEasing = $showEasing.val();
                }
                if ($hideEasing.val().length) {
                    toastr.options.hideEasing = $hideEasing.val();
                }
                if ($showMethod.val().length) {
                    toastr.options.showMethod = $showMethod.val();
                }
                if ($hideMethod.val().length) {
                    toastr.options.hideMethod = $hideMethod.val();
                }
                if (!msg) {
                    msg = getMessage();
                }
                $("#toastrOptions").text("Command: toastr["
                        + shortCutFunction
                        + "](\""
                        + msg
                        + (title ? "\", \"" + title : '')
                        + "\")\n\ntoastr.options = "
                        + JSON.stringify(toastr.options, null, 2)
                );
                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;
                if ($toast.find('#okBtn').length) {
                    $toast.delegate('#okBtn', 'click', function () {
                        alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                        $toast.remove();
                    });
                }
                if ($toast.find('#surpriseBtn').length) {
                    $toast.delegate('#surpriseBtn', 'click', function () {
                        alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                    });
                }
            });
            function getLastToast(){
                return $toastlast;
            }
            $('#clearlasttoast').click(function () {
                toastr.clear(getLastToast());
            });
            $('#cleartoasts').click(function () {
                toastr.clear();
            });
        
});


$('#area').hide();
$(".modal-open").click(function(){

    var url=$(this).data('url'),
        title = $(this).data('title');

        console.log(title);
    $('#create_form').attr('action', url);
    $('#modal-form .modal-body .head').text(title);
    form = $('#create_form');
    
    if(title!='Create Specification' && title!='Create Amenities' && title!='Create Project Gallery' && title!='Floor Plan' && title!='Create NewsImages' && title!="Create Key Information" && title!='Photo')
    {   
        form.find('input[name=_method]').val('PUT');
    }
    if(title=='Create Project Gallery')
    {
        $('#description').hide();
    }
    if(title=='Floor Plan')
    {
        $('#area').show();
        $('#description').hide();
    }
    if(title=='Create Specification')
    {
        $('#title').hide();
        $('#image').hide();
    }
    if(title=='Create Key Information')
    {
        $('#title').hide();
        $('#image').hide();
    }
});

$('.btnDeleteRow').click(function (e) {
    var url = $(this).data('url');
    e.preventDefault();

    swal({
        title: "Are you sure?",
        text: "You want to delete this !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (isConfirm) {
            var data = $('.deleteForm').serialize();
             $.ajax({
                    url: url,
                    type: "POST",
                    data: data ,
                    success: function (response) {
                        console.log(response);
                        if(response=='true')
                        {
                            swal("Deleted!", "Row has been deleted.", "success");
                            setTimeout(function(){ 
                                    location.reload();
                            }, 1000);
                            
                        }else{
                            swal("Error", "Oops Something went wrong :)", "error");
                        }
                       
                    },

                });     
            
        } else {
            swal("Cancelled", "Oops Something went wrong :)", "error");
        }
    });

});


$('.btnEditRow').click(function(e){
    e.preventDefault();
    var id =$(this).data('id'),
    title = $(this).data('title'),
    url = $(this).data('url');
    var row = $(this).parents('tr'),
    form = $('#create_form');
    form.find('input[name=_method]').val('PUT');
    if(title=='User Update')
    { 
        
        form.find('input[name=name]').val(row.children('td:nth-child(1)').text());
        form.find('input[name=email]').val(row.children('td:nth-child(2)').text());
    }
    if(title=='Floor Plan')
    {
        form.find('input[name=title]').val(row.children('td:nth-child(2)').text());
        form.find('input[name=area]').val(row.children('td:nth-child(3)').text());
    }
    if(title=='Video Update')
    {
        form.find('input[name=caption]').val(row.children('td:nth-child(2)').text());
        form.find('input[name=youtube_video_id]').val(row.children('td:nth-child(3)').find('#video_id').val());
    }
    if(title=='Role Update')
    {
        form.find('input[name=name]').val(row.children('td:nth-child(1)').text());
        form.find('textarea#description').val(row.children('td:nth-child(2)').text());
    }
    if(title=='Edit Key Information')
    {
        $('#title').hide();
        $('#image').hide();
        form.find('input[name=priority]').val(row.children('td:nth-child(2)').text());
        form.find('textarea#description').val(row.children('td:nth-child(3)').text());
    }

    if(title=='Edit Amenity')
    {
        // form.find('input[name=priority]').val(row.children('td:nth-child(2)').text());
        form.find('input[name=title]').val(row.children('td:nth-child(2)').text());
        // form.find('textarea#description').val(row.children('td:nth-child(3)').text());
        
    }

    if(title='photoImage Update')
    {
        form.find('input[name=caption]').val(row.children('td:nth-child(2)').text());
    }

    var data=form.serialize();

     $.ajax({
        url: url,
        type: "POST",
        data: data ,
        success: function (response) {
            console.log(response);
           
        },

    });   
});


$('#checkAll').on('ifChecked', function (e) { 
    $('input').iCheck('toggle');
})
