$(document).ready(  
           function() {  
        
  /*******Approved For GovermentDocumentType*********/
    $(document).on('click',' .aprov', function(e) {
        //alert('himm,,,,,');
      theid= $(this).attr("id");
        arr = theid.split("_");
        if(arr[2]==0){
            alert("Do You Want to Approve....");
        }else{
            alert("Do You Want to InApprove....");
    }
    $.ajax({
        type:"POST",
        url:"index.php?r=govern-document-type/approvedgov", 
        data:{id:arr[1],
              idapprov:arr[2]},
         success:  function(result) { 
             /* if(arr[2]==1){
                 alert("vendor activate..")
             }else{
                 alert("vendor Inactivate..")
             }*/
            // alert(result);
            
             if(result==0){
                 alert("Not Approved Update.");
             }else{ 
             if(arr[2]==0){
                 $("#"+theid).removeClass("glyphicon glyphicon-ban-circle");
                 $("#"+theid).addClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).css("color","#33CCFF");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_1");
                  alert("Approved..");                                 
             }else{
                  $("#"+theid).removeClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).addClass("glyphicon glyphicon-ban-circle");                
                  $("#"+theid).css("color","#d9534f");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_0");
                  alert("Inapproved..");
             }
             
             }
         },
    })
   
   });
   
  
   /*******Approved For Skills*********/
    $(document).on('click',' .aprovs', function(e) {
        //alert('himm,,,,,');
      theid= $(this).attr("id");
        arr = theid.split("_");
        if(arr[2]==0){
            alert("Do You Want to Approve....");
        }else{
            alert("Do You Want to InApprove....");
    }
    $.ajax({
        type:"POST",
        url:"index.php?r=skills/approvedskill", 
        data:{id:arr[1],
              idapprov:arr[2]},
         success:  function(result) { 
             /* if(arr[2]==1){
                 alert("vendor activate..")
             }else{
                 alert("vendor Inactivate..")
             }*/
            // alert(result);
            
             if(result==0){
                 alert("Not Approved Update.");
             }else{ 
             if(arr[2]==0){
                 $("#"+theid).removeClass("glyphicon glyphicon-ban-circle");
                 $("#"+theid).addClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).css("color","#33CCFF");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_1");
                  alert("Approved..");                                 
             }else{
                  $("#"+theid).removeClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).addClass("glyphicon glyphicon-ban-circle");                
                  $("#"+theid).css("color","#d9534f");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_0");
                  alert("Inapproved..");
             }
             
             }
         },
    })
   
   });
   
  
   /*******Approved For Skills_Cast*********/
    $(document).on('click',' .aprovcast', function(e) {
        //alert('himm,,,,,');
      theid= $(this).attr("id");
        arr = theid.split("_");
        if(arr[2]==0){
            alert("Do You Want to Approve....");
        }else{
            alert("Do You Want to InApprove....");
    }
    $.ajax({
        type:"POST",
        url:"index.php?r=skills-cast/approvedskillcast", 
        data:{id:arr[1],
              idapprov:arr[2]},
         success:  function(result) { 
             /* if(arr[2]==1){
                 alert("vendor activate..")
             }else{
                 alert("vendor Inactivate..")
             }*/
            // alert(result);
            
             if(result==0){
                 alert("Not Approved Update.");
             }else{ 
             if(arr[2]==0){
                 $("#"+theid).removeClass("glyphicon glyphicon-ban-circle");
                 $("#"+theid).addClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).css("color","#33CCFF");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_1");
                  alert("Approved..");                                 
             }else{
                  $("#"+theid).removeClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).addClass("glyphicon glyphicon-ban-circle");                
                  $("#"+theid).css("color","#d9534f");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_0");
                  alert("Inapproved..");
             }
             
             }
         },
    })
   
   });
   
   
    /*******Approved For Skills_Faith*********/
    $(document).on('click',' .aprovfaith', function(e) {
        //alert('himm,,,,,');
      theid= $(this).attr("id");
        arr = theid.split("_");
        if(arr[2]==0){
            alert("Do You Want to Approve....");
        }else{
            alert("Do You Want to InApprove....");
    }
    $.ajax({
        type:"POST",
        url:"index.php?r=skills-faith/approvedskillfaith", 
        data:{id:arr[1],
              idapprov:arr[2]},
         success:  function(result) { 
             /* if(arr[2]==1){
                 alert("vendor activate..")
             }else{
                 alert("vendor Inactivate..")
             }*/
            // alert(result);
            
             if(result==0){
                 alert("Not Approved Update.");
             }else{ 
             if(arr[2]==0){
                 $("#"+theid).removeClass("glyphicon glyphicon-ban-circle");
                 $("#"+theid).addClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).css("color","#33CCFF");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_1");
                  alert("Approved..");                                 
             }else{
                  $("#"+theid).removeClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).addClass("glyphicon glyphicon-ban-circle");                
                  $("#"+theid).css("color","#d9534f");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_0");
                  alert("Inapproved..");
             }
             
             }
         },
    })
   
   });
   
     /*******Approved For Skills_Hobbies*********/
    $(document).on('click',' .aprovhobbi', function(e) {
        //alert('himm,,,,,');
      theid= $(this).attr("id");
        arr = theid.split("_");
        if(arr[2]==0){
            alert("Do You Want to Approve....");
        }else{
            alert("Do You Want to InApprove....");
    }
    $.ajax({
        type:"POST",
        url:"index.php?r=skills-hobbies/approvedskillhobbies", 
        data:{id:arr[1],
              idapprov:arr[2]},
         success:  function(result) { 
             /* if(arr[2]==1){
                 alert("vendor activate..")
             }else{
                 alert("vendor Inactivate..")
             }*/
            // alert(result);
            
             if(result==0){
                 alert("Not Approved Update.");
             }else{ 
             if(arr[2]==0){
                 $("#"+theid).removeClass("glyphicon glyphicon-ban-circle");
                 $("#"+theid).addClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).css("color","#33CCFF");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_1");
                  alert("Approved..");                                 
             }else{
                  $("#"+theid).removeClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).addClass("glyphicon glyphicon-ban-circle");                
                  $("#"+theid).css("color","#d9534f");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_0");
                  alert("Inapproved..");
             }
             
             }
         },
    })
   
   });
   
    /*******Approved For Skills_Religion*********/
    $(document).on('click',' .aprovreg', function(e) {
        //alert('himm,,,,,');
      theid= $(this).attr("id");
        arr = theid.split("_");
        if(arr[2]==0){
            alert("Do You Want to Approve....");
        }else{
            alert("Do You Want to InApprove....");
    }
    $.ajax({
        type:"POST",
        url:"index.php?r=skills-religion/approvedskillreg", 
        data:{id:arr[1],
              idapprov:arr[2]},
         success:  function(result) { 
             /* if(arr[2]==1){
                 alert("vendor activate..")
             }else{
                 alert("vendor Inactivate..")
             }*/
            // alert(result);
            
             if(result==0){
                 alert("Not Approved Update.");
             }else{ 
             if(arr[2]==0){
                 $("#"+theid).removeClass("glyphicon glyphicon-ban-circle");
                 $("#"+theid).addClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).css("color","#33CCFF");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_1");
                  alert("Approved..");                                 
             }else{
                  $("#"+theid).removeClass("glyphicon glyphicon-ok-circle");
                  $("#"+theid).addClass("glyphicon glyphicon-ban-circle");                
                  $("#"+theid).css("color","#d9534f");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_0");
                  alert("Inapproved..");
             }
             
             }
         },
    })
   
   });
   
   
  
});  