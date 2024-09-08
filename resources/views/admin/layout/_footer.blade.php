<?php
$_action = app('request')->route()->getAction(); 
$isController = class_basename($_action['controller']);
$expl = explode('@',$isController);
?>
    <footer>
        <p>{{date('Y')}} &copy; {{ config('app.project.name') }} Admin.</p>
    </footer>

    <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>
</div>
<!-- END Content -->

</div>
<!-- END Container -->

<script type="text/javascript">
    var oops = "oops";
    var are_you_sure  = "Are you sure.";
    var please_select_the_record_to_perform_this_action ="Please select the record to perform this action";
    var do_you_really_want_to_delete_selected_records = "Do you really want to delete selected records";
    var do_you_really_want_to_deactivate_selected_records = "do you really want to deactivate selected records";
    var do_you_really_want_to_activate_selected_records = "Do you really want to activate selected records";
    $(document).ready(function() {
        function checkImg(img) {
            if (img.naturalHeight <= 1 && img.naturalWidth <= 1) {
                // undersize image here
                img.src = "{{url('').'/uploads/default.png' }}";
            }
        }
        $("img").each(function() {
            // if image already loaded, we can check it's height now
            if (this.complete) {
                checkImg(this);
            } else {
                // if not loaded yet, then set load and error handlers
                $(this).load(function() {
                    checkImg(this);
                }).error(function() {
                    // img did not load correctly
                    // set new .src here
                    this.src = "{{url('').'/uploads/default.png' }}";
                });
            }
        });
    });
</script>

<script type="text/javascript" src="{{ url('/') }}/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="{{ url('/') }}/assets/jquery-cookie/jquery.cookie.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/jquery-validation/dist/additional-methods.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
<script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/chosen-bootstrap/chosen.jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="{{url('')}}/js/admin/jquery.blockUI.js"></script>
<script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<!--flaty scripts-->
<script type="text/javascript" src="{{ url('/') }}/js/admin/flaty.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/admin/flaty-demo-codes.js"></script>
<script type="text/javascript" src="{{ url('/') }}/js/admin/validation.js"></script>
<script type="text/javascript" src="{{ url('/') }}/assets/alert/js/alert.js"></script>
<script type="text/javascript">
var imgUrl = '{{url('')}}/';
$(document).ready(function(){
    console.log(window.location.href);
})
$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var strURL = $(this).attr('href');
    getDataContent(strURL);
});

function getDataContent(_url) 
{
    window.history.pushState({path:_url},'',_url);
    $.ajax({
        url : _url
    }).done(function (data) {
        $('.replaceableContent').html(data);  
    }).fail(function () {
      alert('internal error');
    });
}

$(document).ajaxStart(function() {
   beforeLoad();
});
$(document).ajaxStop(function() {
   $('body').unblock();
});
function beforeLoad()
{
    $('body').block({ 
        message: '<h1>Processing</h1>',
        css: {
          border: 'none',
          padding: '15px',
          backgroundColor: '#000',
          '-webkit-border-radius': '10px',
          '-moz-border-radius': '10px',
          opacity: .5,
          color: '#fff'
      }
    });
}

$(document).on('click','.open-order-modal',function(){
  var senderId = $(this).data('sender-id');
  $('input[name="txtSenderId"]').val(senderId);
  getPharmacies();
});

function getPharmacies()
{
    $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : SITE_URL+'/users/get-pharmacies/',
        type     : "get",
        dataType : "json",
        /*data     : {id:id,quantity:qty},*/
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            if(execGetUser != null){
                execGetUser.abort();
            }
            $('select[name="selPharmacy"]').html('<option value="">select pharmacy<\/option>');
            $('input[name="fileName"],input[name="txtName"],input[name="txtMobileNumber"]').val('');
            
        },
        success : function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            execGetUser = null;
            if(data.status == 'success')
            {
                
                var arrPharmacies = ['<option value="">select pharmacy<\/option>'];
                var pharmaciesList = data.pharmaciesList;
                if(pharmaciesList.length > 0)
                {
                    $.each(pharmaciesList, function(i, val){
                        var obj = pharmaciesList[i];
                        arrPharmacies.push('<option value="'+obj.id+'">'+obj.name+'<\/option>');
                    });
                }
                $('select[name="selPharmacy"]').html(arrPharmacies.join(''));
                
               $("#orderModal").modal('show');
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml = $('#error-'+key).html(value);
                        alert(value);
                    });
                }
            }
        },
        error:function(data, statusText, xhr, wrapper){
            $('body').unblock();
            execGetUser = null;
            alert('error');
        }
    });
}

