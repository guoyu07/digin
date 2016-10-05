/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {  
    
             /*   $(document).on('click', '.submit',function(e){ 
                       
                       /*if( $('#listB > option').length<=0)
                        { 
                            alert("At least one facility should be selected from list"); 
                            e.preventDefault();                                                             
                        }*/
              //          $('#list2 > option').prop("selected",true);
              //       } );     
                
        /************************For Skills*****************************************/   
             /*   $('#btnAdd').click(  
                    function(e) {  
                        //alert("add 1...");
                       if( $('#list1 > option:selected').text()!='Select')
                        {    
                        $("#list2 > option[value='']").remove();                      
                        $('#list1 > option:selected').appendTo('#list2'); 
                        e.preventDefault(); 
                    }
                    });  
  
                  
  
                $('#btnRemove').click(  
                function(e) { 
                      if( $('#list2 > option:selected').text()!='Select')
                        { 
                            $('#list2 > option:selected').appendTo('#list1');                                          
                            e.preventDefault();  
                        }
                });  */
                
                
                
        /**********************For Hobbies***********************************/
        $(document).on('click', '.hobyadd',function(e){                                   
                        $('#listB > option').prop("selected",true);
            });
            
        $(document).on('click', '.hobysave',function(e){                                   
                        $('#listB > option').prop("selected",true);
            });
                     
                 $('#btnadd1').click(  
                    function(e) {  
                        //alert("add 2...");
                       if( $('#listA > option:selected').text()!='Select')
                        {    
                        $("#listB > option[value='']").remove();                      
                        $('#listA > option:selected').appendTo('#listB'); 
                        e.preventDefault(); 
                    }
                    });  
  
                  
  
                $('#btnremove1').click(  
                function(e) { 
                      if( $('#listB > option:selected').text()!='Select')
                        {                           
                            opt=$('#listB > option:selected').text();
                            val=$('#listB > option:selected').val();
                            if ($('#listA option:contains('+ opt +')').length) {
                                //alert('This option exists');
                                $("#listA > option[value="+val+"]").remove();  
                                $('#listB > option:selected').appendTo('#listA');                                          
                                e.preventDefault();  
                           }
                        }
                });  
                
             
      
 });  