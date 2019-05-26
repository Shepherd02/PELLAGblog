$(document).ready(function(){
    var $submitBtn = $("#form input[type='submit']");
    var $passwordBox = $("#password");
    var $confirmBox = $("#confirm_password");
    var $errorMsg =  $('<span id="error_msg">Passwords do not match.</span>');
    var $confirmMsg = $('<span id="confirm_msg">Confirmed:Passwords match.</span>');

    // This is incase the user hits refresh - some browsers will maintain the disabled state of the button.
    $submitBtn.removeAttr("disabled");

    function checkMatchingPasswords(){
        if($confirmBox.val() != "" && $passwordBox.val() != ""){
            if( $confirmBox.val() != $passwordBox.val() ){
                $submitBtn.attr("disabled", "disabled"); // disables submit button when confirmpassword and newpassword dont match
                $errorMsg.insertAfter($confirmBox);// error message appears next to confirm password box
            }else if($confirmBox.val() === $passwordBox.val()){
                $confirmMsg.insertAfter($confirmBox);
            }
        }

    }

    function resetPasswordError(){
        $submitBtn.removeAttr("disabled"); // enables submit button
        var $errorCont = $("#error_msg");
        var $ConfirmCont = $("#confirm_msg");
        if($errorCont.length > 0 || $ConfirmCont.length > 0){
            $errorCont.remove(); // clears out error if message is still shown
            $ConfirmCont.remove();
        }  
    }

    //checks for matching passwords on these events 
    $("#confirm_password, #password")
         .on("keydown", function(e){
            /* only check when the tab or enter keys are pressed
             * to prevent the method from being called needlessly  */
            if(e.keyCode == 13 || e.keyCode == 9) {
                checkMatchingPasswords();
            }
         })
         .on("blur", function(){  
            // also check when the element looses focus (clicks somewhere else)
            checkMatchingPasswords();
        })
        .on("focus", function(){
            // reset the error message when they go to make a change
            resetPasswordError();
        })

 });