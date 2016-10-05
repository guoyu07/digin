/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() { 
  
/********************For Common details**********************************/   
/*$("#commondetailsform").on("submit",function(e){    
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);
            alert(form.attr("action"));
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           //form.trigger("reset");                           
                           alert("Your information is saved successfully!");                          
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });*/
           
$("#commondetailsform").submit(function(e)
{     
      e.preventDefault();
      e.stopImmediatePropagation();
      
      var form=$(this);
      var formURL = $(this).attr("action");    
      var data = new FormData(this);   // imp for file upload
        
      $.ajax({
                url : formURL,
                type: "POST",
                data : data,
                contentType: false,
                processData: false,
                success:function(data)
                {                    
                    if(data==1)
                    {
                           //form.trigger("reset");
                           alert("Your information is saved successfully!");
                           console.log(data);
                    }
                    else{                           
                           alert("Some of the field is missing!");            
                       }                       
                },
                error: function(data)
                {
                    alert("server error!");
                    console.log(data.responseJSON);
                    //in the responseJSON you get the form validation back.
                }
            });
        return false;      
});           
           
           
/***********************************For Occupation****************************************/   
$("#occupationform").on("submit",function(e){ 
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);
            //alert(form.attr("action"));
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset"); 
                           $(".occsave").addClass("btn-success occadd");         
                           $(".occsave").removeClass("btn-primary occsave");  
                           $(".occadd").html('Add');
        
                           $("#upd").val('');
                           alert("Your information is saved successfully!"); 
                           $.pjax.reload({container:'#occupationgrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
           
 $(document).on('click','.updoc', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".occadd").addClass("btn-primary occsave");           
      $(".occadd").removeClass("btn-success occadd");  
      $(".occsave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#upd").val(no[1]);
    //alert(no[1]);
    //return false;
   $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updateoccupation",           
           data:{id:no[1]},
           success:  function(result) {                                     
              $.each(result, function(index, value) {                    
                 $("#skillsoccupation-occupationtype").val(value['occupationtype']);
                 $("#skillsoccupation-company").val(value['company']);
                 $("#skillsoccupation-designation").val(value['designation']);
                 $("#skillsoccupation-tenure").val(value['tenure']);
                 $("#skillsoccupation-fromdate").val(value['fromdate']);
                 $("#skillsoccupation-todate").val(value['todate']);
                 $("#skillsoccupation-description").val(value['description']);
             }); 
            },
    });      
});
   
