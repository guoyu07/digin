/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    /******************Code to Invisible Button when field empty...*************************/
   // $("#vendorleadsform").on("submit",function(e){   
        $(document).on('click', '.submit',function(e){       
           //e.preventDefault();
           //alert('hi m in ...vendorleads....');
            //if($("#vendor-franchisee").val()=='' && $("#vendor-franchexecutive").val()=='')
                if($("#vendor-franchexecutive").val()=='None')
                        { 
                            e.preventDefault();
                            alert("No Exicutive Present in this Franchisee,Can't Proceed..");
                            $('button[type="submit"]').attr('disabled','disabled');
                            
                        }
                        else{
                            $("#vendorleadsform").submit();
                        }
                       
                        
                       if($("#vendorleads-excelfile").val()==''){
                            event.preventDefault();
                            //event.stopPropagation();
                           alert('No File has been Choosen.');
                            $('button[type="submit"]').attr('disabled','disabled');                                              
                      }
                       
                    
         //return false;
          });
//            $('input[type=file]').change(function(e){
//                            $in=$(this);
//                           alert($in.val());
//                           if($in.val()==''){
//                               e.preventDefault();
//                               alert('No File has been Choosen.');
//                               $('button[type="submit"]').attr('disabled','disabled');
//                             
//                           }
//                          });   

/****************disable button*****/


         $('#vendor-franchisee').change(function(e){ 
             //alert('hi m in change event..?');
           $('button[type="submit"]').prop('disabled', false);
    
       });



/******************************Display popup for convert**********************/     
      $(document).on('click','.convertdoc', function(e){  
      alert('Are you sure you want to convert the lead to vendor.....?');
       
      /*e.preventDefault();
      e.stopImmediatePropagation();
      
      var url=$(this).attr('href');
      alert(url);
      $('<div>Are you sure you want to convert lead to vendor..?</div>'). dialog({
      draggable: false,
      modal: true,
      resizable: false,
      width: 'auto',
      //title: title,
      buttons: {
        "Ok": function() {          
          $(this).dialog("close"); 
          location.href=url;
        },
        "Cancel": function() {
           e.preventDefault();
          $(this).dialog("close");
        }
      }
    });*/
      
    });
            
 });







/*******************************Submit Form Convert to Vendor Form*******************************************/
/*$(document).on('click','.convertdoc', function(e){  
      e.preventDefault();
      e.stopImmediatePropagation();
    var id=$(this).attr('id');
    no=id.split('_');
    //$("#vld").val(no[1]);
    //alert(no[1]);
    //return false;
   $.ajax({
        type:"GET",
        dataType: "json",
           url:"index.php?r=vendorleads/convertdata",           
           data:{id:no[1]},
           success:  function(result) {    
               //alert('Hi..m In...vendorleads....');
              $.each(result, function(index, value) {  
                  alert(value['vendor_type']);
                 $("#vendor-firstname").val(value['firstname']);
                 $("#vendor-lastname").val(value['lastname']);
                 $("#vendor-email").val(value['email']);
                 $("#vendor-website").val(value['website']);
                 $("#vendor-businessname").val(value['businessname']);
                 $("#vendor-vendtor_type").val(value['vendor_type']);
                 $("#vendor-phone1").val(value['phone1']);
                 $("#vendor-phone2").val(value['phone2']);
                 $("#vendor-address1").val(value['address1']);
                 $("#vendor-address2").val(value['address2']);
                 $("#vendor-city").val(value['city']);
                 $("#vendor-state").val(value['state']);
                 $("#vendor-pin").val(value['pin']);
                 $("#vendor-frid").val(value['frid']);
                 $("#vendor-crtby").val(value['crtby']);
             }); 
            },
    });     
});*/