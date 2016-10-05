/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
 /* **** This is for to generate autocomplete field dynamically via ajax
  *  var max_fields      = 1000; //maximum input boxes allowed
    var wrapper         = $("#form"); //Fields wrapper   
    var x = 0;//initlal text box 
    var count=1;
    
    $("#add1").click(function(e){  //on add input button click
    e.preventDefault();    
    if(x < max_fields){   
        x++;
    $.ajax({
        type:"POST",
           url:"index.php?r=vendor-products/createcatautocomp",
           data:{category:x},
           success:  function(result) {
               //alert(result);
               $(wrapper).append(result);
            },
    });   
    }
}); 

$(document).on( "autocompleteselect", ".catautcomp", function( event, ui ) {
    alert($(this).attr('id'));
     cid=$(this).attr('id').split('_')[1];
     alert($('#vendorproducts-'+cid+'-category').val());
     $('#vendorproducts-'+cid+'-category').val(ui.item.id);
     
} );*/


/*$(document).on( "autocompleteclose", ".catautcomp", function( event, ui ) {     
     var categoryid=$('#vendorproducts-category').val();
      $.ajax({
        type:"POST",
           url:"index.php?r=vendor-products/getcategory",           
           data:{category:categoryid},
           success:  function(result) {                           
               var data=jQuery.parseJSON(result);               
               $('#prod').autocomplete({
                source:data               
                }); 
            },
    });       
});*/
    
                     
$(document).on('click','#searchcat', function(){
    $('#cat').text('None');
    var category=$('#vendorproducts-catname').val();
     $.ajax({
        type:"POST",
           url:"index.php?r=vendor-products/getcategory",           
           data:{catname:category},
           success:  function(result) {                
               $('#vendorproducts-catname').val('');
               $("#listone").empty();
              var data=jQuery.parseJSON(result);
               $.each(data, function(index, value) {                   
                 $('#listone').append($('<option>').text(value['path']).val(value['id']));
                });
            
            },
    });       
});


$(document).on('click','#searchprod', function(){
    $('#prod').text('None');
    var product=$('#vendorproducts-prodname').val();
    var categoryid=$('#listone > option:selected').val();       
     $.ajax({
        type:"POST",
           url:"index.php?r=vendor-products/getproduct",           
           data:{prodname:product,
                 category:categoryid},
           success:  function(result) {                   
               $('#vendorproducts-prodname').val('');
               $("#listtwo").empty();
              var data=jQuery.parseJSON(result);
              if(data==''){                 
                   $('#listtwo').append($('<option>').text('No Results Found'));
              }
               $.each(data, function(index, value) {                   
                 $('#listtwo').append($('<option>').text(value['prodname']).val(value['prid']));
                });  
            
                $('#listtwo').change(function(){
                var product=$('#listtwo > option:selected').text();                
                var prodindex=$('#listtwo > option:selected').index();
                $('#prod').text(product);                
                $.each(data, function(index, value) { 
                    if(prodindex==index){                        
                        $('#cat').text(value['path']);
                        catid=value['catid'];                           
                        $('#listone > option[value='+catid+']').prop("selected",true);
                        return false;
                    }                    
                });
                });
            },
    });       
});

