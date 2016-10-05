/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(  
        
            function() {  
                $(document).on('click', '.submit',function(e){ 
                       
                       /*if( $('#listB > option').length<=0)
                        { 
                            alert("At least one facility should be selected from list"); 
                            e.preventDefault();                                                             
                        }*/
                        $('#listB > option').prop("selected",true);
                     } );
                
               
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
                 
 });  