
/* 
Method : changeStatus
@param : id,controllerName (example user)
Author : Kundan Roy
Description : Change the status of record to activate or deactivate
*/

function Captcha(type){
     var alpha = new Array('1','2','3','4','5','6','7','8','9','0');
     var i;
     for (i=0;i<6;i++){
       var a = alpha[Math.floor(Math.random() * alpha.length)];
       var b = alpha[Math.floor(Math.random() * alpha.length)];
       var c = alpha[Math.floor(Math.random() * alpha.length)];
       var d = alpha[Math.floor(Math.random() * alpha.length)];
       var e = alpha[Math.floor(Math.random() * alpha.length)];
      }
    var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e;

    document.getElementById("mainCaptcha").innerHTML = code
    document.getElementById("mainCaptcha2").innerHTML = code  
    $('.btnSubmit').attr('disabled','disabled');
     $('.btnSubmit2').attr('disabled','disabled');
  }
  function ValidCaptcha(type){

    if(type==1){
       var string1 = removeSpaces(document.getElementById('mainCaptcha').innerHTML);

      var string2 = removeSpaces(document.getElementById('txtInput').value);
      if (string1 == string2){
        document.getElementById('CaptchaMsg').innerHTML="";  
        $('#btnSubmit').removeAttr("disabled");     
        return true;
        
      }
      else{ 
        document.getElementById('CaptchaMsg').innerHTML="Invalid Captcha";
        $('#btnSubmit').attr('disabled','disabled');       
        return false;
      } 
      }else{
        var string1 = removeSpaces(document.getElementById('mainCaptcha2').innerHTML);

          var string2 = removeSpaces(document.getElementById('txtInput2').value);
          
          if (string1 == string2){
            document.getElementById('CaptchaMsg2').innerHTML="";   
            $('.btnSubmit2').removeAttr("disabled"); 
            return true;
          }
          else{ 
            $('.btnSubmit2').attr('disabled','disabled');
            document.getElementById('CaptchaMsg2').innerHTML="Invalid Captcha";       
            return false;
          }
      }
      
  }

  function removeSpaces(string){
    return string.split(' ').join('');
  }



$(document).ready( function(event) {
    // enquiry
    $('#btnSubmit').attr('disabled','disabled'); 
    $("#Enquiry").validate({         
        errorClass: 'errorClass', // default input error message class        
        rules: {
            name: {
                required: true,                    
            },
             country: {
                required: true,                    
            },
            job_title: {
                required: true,                    
            }, 
            email: {
                required: true,
                email: true
            },            
            phone: {
                required: true,
            },
            request_description:{
                required:true
            }
        },
        
        submitHandler: function(form,e) {
             e.preventDefault();
            $.ajax({
                type: "POST",
                data:  $( "#Enquiry" ).serialize(),
                url: url+'/saveForm',
                beforeSend: function() {
                   $('#btnSubmit').html('please wait...');
                },
                success: function(response) {
                   $('#btnSubmit').html('Submit Request');
                   if(response.status==1){
                    form.reset();
                     bootbox.alert(response.message);
                   }else{
                    $('.successMsg').html(response.message+'<br>').css('color','red');
                   }
                }

            });

         }
        });


    // request 
    $('#btnSubmit').attr('disabled','disabled'); 
    $("#Request").validate({         
        errorClass: 'errorClass', // default input error message class        
        rules: {
            name: {
                required: true,                    
            },
             country: {
                required: true,                    
            },
            job_title: {
                required: true,                    
            }, 
            email: {
                required: true,
                email: true
            },            
            phone: {
                required: true,
            },
            request_description:{
                required:true
            }
        },
        
        submitHandler: function(form,e) {
             e.preventDefault();
            $.ajax({
                type: "POST",
                data:  $( "#Request" ).serialize(),
                url: url+'/saveForm',
                beforeSend: function() {
                   $('.btnSubmit2').html('please wait...');
                },
                success: function(response) {
                   $('.btnSubmit2').html('Submit Request');
                   if(response.status==1){
                    form.reset();
                     bootbox.alert(response.message);
                   }else{
                    $('.successMsg').html(response.message+'<br>').css('color','red');
                   }
                }

            });

         }
        });

    // contact

     $("#contactForm").validate({         
        errorClass: 'errorClass', // default input error message class        
        rules: {
            name: {
                required: true,                    
            },
             country: {
                required: true,                    
            },
            job_title: {
                required: true,                    
            }, 
            email: {
                required: true,
                email: true
            },            
            phone: {
                required: true,
            },
            request_description:{
                required:true
            },
            company:{
                required:true
            }
        },
        
        submitHandler: function(form,e) {
             e.preventDefault();
            $.ajax({
                type: "POST",
                data:  $( "#contactForm" ).serialize(),
                url: url+'/saveForm',
                beforeSend: function() {
                 //  $('.btnSubmit2').html('please wait...');
                },
                success: function(response) {
                   
                   if(response.status==1){
                    form.reset();
                     bootbox.alert(response.message);
                   }else{
                     bootbox.alert(response.message);
                   }
                }

            });

         }
        });

    });



