<?php


namespace App\Services;
use App\Data\DB;

class FormValidate
{
	public $error = []; // Array data to collect more than one error from the validation
	public $db;	// To Access Database
	public $dateValue; // Date Value

    // Check Empty
    public function checkEmpty($input, $elem){
        if(strlen($input) < 1){
            $this->error[] = "$elem is empty.";
        }
        else{
            return $input;
        }
    }
	// Name Validation Method
	public function name($name)
	{
		// Full Name must contain letters, dashes and spaces only and must start with upper case letter.
		if(!preg_match("/^[a-z0-9_-]{2,50}$/", $name)){
			$this->error[] = 'Only letters and white space allowed. Characters must between 2 and 50!';
		}
		else{
			return $name;
		}
	}

	// Email Address Validation Method
	public function email($email)
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->error[] = "Invalid Email Format!";
		}
		else{
			return $email;
		}
	}

	// Phone Number Validation Method
	public function phoneNumber($phoneNumber)
	{
		if(!preg_match("/[0-9-()+]{5,20}/", $phoneNumber)){
			$this->error[] = "Please Enter Your Phone Number!";
		}
		else{
			return $phoneNumber;
		}
	}

	// Password Validation
	public function password($pass)
	{
		if(!preg_match("/^[a-z0-9_-]{6,50}$/", $pass)){
			$this->error[] = "Please Enter Password, 6-50 characters.";
		}
		else{
			return sha1($pass);
		}
	}

	// Passwords Match Validation
	public function passwordMatch($pass1, $pass2)
	{
		if($pass1 != $pass2){
			$this->error[] = "Passwords do not Match!";
		}
		else{
			return $pass1;
		}
	}

	//URL Validation
	public function urlValidate($website)
	{
		if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
		  $this->error[] = "Invalid Website";
		}
		else{
			return $website;
		}
	}

	// Textbox Validation
	public function messageDetails($message, $max=5000, $min=50, $input="Message Box")
	{
		if(strlen($message) < $min || strlen($message) > $max){
			$this->error[] = "$input must be between $min and $max characters!";
		}
		else{
			return $message;
		}
	}

	// Date Validation For Registration
	public function CheckDate($month, $day, $year, $bool=true)
	{
		if(strlen($year) != 0 && strlen($month) != 0 && strlen($day) != 0){
			if(checkdate($month, $day, $year) !== false){
				$date = mktime(0,0,0,$month, $day, $year);
				return date("Y-m-d", $date);
			}
			else {
				$this->error[] = "Check the date again";
			}
	    }
		else{
			if($bool === true){
				if(strlen($month) == 0){ $input = "month"; }
				elseif (strlen($day) == 0){ $input = "day"; }
				elseif (strlen($year) == 0){ $input = 'year'; }
				else { $input = "Date of birth"; }
				$this->error[] = "Please enter the {$input} box.";
			}
		}
	}

    // Date Validation one Parameter
    public function checkDateInput($date){
        if(preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $matches))
        {
            if(checkdate($matches[2], $matches[3], $matches[1]))
            {
                return $date;
            }else{
                $this->error[] = "Please Fill the Date";
            }
        }
    }


	// User's Details Availability
	public function checkName($tableName, $key, $name)
	{
		$this->db = new DB;
		$check_name = $this->db->getTotalDataWhere($tableName, $key);
		if($check_name > 0){
			$this->error[] = "Name already taken. Try another name!";
		}else{
			return $name;
		}
	}

	// User's Details Availability
	public function checkEmail($tableName, $key)
	{
		$this->db = new DB;
		$check_email = $this->db->getTotalDataWhere($tableName, $key);
		if($check_email > 0){
			$this->error[] = "Email already taken. Try another email!";
			return false;
		}else{
			return true;
		}
	}

	// User's Details Availability
	public function checkPhone($tableName, $phone)
	{
		$this->db = new DB;
		$check_phone = $this->db->getTotalDataWhere($tableName, "mobile = '$phone'");
		if($check_phone > 0){
			$this->error[] = "Phone already used. Try another phone number!";
		}else{
			return $phone;
		}
	}

	// User's Details Availability
	public function checkEmailPass($tableName, $key)
	{
		$this->db = new DB;
		$check_user = $this->db->getTotalDataWhere($tableName, $key);
		if($check_user != 1){
            $this->error[] = "Login details not correct. Try Again";
		}
	}

	// Check User's Phone
	public function checkPhoneID($tableName, $phone, $id)
	{
		$this->db = new DB;
		// Check User's Phone
		$check_phone = $this->db->getTotalDataWhere($tableName, "mobile = '$phone' AND user_ID != '$id'");
		if($check_phone > 0){
			$this->error[] = "Phone Number taken. Try another Phone Number!";
		}
	}

	// Check User's Email
	public function checkEmailID($tableName, $email, $id)
	{
		$this->db = new DB;
		// Check User's Email
		$check_email = $this->db->getTotalDataWhere($tableName, "email = '$email' AND user_ID != '$id'");
		if($check_email > 0){
			$this->error[] = "Email Address taken. Try another Email Address!";
		}
	}

	// Check User's Name
	public function checkNameID($tableName, $name, $id)
	{
		$this->db = new DB;
		// Check User's Name
		$check_name = $this->db->getTotalDataWhere($tableName, "name = '$name' AND user_ID != '$id'");
		if($check_name > 0){
			$this->error[] = "Names already used. Try another Names!";
		}
	}

	// Check User's Password
	public function checkPasswordID($tableName, $password, $id, $email)
	{
		$this->db = new DB;
		// Check User's password
		$check_password = $this->db->getTotalDataWhere($tableName, "password = '$password' AND user_ID = '$id' AND email = '$email'");
		if($check_password != 1){
			$this->error[] = "Your Current password is not correct. Try again!";
		}
	}
}

