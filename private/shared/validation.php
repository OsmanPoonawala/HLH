<?php 
	function isOnlyCharacter($var){
			if(!isset($var)||empty($var))
				return 7;
            if(strlen($var)<2){
                return 2;
            }
            if(strlen($var)>30){
                return 3;
            }
            if (preg_match("/^([a-zA-Z]+\s)*[a-zA-Z]+$/",$var))
            {
                return 1;
            }
            return 4;
        return false;
	}

	function isOnlyNumber($var){
        $var = trim($var," ");
		if(!isset($var)||empty($var))
				return 7;
        if (preg_match("/^\d+$/", $var))
        {
            return 1;
        }
        return 5;
        
    }

    function validateUserEmail($var){
    	if(!isset($var)||empty($var))
				return 7;
            if (preg_match("/^\w+([\.-]?\w+)*@nhs.net$/", $var))
            {
                return 1;
            }else if (preg_match("/^\w+([\.-]?\w+)*@[0-9a-zA-Z]+.nhs.uk$/", $var))
            {
                return 1;
            }
            return 6;   
    }

    function ValidateClientEmail($var) 
    {
    	if(!isset($var)||empty($var))
				return 7;

        if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$var))
        {

            return 1;

        }

        return 6;    
        
    }


	function getMessage($value,$title=""){
        
		switch ($value) {
			case '2':
				return $title." must have more than equal to 2 characters<br/>";
				break;
			case '3':
				return $title." must have less than equal to 30 characters<br/>";
				break;
			case '4':
				return $title." can only contain Characters<br/>";
				break;
			case '5':
				return $title." can only contain Numbers<br/>";
				break;
			case '6':
				return "Invalid Email<br/>";
				break;
			case '7':
				return "Emptry String<br/>";
				break;
			default:
				
				# code...
				break;
		}
	}
?>