$('#listone').change(function(){
    var category=$('#listone > option:selected').text();
    $('#cat').text(category);
    
    var product=$('#vendorproducts-prodname').val();
    var categoryid=$('#listone > option:selected').val(); 
    $('#prod').text('None');
      $.ajax({
        type:"POST",
           url:"index.php?r=vendor-products/getproduct",           
           data:{prodname:product,
                 category:categoryid},
           success:  function(result) {                 
               $('#vendorproducts-prodname').val('');
               $("#listtwo").empty();                
              var data=jQuery.parseJSON(result);
              if(data==''){                 
                   $('#listtwo').append($('<option>').text('No Results Found'));
              }
               $.each(data, function(index, value) {                   
                 $('#listtwo').append($('<option>').text(value['prodname']).val(value['prid']));
                });  
            
                $('#listtwo').change(function(){
                var product=$('#listtwo > option:selected').text();                
                var prodindex=$('#listtwo > option:selected').index();
                $('#prod').text(product);                
                $.each(data, function(index, value) { 
                    if(prodindex==index){                        
                        $('#cat').text(value['path']);
                        catid=value['catid'];                           
                        $('#listone > option[value='+catid+']').prop("selected",true);
                        return false;
                    }                    
                });
                });
            },
    });    
});

    
$('#listtwo').change(function(){
    var product=$('#listtwo > option:selected').text();
    $('#prod').text(product);
});
$('#vendorproducts-unit').change(function(){
    var unit=$('#vendorproducts-unit > option:selected ').text();
    $('#unit').text(unit);
});
$('#vendorproducts-price').on('input', function(){
    var price=$('#vendorproducts-price').val();
    $('#price').text(price);
});
/******************Code to update grid view*************************/
  $("#vendorprodform").on("beforeSubmit",function(e){    
            var form=$(this);             
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){  
                                           
                       if(result==1)
                       {
                          //form.trigger("reset");
                           form.find('input:text, select').val('');                          
                           $(".prodtab").find("td").text("None");
                           $.pjax.reload({container:'#vendorprod'});
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
           
           
 //*****Product report********************************************************************///
 
 $(document).on('click','#searchcatrpt', function(){
    $('#cat').text('None');
    var category=$('#vendorproducts-catname').val();
   // alert(category);
     $.ajax({
        type:"POST",
           url:"index.php?r=vendor-products/getcategory",           
           data:{catname:category,
                _csrf:$("input[name='_csrf']").val(),
         },
           success:  function(result) {                
               $('#vendorproducts-catname').val('');
               $("#listone1").empty();
              var data=jQuery.parseJSON(result);
               $.each(data, function(index, value) {                   
                 $('#listone1').append($('<option>').text(value['path']).val(value['id']));
                });
            
            },
    });       
});
 
      
 $(document).on('click','#searchprodrpt', function(){
    $('#prod').text('None');
    var product=$('#vendorproducts-prodname').val();
    var categoryid=$('#listone1 > option:selected').val();       
     $.ajax({
        type:"POST",
           url:"index.php?r=vendor-products/getproduct",           
           data:{prodname:product,
                  category:categoryid,
                 _csrf:$("input[name='_csrf']").val(),
                 },
           success:  function(result) {                   
               $('#vendorproducts-prodname').val('');
               $("#listtwo").empty();
              var data=jQuery.parseJSON(result);
              if(data==''){                 
                   $('#listtwo').append($('<option>').text('No Results Found'));
              }
               $.each(data, function(index, value) {                   
                 $('#listtwo').append($('<option>').text(value['prodname']).val(value['prid']));
                });  
            
                $('#listtwo').change(function(){
                var product=$('#listtwo > option:selected').text();                
                var prodindex=$('#listtwo > option:selected').index();
                $('#prod').text(product);                
                $.each(data, function(index, value) { 
                    if(prodindex==index){                        
                        $('#cat').text(value['path']);
                        catid=value['catid'];                           
                        $('#listone1 > option[value='+catid+']').prop("selected",true);
                        return false;
                    }                    
                });
                });
            },
    });       
});

$('#listone1').change(function(){
  //  alert("jhjhkhk");
    var category=$('#listone1 > option:selected').text();
    $('#cat').text(category);
    
    var product=$('#vendorproducts-prodname').val();
    var categoryid=$('#listone1 > option:selected').val(); 
    $('#prod').text('None');
    //alert(categoryid);
      $.ajax({
        type:"POST",
           url:"index.php?r=vendor-products/getproduct",           
           data:{prodname:product,
                 category:categoryid,
                _csrf:$("input[name='_csrf']").val(),  
             },
           success:  function(result) {                 
               $('#vendorproducts-prodname').val('');
               $("#listtwo").empty();                
              var data=jQuery.parseJSON(result);
              if(data==''){                 
                   $('#listtwo').append($('<option>').text('No Results Found'));
              }
               $.each(data, function(index, value) {                   
                 $('#listtwo').append($('<option>').text(value['prodname']).val(value['prid']));
                });  
            
                $('#listtwo').change(function(){
                var product=$('#listtwo > option:selected').text();                
                var prodindex=$('#listtwo > option:selected').index();
                $('#prod').text(product);                
                $.each(data, function(index, value) { 
                    if(prodindex==index){                        
                        $('#cat').text(value['path']);
                        catid=value['catid'];                           
                        $('#listone1 > option[value='+catid+']').prop("selected",true);
                        return false;
                    }                    
                });
                });
            },
    });    
});


$(document).on('click','#searchprod', function(){
  alert('hiiii');
    $('#prod').text('None');
    var product=$('#product-name').val();
     $.ajax({
        type:"POST",
           url:"index.php?r=featured-product/getproducts",           
           data:{prodname:product},
           success:  function(result) {                
               $('#product-name').val('');
               $("#prodlist").empty();
              var data=jQuery.parseJSON(result);
               $.each(data, function(index, value) {                   
                // $('#prodlist').append($('<option>').text(value['path']).val(value['id']));
                });
            
            },
    });       
});


});