var execCreateOrder = null;
$('form[name="frmProcessOrder"]').on('submit',(function(e){
    e.preventDefault();
    $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : SITE_URL+'/users/create-order/',
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'json',
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            if(execCreateOrder != null){
                execCreateOrder.abort();
            }
        },
        success: function(data, statusText, xhr, wrapper)
        {
            if(data.status == 'success')
            {
                var _userType = $('.clsUserType').data('usertype');
                alert(data.userMsg);
                if(data.recStatus == "existed")
                {
                    getDataContent(window.location.href);
                }
                else{
                    getDataContent(SITE_URL+'/users/manage/'+_userType+'/');
                }
                $("#orderModal").modal('hide');
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml += value+"\n";
                    });
                    alert(errorsHtml);
                }
            }
        },
        error: function(data, statusText, xhr, wrapper)
        {

        }
    });
}));

$(document).on('click','.open-user-modal',function(){
  var _url = $(this).data('url');
  getUserDetails(_url);
});

var execGetUser = null;
function getUserDetails(_url)
{
    execGetUser = $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : _url,
        type     : "get",
        dataType : "json",
        /*data     : {id:id,quantity:qty},*/
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            if(execGetUser != null){
                execGetUser.abort();
            }
            $('.userName').html('');
            $('select[name="selCity"]').html('<option value="">select city<\/option>');
            $('input[name="firstName"],input[name="lastName"],input[name="txtDOB"],input[name="mobileNumber"],input[name="txtAddress"],input[name="mobileNumber"]').val('');
            $('select[name="selState"],select[name="txtPostcode"]').index(0);
        },
        success : function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            execGetUser = null;
            if(data.status == 'success')
            {
                var userDetails = data.userDetails;
                if(userDetails.length > 0)
                {
                    $('.userName').html(userDetails[0]['firstName']+' '+userDetails[0]['lastName'])
                    $('input[name="txtId"]').val(userDetails[0]['id']);
                    $('input[name="firstName"]').val(userDetails[0]['firstName']);
                    $('input[name="lastName"]').val(userDetails[0]['lastName']);
                    $('input[name="txtDOB"]').val(userDetails[0]['dateOfBirth']);
                    $('input[name="mobileNumber"]').val(userDetails[0]['mobileNumber']);
                    $('input[name="txtRegistrationNo"]').val(userDetails[0]['registrationNo']);

                    if(userDetails[0]['userType'] == "pharmacy")
                    {
                        $('input[name="txtAddress"]').val(userDetails[0]['address']);
                        $('input[name="txtPostcode"]').val(userDetails[0]['zipcode']);
                        $('#selState > option').eq(userDetails[0]['state']).attr('selected','selected');
                        var arrCities = [];
                        var citiesList = data.citiesList;
                        if(citiesList.length > 0)
                        {
                            $.each(citiesList, function(i, val){
                                var obj = citiesList[i];
                                var _selected = userDetails[0]['city'] == obj.id ? 'selected="selected"':'';
                                arrCities.push('<option value="'+obj.id+'" '+_selected+'>'+obj.name+'<\/option>');
                            });
                        }
                        $('select[name="selCity"]').html(arrCities.join(''));
                    }
                }
               $("#userModal").modal('show');
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml = $('#error-'+key).html(value);
                        alert(value);
                    });
                }
            }
        },
        error:function(data, statusText, xhr, wrapper){
            $('body').unblock();
            execGetUser = null;
            alert('error');
        }
    });
}

