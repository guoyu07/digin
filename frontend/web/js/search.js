$(document).ready(function($) {    
  
  $(".typesearch").on('input',function(e){    
      //alert($(this).attr('id'));
      var id=$(this).attr('id');
      var keyword=$("#"+id).val(); 
      var lat=$("#lat").val();
      var lng=$("#lng").val();
       $.ajax({
           type:"GET",
           url:"index.php?r=autosearch/search",          
           data:{search:keyword,
                 currentlat:lat,
                 currentlng:lng},
           success:  function(result) {
               //alert(result);
               var data=jQuery.parseJSON(result);               
               $("#"+id).autocomplete({
                minLength:3,     
                source:data,                
                  select: function( event, ui ) {
                    $("#"+id).val( ui.item.value);
                    //$( "#typesearch").val( ui.item.id); 
                    prodvals=ui.item.id.split(":");
                    if(prodvals[0]=='Product')
                    {
                        //event.preventDefault();
                    //$("#searchit").attr('action','index.php?r=search/searchproducts&lat='+lat+'&lng='+lng+'&prid='+prodvals[1]).submit();
                     //location.href='index.php?r=search/searchproducts&lat='+lat+'&lng='+lng+'&prid='+prodvals[1];
                     location.href='index.php?r=search/searchproducts&prid='+prodvals[1];
                    //$("#searchit").submit();
                    } 
                    else if(prodvals[0]=='Vendor')
                    {
                       // location.href='index.php?r=search/searchvendors&lat='+lat+'&lng='+lng+'&vid='+prodvals[1];
                        location.href='index.php?r=search/searchvendors&vid='+prodvals[1];
                    }
                    else if(prodvals[0]=='Category')
                    {
                        location.href='index.php?r=productdetail/productdetails&catid='+prodvals[1];
                    }
                    return false;
                  }
                })
                .autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                  .append( "<a id=value>" + item.label + "</a>" )
                  .append( "<a id=typ>" + item.type + "</a>" )                  
                  .appendTo( ul );
              }; 
            },
       });
  }); 
 
  $("#searchit").on('submit', function(e){      
      if($("#type").val()==""){
          e.preventDefault();
          alert("Please enter some characters to search!");
      }
  });


  $(".imgloc").click(function(e){
      //alert('hi m in..location..');
      if($('.loc').css('display') == 'none')
        {
             $(".loc").css('display','block');
        }
     else{
          $(".loc").css('display','none');
     }
  });
 
});
