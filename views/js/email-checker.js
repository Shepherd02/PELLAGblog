 function checkEmailExists(str) {
    $.ajax({
        type: "GET",
        url: 'helpers/checkEmailExists.php',
        data: {email: str},
        success: function($data){
            console.log($data);
            if ($data === "true") {
                document.getElementById("emailMsg").innerHTML = "Please choose another email";
            } else{
                document.getElementById("emailMsg").innerHTML = "";
            }
        }
    });
} 