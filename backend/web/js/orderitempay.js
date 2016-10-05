$(document).ready(function(){
    //$("#gosave").prop("disabled", true); 
    //$("#gosave").click(function(){
   
    //alert(paytype);
    
        
     $("#gosave").click(function(e){
         paytype = $("#orderitem-payacn").val();
        if(paytype==2){
          //alert("Submitted");
          //alert($('.grid-view').yiiGridView('getSelectedRows'));
          keys = $('.grid-view').yiiGridView('getSelectedRows');
          //alert(keys);
          $('#payrpt').append("<input type='hidden' name='selection' value='"+keys+"'>");
          //$('#payrpt').append(keys);
          $('#payrpt').submit();
        }else{
//          e.stopPropagation();
//          e.preventDefault();
          alert('Please select action..');
          e.preventDefault();
         } 
          
       });
      
});
 
 
 
 $(function() {
    var start = moment().subtract(30, 'days');
    var end = moment();
 
$('input[name="OrderitemSearch[vendor_pay_date]"]').daterangepicker();

$('input[name="OrderitemSearch[vendor_pay_date]"]').daterangepicker(
{
    locale: {
      format: 'YYYY-MM-DD'
    },
    startDate: start,
    endDate: end
}, 
        function(start, end, label) {
          
        });


});


$(function(){  
 var start = moment().subtract(30, 'days');
    var end = moment();
     
$('input[name="OrderitemSearch[crtdt]"]').daterangepicker();   

$('input[name="OrderitemSearch[crtdt]"]').daterangepicker(
{
    locale: {
      format: 'YYYY-MM-DD'
    },
    startDate: start,
    endDate: end
}, 
        function(start, end, label) {
          
        });
});