$(document).on('click','button[name="btnContinue"]',function(){
    setUserDetails();
});

execProcessUser = null;
function setUserDetails(_url)
{
    execProcessUser = $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : '{{url('')}}/superadmin/users/process/',
        type     : "POST",
        dataType : "json",
        data     : $('form[name="frmProcessUser"]').serialize(),
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            if(execProcessUser != null){
                execProcessUser.abort();
            }
        },
        success : function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            execProcessUser = null;
            if(data.status == 'success')
            {
                $('.userName').html($('input[name="firstName"]').val()+' '+$('input[name="lastName"]').val());
                var _userType = $('.clsUserType').data('usertype');
                alert(data.userMsg);
                if(data.recStatus == "existed")
                {
                    getDataContent(window.location.href);
                }
                else{
                    getDataContent(SITE_URL+'/users/manage/'+_userType+'/');
                }
                $("#userModal").modal('hide');
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml += value+"\n";
                    });
                    alert(errorsHtml);
                }
            }
        },
        error:function(data, statusText, xhr, wrapper){
            $('body').unblock();
            execProcessUser = null;
            alert('error');
        }
    });
}

execUserStatus = null;
$(document).on('click','a.changeStatus',function(_event){
    _event.preventDefault();
    var _url = $(this).attr('href');
    if(confirm('Are you sure! you want to change the status of selected user?'))
    {
        setUserStatus(_url);
    }
    else{
        return false;
    }
});
function setUserStatus(_url)
{
    execUserStatus = $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : _url,
        type     : "get",
        dataType : "json",
        data     : '',
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            if(execUserStatus != null){
                execUserStatus.abort();
            }
        },
        success : function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            execUserStatus = null;
            if(data.status == 'success')
            {
                alert(data.userMsg);
                getDataContent(window.location.href);
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml += value+"\n";
                    });
                    alert(errorsHtml);
                }
            }
        },
        error:function(data, statusText, xhr, wrapper){
            $('body').unblock();
            execUserStatus = null;
            alert('error');
        }
    });
}


execUserDelete = null;
$(document).on('click','a.deleteUser',function(_event){
    _event.preventDefault();
    var _url = $(this).attr('href');
    if(confirm('Are you sure! you want to delete the selected user?'))
    {
        deleteUser(_url);
    }
    else{
        return false;
    }
});
function deleteUser(_url)
{
    execUserDelete = $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : _url,
        type     : "get",
        dataType : "json",
        data     : '',
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            if(execUserDelete != null){
                execUserDelete.abort();
            }
        },
        success : function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            execUserDelete = null;
            if(data.status == 'success')
            {
                alert(data.userMsg);
                getDataContent(window.location.href);
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml += value+"\n";
                    });
                    alert(errorsHtml);
                }
            }
        },
        error:function(data, statusText, xhr, wrapper){
            $('body').unblock();
            execUserDelete = null;
            alert('error');
        }
    });
}
var execCityList = null;
$(document).on('change','select[name="selState"]',function(_event){
    var stateId = $(this).val();
    if(stateId!='')
    {
        getCities(stateId);
    }
    else{
        $('select[name="selCity"]').html('<option value="">select city<\/option>');
    }

});
function getCities(_stateId)
{
    execCityList = $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : SITE_URL+'/users/get-cities',
        type     : "post",
        dataType : "json",
        data     : {state_id:_stateId},
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            if(execCityList != null){
                execCityList.abort();
            }
            $('select[name="selCity"]').html('<option value="">select city<\/option>');
        },
        success : function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            execCityList = null;
            if(data.status == 'success')
            {
                var arrCities = [];
                var citiesList = data.citiesList;
                if(citiesList.length > 0)
                {
                    $.each(citiesList, function(i, val){
                        var obj = citiesList[i];
                        arrCities.push('<option value="'+obj.id+'">'+obj.name+'<\/option>');
                    });
                }
                $('select[name="selCity"]').html(arrCities.join(''));
            }
        },
        error:function(data, statusText, xhr, wrapper){
            $('body').unblock();
            execCityList = null;
            console.log('error');
        }
    });
}