$(document).on('click','.deloc', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                type:"GET",
                //dataType: "json",
                   url:"index.php?r=allforms/deleteoccupation",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#occupationgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });
        
});
/***********************************For User skills********************************************/   
$("#userskillsform").on("submit",function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);
            //alert(form.attr("action"));
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset"); 
                           $(".skillsave").addClass("btn-success skilladd");         
                           $(".skillsave").removeClass("btn-primary skillsave");  
                           $(".skilladd").html('Add');
                           
                           $("#updsk").val('');
                           alert("Your information is saved successfully!"); 
                           $.pjax.reload({container:'#skillsgrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
  
$("#skills-skill").click(function(){
    $("#userskills-skillid").prop("disabled", true);
});

 $(document).on('click','.updsk', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".skilladd").addClass("btn-primary skillsave");           
      $(".skilladd").removeClass("btn-success skilladd");  
      $(".skillsave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updsk").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updateskill",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#userskills-skillid").val(value['skillid']);
                 $("#userskills-description").val(value['description']);
             }); 
            },
    });
 });
 $(document).on('click','.delsk', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                type:"GET",
                //dataType: "json",
                   url:"index.php?r=allforms/deleteskill",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#skillsgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Consultant***********************************************/   
$("#consultantform").on("submit",function(e){    
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset");
                           $(".consave").addClass("btn-success conadd");         
                           $(".consave").removeClass("btn-primary consave");  
                           $(".conadd").html('Add');
                           
                           $("#updcon").val('');
                           alert("Your information is saved successfully!");
                           $.pjax.reload({container:'#consultantgrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });           
 $(document).on('click','.updcon', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".conadd").addClass("btn-primary consave");           
      $(".conadd").removeClass("btn-success conadd");  
      $(".consave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updcon").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updateconsultant",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsconsultants-consultant_type").val(value['consultant_type']);
                 $("#skillsconsultants-name").val(value['name']);
                 $("#skillsconsultants-phone").val(value['phone']);
                 $("#skillsconsultants-email").val(value['email']);
             }); 
            },
    });
 });  
 $(document).on('click','.delcon', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deleteconsultant",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#consultantgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Testimonial***********************************************/   
$("#testimonialform").submit(function(e)
{     
      e.preventDefault();
      e.stopImmediatePropagation();
      
      var form=$(this);
      var formURL = $(this).attr("action");    
      var data = new FormData(this);   // imp for file upload
        
      $.ajax({
                url : formURL,
                type: "POST",
                data : data,
                contentType: false,
                processData: false,
                success:function(data)
                {                    
                    if(data==1)
                    {
                           form.trigger("reset");
                           $(".testsave").addClass("btn-success testadd");         
                           $(".testsave").removeClass("btn-primary testsave");  
                           $(".testadd").html('Add');
                           
                           $("#updtest").val('');
                           alert("Your information is saved successfully!");
                           $.pjax.reload({container:'#testgrid'});
                           console.log(data);
                    }
                    else{                           
                           alert("Some of the field is missing!");            
                       }                       
                },
                error: function(data)
                {
                    alert("server error!");
                    console.log(data.responseJSON);
                    //in the responseJSON you get the form validation back.
                }
            });
        return false;
       // e.preventDefault(); //STOP default action      
});   
$(document).on('click','.updtest', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".testadd").addClass("btn-primary testsave");           
      $(".testadd").removeClass("btn-success testadd");  
      $(".testsave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updtest").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatetest",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillstestimonials-quotes").val(value['quotes']);
                 $("#skillstestimonials-name").val(value['name']);                 
             }); 
            },
    });
 }); 
 $(document).on('click','.deltest', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletetest",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#testgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Investment***********************************************/  
$("#investmentform").on("submit",function(e){    
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                       
                       if(result==1)
                       {
                           form.trigger("reset");  
                           $(".invsave").addClass("btn-success invadd");         
                           $(".invsave").removeClass("btn-primary invsave");  
                           $(".invadd").html('Add');
        
                           $("#updinv").val('');
                           alert("Your information is saved successfully!"); 
                           $.pjax.reload({container:'#investgrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
 $(document).on('click','.updinv', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".invadd").addClass("btn-primary invsave");           
      $(".invadd").removeClass("btn-success invadd");  
      $(".invsave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updinv").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updateinvest",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsinvestment-investment_type").val(value['investment_type']);
                 $("#skillsinvestment-valuation").val(value['valuation']);   
                 $("#skillsinvestment-description").val(value['description']);   
             }); 
            },
    });
 }); 
 $(document).on('click','.delinv', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deleteinvest",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#investgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Bank***********************************************/    
$("#bankform").on("submit",function(e){   
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset"); 
                           $(".banksave").addClass("btn-success bankadd");         
                           $(".banksave").removeClass("btn-primary banksave");  
                           $(".bankadd").html('Add');
                           
                           $("#updbank").val('');
                           alert("Your information is saved successfully!");
                           $.pjax.reload({container:'#bankgrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
 $(document).on('click','.updbank', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".bankadd").addClass("btn-primary banksave");           
      $(".bankadd").removeClass("btn-success bankadd");  
      $(".banksave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updbank").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatebank",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsbanks-bankname").val(value['bankname']);
                 $("#skillsbanks-branchname").val(value['branchname']);   
                 $("#skillsbanks-account_no").val(value['account_no']); 
                 $("#skillsbanks-ifsc_no").val(value['IFSC_no']); 
             }); 
            },
    });
 });
 $(document).on('click','.delbank', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletebank",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#bankgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Education***********************************************/    
$("#educationform").on("submit",function(e){    
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset");  
                           $(".edusave").addClass("btn-success eduadd");           
                           $(".edusave").removeClass("btn-primary edusave");  
                           $(".eduadd").html('Add');
                                                     
                           $("#updedu").val('');
                           alert("Your information is saved successfully!");
                           $.pjax.reload({container:'#educationgrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
 $(document).on('click','.updedu', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".eduadd").addClass("btn-primary edusave");           
      $(".eduadd").removeClass("btn-success eduadd");  
      $(".edusave").html('Save');           
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updedu").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updateeducation",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillseducation-qualification").val(value['qualification']);
                 $("#skillseducation-year").val(value['year']);   
                 $("#skillseducation-institute").val(value['institute']);                  
             }); 
            },
    });
 }); 
 $(document).on('click','.deledu', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deleteeducation",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#educationgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Family***********************************************/    
$("#familyform").on("submit",function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset"); 
                           $("#updsib").val('');
                           alert("Your information is saved successfully!");
                           $.pjax.reload({container:'#sibblinggrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
 $(document).on('click','.updsib', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updsib").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatesibbling",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillssibblings-firstname").val(value['firstname']);
                 $("#skillssibblings-lastname").val(value['lastname']);   
                 $("#skillssibblings-link").val(value['link']);  
                 $("#skillssibblings-relation").val(value['relation']);  
             }); 
            },
    });
 }); 
