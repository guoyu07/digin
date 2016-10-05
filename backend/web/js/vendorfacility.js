/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(  
        
            function() {  
                $(document).on('click', '.submit',function(e){       
                        if($("#vendor-email").val()=='' && $("#vendor-phone1").val()=='')
                        {
                             e.preventDefault();
                             alert("Either email address or at least one phone number should be filled");
                        }
                       /*if($('#listB > option').length<=0)
                        {                            
                            e.preventDefault();                           
                            alert("At least one facility should be selected from list");                                  
                        }*/
                        if(!$('input[name="VendorReceivablePayType[ptypeid]"]').is(":checked"))
                        {
                            e.preventDefault();
                            alert("At least one type of payment should be selected");
                        }
                        
                     /*   var fname= $("#vendor-firstname").val();
                        var phone=$("#vendor-phone1").val();                                 
                        var nm=fname.substr(0,4);
                        var phn=phone.substr(-4,4);
                        var pass=nm+phn;                        
                        $("#vendor-password_field").val(pass);*/
                   
                        $('#listB > option').prop("selected",true);
                     } );
              
               
               $("#vendor-email").change(function(){
                   var uname=$("#vendor-email").val();
                   $("#vendor-username").val(uname);
               });
               
                              
                $('#btnAdd').click(  
                    function(e) {  
                       if( $('#listA > option:selected').text()!='Select')
                        {    
                        $("#listB > option[value='']").remove();                      
                        $('#listA > option:selected').appendTo('#listB'); 
                        e.preventDefault(); 
                    }
                    });  
  
                  
  
                $('#btnRemove').click(  
                function(e) { 
                      if( $('#listB > option:selected').text()!='Select')
                        { 
                            $('#listB > option:selected').appendTo('#listA');                            
                            e.preventDefault();
                           
                        }
                }); 
                
       var fulladdr='';
        $(document).on("input",".address", function(){                          
             if($('#vendor-address1').val()!='')
                fulladdr=$('#vendor-address1').val();
             if($('#vendor-address2').val()!='')
                fulladdr+=','+$('#vendor-address2').val();
             if($('#vendor-city').val()!='')
                fulladdr+=','+$('#vendor-city').val();
             if($('#vendor-state').val()!='')
                fulladdr+=','+$('#vendor-state').val();
             if($('#vendor-pin').val()!='')
             fulladdr+=','+$('#vendor-pin').val();
            
            if(fulladdr!='')
                   $("#googleaddress").val(fulladdr);
       });
       
      $("#showmap").click(function(){
            $("#map").toggle();
            $("#loc").toggle();
    
   });
     

            $("input[name='VendorReceivablePayType[ptypeid]']").change(function(){

            if($(this).val()=="1")
            {
               $(".chkdate").css('display','none');
            }
            if($(this).val()=="2")
            {
               $(".chkdate").css('display','block');
                $(".chq").text("Cheque No.");  
               $(".chqdt").text("Cheque Date");  
            }
            if($(this).val()=="3")
            {
               //$(".chkdate").css('display','block');
               //$(".chq").text("Tansaction No.");  
               //$(".chqdt").text("Tansaction Date");  
               $('#vendorreceivablepaytype-chq_no').val(0);               
               var dt=$.datepicker.formatDate('yy-mm-dd', new Date());
               $('#vendorreceivablepaytype-chq_date').val(dt);
           }
            if($(this).val()=="4")
            {
               $(".chkdate").css('display','block');
                $(".chq").text("Add DD No.");  
               $(".chqdt").text("Add Date");  
            }
});

$('#vendor-pin').change(function(){
    getDP();   
});

 
$("#vendor-country").change(function(){
   getPlan();
});

//$("input[name='Vendor[paymentanddelivery]']").change(function(){Vendor[paymntopt]Vendor[delivryopt]
$("input[name='Vendor[delivryopt]']").change(function(){
    
   payoptn = $("input[name='Vendor[paymntopt]']:checked").val();
   //alert(payoptn);
    
       if($(this).val()=="1" && payoptn==1)
       {
            $("#dp").css('display','block');
           
       }
       else{
           alert('Please select digin payment option');
           $("#dp").css('display','none');
           $(".tg").css('display','none');
       }
       
       
  
       if($(this).val()=="1"){
           //alert("digin delivery");  
           if($("#listB option:contains('Self Delivery')") || $("#listB option:contains('No Delivery')")){              
                $("#listB option:contains('Self Delivery')").appendTo('#listA');
                $("#listB option:contains('No Delivery')").appendTo('#listA');
            }
           $('#listA').val($("#listA option:contains('Digin Delivery')").val());
           $('#listA > option:selected').appendTo('#listB');           
       }
       if($(this).val()=="2"){
            //alert("Self delivery");
            if($("#listB option:contains('Digin Delivery')") || $("#listB option:contains('No Delivery')")){
                //alert("has digin");
                $("#listB option:contains('Digin Delivery')").appendTo('#listA');
                $("#listB option:contains('No Delivery')").appendTo('#listA');
            }
            $('#listA').val($("#listA option:contains('Self Delivery')").val());
            $('#listA > option:selected').appendTo('#listB'); 
       }
       if($(this).val()=="3"){
            //alert("No delivery");
            if($("#listB option:contains('Digin Delivery')") || $("#listB option:contains('Self Delivery')")){                             
                $("#listB option:contains('Digin Delivery')").appendTo('#listA');
                $("#listB option:contains('Self Delivery')").appendTo('#listA');
            }
            $('#listA').val($("#listA option:contains('No Delivery')").val());
            $('#listA > option:selected').appendTo('#listB'); 
       }
       if($(this).val()=="4"){
            //alert("No delivery");
            if($("#listB option:contains('Digin Delivery')") || $("#listB option:contains('Self Delivery')")){                             
                $("#listB option:contains('Digin Delivery')").appendTo('#listA');
                $("#listB option:contains('Self Delivery')").appendTo('#listA');
            }
            $('#listA').val($("#listA option:contains('No Delivery')").val());
            $('#listA > option:selected').appendTo('#listB'); 
       }
       
});
 
$(document).on('click','.chkacpt',function(e){
    if($(this).is(":checked")==true)
            {                
                $(".agree").css('display','block');
              $('#cncl').css({'margin-top' : '-34px', 'margin-left' : '70px'});                            
            
      }else{                
               $(".agree").css('display','none');
            }  
});

/**********************Delivery options********************/

$(document).on('change','#specialdeliveryoption-delivery_limit',function(e){
   kmval = $("#specialdeliveryoption-delivery_limit").val();
   if(kmval==1){
       $("#kmfld").css('display','block'); 
   }else{
       $("#kmfld").css('display','none'); 
   }
});


$("input[name='Vendor[delivryopt]").change(function(){
     if($(this).val()=="3")
       {
           $("#dlvrsbid").css('display','block');
       }
       else{
           
           $("#dlvrsbid").css('display','none');
       }
    
});


$(document).on('click',' .block', function(e) { 
    theid= $(this).attr("id");
    arr = theid.split("_");
    if(arr[2]==0){
        alert("Do You Want to Block Vendor....");
    }else{
        alert("Do You Want to Unblock Vendor....");
    }
    
    //alert(arr[1]+" " + arr[2]);
    $.ajax({
        type:"POST",
        url:"index.php?r=vendor/blockedvendor", 
        data:{vid:arr[1],
              vidblock:arr[2]},
         success:  function(result) {    
             if(result==0){
                 alert("Vendor Not Updated.");
             }else{
                       if(arr[2]==0){
                          
                            $("#"+theid).removeClass("glyphicon-ok-sign");
                           $("#"+theid).addClass("glyphicon-exclamation-sign");
                           $("#"+theid).css("color","#d9534f");

                          // $("#"+$(this).attr("id")).toggleClass( "glyphicon-exclamation-sign" );
                            
                           $("#"+theid).attr("id","v_"+arr[1]+"_1");
                           alert("Vendor is blocked.");
                           //location.reload();
                       }else{
                            //alert(theid);
                           $("#"+theid).removeClass("glyphicon-exclamation-sign");
                           $("#"+theid).addClass("glyphicon-ok-sign");
                            $("#"+theid).css("color","#5cb85c");
                           $("#"+theid).attr("id","v_"+arr[1]+"_0");
                           alert("Vendor is Unblocked.");  
                             //location.reload();
                       }       
                   }          
             },
    })
   });
   
   $(document).on('click',' .activ', function(e) { 
      theid= $(this).attr("id");
        arr = theid.split("_");
        if(arr[2]==0){
            alert("Do You Want to Active Vendor....");
        }else{
            alert("Do You Want to Inactive Vendor....");
    }
    $.ajax({
        type:"POST",
        url:"index.php?r=vendor/activevendor", 
        data:{vid:arr[1],
              vidactiv:arr[2]},
         success:  function(result) { 
             /* if(arr[2]==1){
                 alert("vendor activate..")
             }else{
                 alert("vendor Inactivate..")
             }*/
            // alert(result);
             if(result==0){
                 alert("Vendor Not Updated.");
             }else{ 
             if(arr[2]==0){
                 $("#"+theid).removeClass("glyphicon glyphicon-ban-circle");
                 $("#"+theid).addClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).css("color","#33CCFF");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_1");
                  alert("Vendor is active.");                                 
             }else{
                  $("#"+theid).removeClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).addClass("glyphicon glyphicon-ban-circle");                
                  $("#"+theid).css("color","#d9534f");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_0");
                  alert("Vendor is Inactive.");
             }
             
             }
         },
    })
   
   });
   
   
   $("#vendor-dppkg").change(function(){
       //alert($(this).find("option:selected").text());
       pkgname=$(this).find("option:selected").text();
       pkgid=$("#vendor-dppkg").val();
      // alert(pkgid);
       $.ajax({
        type:"POST",
        dataType: "json",
        url:"index.php?r=vendor/getpackage", 
        data:{pkgid:pkgid},
         success:  function(result) {
             //alert(result['cityrate']);
             $(".tg").css('display','block');
             $(".tg-5rcs").html(pkgname);            

             $("#r1").html(result['cityrate']);
             $("#r2").html(result['zonerate']);
             $("#r3").html(result['metrorate']);
             $("#r4").html(result['RoIArate']);
             $("#r5").html(result['RoIBrate']);
             $("#r6").html(result['spldestrate']);
             $("#r7").html(result['addwithincityrate']);
             $("#r8").html(result['addzonerate']);
             $("#r9").html(result['addmetrorate']);
             $("#r10").html(result['addRoIArate']);
             $("#r11").html(result['addRoIBrate']);
             $("#r12").html(result['addspldestrate']);
             
                 
             
            if(result['bulkrate']==1){                 
                 $("#bulkrow").css('visibility','visible');
                 $("#r13").html(result['bulkcityrate']);
                $("#r14").html(result['bulkzonerate']);
                $("#r15").html(result['bulkmetrorate']);
                $("#r16").html(result['bulkRoIArate']);
                $("#r17").html(result['bulkRoIBrate']);
                $("#r18").html(result['bulkspldestrate']);
                
            }else{
                 $("#bulkrow").css('visibility','hidden');
            }
             
              
         }
     });
   });
   
});  

