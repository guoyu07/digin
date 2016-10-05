/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    /******************Code to update grid view*************************/
    $("#reviewquestionform").on("beforeSubmit",function(e){    
            var form=$(this);             
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                         
                       var res=result.split('_');
                        count=res[1];                       
                       if(res[0]==1)
                       {                          
                          form.find('textarea').val('');                           
                          $.pjax.reload({container:'#reviewquestiongrid'});
                          if(count==5)
                          {
                              //$(".btn btn-success").attr("disabled","disabled");
                              $('button[type="submit"]').attr('disabled','disabled');
                          }
                       }
                       else
                       {
                           $("#message").html(result);                           
                       } 
                   }).fail(function()
                   {
                       console.log("server error!");
                   }); 
                   return false; 
           }); 
});