$(document).on('click','.delsib', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletesibbling",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#sibblinggrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Healthdetails***********************************************/       
$("#healthdetailsform").on("submit",function(e){ 
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           //form.trigger("reset"); 
                           $("#upddis").val('');
                           $("#skillsdiseases-disease").val('');
                           alert("Your information is saved successfully!");   
                           $.pjax.reload({container:'#diseasegrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.upddis', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#upddis").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatedisease",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsdiseases-disease").val(value['disease']);                 
             }); 
            },
    });
 }); 
$(document).on('click','.deldis', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletedisease",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#diseasegrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Physician***********************************************/      
$("#physicianform").on("submit",function(e){ 
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset"); 
                           $(".physave").addClass("btn-success phyadd");         
                           $(".physave").removeClass("btn-primary physave");  
                           $(".phyadd").html('Add');
        
                           $("#updphy").val('');
                           alert("Your information is saved successfully!");  
                           $.pjax.reload({container:'#physiciangrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.updphy', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".phyadd").addClass("btn-primary physave");           
      $(".phyadd").removeClass("btn-success phyadd");  
      $(".physave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updphy").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatephysician",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsphysicians-physician_name").val(value['physician_name']);
                 $("#skillsphysicians-speciality").val(value['speciality']);   
                 $("#skillsphysicians-phone").val(value['phone']);  
                 $("#skillsphysicians-email").val(value['email']);  
             }); 
            },
    });
 });
$(document).on('click','.delphy', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletephysician",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#physiciangrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Vehicles***********************************************/      
$("#vehiclesform").on("submit",function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset");   
                           $(".vecsave").addClass("btn-success vecadd");           
                           $(".vecsave").removeClass("btn-primary vecsave");  
                           $(".vecadd").html('Add');
                           
                           $("#updvehcl").val('');
                           alert("Your information is saved successfully!"); 
                           $.pjax.reload({container:'#vehiclegrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.updvehcl', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
           
      $(".vecadd").addClass("btn-primary vecsave");           
      $(".vecadd").removeClass("btn-success vecadd");  
      $(".vecsave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updvehcl").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatevehicle",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsvehicles-vehicle_type").val(value['vehicle_type']);
                 $("#skillsvehicles-make").val(value['make']);   
                 $("#skillsvehicles-year").val(value['year']);  
                 $("#skillsvehicles-registration_no").val(value['registration_no']);  
             }); 
            },
    });
 });
 $(document).on('click','.delvehcl', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletevehicle",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#vehiclegrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************************For Government Ids***********************************************/                  
$("#governmentidsform").on("submit",function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset"); 
                           $(".govsave").addClass("btn-success govadd");           
                           $(".govsave").removeClass("btn-primary govsave");  
                           $(".govadd").html('Add');
                           
                           $("#updgov").val('');
                           alert("Your information is saved successfully!"); 
                           $.pjax.reload({container:'#govgrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$("#governdocumenttype-doc_name").click(function(){
    $("#skillsgovernmentids-governdoc_type").prop("disabled", true);
});
$(document).on('click','.updgov', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".govadd").addClass("btn-primary govsave");           
      $(".govadd").removeClass("btn-success govadd");  
      $(".govsave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updgov").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updategovid",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsgovernmentids-governdoc_type").val(value['governdoc_type']);
                 $("#skillsgovernmentids-govern_no").val(value['govern_no']);
             }); 
            },
    });
 });
