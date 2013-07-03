var App =(function ($, document,path) {
    var sitepath=path;
   
    return {
        getpath:function(){
            return sitepath;
        },
        validate_form:function(){
            $('#univer').append('<option value="0">อื่นๆ</option>');
            $('#univer').change(function(){
                if($('#univer').val()==0){
                    $('#otherU').show();
                }else{
                    $('#otherU').hide();
                }
            }); 
            $('#photo').change(function(){
                var jpg= $('#photo').attr('value').lastIndexOf(".jpg")==-1;
                var png=$('#photo').attr('value').lastIndexOf(".png")==-1;
                console.log(jpg);
                console.log(png);
                if(jpg && png){
                    alert('รูปต้องเป็นนามสกุล jpg หรือ png');
                    $('#photo').attr('value','');
                } 
            });
          
            $( "#application-form" ).validate({
                rules:{
                    mphone:{
                        digits:true
                    },
                    phone:{
                        digits:true
                    },
                    ID_Card:{
                        digits:true
                    }
                },
                message:{},
                errorClass :'inputError',
                validClass :'inputSuccess',
                errorElement :'p',
                errorPlacement:function(error,invalid){               
                    error.appendTo(invalid.parent());
                },
                highlight: function(element) {     
                    $(element).closest('.control-group').removeClass('success').addClass('error');
                },
                success: function(element) {
                    element
                    .text('OK!').addClass('help-block')
                    .closest('.control-group').removeClass('error').addClass('success');
                }
            });
        },
        checkemail:function(){
            console.log('here');
            if(!$("#application-form").validate().element("#Email")){
                
                return false;
            }
            $.ajax({
        
                type:'post',
                dataType: "json",
                url: this.getpath()+'home/ajax_check_email',
                data: {
                    Email: $('#Email').val()      
                },
                success: function(data){
                    if(data.result==false){
                        $('#Email').val('');    
                        $("#application-form").validate().element("#Email");
                    }
                    alert(data.msg);
                }
            }).always(function(data) {
                console.log(data);
            });
            
        },
        validate_addform:function(){
            $('#fontfile').change(function(){
                var pdf= $('#fontfile').attr('value').lastIndexOf(".pdf")==-1;
              
                if(pdf){
                    alert('Font  ต้อง เป็นนามสกุล pdf');
                    $('#fontfile').attr('value','');
                } 
            });
            
        },
        swaptoView:function(){
            
            $('.control-group.edited,form.edited').hide();
            $('.control-group.view').show();
            
            $( "form input[type=text],textarea" ).each(function( index ) {
                $(this).parent().prepend('<label style="margin: 5px 0;"  >'+meta[this.id]+'</label>'); 
                $(this).hide();
            });
            
            
        },
        swaptoEdit:function(){
            
            $('.control-group.edited,form.edited').show();
            $('.control-group.view').hide();
            $( "form input,textarea" ).each(function( index ) {
               
                $(this).show();
               if (meta[this.id]!=undefined){
                    $(this).parent().find('label').remove();
                   $(this).val(meta[this.id]);
               }
                  
            });
        }
        
       
      
    
    }
        
}(jQuery, this,sitepath));







/* ---------- Add class .active to current link  ---------- */
if(window.location.pathname.split('/')[2]==''){
    $('#home a').addClass('MuseMenuActive'); 
} else
{	
    $('#menuu142 li').each(function(){
          
        if($($(this))[0].id==window.location.pathname.split('/')[2])
            $(this).find('a').addClass('MuseMenuActive');
 
    });
}