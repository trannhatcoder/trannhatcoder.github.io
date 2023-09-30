<?php
//set default values
$name = '';
$email = '';
$phone = '';
$message = 'Enter some data and click on the Submit button.';

//process
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
    case 'process_data':
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        /*************************************************
         * validate and process the name
         ************************************************/
        // 1. make sure the user enters a name
        $name = trim($name);
        $email = trim($email);
        $phone = trim($phone);

        if(empty($name)){
            $message = 'You must enter a name';
            break;
        }
        // 2. display the name with only the first letter capitalized
        $name = strtolower($name); //convert capitalize into lowercase
        $name = ucwords($name);  //Capitalize the first letter of each word

        /*************************************************
         * validate and process the email address
         ************************************************/
        // 1. make sure the user enters an email
        if(empty($email)){
            $message = 'You must enter an email address';
            break;
            // 2. make sure the email address has at least one @ sign and one dot character
        }else if(strpos($email, '@') === FALSE){
            $message = 'The email address must contain an @ sign';
            break;
        }else if(strpos($email, '.') === FALSE){
            $message = 'The email address must contain a dot character';
            break;
        }
        
        /*************************************************
         * validate and process the phone number
         ************************************************/
        // 1. make sure the user enters at least seven digits, not including formatting characters
        if(empty($phone)){
            $message = 'You must enter string number';
            break;
        }
        // 2. format the phone number like this 123-4567 or this 123-456-7890
        if(strlen($phone) < 10){
            $message = 'The phone number must contain at ten digister';
            break;
        }
        /*************************************************
         * Display the validation message
         ************************************************/
        $message = "Hello $name \n".
                    "Thank you for entering this data \n\n".
                    "Name: $name \n".
                    "Email: $email \n".
                    "Phone: $phone";

        break;
}
include 'string_tester.php';
?>