/*********Prescription Orders************/

$(document).on('click','button[name="btnRejectPrescription"]',function(_event){
    var _id = $('input[name="txtOrderId"]').val();
    if(confirm('Are you sure! you want to change the status of selected order?'))
    {
        var _url = SITE_URL+'/order_history/order/reject?id='+_id;
        _acceptOrder(_url,'yes');
    }
    else{
        return false;
    }
});

$(document).on('click','button[name="btnAcceptPrescription"]',function(_event){
    var _id = $('input[name="txtOrderId"]').val();
    var _url = SITE_URL+'/order_history/order/accept?id='+_id;
    _acceptOrder(_url,'yes');
});

acceptOrder = null;
$(document).on('click','.clsAcceptOrder,.clsRejectOrder',function(_event){
    _event.preventDefault();

    if(confirm('Are you sure! you want to change the status of selected order?'))
    {
        var _url = this.href;
        _acceptOrder(_url,'no');
    }
    else{
        return false;
    }
});

function _acceptOrder(_url, _refresh)
{
    acceptOrder = $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : _url,
        type     : "POST",
        dataType : "json",
        data     : '',
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            if(acceptOrder != null){
                acceptOrder.abort();
            }
        },
        success : function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            acceptOrder = null;
            if(data.status == 'success')
            {
                if(_refresh == 'yes')
                {
                    $("#prescriptionModal").modal('hide');
                }
                alert(data.userMsg);
                getDataContent(window.location.href);
                /*$('.userName').html($('input[name="firstName"]').val()+' '+$('input[name="lastName"]').val());
                var _userType = $('.clsUserType').data('usertype');
                if(data.recStatus == "existed")
                {
                    getDataContent(window.location.href);
                }
                else{
                    getDataContent(SITE_URL+'/users/manage/'+_userType+'/');
                }
                $("#userModal").modal('hide');*/
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml += value+"\n";
                    });
                    alert(errorsHtml);
                }
            }
        },
        error:function(data, statusText, xhr, wrapper){
            $('body').unblock();
            acceptOrder = null;
            alert('error');
        }
    });
}

viewOrder = null;
$(document).on('click','.clsViewOrder',function(_event){
    _event.preventDefault();
    var _url = this.href;
    _viewOrder(_url);
});