function popupAlert(url,id){
    bootbox.confirm({
    title: "Destroy default category?",
    message: "Do you want to delete the default category? This cannot be undone.",
    buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
    callback: function (result) {
        if(result){
            $('#'+id).attr('href',url); 
            window.location.href = url;
        }

    }
});
}

/* 
Method : changeStatus
@param : id,controllerName (example user)
Author : Kundan Roy
Description : Change the status of record to activate or deactivate
*/
function changeStatus(id,method)
{
    var status =  $('#'+id).attr('data'); 
    $.ajax({
        type: "GET",
        data: {id: id,status:status},
        url: url+'/admin/'+method,
        beforeSend: function() {
           $('#'+id).html('Processing');
        },
        success: function(response) {
            
	  //bootbox.alert('Activated');            
		if(response==1)
            {
                $('#'+id).html('Active'); 
                $('#'+id).attr('data',response);
                $('#'+id).removeClass('label label-warning status').addClass('label label-success status');
                
                 console.log(response);
                 $('#btn'+id).removeAttr('disabled');
            }else
            {
                $('#'+id).html('Inactive'); 
                $('#'+id).attr('data',response);
                $('#'+id).removeClass('label label-success status').addClass('label label-warning status');
                $('#btn'+id).attr('disabled','disabled');
            }
        }
    });
}
/* 
Method : changeAllStatus
@param : id,controllerName (example user)
Author : Kundan Roy
Description : Change the status of all record to activate or deactivate
*/