$(document).on('click','.delgov', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletegovid",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#govgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************For Passport**********************************/    
$("#passportform").submit(function(e)
{      
      e.preventDefault();
      e.stopImmediatePropagation();
      
      var form=$(this);
      var formURL = $(this).attr("action");    
      var data = new FormData(this);   // imp for file upload
        
      $.ajax({
                url : formURL,
                type: "POST",
                data : data,
                contentType: false,
                processData: false,
                success:function(data)
                {                    
                    if(data==1)
                    {
                           form.trigger("reset");
                           $(".passsave").addClass("btn-success passadd");         
                           $(".passsave").removeClass("btn-primary passsave");  
                           $(".passadd").html('Add');
        
                           $("#updpass").val('');
                           alert("Your information is saved successfully!");
                           console.log(data);
                           $.pjax.reload({container:'#passgrid'});
                    }
                    else{                           
                           alert("Some of the field is missing!");            
                       }                       
                },
                error: function(data)
                {
                    alert("server error!");
                    console.log(data.responseJSON);
                    //in the responseJSON you get the form validation back.
                }
            });
        return false;    
        //e.preventDefault(); //STOP default action      
});   
$(document).on('click','.updpass', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation(); 
      
      $(".passadd").addClass("btn-primary passsave");           
      $(".passadd").removeClass("btn-success passadd");  
      $(".passsave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updpass").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatepassport",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillspassport-nationality").val(value['nationality']);
                 $("#skillspassport-passport_no").val(value['passport_no']);   
                 $("#skillspassport-issuedate").val(value['issuedate']);  
                 $("#skillspassport-expirydate").val(value['expirydate']);  
             }); 
            },
    });
 });
$(document).on('click','.delpass', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletepassport",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#passgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************For User hobbies**********************************/   
$("#userhobbiesform").on("submit",function(e){
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);
            //alert(form.attr("action"));
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                        
                       if(result==1)
                       {
                           form.trigger("reset");
                           $(".hobysave").addClass("btn-success hobyadd");         
                           $(".hobysave").removeClass("btn-primary hobysave");  
                           $(".hobyadd").html('Add');
        
                           $("#listB").empty();
                           $("#updhby").val('');
                           alert("Your information is saved successfully!"); 
                           $.pjax.reload({container:'#hobbygrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.updhby', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".hobyadd").addClass("btn-primary hobysave");           
      $(".hobyadd").removeClass("btn-success hobyadd");  
      $(".hobysave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updhby").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatehobby",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                $('#listB').append($('<option>').text(value['hobby']).val(value['hobbyid']));
             }); 
            },
    });
 });      
