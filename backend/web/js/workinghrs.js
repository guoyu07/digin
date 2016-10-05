/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    //$("#shift1").prop('checked',true);

    /****************Disable dropdowns of checked weekly off day*********************/
    $('.weekday').click(function() {
        var id = $(this).attr('id');
        var count = id.split('_');

        if ($("#day_" + count[1]).is(":checked"))
        {
            disabletimedrpdwn(count[1] - 1);
        }
        else
        {
            enabletimedrpdwn(count[1] - 1);
        }
    });

    function disabletimedrpdwn(index) {
        $(".drpdn_" + index).attr('disabled', 'disabled');
        $(".drpdn_" + index).removeAttr('enabled', 'enabled');

    }

    function enabletimedrpdwn(index) {
        $(".drpdn_" + index).attr('enabled', 'enabled');
        $(".drpdn_" + index).removeAttr('disabled', 'disabled');

    }



  
    $('input[name="Vendor[shift]"]').click(function() {
        
        applyShift($(this).val());  
    });
    
    function applyShift(shiftval)
    {
        if (shiftval == 'D')
        {
            $("#row4").show();
            $("#row5").show();
            $("#shiftname").html("Morning Shift");
        }
        if (shiftval == 'S')
        {
            $("#shiftname").html("Single Shift");
            $("#row4").hide();
            $("#row5").hide();
        }
    }
    
    
  
    /************For Single Shift******************/
    $("#applyall1").click(function() {
        day = '';
        var wklyoff = [];
        //wklyoff='';      for only 1 day
        fromtime = '';
        totime = '';
        $('.weekday').each(function() {
            if (!$(this).is(":checked"))
            {
                if (day == '')
                {
                    day = $(this).attr('id');
                    fromtime = $('#fromtime_' + day.split('_')[1]).val();
                    totime = $('#totime_' + day.split('_')[1]).val();
                }
            }
            else
            {
                //wklyoff=$(this).attr('id');        for only 1 day
                wklyoff.push($(this).attr('id'));  //for more than 1 day
            }
        });
        //alert(wklyoff);
        $('.weekday').each(function() {
            //if($(this).attr('id')!=wklyoff)        for only 1 day
            if ($.inArray($(this).attr('id'), wklyoff) == -1)  //$.inArray() method returns -1 when it doesn't find a match
            {
                $('#fromtime_' + $(this).attr('id').split('_')[1]).val(fromtime);
                $('#totime_' + $(this).attr('id').split('_')[1]).val(totime);
            }
        });
    });


    /************For Evening Shift******************/
    $("#applyall2").click(function() {
        day = '';
        var wklyoff = [];
        fromtime = '';
        totime = '';
        $('.weekday').each(function() {
            if (!$(this).is(":checked"))
            {
                if (day == '')
                {
                    day = $(this).attr('id');
                    fromtime = $('#evengfromtime_' + day.split('_')[1]).val();
                    totime = $('#evengtotime_' + day.split('_')[1]).val();
                }
            }
            else
            {
                wklyoff.push($(this).attr('id'));
            }
        });
        $('.weekday').each(function() {
            if ($.inArray($(this).attr('id'), wklyoff) == -1)  //$.inArray() method returns -1 when it doesn't find a match
            {
                $('#evengfromtime_' + $(this).attr('id').split('_')[1]).val(fromtime);
                $('#evengtotime_' + $(this).attr('id').split('_')[1]).val(totime);
            }
        });
    });


  for (i = 0; i <= 6; i++)
    {
       //alert($("#day_" + i+1).is(":checked"));
       
        if ($("#day_" +(i+1)).is(":checked")) {
             disabletimedrpdwn(i);

        }
    }
   
   applyShift($('input[name="Vendor[shift]"]:checked').val());  
   
  
});

               