function changeAllStatus(id,method,status)
{
    //var status =  $('#'+id).attr('data');
    //alert(url); return false;
    $.ajax({
        type: "GET",
        data: {id: id,status:status},
        url: url+'/'+method,
        beforeSend: function() {
           $('#'+id).html('Processing')
        },
        success: function(response) {
            
            if(response==1)
            {
                $('#'+id).html('Approved'); 
                $('#'+id).attr('data',response);
                $('#'+id).removeClass('label label-warning status').addClass('label label-success status');
                
                  
                
            }else if(response==2)
            {
                $('#'+id).html('Not Approve'); 
                $('#'+id).attr('data',response);
                $('#'+id).removeClass('label label-success status').addClass('label label-warning status');
                
            }
            else
            {
                $('#'+id).html('Yet not Approve'); 
                $('#'+id).attr('data',response);
                $('#'+id).removeClass('label label-success status').addClass('label label-warning status');
                
            }
        }
    });


}
/************28/12/2015[Ismael]***************/
var Title1='This field is required';
$(document).ready(function(){
$("#group_title").validate({          
        errorClass: 'error', // default input error message class        
        rules: {
            Title: {
                required: true,                    
            }
        },
        // Specify the validation error messages
        messages: {
            Title: {
                required: Title1               
                },           
        },
        submitHandler: function(event) {
             $("#group_title").submit();
         }
    });

/***********for users**************/
var firstname_msg="First Name is required."; 
var email_msg="Email Should be Validate.";
var pwd_msg="Password is required.";

$('#saveBtn').click(function(){
	//alert('saveBtn');
});


$("#users_form1").validate({          
        errorClass: 'error', // default input error message class        
        rules: {
            first_name: {
                required: true,                    
            },
            
            email: {
                required: true,
                email: true
            },            
            password: {
                required: true,
            }     
        },
        // Specify the validation error messages
        messages: {
           	first_name: {
                required: firstname_msg               
                },  
            email: {
                required: email_msg               
                },
            password: {
                required: pwd_msg,
                },     
        },
        submitHandler: function(event) {
	    
             $("#users_form").submit();
             return false;
         }
    });

/***************for package*******************/
var namefr="NameFR Should be filled.";
var nameen="NameEN Should be filled.";
var price="Price Should be filled and must be numeric";
var month="Month Should be filled.";
$("#package").validate({          
        errorClass: 'error', // default input error message class        
        rules: {
            NameFR: {
                required: true,                    
            },
            NameEN: {
                required: true,                    
            }
            ,
            Price: {
                required: true, 
                            
            }
            ,
            Month: {
                required: true,                    
            }
        },
        // Specify the validation error messages
        messages: {
            NameFR: {
                required: namefr               
                }, 
            NameEN: {
                required: nameen               
                }, 
            Price: {
                required: price 
                             
                },
            Month: {
                required: month               
                },           
        },
        submitHandler: function(event) {
             $("#package").submit();
         }
    });
/*****************building**********************/
var Title_img="Title Should be filled.";
var file_name="File name Should be filled.";
$("#building").validate({          
        errorClass: 'error', // default input error message class        
        rules: {
            Title: {
                required: true,                    
            },
            File_name: {
                required: true,                    
            }                    
        },
        // Specify the validation error messages
        messages: {
            Title: {
                required: Title_img               
                }, 
            File_name: {
                required: file_name               
                }       
        },
        submitHandler: function(event) {
             $("#building").submit();
         }
    });

var price_by_month1="Price by month Should be filled.";
$("#building_rent").validate({          
        errorClass: 'error', // default input error message class        
        rules: {
            price_by_month: {
                required: true,                    
            }                  
        },
        // Specify the validation error messages
        messages: {
            price_by_month: {
                required: price_by_month1               
                }      
        },
        submitHandler: function(event) {
             $("#building_rent").submit();
         }
    });
var inclusion="Inclusion Should be filled.";
$("#building_inc").validate({          
        errorClass: 'error', // default input error message class        
        rules: {
            Inclusion: {
                required: true,                    
            }                  
        },
        // Specify the validation error messages
        messages: {
            Inclusion: {
                required: inclusion               
                }      
        },
        submitHandler: function(event) {
             $("#building_inc").submit();
         }
    });

var exclusion="Exclusion Should be filled.";
$("#building_exc").validate({          
        errorClass: 'error', // default input error message class        
        rules: {
            Exclusion: {
                required: true,                    
            }                  
        },
        // Specify the validation error messages
        messages: {
            Exclusion: {
                required: exclusion               
                }      
        },
        submitHandler: function(event) {
             $("#building_exc").submit();
         }
    });

});

 
 

function getHora() {
    date = new Date();
    return date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
};




$(function(){
     $("#user-form2").validate({
        errorLabelContainer: '.error-loc',
         errorClass:'myClass',
        rules: {
            category_group_name: {
                required: true, 
            } 
        },
        // Specify the validation error messages
        messages: {
            category_group_name: {
                required: "category group name is required."
            },
             
        },
        submitHandler: function(event) {
            $("#user-form").submit();
        }
    });
});

function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }

 function checkAllContact(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }



 function deleteRow(tableID) {
     try {
         var table = document.getElementById(tableID);
         var rowCount = table.rows.length;

         for (var i = 1; i < rowCount; i++) {
             var row = table.rows[i];
             var chkbox = row.cells[0].childNodes[0];
             if (null != chkbox && true == chkbox.checked) {
                 table.deleteRow(i);
                 rowCount--;
                 i--;
             }
         }
     } catch (e) {
         alert(e);
     }
 }