$(document).on('click','.delhby', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletehobby",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#hobbygrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************For Plan**********************************/   
$("#planform").on("submit",function(e){   
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);
            //alert(form.attr("action"));
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                                             
                       if(result==1)
                       {
                           form.trigger("reset");
                           $(".plansave").addClass("btn-success planadd");         
                           $(".plansave").removeClass("btn-primary plansave");  
                           $(".planadd").html('Add');
                           
                           $("#updplan").val('');
                           alert("Your information is saved successfully!");
                           $.pjax.reload({container:'#plangrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           }); 
$(document).on('click','.updplan', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();   
      
      $(".planadd").addClass("btn-primary plansave");           
      $(".planadd").removeClass("btn-success planadd");  
      $(".plansave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updplan").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updateplan",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsplans-plantype").val(value['plantype']);
                 $("#skillsplans-description").val(value['description']);                    
             }); 
            },
    });
 });    
 $(document).on('click','.delplan', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deleteplan",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#plangrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************For Creations**********************************/    
$("#creationsform").submit(function(e)
{      
      e.preventDefault();
      e.stopImmediatePropagation();
      
      var form=$(this);
      var formURL = $(this).attr("action");    
      var data = new FormData(this);   // imp for file upload
        
      $.ajax({
                url : formURL,
                type: "POST",
                data : data,
                contentType: false,
                processData: false,
                success:function(data)
                {                    
                    if(data==1)
                    {
                           form.trigger("reset");
                           $(".crtsave").addClass("btn-success crtadd");         
                           $(".crtsave").removeClass("btn-primary crtsave");  
                           $(".crtadd").html('Add');
        
                           $("#updcrt").val('');
                           alert("Your information is saved successfully!");
                           console.log(data);
                           $.pjax.reload({container:'#creategrid'});
                    }
                    else{                           
                           alert("Some of the field is missing!");            
                       }                       
                },
                error: function(data)
                {
                    alert("server error!");
                    console.log(data.responseJSON);
                    //in the responseJSON you get the form validation back.
                }
            });
        return false;
        //e.preventDefault(); //STOP default action      
});   
$(document).on('click','.updcrt', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();  
      
      $(".crtadd").addClass("btn-primary crtsave");           
      $(".crtadd").removeClass("btn-success crtadd");  
      $(".crtsave").html('Save'); 
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updcrt").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatecreation",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillscreations-title").val(value['title']);
                 $("#skillscreations-note").val(value['note']);
                 $("#skillscreations-youtoube_link").val(value['youtoube_link']);
             }); 
            },
    });
 });    
 $(document).on('click','.delcrt', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletecreation",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#creategrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});
/********************For Achievements**********************************/   
$("#achievementsform").on("submit",function(e){ 
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);           
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                                             
                       if(result==1)
                       {
                           form.trigger("reset");
                           $(".achsave").addClass("btn-success achadd");         
                           $(".achsave").removeClass("btn-primary achsave");  
                           $(".achadd").html('Add');
        
                           $("#updach").val('');
                           alert("Your information is saved successfully!");  
                           $.pjax.reload({container:'#achievegrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           }); 
$(document).on('click','.updach', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation(); 
      
      $(".achadd").addClass("btn-primary achsave");           
      $(".achadd").removeClass("btn-success achadd");  
      $(".achsave").html('Save');  
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updach").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updateachievement",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsachievements-title").val(value['title']);
                 $("#skillsachievements-note").val(value['note']);
                 $("#skillsachievements-professional_plan").val(value['professional_plan']);
             }); 
            },
    });
 });    
 $(document).on('click','.delach', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deleteachievement",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#achievegrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});         
/********************For Philosophy**********************************/   
$("#philosophyform").on("submit",function(e){    
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);           
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                                             
                       if(result==1)
                       {
                           form.trigger("reset");  
                           $(".phisave").addClass("btn-success phiadd");         
                           $(".phisave").removeClass("btn-primary phisave");  
                           $(".phiadd").html('Add');
        
                           $("#updphilo").val('');
                           alert("Your information is saved successfully!");
                           $.pjax.reload({container:'#philospygrid'});                          
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.updphilo', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();  
      
      $(".phiadd").addClass("btn-primary phisave");           
      $(".phiadd").removeClass("btn-success phiadd");  
      $(".phisave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updphilo").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatephilosophy",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsphilosophy-philosophytext").val(value['philosophytext']);                                 
             }); 
            },
    });
 });    
 $(document).on('click','.delphilo', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletephilosophy",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#philospygrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});         
/********************For Memories**********************************/           
$("#memoryform").on("submit",function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);
            //alert(form.attr("action"));
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                                                     
                       if(result==1)
                       {
                          form.trigger("reset");
                          $(".memsave").addClass("btn-success memadd");         
                          $(".memsave").removeClass("btn-primary memsave");  
                          $(".memadd").html('Add');
                           
                          $("#updmem").val('');
                          alert("Your information is saved successfully!");  
                          $.pjax.reload({container:'#memorygrid'});
                       }
                       else {
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.updmem', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".memadd").addClass("btn-primary memsave");           
      $(".memadd").removeClass("btn-success memadd");  
      $(".memsave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updmem").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatememory",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsmemories-title").val(value['title']); 
                 $("#skillsmemories-note").val(value['note']); 
             }); 
            },
    });
 });    
 $(document).on('click','.delmem', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletememory",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#memorygrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});        
/********************For Likings**********************************/   
$("#likingsform").on("submit",function(e){
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);           
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                                             
                       if(result==1)
                       {
                           form.trigger("reset");  
                           $(".lyksave").addClass("btn-success lykadd");         
                           $(".lyksave").removeClass("btn-primary lyksave");  
                           $(".lykadd").html('Add');
                          
                           $("#updlyk").val('');
                           alert("Your information is saved successfully!"); 
                           $.pjax.reload({container:'#likegrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.updlyk', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();   
      
      $(".lykadd").addClass("btn-primary lyksave");           
      $(".lykadd").removeClass("btn-success lykadd");  
      $(".lyksave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updlyk").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updateliking",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillslikings-title").val(value['title']); 
                 $("#skillslikings-note").val(value['note']); 
             }); 
            },
    });
 });    
 $(document).on('click','.dellyk', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deleteliking",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#likegrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});           
/********************For Dislike**********************************/   
$("#dislikeform").on("submit",function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);           
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                                             
                       if(result==1)
                       {
                           form.trigger("reset"); 
                           $(".dlyksave").addClass("btn-success dlykadd");         
                           $(".dlyksave").removeClass("btn-primary dlyksave");  
                           $(".dlykadd").html('Add');
                           
                           $("#upddislyk").val('');
                           alert("Your information is saved successfully!"); 
                           $.pjax.reload({container:'#dislikegrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.upddislyk', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation(); 
      
      $(".dlykadd").addClass("btn-primary dlyksave");           
      $(".dlykadd").removeClass("btn-success dlykadd");  
      $(".dlyksave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#upddislyk").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatedislike",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsdislike-title").val(value['title']); 
                 $("#skillsdislike-note").val(value['note']); 
             }); 
            },
    });
 });    
 $(document).on('click','.deldislyk', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletedislike",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#dislikegrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});            
/********************For Belongings**********************************/    
$("#belongingsform").submit(function(e)
{      
      e.preventDefault();
      e.stopImmediatePropagation();
      
      var form=$(this);
      var formURL = $(this).attr("action");    
      var data = new FormData(this);   // imp for file upload
       
     
      $.ajax({
                url : formURL,
                type: "POST",
                data : data,
                contentType: false,
                processData: false,
                success:function(data)
                {      
                    //alert(data);
                    if(data==1)
                    {
                           form.trigger("reset");
                           $(".belsave").addClass("btn-success beladd");         
                           $(".belsave").removeClass("btn-primary belsave");  
                           $(".beladd").html('Add');
                           
                           $("#updbel").val('');
                           alert("Your information is saved successfully!");
                           console.log(data);
                           $.pjax.reload({container:'#belonggrid'});
                    }
                    else{                           
                           alert("Some of the field is missing!");            
                       }                       
                },
                error: function(data)
                {
                    alert("server error!");
                    console.log(data.responseJSON);
                    //in the responseJSON you get the form validation back.
                }
            });
            return false; 
        //e.preventDefault(); //STOP default action      
});   
$(document).on('click','.updbel', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation(); 
      
      $(".beladd").addClass("btn-primary belsave");           
      $(".beladd").removeClass("btn-success beladd");  
      $(".belsave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updbel").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatebelonging",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsbelongings-title").val(value['title']); 
                 $("#skillsbelongings-note").val(value['note']); 
             }); 
            },
    });
 });    
 $(document).on('click','.delbel', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletebelonging",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#belonggrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
}); 
/********************For Idols**********************************/   
$("#idolsform").on("submit",function(e){ 
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);           
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                                             
                       if(result==1)
                       {
                           form.trigger("reset");
                           $(".idolsave").addClass("btn-success idoladd");         
                           $(".idolsave").removeClass("btn-primary idolsave");  
                           $(".idoladd").html('Add');
        
                           $("#updid").val('');
                           alert("Your information is saved successfully!");
                           $.pjax.reload({container:'#idolgrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.updid', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();  
      
      $(".idoladd").addClass("btn-primary idolsave");           
      $(".idoladd").removeClass("btn-success idoladd");  
      $(".idolsave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updid").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updateidol",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsidols-name").val(value['name']);                  
             }); 
            },
    });
 });    
 $(document).on('click','.delid', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deleteidol",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#idolgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
}); 
/********************For traveldetails**********************************/   
$("#traveldetailsform").on("submit",function(e){ 
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);           
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                                             
                       if(result==1)
                       {
                           form.trigger("reset"); 
                           $(".trvsave").addClass("btn-success trvadd");         
                           $(".trvsave").removeClass("btn-primary trvsave");  
                           $(".trvadd").html('Add');
        
                           $("#updtrv").val('');
                           alert("Your information is saved successfully!");   
                           $.pjax.reload({container:'#travelgrid'});
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
$(document).on('click','.updtrv', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
      
      $(".trvadd").addClass("btn-primary trvsave");           
      $(".trvadd").removeClass("btn-success trvadd");  
      $(".trvsave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updtrv").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatetravel",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillstraveldetails-place").val(value['place']); 
                 $("#skillstraveldetails-year").val(value['year']); 
                 $("#skillstraveldetails-description").val(value['description']);
             }); 
            },
    });
 });    
 $(document).on('click','.deltrv', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletetravel",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#travelgrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
});          
/********************For socialmedia**********************************/   
$("#socialmediaform").on("submit",function(e){
      e.preventDefault();
      e.stopImmediatePropagation();
            var form=$(this);           
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                                             
                       if(result==1)
                       {
                           form.trigger("reset");                           
                           alert("Your information is saved successfully!");                          
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });  
                   return false; 
           });
           
