$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    getArrears()
    .then((response) => {
        $('.total-arrears').text(response.total_arrears)
    })
    .catch((error) => {
        $('.total-arrears').text('Invalid!')
    })
    $('#full_name').focusout(function(){
        if($(this).val() == ''){
            $('.account-name-container .icon-ex').css('display','block')
            $('#full_name').css('border-color','red')
            if($('.error-message-warning').length == 0){
                $('.error-message').addClass('error-message-warning');
                $('.error-message').text('Account name is required')
                $('.account-name-container .icon-wrong').css('display','none')
            }
        }else{
            checkFullName($(this).val())
            .then((response) => {
                $('#full_name').css('border-color','green')
                $('.account-name-container .icon-wrong').css('display','none')
                $('.account-name-container .icon-ex').css('display','none')
                $('.account-name-container .icon-check').css('display','block')
                $('.error-message').remove()
            })
            .catch((error) => {
                if(error.status >= 500){
                    if($('.error-message').length == 0){
                        $('<p class="error-message">Server connection error</p>').insertAfter('#full_name')
                    }else{
                        $('.error-message').text('Server connection error')
                    }
                }else{
                    $('.account-name-container .icon-wrong').css('display','block')
                    if($('.error-message-warning').length > 0){
                        $('.account-name-container .icon-ex').css('display','none')
                        $('.error-message').text('Account name is not a member consumer')
                    }
                    if($('.error-message').length == 0){
                        
                        $('<p class="error-message">Account name is not a member consumer</p>').insertAfter('#full_name')
                    }
                }
                $('#full_name').css('border-color','red')
                
            })
        }
    })
    $('#account_no').focus(function(){
        $('.account-no-container .icon-wrong').css('display','none')
        $('.account-no-container .icon-ex').css('display','none')
        $('.account-no-container .icon-check').css('display','none')
        $('#account_no').css('border-color','black')
        $('.error-message').remove()
        if($('#full_name').val() == ''){
            $('.account-name-container .icon-ex').css('display','block')
            $('#full_name').css('border-color','red')
            if($('.error-message-warning').length == 0){
                $('.error-message').addClass('error-message-warning');
                $('<p class="error-message">Account name is required</p>').insertAfter('#full_name')
                $('.account-name-container .icon-wrong').css('display','none')
            }
        }
    })
    $('#account_no').focusout(function(){
        if($(this).val() == ''){
            $('.account-no-container .icon-ex').css('display','block')
            $('#account_no').css('border-color','red')
            if($('.error-message-warning').length == 0){
                $('.error-message').addClass('error-message-warning');
                $('<p class="error-message">Account number is required</p>').insertAfter('#account_no')
                $('.account-no-container .icon-wrong').css('display','none')
            }
        }else{
            checkAccountNo($(this).val())
            .then((response) => {
                $('#account_no').css('border-color','green')
                $('.account-no-container .icon-wrong').css('display','none')
                $('.account-no-container .icon-ex').css('display','none')
                $('.account-no-container .icon-check').css('display','block')
                $('.error-message').remove()
            })
            .catch((error) => {
                if(error.status >= 500){
                    if($('.error-message').length == 0){
                        $('<p class="error-message">Server connection error</p>').insertAfter('#account_no')
                    }else{
                        $('.error-message').text('Server connection error')
                    }
                }else{
                    $('.account-no-container .icon-wrong').css('display','block')
                    if($('.error-message-warning').length > 0){
                        $('.account-no-container .icon-ex').css('display','none')
                        $('.error-message').text('Account number is not a member consumer')
                    }
                    if($('.error-message').length == 0){
                        $('<p class="error-message">Account number is not a member consumer</p>').insertAfter('#account_no')
                    }
                }
                $('#account_no').css('border-color','red')
            })
        }
    })
    $('#current_pass').focusout(function(){
        if($(this).val() == ''){
            $('.account-current-pass-container .icon-ex').css('display','block')
            $('#current_pass').css('border-color','red')
            if($('.error-message-warning').length == 0){
                $('.error-message').addClass('error-message-warning');
                $('<p class="error-message">This field is required</p>').insertAfter('#current_pass')
                $('.account-current-pass-container .icon-wrong').css('display','none')
            }
        }else{
            checkCurrentPassword($(this).val())
            .then((response) => {
                $('#current_pass').css('border-color','green')
                $('.account-current-pass-container .icon-wrong').css('display','none')
                $('.account-current-pass-container .icon-ex').css('display','none')
                $('.account-current-pass-container .icon-check').css('display','block')
                $('.error-message').remove()
            })
            .catch((error) => {
                if(error.status >= 500){
                    if($('.error-message').length == 0){
                        $('<p class="error-message">Server connection error</p>').insertAfter('#current_pass')
                    }else{
                        $('.error-message').text('Server connection error')
                    }
                }else{
                    $('.account-current-pass-container .icon-wrong').css('display','block')
                    if($('.error-message-warning').length > 0){
                        $('.account-current-pass-container .icon-ex').css('display','none')
                        $('.error-message').text('Password does not match the record!')
                    }
                    if($('.error-message').length == 0){
                        $('<p class="error-message">Password does not match the record!</p>').insertAfter('#current_pass')
                    }
                }
                $('#current_pass').css('border-color','red')
            })
        }
    })
    $('#current_pass').focus(function(){
        $('#current_pass').css('border-color','black')
        $('.account-current-pass-container .icon-wrong').css('display','none')
        $('.account-current-pass-container .icon-ex').css('display','none')
        $('.account-current-pass-container .icon-check').css('display','none')
        $('.account-current-pass-container .error-message').remove()
    })
    $('#n_pass').focus(function(){
        if($('#current_pass').val() == ''){
            $('.account-current-pass-container .icon-ex').css('display','block')
            $('#current_pass').css('border-color','red')
            if($('.error-message-warning').length == 0){
                $('.error-message').addClass('error-message-warning');
                $('<p class="error-message">This field is required</p>').insertAfter('#current_pass')
                $('.account-current-pass-container .icon-wrong').css('display','none')
            }else{
                $('<p class="error-message">This field is required</p>').insertAfter('#current_pass')
            }
        }
        $('#n_pass').css('border-color','black')
        $('.account-new-pass-container .icon-wrong').css('display','none')
        $('.account-new-pass-container .icon-ex').css('display','none')
        $('.account-new-pass-container .icon-check').css('display','none')
        $('.account-new-pass-container .error-message').remove()
    
    })
    $('#c_n_pass').focus(function(){
        if($('#n_pass').val() == ''){
            $('.account-new-pass-container .icon-ex').css('display','block')
            $('#n_pass').css('border-color','red')
            if($('.error-message-warning').length == 0){
                $('.error-message').addClass('error-message-warning');
                $('<p class="error-message">This field is required</p>').insertAfter('#n_pass')
                $('.account-new-pass-container .icon-wrong').css('display','none')
            }else{
                $('<p class="error-message">This field is required</p>').insertAfter('#n_pass')
            }
        }
        if($('#current_pass').val() == ''){
            $('.account-current-pass-container .icon-ex').css('display','block')
            $('#current_pass').css('border-color','red')
            if($('.error-message-warning').length == 0){
                $('.error-message').addClass('error-message-warning');
                $('<p class="error-message">This field is required</p>').insertAfter('#current_pass')
                $('.account-current-pass-container .icon-wrong').css('display','none')
            }
        }
    })
})
$(document).on('click','.consumer_save',function(){
    event.preventDefault()
    var ex = '/user/update'
    validateInput($('#full_name').val(),$('#account_no').val())
    .then((response) => {
        $.ajax({
            url: rootDirectory(ex),
            dataType: "json",
            method: "post",
            data: {
                full_name: $('#full_name').val(),
                account_no: $('#account_no').val()
            },
            success: function(data){
                Swal.fire(
                    'Success!',
                    'User information was saved!',
                    'success'
                )
                location.reload()
            },
            error: function(error){
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong!',
                })
            }
        })
    })
    .catch((error) => {
        $('#account_no').css('border-color','red')
        Swal.fire({
            icon: 'error',
            title: 'Not found!',
            text: 'Inputted data did not match from the records',
        })
    })
    
})
$(document).on('click','.change-password-user',function(){
    let userAccount = $('#user-account').val()
    var npass = $('#n_pass').val()
    var c_npass = $('#c_n_pass').val()
    if(npass.localeCompare(c_npass) != 0){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'New password is not equal to confirm password!',
        })
    }else{
        let ex = '/logout'
        userChangePass(npass,$('#current_pass').val(),userAccount)
        .then((response) => {
            $.ajax
            ({
                method: 'POST',
                url: rootDirectory(ex),
                success: function()
                {
                    location.reload();
                }
            });
        })
        .catch((error) => {
            console.log(error)
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: error,
            })
        })
    }
})
function userChangePass(n_pass,c_pass,id){
    var ex =  '/user/change/password';
    return new Promise((resolve,reject) => {
        $.ajax({
            url: rootDirectory(ex),
            dataType: "json",
            method: "post",
            data: {
                password: c_pass,
                user_id: id,
                new_password: n_pass 
            },
            success: function(data){
                resolve(data)
            },
            error: function(error){
                reject(error)
            }
        })
    })    
}
function checkFullName(fullname){
     var ex =  '/user/fullname';
    return new Promise((resolve,reject) => {
        $.ajax({
            url: rootDirectory(ex),
            dataType: "json",
            method: "post",
            data: {
                full_name: fullname
            },
            success: function(data){
                resolve(data)
            },
            error: function(error){
                reject(error)
            }
        })
    })
}
function checkAccountNo(accountno){
    var ex =  '/user/accountno';
   return new Promise((resolve,reject) => {
       $.ajax({
           url: rootDirectory(ex),
           dataType: "json",
           method: "post",
           data: {
               account_no: accountno
           },
           success: function(data){
               resolve(data)
           },
           error: function(error){
               reject(error)
           }
       })
   })
}
function validateInput(fullname,accountno){
    var ex =  '/user/input_validation';
    return new Promise((resolve,reject) => {
       $.ajax({
           url: rootDirectory(ex),
           dataType: "json",
           method: "post",
           data: {
               full_name: fullname,
               account_no: accountno
           },
           success: function(data){
               resolve(data)
           },
           error: function(error){
               reject(error)
           }
       })
   })
}
function checkCurrentPassword(current_pass){
    var ex =  '/check/user/password';
    let userAccount = $('#user-account').val()
    return new Promise((resolve,reject) => {
       $.ajax({
           url: rootDirectory(ex),
           dataType: "json",
           method: "post",
           data: {
               password: current_pass,
               user_id: userAccount
           },
           success: function(data){
               resolve(data)
           },
           error: function(error){
               reject(error)
           }
       })
   })
}
function getArrears(){
    var ex =  '/user/total_arrears';
    let userAccount = $('#user-account').val()
    return new Promise((resolve,reject) => {
       $.ajax({
           url: rootDirectory(ex),
           dataType: "json",
           method: "post",
           data: {
                mr_account_no: userAccount
           },
           success: function(data){
               resolve(data)
           },
           error: function(error){
               reject(error)
           }
       })
   })
}
function rootDirectory(ext){
    var root = window.location.protocol + '//' + window.location.host;
    var GET_USERS_URL = root + ext;
    return GET_USERS_URL;
}