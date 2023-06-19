// JavaScript code to send the variable value to the PHP file
var variableValue = "totalPrice"; // Replace with your actual variable value

$.ajax({
    type: "POST",
    url: "\my_project1\connect.php", // Replace with the path to your PHP file
    data: { variable: variableValue },
    success: function(response) {
        console.log(response);
    }
});
