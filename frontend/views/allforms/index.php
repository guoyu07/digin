<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
  
?>
<h1>allforms/index</h1>

<div class="testimonial-form" >             
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                                                           //'action' => [''], //allforms/test
                                                           //'method' => 'post',
                                                           'id'=>'testimonialform',
                                            ]);  ?>
        
             <div class="row">
                    <div class="col-xs-3">
                       <?= $form->field($testmodel, 'quotes')->textarea(['rows' => 6]) ?>
                   </div>
              </div>

              <div class="row">
                    <div class="col-xs-3">
                       <?= $form->field($testmodel, 'name')->textInput(['maxlength' => true]) ?>
                  </div>
              </div>
    
         <div class="row">
              <div class="col-xs-3">
                       <!--?= $form->field($testmodel, 'image')->fileInput() ?-->
                        <?php  echo $form->field($testmodel, 'image')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*']                      
                            ]);    ?>
              </div>
        </div>

               <div class="col-xs-3">
               <div class="form-group">
                   <?= Html::submitButton($testmodel->isNewRecord ? 'Create' : 'Update', ['class' => $testmodel->isNewRecord ? 'btn btn-success submit' : 'btn btn-primary submit']) ?>
               </div>
               </div>
             <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    //$("#testimonialform").attr("action","");
    alert($("#testimonialform").attr("action"));
  /*  $("#testimonialform").on("submit",function(e){ 
            var form=$(this);            
            $.post(form.attr("action"),
                   form.serialize()).done(function(result){                      
            // $.post.done(function(result){                        
                       alert(result);
                       if(result==1)
                       {
                           form.trigger("reset");                           
                           alert("Your information is saved successfully!");                          
                       }
                       else{                           
                           alert("Some of the field is missing!");            
                       }                      
                   }).fail(function()
                   {
                       alert("server error!");
                   });                
                   return false; 
           }); */
    
 /*   $("#testimonialform").submit(function(e){
    //$(document).on('click', '.submit',function(e){  
      alert($("#testimonialform").attr("action"));
       //e.preventDefault();
      var data = new FormData($('input[name="SkillsTestimonials[image]"]'));     
        jQuery.each($('input[name="SkillsTestimonials[image]"]')[0].files, function(i, file) {
            data.append(i, file);
        });
        alert(data);
        e.preventDefault();
     /*  $.ajax({
            type:"POST",
             //url:$("#testimonialform").attr("action"),  
             url:"index.php?r=allforms/test",
             data : data,
             contentType: false,
             processData: false,
              success:  function(result) {  
                   alert(result);
                //  $('#testimonialform').submit();                   
                },
        }); 
        
    }); */
    
    $("#testimonialform").submit(function(e)
    {
       // var postData = $(this).serializeArray();
        //var postData = $(this).serialize();
        var form=$(this);
        var formURL = $(this).attr("action");

      /*  var data = new FormData($('input[name="SkillsTestimonials[image]"]'));     
        jQuery.each($('input[name="SkillsTestimonials[image]"]')[0].files, function(i, file) {
            data.append(i, file);
        });
        alert(data);*/
        var data = new FormData(this);
        
       $.ajax(
            {
                url : formURL,
                type: "POST",
//                data : postData,
                data : data,
                contentType: false,
                processData: false,
                success:function(data)
                {
                    alert(data);
                    if(data==1)
                    {
                           //$(this).trigger("reset");                           
                           alert("Your information is saved successfully!");
                           console.log(data);
                    }
                    else{      
                            form.trigger("reset");  
                           // form.find('input:text, textarea').val('');
                           alert("Some of the field is missing!");            
                       }        
                    //data: return data from server
                },
                error: function(data)
                {
                    alert("server error!");
                    console.log(data.responseJSON);
                    //in the responseJSON you get the form validation back.
                }
            });
        e.preventDefault(); //STOP default action      
});   
</script>