var getPlan=function()
{
     var con=$("#vendor-country").val();
     $.ajax({
        type:"GET",
        url:"index.php?r=vendor/getplan", 
        data:{country:con},
         success:  function(result) {  
              //alert(result);              
              var data=jQuery.parseJSON(result);             
              if(data==""){
                  //alert("No D. P.s");
                  $(".planmsg").css("display", "block");
                  $('#vendor-plan').empty();
                  $("#plandesc").html("No Plan");
              }else{
                  $(".planmsg").css("display", "none");  
                  $('#vendor-plan').empty();
                  $('#vendor-plan').append("<option value=''>Select</option>");
                  $.each(data, function(index, value) {                     
                    $('#vendor-plan').append($('<option>').text(value['name']).val(value['id']));                  
                 });                 
            }
         }
     });
}

var getDP=function()
{
    var venpin=$('#vendor-pin').val();
    $.ajax({
        type:"GET",
        url:"index.php?r=vendor/getdeliverypartner", 
        data:{pin:venpin},
         success:  function(result) {  
              //alert(result);              
              var data=jQuery.parseJSON(result);
              if(data==""){
                  //alert("No D. P.s");
                  $(".dpmsg").css("display", "block");
                  $("#vendor-dppkg").attr('disabled',true);
              }else{
                  $(".dpmsg").css("display", "none");
                  $("#vendor-dppkg").attr('disabled',false);
                  $.each(data, function(index, value) {                   
                  $('#vendor-deliverypartner').append($('<option>').text(value['name']).val(value['dpid']));
                 });
            }
         }
     }); 
}