<?php

function validateProfileUpdate($data) {
    $errors = [];

    $newUsername = $data['username'];
    $newEmail = $data['email'];
    $newFullName = $data['full_name'];
    $newCountry = $data['country'];
    $newBirthdate = $data['birthdate'];
    $newMobileNumber = $data['mobile_number'];

    if (!isValidUsername($newUsername)) {
        $errors[] = "Username can only contain letters and numbers.";
    }

    if (!isValidEmail($newEmail)) {
        $errors[] = "Invalid or empty email address.";
    }

    if (!isValidName($newFullName) || !isValidName($newCountry)) {
        $errors[] = "Full name and country can only contain letters and spaces.";
    }

    if (!isValidMobileNumber($newMobileNumber)) {
        $errors[] = "Invalid mobile number. Only numeric values are allowed.";
    }

    return $errors;
}

function isValidUsername($username) {
    for ($i = 0; $i < strlen($username); $i++) {
        $char = $username[$i];
        if (!isValidLetterOrNumber($char)) {
            return false;
        }
    }
    return true;
}

function isValidEmail($email) {
  if (strpos($email, '@') === false || strpos($email, '.') === false) {
      return false;
  }

  return true;
}


function isValidName($name) {
    for ($i = 0; $i < strlen($name); $i++) {
        $char = $name[$i];
        if (!isValidLetterOrSpace($char)) {
            return false;
        }
    }
    return true;
}

function isValidMobileNumber($mobileNumber) {
    for ($i = 0; $i < strlen($mobileNumber); $i++) {
        $char = $mobileNumber[$i];
        if (!isValidDigit($char)) {
            return false;
        }
    }
    return true;
}

function isValidLetterOrNumber($char) {
    return (isLetter($char) || isNumber($char));
}

function isLetter($char) {
    return (($char >= 'a' && $char <= 'z') || ($char >= 'A' && $char <= 'Z'));
}

function isNumber($char) {
    return ($char >= '0' && $char <= '9');
}

function isValidLetterOrSpace($char) {
    return (isLetter($char) || $char === ' ');
}

function isValidDigit($char) {
    return ($char >= '0' && $char <= '9');
}
?>