String.prototype.ucwords = function() {
    str = this.toLowerCase();
    return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
    function($1){
        return $1.toUpperCase();
    });
}
function ImageExist(url) 
{
   var img = new Image();
   img.src = url;
   return img.height != 0;
}
function fileExists(url) {
    if(url){
        var req = new XMLHttpRequest();
        req.open('GET', url, false);
        req.send();
        return req.status==200;
    } else {
        return false;
    }
}
function _viewOrder(_url)
{
    viewOrder = $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : _url,
        type     : "POST",
        dataType : "json",
        data     : '',
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            if(viewOrder != null){
                viewOrder.abort();
            }
        },
        success : function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            viewOrder = null;
            if(data.status == 'success')
            {
                var dataOrders = data.dataOrders;
                if(dataOrders['senderUT'] == "patient" && dataOrders['sentForUT'] == "doctor")
                {
                    var _labelSender      =   'Patient Name';
                    var _labelSentFor     =   'Refered by Dr.';
                    var _labelSenderName  =   dataOrders['senderFullName'].ucwords();
                    if(dataOrders['is_doctor_unverified'] == '1')
                    {
                        var _labelSentForName =   dataOrders['docsentForFullName'].ucwords();
                    }
                    else
                    {
                        var _labelSentForName =   dataOrders['sentForFullName'].ucwords();
                    }
                    var _labelMobile      =   dataOrders['senderMobile'].ucwords();
                }
                else
                {
                    var _labelSender      =   'Refered by Dr.';
                    var _labelSentFor     =   'Patient Name';
                    var _labelSenderName  =   dataOrders['senderFullName'].ucwords();
                    if(dataOrders['is_doctor_unverified'] == '1')
                    {
                        var _labelSentForName =   dataOrders['docsentForFullName'].ucwords();
                    }
                    else
                    {
                        var _labelSentForName =   dataOrders['sentForFullName'].ucwords();
                    }
                    var _labelMobile      =   dataOrders['sentForMobile'].ucwords();
                }
                $('.clsSenderName').html(_labelSender);
                $('.clsSentForName').html(_labelSentFor);
                var _imageFound = fileExists(imgUrl+dataOrders['prescriptionImage']);
                if(_imageFound)
                {
                    $('.clsPrescriptionImage').attr('src',imgUrl+dataOrders['prescriptionImage']);
                    console.clear();
                }
                else{
                    $('.clsPrescriptionImage').attr('src',imgUrl+'images/img-not-found.png');
                    console.clear();
                }

                $('input[name="txtSenderName"]').val(_labelSenderName);
                $('input[name="txtSentForName"]').val(_labelSentForName);
                $('input[name="txtMobileNumber"]').val(_labelMobile);
                $('input[name="txtOrderId"]').val(dataOrders['orderKey']);
                /*
                if(data.recStatus == "existed")
                {
                    getDataContent(window.location.href);
                }
                else{
                    getDataContent(SITE_URL+'/users/manage/'+_userType+'/');
                }*/
                $("#prescriptionModal").modal('show');
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml += value+"\n";
                    });
                    alert(errorsHtml);
                }
            }
        },
        error:function(data, statusText, xhr, wrapper){
            $('body').unblock();
            viewOrder = null;
            alert('error');
        }
    });
}
completeOrder = null;
$(document).on('click','.clsCompleteOrder',function(_event){
    _event.preventDefault();
    var _url = this.href;
    _openCompleteOrder(_url);
});
function _openCompleteOrder(_url)
{
    completeOrder = $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : _url,
        type     : "POST",
        dataType : "json",
        data     : '',
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            if(completeOrder != null){
                completeOrder.abort();
            }
            $('input[name="txtOrderValue"]').val('');
        },
        success : function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            completeOrder = null;
            if(data.status == 'success')
            {
                var dataOrders = data.dataOrders;
                $('input[name="_txtOrderId"]').val(dataOrders['orderKey']);
                /*
                if(data.recStatus == "existed")
                {
                    getDataContent(window.location.href);
                }
                else{
                    getDataContent(SITE_URL+'/users/manage/'+_userType+'/');
                }*/
                $("#completeModal").modal('show');
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml += value+"\n";
                    });
                    alert(errorsHtml);
                }
            }
        },
        error:function(data, statusText, xhr, wrapper){
            $('body').unblock();
            completeOrder = null;
            alert('error');
        }
    });
}

var execCreateOrder = null;
$('form[name="frmCompletePrescription"]').on('submit',(function(e){
    e.preventDefault();
    $.ajax({
        headers  : {'X-CSRF-Token': $('input[name="_token"]').val()},
        url      : SITE_URL+'/order_history/complete-order/',
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:'json',
        beforeSend: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            if(execCreateOrder != null){
                execCreateOrder.abort();
            }
        },
        success: function(data, statusText, xhr, wrapper)
        {
            if(data.status == 'success')
            {
                alert(data.userMsg);
                getDataContent(window.location.href);
                $("#completeModal").modal('hide');
            }
            else
            {
                if(data.userMsg!='')
                {
                    alert(data.userMsg)
                }
                if(data.errors != '')
                {
                    var errorsHtml = '';
                    $.each(data.errors, function( key, value ) {
                        errorsHtml += value+"\n";
                    });
                    alert(errorsHtml);
                }
            }
        },
        error: function(data, statusText, xhr, wrapper)
        {
            $('body').unblock();
            completeOrder = null;
            alert('error');
        }
    });
}));
/*********Prescription Orders************/

$('#txtDOB').datepicker({ 
  dateFormat: "dd-mm-yy",
  setDate: new Date()
});
</script>
</body>
</html>