/********************For Media**********************************/    
$("#mediaform").submit(function(e)
{      
      e.preventDefault();
      e.stopImmediatePropagation();
      
      var form=$(this);
      var formURL = $(this).attr("action");    
      var data = new FormData(this);   // imp for file upload
        
      $.ajax({
                url : formURL,
                type: "POST",
                data : data,
                contentType: false,
                processData: false,
                success:function(data)
                {                    
                    if(data==1)
                    {
                           form.trigger("reset");
                           $(".medsave").addClass("btn-success medadd");         
                           $(".medsave").removeClass("btn-primary medsave");  
                           $(".medadd").html('Add');
        
                           $("#updmed").val('');
                           alert("Your information is saved successfully!");
                           console.log(data);
                           $.pjax.reload({container:'#mediagrid'});
                    }
                    else{                           
                           alert("Some of the field is missing!");            
                       }                       
                },
                error: function(data)
                {
                    alert("server error!");
                    console.log(data.responseJSON);
                    //in the responseJSON you get the form validation back.
                }
            });
        return false;
        //e.preventDefault(); //STOP default action      
    }); 
});
$(document).on('click','.updmed', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation(); 
      
      $(".medadd").addClass("btn-primary medsave");           
      $(".medadd").removeClass("btn-success medadd");  
      $(".medsave").html('Save');
      
    var id=$(this).attr('id');
    no=id.split('_');
    $("#updmed").val(no[1]);
    //alert(no[1]);
    $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=allforms/updatemedia",           
           data:{id:no[1]},
           success:  function(result) {               
              $.each(result, function(index, value) {                              
                 $("#skillsmedia-title").val(value['title']); 
                 $("#skillsmedia-note").val(value['note']);
                 $("#skillsmedia-link").val(value['link']);
             }); 
            },
    });
 });    
 $(document).on('click','.delmed', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');    
    //alert(no[1]);   
    
    $('<div>Are you sure you want to delete this record?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close");
          $.ajax({
                   type:"GET",                
                   url:"index.php?r=allforms/deletemedia",           
                   data:{id:no[1]},
                   success:  function(result) {                                     
                        alert(result);
                        $.pjax.reload({container:'#mediagrid'});
                    },
            });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });        
}); 