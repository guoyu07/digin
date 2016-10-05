/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
     $(document).on('click', '.create',function(e){  
            if( $('#catlist > option').length<=0)
            { 
                    alert("At least one category should be selected from list"); 
                    e.preventDefault();                                                             
            }
            $('#catlist > option').prop("selected",true);
                        
                        
            var product=$('#product-prodname').val();
            var category=$('#catlist').val();       
            e.preventDefault();             
            $.ajax({
            type:"POST",
               url:"index.php?r=product/checkproduct",           
               data:{prodname:product,
                     prodcat:category},
               success:  function(result,e) {                                         
                  if(result>0){                                      
                      $('.proderror').text("Product Name already exists");                    
                  }
                  else{
                      $('#productform').submit();
                  }
                },
        }); 
                 
       });

        $('#btnAdd1').click(  
                    function(e) {  
                       if( $('#list1 > option:selected').text()!='Select')
                        {    
                        $("#catlist > option[value='']").remove();                      
                        $('#list1 > option:selected').appendTo('#catlist'); 
                        e.preventDefault(); 
                    }
                    });  
                    
  
                $('#btnRemove1').click(  
                function(e) { 
                      if( $('#catlist > option:selected').text()!='Select')
                        { 
                            $('#catlist > option:selected').appendTo('#list1');                                          
                            e.preventDefault();  
                        }
                });
       /**************to save primary image**************/        
        $(document).on('click','.file-preview-frame', function(e){
            //alert($('#'+$(this).attr('id')+'>img').attr('title'));               
            if($(e.target).attr('class')!=='glyphicon glyphicon-trash close'){
            $('.file-preview-frame').css('background-color','');
            $('#'+$(this).attr('id')).css('background-color','#F1D8D8');
            $('#productimages-primaryimage').val($('#'+$(this).attr('id')+'>img').attr('title'));
        }
        });
               
    
    /*******************js to delete image from database on click of delete icon(x)*****************************/
    $(document).on('click',' .close', function(e) {        
        var imageid = $(this).closest('.file-preview-frame').find('img').attr('id');  
        var divid=$(this).closest('.file-preview-frame').attr('id');        
        var prodid=divid.split('-')[1];
        
         $.ajax({
            type:"POST",
            url:"index.php?r=product/deleteimage",           
            data:{dbimage:imageid,
                  prodimage:prodid},
            success:  function(result) {                           
                alert(result);                     
                $("#"+imageid).remove();                
             },
        });
        
        var divid=$(this).closest('.file-preview-frame').attr('id');
        $("#"+divid).remove();              
    }); 

// Get the modal
var modal = document.getElementById('share-button');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
// span.onclick = function() {
    // modal.style.display = "none";
// }

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

   
});

  $(document).on('click',' .activ', function(e) { 
      theid= $(this).attr("id");
        arr = theid.split("_");
		stsid= $(this).attr("catstatus");
		//alert ( stsid);
		if(stsid==0){
			 alert("Please activate the catagory for this product."); 
		}else{
			if(arr[2]==0){
				alert("Do You Want to Active Product....");
			}else{
				alert("Do You Want to Inactive Product....");
			}
		}
		
	if(stsid==0){
		  alert("Can't activate the product"); 	
	}
	else{	
		$.ajax({
			type:"POST",
			url:"index.php?r=product/activeproduct", 
			data:{prid:arr[1],
				  pridactiv:arr[2]},
			 success:  function(result) {              
				 if(result==0){
					 alert("Product Not Updated.");
					 
				 }else{ 
					 if(arr[2]==0){
						 $("#"+theid).removeClass("glyphicon glyphicon-ban-circle");
						 $("#"+theid).addClass("glyphicon glyphicon-ok-circle");
						  $("#"+theid).css("color","#33CCFF");
						  $("#"+theid).attr("id","prod_"+arr[1]+"_1");
						  alert("Product is active.");  
										  
					 }else{
						  $("#"+theid).removeClass("glyphicon glyphicon-ok-circle");
						  $("#"+theid).addClass("glyphicon glyphicon-ban-circle");                
						  $("#"+theid).css("color","#d9534f");
						  $("#"+theid).attr("id","prod_"+arr[1]+"_0");
						  alert("Product is Inactive.");
						
					 }
				 }
			 },
		 })
	}
      
   });
   
   
   $(document).on('click','#searchcat', function(){
    //$('#cat').text('None');
    var category=$('#product-category').val();
     $.ajax({
        type:"POST",
           url:"index.php?r=product/getcategory",           
           data:{category:category},
           success:  function(result) {                
               $('#product-category').val('');
               $("#list1").empty();
              var data=jQuery.parseJSON(result);
               $.each(data, function(index, value) {                   
                 $('#list1').append($('<option>').text(value['path']).val(value['id']));
                });
            
            },
    });       
}); 
   
   $(document).on('click','#searchcat1', function(){
    //$('#cat').text('None');
    var category=$('#product-category').val();
     $.ajax({
        type:"POST",
           url:"index.php?r=product/getvendorcategory",           
           data:{category:category},
           success:  function(result) {                
               $('#product-category').val('');
               $("#list1").empty();
              var data=jQuery.parseJSON(result);
               $.each(data, function(index, value) {                   
                 $('#list1').append($('<option>').text(value['path']).val(value['id']));
                });
            
            },
    });       
}); 
 
$(document).on('click','#addvencat', function(e){
	 e.preventDefault();
    var vencat=$('#ventitlecat').val();
    var vencatitle=$('#title').val();
	if(vencatitle == ""){
		 alert("Title must be filled out");
		  return false;
	}else{
		 
     $.ajax({
        type:"POST",
           url:"index.php?r=product/addcatagory",           
           data:{vencatagory:vencat,
				 title:vencatitle}, 
           success:  function(result) { 	
				alert("hii");
				
				$('#ventitlecat').val('');
               $('#cat').val('');
               $('#title').val('');
		 var div = document.getElementById("suggcat");
			if (div.style.display !== "none") {
				div.style.display = "none";
			}
			else {
				div.style.display = "block";
			}
				},
    });
	}
});


/****************************For Active/Inactive Vender Catagory****************************/
 $(document).on('click',' .activVen', function(e) { 
      theid= $(this).attr("id");
        arr = theid.split("_");
        if(arr[2]==0){
            alert("Do You Want to Active Vendor Catagory....");
        }else{
            alert("Do You Want to Inactive Vendor Catagory....");
    }
    $.ajax({
        type:"POST",
        url:"index.php?r=category/actvendorproduct", 
        data:{id:arr[1],
              venidactiv:arr[2]},
         success:  function(result) { 
             
             if(result==0){
                 alert("Vendor Catagory Not Updated.");
             }else{ 
             if(arr[2]==0){
                 $("#"+theid).removeClass("glyphicon glyphicon-exclamation-sign");
                 $("#"+theid).addClass("glyphicon glyphicon-ok-sign");
                  $("#"+theid).css("color","rgb(92, 184, 92)");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_1");
                  alert("Vendor Catagory is active.");                                 
             }else{
                  $("#"+theid).removeClass("glyphicon glyphicon-ok-sign");
                  $("#"+theid).addClass("glyphicon glyphicon-exclamation-sign");                
                  $("#"+theid).css("color","rgb(217, 83, 79)");
                  $("#"+theid).attr("id","ven_"+arr[1]+"_0");
                  alert("Vendor Catagory is Inactive.");
             }
             
             }
         },
    })
   
 });

 
