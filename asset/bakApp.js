var App =(function ($, window,path) {
    var sitepath=path;
    var Template=null;
    var Generate_cache_condition=function(cache_condition){
        if(cache_condition==undefined){          
            cache_condition=Template.Generate(); 
        }

        return cache_condition;
    };

    var create_Chart=function(canvas,json){
        var data = {
    labels : json.label,
    datasets : [
        {
            fillColor : "rgba(220,220,220,0.5)",
            strokeColor : "rgba(220,220,220,1)",
            data :json.value
        }
              ]
        };
       new Chart(canvas).Bar(data,{scaleOverride :true,scaleStartValue :0,scaleSteps : 5,
    scaleStepWidth : 1,});
    };
    return {
        generatequery:function(index){
            var cache_condition = Generate_cache_condition( $.cookie(Template.cookie_name()),Template);
            console.log($.cookie(Template.cookie_name()));
            $.ajax({
                type:'post',
                dataType: "json",
                url: Template.path_name(),
                data: {
                    condition:$.cookie(Template.cookie_name()),
                    startrow:index    
                },
                beforeSend:function(){
                    var tbody = $('#result tbody');
                    tbody.html('');
                    $('#loading-indicator').show();
                // alert('sdf');

            },
            success: function(json){
                Template.Render(json)
            }
        }).always(function(data, textStatus) {
            console.log(data);
            console.log(textStatus);
            $('#loading-indicator').hide();
        });

    },
    search:function(){
        Template.Generate();
        this.generatequery(0);
    },
    confirm_mark:function(id){
        if(confirm('Are you sure to Mark this font ?')==true)

        {

            window.location.href = sitepath+'Backend/typeface/marktypeface/'+id;

        }

    },
    getpath:function(){
        return sitepath;
    }, 
    getFont_template:function(){
        var cookie_name = 'Font_cache_condition';
        var  path = this.getpath()+'Backend/typeface/ajax_getquery';
        return {
            Generate:function(){
                var  cache=$('#text').val()+','+$('#user').val()+','+$('#select_con').val();      
                return $.cookie('Font_cache_condition',cache,{
                    expires: 5,
                    path: window.location.pathname
                });
            },
            Render:function(json){

                var tbody = $('#result tbody')

                $.each(json.data, function(index, value) {
                    console.log(index + ': ' + value.FontID);
                    var genlink =sitepath+'Backend/typeface/viewtypeface/'+value.FontID
                    var tr=$('<tr></tr>');
                    tr.append('<td>'+value.FontCode+'</td>');
                    tr.append('<td>'+value.Fontname+'</td>');
                    tr.append('<td>'+value.Uploadtime+'</td>');
                    tr.append('<td>'+value.Lasteditedtime+'</td>');
                    tr.append('<td>'+value.Name+'  '+value.Lastname+'</td>');
                    tr.append('<td> <a href="'+genlink+'" class="btn" >viewFont</a></td>');
                    tbody.append(tr);
                });
                $('#page_link').html(json.link);

            }
            ,
            cookie_name: function(){
                return cookie_name;
            },
            path_name: function(){
                return path;
            }    
        };
    },
    getUser_template:function(){
        var cookie_name = 'User_cache_condition';
        var  path = this.getpath()+'Backend/user/ajax_getquery';
        return {
            Generate:function(){
                var  cache=$('#text').val()+','+$('#sex').val()     
                return $.cookie(cookie_name,cache,{
                    expires: 5,
                    path: window.location.pathname
                });
            },
            Render:function(json){

                var tbody = $('#result tbody')

                $.each(json.data, function(index, value) {
                    console.log(index + ': ' + value);
                    var genlink =sitepath+'Backend/user/viewuser/'+value.UserID
                    var tr=$('<tr></tr>');
                    tr.append('<td>'+value.Username+'</td>');
                    tr.append('<td>'+value.Name+'  '+value.Lastname+'</td>');
                    tr.append('<td>'+value.Mobile+'</td>');
                    tr.append('<td>'+value.Telephone+'</td>');
                    tr.append('<td>'+value.University+'</td>');
                    tr.append('<td>'+value.Email+'</td>');
                    tr.append('<td> <a href="'+genlink+'" class="btn" >viewFont</a></td>');
                    tbody.append(tr);
                });
                $('#page_link').html(json.link);

            }
            ,
            cookie_name: function(){
                return cookie_name;
            },
            path_name: function(){
                return path;
            }      
        };

    }
    ,
    setTemplate:function(template){
        Template = template;
    },
    showGraph:function(){

    jQuery.ajax({
      url: this.getpath()+'Backend/scorereport/getdata_chart',
      type: 'POST',
      dataType: 'json',
      success: function(json) {
        console.log(json);
        var ctx = window.document.getElementById("score-chart").getContext("2d");
         create_Chart(ctx,json);
      }
      
    });
    
    }

}
}(jQuery, this,sitepath));

var splitpath =window.location.pathname.split('/');

if(splitpath[3]==undefined ||splitpath[3] =='' ){
    $('#sidemenu #typeface').addClass('active'); 
    console.log('here');
} else
{	
    console.log('oop');
    $('#sidemenu li').each(function(){

        if($($(this))[0].id==splitpath[3])
            $(this).addClass('active');

    });
}