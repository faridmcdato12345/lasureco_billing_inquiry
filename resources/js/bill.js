$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#show_bill').click(function(){
    if($('#bill_period').val() == ''){
        Swal.fire({
            icon: 'error',
            title: 'Billing Date Error!',
            text: 'Billing date is required!',
        })
    }else{
        console.log($('#bill_period').val())
        getUserInfo($(this).val())
        .then((resolve) => {
            showPowerBill(resolve.account_no,$('#bill_period').val())
            .then((resolve) => {
                let status = (resolve[0].mr_status == 0) ? 'Unpaid' : 'Paid'
                let dueDate = new Date(resolve[0].mr_due_date)
                let discDate = new Date(resolve[0].mr_discon_date)
                var formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'PHP',
                  });
                let dataDiv = '<h5 class="mb-2 text-sm sm:text-2xl md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Result</h5>'
                +'<hr>'
                +'<table class="table">'
                +'<tbody>'
                +'<tr>'
                +'<td><b>Bill Status:</b></td>'
                +'<td class="bill-result">'+status+'</td>'
                +'</tr>'
                +'<tr>'
                +'<td><b>Bill Date:</b></td>'
                +'<td class="bill-result">'+resolve[0].mr_date_year_month+'</td>'
                +'</tr>'
                +'<tr>'
                +'<td><b>Due Date:</b></td>'
                +'<td class="bill-result">'+dueDate.toDateString()+'</td>'
                +'</tr>'
                +'<tr>'
                +'<td><b>Disconnection Date:</b></td>'
                +'<td class="bill-result">'+discDate.toDateString()+'</td>'
                +'</tr>'
                +'<tr>'
                +'<td><b>Previous Reading:</b></td>'
                +'<td class="bill-result">'+resolve[0].mr_prev_reading+'</td>'
                +'</tr>'
                +'<tr>'
                +'<td><b>Present Reading:</b></td>'
                +'<td class="bill-result">'+resolve[0].mr_pres_reading+'</td>'
                +'</tr>'
                +'<tr>'
                +'<td><b>KWH Used:</b></td>'
                +'<td class="bill-result">'+resolve[0].mr_kwh_used+'</td>'
                +'</tr>'
                +'<tr>'
                +'<td><b>Bill Amount:</b></td>'
                +'<td class="bill-result">'+formatter.format(resolve[0].mr_amount)+'</td>'
                +'</tr>'
                +'</tbody>'
                '</table>'
                $('.card-data').html(dataDiv)
            })
            .catch((error) => {
                if(error.status >= 500){
                    $('.card-data').html('<h5 class="mb-2 text-sm md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">SERVER CONNECTION ERROR.</h5>')
                }else{
                    $('.card-data').html('<h5 class="mb-2 text-sm md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">No power bill for the given date.</h5>')
                }
            })
        })
        .catch((error) => {
        })
    }
})
window.onload  = () => {
    var ex =  '/check/user/account';
    // let urlUpdate = url.replace(':id',$('#user-account').val())
    $.ajax({
        url: rootDirectory(ex),
        dataType: "json",
        method: "post",
        data: {
            id: $('#user-account').val()
        },
        success: function(data){
            toggleModal(false)
        },
        error: function(error){
            toggleModal(true)
        }
    })
}

function getUserInfo(id){
    var ex =  '/user/show';
    return new Promise((resolve,reject) => {
       $.ajax({
           url: rootDirectory(ex),
           dataType: "json",
           method: "post",
           data: {
                user_id: id,
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
function showPowerBill(account_no,bill_date){
    var ex =  '/user/inquiry/powerbill';
    return new Promise((resolve,reject) => {
        $.ajax({
            url: rootDirectory(ex),
            dataType: "json",
            method: "post",
            data: {
                 mr_account_no: account_no,
                 mr_bill_date: bill_date
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
function toggleModal(show = true){
    const modalEl = document.getElementById("authentication-modal");
    if (show) {
      modalEl.classList.add('flex');
      modalEl.classList.remove('hidden');
      modalEl.setAttribute('aria-modal', 'true');
      modalEl.setAttribute('role', 'dialog');
      modalEl.removeAttribute('aria-hidden'); // create backdrop element
  
      var backdropEl = document.createElement('div');
      backdropEl.setAttribute('modal-backdrop', '');
      backdropEl.classList.add('bg-gray-900', 'bg-opacity-50', 'dark:bg-opacity-80', 'fixed', 'inset-0', 'z-40');
      document.querySelector('body').append(backdropEl);
    } 
    else {
      modalEl.classList.add('hidden');
      modalEl.classList.remove('flex');
      modalEl.setAttribute('aria-hidden', 'true');
      modalEl.removeAttribute('aria-modal');
      modalEl.removeAttribute('role');
      document.querySelector('[modal-backdrop]').remove();
    }
};

