if (jQuery().validate) 
{
    var removeSuccessClass = function(e) 
    {
        $(e).closest('.form-group').removeClass('has-success');
    }

    function applyValidationToFrom(frm_ref)
    {
        $(frm_ref).validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.next('.chosen-container').length) {
                    error.insertAfter(element.next('.chosen-container'));
                } else {
                    error.insertAfter(element);
                }
            },
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",

            invalidHandler: function (event, validator) { //display error alert on form submit              
                var el = $(validator.errorList[0].element);
                if ($(el).hasClass('chosen')) {
                    $(el).trigger('chosen:activate');
                } else {
                    $(el).focus();
                }
            },

            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change dony by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                setTimeout(function(){removeSuccessClass(element);}, 3000);
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
            }
        });

    }
}

$("#state").on('change', function(){
    var state = $(this).val();
    if(state != '')
    {
        $.ajax({
            headers : {'X-CSRF-Token': $('input[name="_token"]').val()},
            url : SITE_URL+'/get_city',
            type:'POST',
            dataType:'json',
            data:{state:state},
            success:function(responce){
                //alert(responce.city_rec);
                if(responce.status=='success')
                {
                    var citiesList = ['<option value="" disabled="disabled" selected="selected">Select</option>'];
                    if(responce.city_rec.length > 0)
                    {
                        var _output = responce.city_rec;
                        var _optionsList = '';
                        $.each(_output, function(i, val)
                        {
                            var obj = _output[i];
                            _optionsList += '<option value="'+obj.id+'">'+obj.city_title+'</option>';
                        });
                        citiesList.push(_optionsList);
                    }
                    $("#city").html(citiesList.join(''));
                }
                else
                {
                    var citiesList = ['<option value="" disabled="disabled" selected="selected">Select</option>'];
                    $("#city").html(citiesList.join(''));
                }
            }
        })
    }
    else
    {
        return false;
    }
});