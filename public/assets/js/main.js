
$(function(){
    $("#addurl_form").validate({
        errorClass  : "errormesssage",
        ignore      : 'input[type="hidden"]',
        rules:{
            url: 
            {
                required    : true
            }
        },
        messages:{
            url : 
             {
                 required   : "Please provide url.",
             }
        },
        submitHandler: function(form)
        {
            try
            {
               
                $.ajax
                    ({
                    type    : "POST",
                    url     : $("#addurl_form").attr('action'),
                    data    : $('#addurl_form').serialize(),
                    dataType: "json",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    beforeSend: function()
                    {
                        $('#BtnSave').prop('disabled', true);
                        $("#BtnSave").html('Please wait..');
                    },
                    success: function(response)
                    {
                        console.log(response);
                        if(response.success == true)
                        {
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            })
                            //   setTimeout(() => {
                            //     //window.location.href = response.link;
                            //     location.reload();
                            //   }, "2000");
                            // location.reload();
                            $('#BtnSave').html('Submit');
                            $('#BtnSave').prop('disabled', false);
                            $('#addurl_form')[0].reset();
                        }
                        else
                        {
                             $('#addurl_form')[0].reset();
                             Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                            $('#BtnSave').prop('disabled', false);
                            $('#BtnSave').html('Submit');
                            $('#BtnSave').button('reset');
                        }

                    }
                });
            }
            catch(e)
            {
                console.log(e);
            }
        }
    });

    // UPGRADE LIMIT

    $("#upgrade_form").validate({
        errorClass  : "errormesssage",
        ignore      : 'input[type="hidden"]',
        rules:{
            upgrade: 
            {
                required    : true
            }
        },
        messages:{
            upgrade : 
             {
                 required   : "Please provide limit.",
             }
        },
        submitHandler: function(form)
        {
            try
            {
               
                $.ajax
                    ({
                    type    : "POST",
                    url     : $("#upgrade_form").attr('action'),
                    data    : $('#upgrade_form').serialize(),
                    dataType: "json",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    beforeSend: function()
                    {
                        $('#BtnSave').prop('disabled', true);
                        $("#BtnSave").html('Please wait..');
                    },
                    success: function(response)
                    {
                        console.log(response);
                        if(response.success == true)
                        {
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            })
                            setTimeout(() => {
                                 location.reload();
                               }, "1000");
                            $('#BtnSave').html('Upgrade');
                            $('#BtnSave').prop('disabled', false);
                            $('#upgrade_form')[0].reset();
                        }
                        else
                        {
                            $('#upgrade_form')[0].reset();
                            Toast.fire({
                               icon: 'error',
                               title: response.message
                           })
                           setTimeout(() => {
                            location.reload();
                           }, "2000");
                           $('#BtnSave').prop('disabled', false);
                           $('#BtnSave').html('Upgrade');
                           $('#BtnSave').button('reset');
                       }

                    }
                });
            }
            catch(e)
            {
                console.log(e);
            }
        }
    });


    // EDIT URL

    $("#edit_form").validate({
        errorClass  : "errormesssage",
        ignore      : 'input[type="hidden"]',
        rules:{
            url: 
            {
                required    : true
            }
        },
        messages:{
            url : 
             {
                 required   : "Please provide url.",
             }
        },
        submitHandler: function(form)
        {
            try
            {
               
                $.ajax
                    ({
                    type    : "POST",
                    url     : $("#edit_form").attr('action'),
                    data    : $('#edit_form').serialize(),
                    dataType: "json",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    beforeSend: function()
                    {
                        $('#BtnSave').prop('disabled', true);
                        $("#BtnSave").html('Please wait..');
                    },
                    success: function(response)
                    {
                        console.log(response);
                        if(response.success == true)
                        {
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            })
                              setTimeout(() => {
                                window.location.href = response.link;
                                // location.reload();
                              }, "2000");
                            // location.reload();
                            $('#BtnSave').html('Save Changes');
                            $('#BtnSave').prop('disabled', false);
                            $('#edit_form')[0].reset();
                        }
                        else
                        {
                            $('#edit_form')[0].reset();
                            Toast.fire({
                               icon: 'error',
                               title: response.message
                           })
                           $('#BtnSave').prop('disabled', false);
                           $('#BtnSave').html('Upgrade');
                           $('#BtnSave').button('reset');
                       }

                    }
                });
            }
            catch(e)
            {
                console.log(e);
            }
        }
    });

});

function deleteUrl(action,id)
{   
   var result = confirm("Do you surely want to delete ?");
   if(result)
   {
     $.ajax
        ({
            type    : "GET",
            url     : action,
            data    : {id:id},
            dataType: "json",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(response)
            {
                if(response.success==true)
                {
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })
                    setTimeout(() => {
                       // window.location.href = response.link;
                        location.reload();
                      }, "2000");
                }
                else
                {
                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    })
                    setTimeout(() => {
                        // window.location.href = response.link;
                         location.reload();
                       }, "2000");
                }

            }
        });
   }
    
}

// DEACTIVATE
function deactivateUrl(action,id)
{   
     $.ajax
        ({
            type    : "GET",
            url     : action,
            data    : {id:id},
            dataType: "json",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(response)
            {
                if(response.success==true)
                {
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })
                    setTimeout(() => {
                       // window.location.href = response.link;
                        location.reload();
                      }, "2000");
                }
                else
                {
                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    })
                    setTimeout(() => {
                        // window.location.href = response.link;
                         location.reload();
                       }, "2000");
                }

            }
        });
   
    
}

// ACTIVATE
// DEACTIVATE
function activateUrl(action,id)
{   
     $.ajax
        ({
            type    : "GET",
            url     : action,
            data    : {id:id},
            dataType: "json",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: function(response)
            {
                if(response.success==true)
                {
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })
                    setTimeout(() => {
                       // window.location.href = response.link;
                        location.reload();
                      }, "2000");
                }
                else
                {
                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    })
                    setTimeout(() => {
                        // window.location.href = response.link;
                         location.reload();
                       }, "2000");
                }

            }
        });
   
    
}