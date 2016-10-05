
$(document).ready(function() {
    
    /**********Button for adding pins into ListBox.............************/
    $("#btnAdd1").click(function(){
     tbval = $('#pincode-pin').val();  // replace Text1 with ur TB id
        alert(tbval);
        $("<option/>").attr("value", tbval)
                .text(tbval)
                .appendTo("#listone1");
               $("#pincode-pin").val('');
            });
            
   /**********To select Options in Listbox...............************/
  $(document).on('click', '.submit',function(e){ 
           $('#listone1 > option').prop("selected",true);
          
          });
     
    /************to Remove selected items from listbox********************************************/
         $("#btnAdd2").click(function(){
             
             listval = $('#listone1').val();
             //alert(listval);
           if(listval==null)
           //if (('#listone1').val()== null && ('#listone1').val() == '') 
            { 
                    alert("Please Select Atleast one Pincode."); 
                    e.preventDefault();                                                             
            }
              $("#listone1 option:selected").remove();
        
         });
         
    /************************For Servicable Pincodes*****************************/     
         $("#btn1").click(function(){
            tbval = $('#servicablepincodes-pin').val();  // replace Text1 with ur TB id
            alert(tbval);
            $("<option/>").attr("value", tbval)
                .text(tbval)
                .appendTo("#listone1");
               $("#servicablepincodes-pin").val('');
            });
        $("#btn2").click(function(){
             
             listval = $('#listone1').val();
             //alert(listval);
           if(listval==null)
           //if (('#listone1').val()== null && ('#listone1').val() == '') 
            { 
                    alert("Please Select Atleast one Pincode."); 
                    e.preventDefault();                                                             
            }
              $("#listone1 option:selected").remove();
        
         });
});
