$('#res_type').on('change',function(){
    if($(this).val() == 3)$('#res_val_div').show();
    else $('#res_val_div').hide();
});