function createGroup(Url,action) {
    var createGroup=0;
    var name ='';
     try {
        var checkValues = $('input[name=checkAll]:checked').map(function()
            {
                return $(this).val();
            }).get(); 
        //alert(action);
         if(checkValues.length==0){
             $('#error_msg').html('Please select contact to create group').css('color','red');
             $('#csave').hide();
             return false;
           }else{
                if(action=='save'){
                   name =  ($('#contact_group').val()).replace(/^\s+|\s+$/gm,'');
                   if(name.length==0){
                        $('#error_msg').html('Please enter group name.').css('color','red');
                        return false;
                     }else{
                        $('#error_msg').html('');
                        $('#csave').show();
                        createGroup =1;
                     }
               }else{
                     $('#error_msg').html('');
                        $('#csave').show();
               } 
           }  
            
            if(createGroup==1){
                $.ajax({
                    url: Url,
                    type: 'get',
                    data: { ids: checkValues,groupName:name },
                     dataType: "json",
                    success:function(data){
                         if(data.status==0){
                            $('#error_msg').html(data.message).css('color','red');
                            return false;
                         }else{
                             $('#responsive').modal('hide');
                             bootbox.alert('Group name created successfully',function(){
                                 var u =url+'/admin/contactGroup';
                                 console.log(u);
                                 window.location.assign(u);
                             });
                             
                         }
                        
                    }
                }); 
            }else{
                $('#responsive').modal('hide');
            }


     } catch (e) {
         alert(e);
     }
 }

 

    $(document).ready(function(){
        var action = "admin/contact/import";
        
     
            $("#import_contact").on('submit',(function(e){
                e.preventDefault();
                $.ajax({
                url: url+'/'+action,
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(datas){
                    console.log(datas);
                    var data = JSON.parse(datas); 
                    if(data.status==0){
                        $('#error_msg2').html(data.message).css('color','red');
                        return false;
                     }else{
                         $('#responsive2').modal('hide');
                         bootbox.alert('Contact imported successfully',function(){
                             var u =url+'/admin/contact';
                             console.log(u);
                             setTimeout(function(){ window.location.assign(u);},100);
                             
                         });
                     }
                },
                error: function(){}             
                });
            })); 
    });

    function updateGroup(Url,id) {
        createGroup=0;
        var name =$('form#updateGroup_'+id+' input#contact_group').val().replace(/^\s+|\s+$/gm,'');  
        console.log(id,name,'form#updateGroup_'+id+' input#contact_group');
        var parent_id = $('form#updateGroup_'+id+' input#parent_id').val();
        try {
        var checkValues = $('form#updateGroup_'+id+' input[name=checkAll]:checked').map(function()
            {
                return $(this).val();
            }).get(); 
        
         if(checkValues.length==0){
             $('form#updateGroup_'+id+' #error_msg').html('Please select contact from list').css('color','red');
            
             return false;
           }else{
                if(name.length==0){
                    $('form#updateGroup_'+id+' #error_msg').html('Please enter group name.').css('color','red');
                    return false;
                 }else{
                    $('form#updateGroup_'+id+' #error_msg').html('');
                    createGroup =1;
                 }
           }  
            if(createGroup==1){
                $.ajax({
                    url: Url,
                    type: 'get',
                    data: { ids: checkValues,groupName:name,parent_id:parent_id },
                     dataType: "json",
                    success:function(data){
                        //return false;
                         if(data.status==0){
                            $('#error_msg').html(data.message).css('color','red');
                            return false;
                         }else{
                             $('#responsive_'+id).modal('hide');
                             bootbox.alert('Group updated successfully',function(){
                                 var u =url+'/admin/contactGroup';
                                 console.log(u);
                                 //window.location.assign(u);
                                setTimeout(function(){ location.reload();},100);
                                
                             });
                             
                         }
                        
                    }
                }); 
            }else{
                $('#responsive').modal('hide');
            }


     } catch (e) {
         alert(e);
     }
 }
 
// import csv
    $(document).ready(function(){
        var action = $('#url_action').val();  
        var redirect_action = $('#redirect_action').val();
        
        $("#import_csv").on('submit',(function(e){
            e.preventDefault();
            $.ajax({
            url: url+'/'+action,
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(datas){
                console.log(datas);
                var data = JSON.parse(datas); 
                if(data.status==0){
                    $('#error_msg2').html(data.message).css('color','red');
                    return false;
                 }else{
                     $('#responsive2').modal('hide');
                     bootbox.alert('Csv imported successfully',function(){
                         var u =url+'/'+redirect_action;
                         console.log(u);
                         setTimeout(function(){ window.location.assign(u);},100);
                         
                     });
                 }
            },
            error: function(){}             
            });
        })); 
    });