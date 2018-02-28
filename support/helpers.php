<?php

// Var Dump and Die function
function dd($str){
    var_dump($str); die();
}

// Var Dump and Die function
function pd($str){
    print_r($str); die();
}
// Url For Articles
function createSlug($string, $chars= 150) {
    $string = substr($string, 0, $chars);

    $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/' => '-', ' ' => '-', ':' => '-', '\'' => '', ',' => '', '.' => '',
            '& ' => ''
    );

    // -- Remove duplicated spaces
    $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $string);

    // -- Returns the slug
    return strtolower(strtr($string, $table));
}

// Call the first string in an Array
function callOneArray($array, $num, $delimit = ", "){
	$imgArr = explode($delimit, $array);
	return $imgArr[$num];
}

// Change Slug to Normal Sentence
function loginStatement($string){
    $string = str_replace("-", " ", $string);
    $string = ucwords($string);
    return $string;
}

// Time and Date Format
function time_format($date){
    return date("F d, Y h:i:sa", strtotime($date));
}

// Time and Date Format
function date_normal($date){
    return date("d/m/Y h:i:sa", strtotime($date));
}

// Date Format Only
function format_date($date){
    return date("F d, Y", strtotime($date));
}

// Year and Month Format Only For Chart
function getMonthYear($month, $year){
	$months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
	$year = substr($year, 2,2);
	return $months[$month - 1] . "," . $year;
}

	// Time Format Only
    function time_format_only($date){
    /*
     * Format Date
     */

         return date("h:i:sa", strtotime($date));

    }

    // User Birthday
    function birthday($date){
        return date("F d, Y", strtotime($date));
    }

    // Shorten Text
    function shorten($text, $chars= 15){
        $text = $text." ";
        $text = substr($text, 0, $chars);
        $text = substr($text, 0, strrpos($text, " "));
        $text = $text . "...";
        return $text;
    }

    // Sanitize data
    function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       return $data;
    }

    // Function to get Ip Address of our customers
    function getIp(){
        $ip = $_SERVER['REMOTE_ADDR'];
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $ip;
    }

    // Copyright Function
    function copyYear($startYear){
        $currentYear = date("Y");
        if($startYear == $currentYear){
            return $startYear;
        }else{
            return $startYear . " - " . $currentYear;
        }
    }

    //  Separate an array into list of items
    function convertToCommaSeparatedString($fieldNames)
    {
        return trim(implode(", ", $fieldNames));
    }

	// Amount in Naira
	function inNaira($amount){
        $amount = number_format($amount);
		return "<b>&#8358;</b>" . $amount;
	}

	// Function for Quantity Total price
	function getTotalPrice($qty, $price){
		return $qty * $price;
	}

	function getFirst($text, $number=2) {
		// regular expression to find typical sentence endings
		$pattern = '/([.?!]["\']?)\s/';
		// use regex to insert break indicator
		$text = preg_replace($pattern, '$1bRE@kH3re', $text);
		// use break indicator to create array of sentences
		$sentences = explode('bRE@kH3re', $text);
		// check relative length of array and requested number
		$howMany = count($sentences);
		$number = $howMany >= $number ? $number : $howMany;
		// rebuild extract and return as single string
		$remainder = array_splice($sentences, $number);
		$result = array();
		$result[0] = implode(' ', $sentences);
		$result[1] = empty($remainder) ? false : true;
		return $result;
	}

	// Get Random Color
	function randColor()
	{
		return '#' . dechex(rand(0x000000, 0xFFFFFF));
	}

	 // Create Thumbnail Function
    function createThumbnail($filename, $path_to_image_directory, $path_to_thumbs_directory)
    {
        $final_width_of_image = 200;
        $final_height_of_image = 200;

        // Check Whether the File is JPG
        if(preg_match('/[.]jpg$/', $filename)){
            $im = imagecreatefromjpeg($path_to_image_directory . $filename);
        }
        else if(preg_match('/[.]gif$/', $filename)){
            $im = imagecreatefromgif($path_to_image_directory . $filename);
        } else{
            $im = imagecreatefrompng($path_to_image_directory . $filename);
        }

        // Get the Height and Width of the original Image
        $ox = imagesx($im);
        $oy = imagesy($im);
        // Your desire width and Height for thumbnail
        $nx = $final_width_of_image;
        $ny = $final_height_of_image; //floor($oy * ($final_width_of_image / $ox));

        $nm = imagecreatetruecolor($nx, $ny);
        imagecopyresized($nm, $im, 0, 0, 0, 0, $nx, $ny, $ox, $oy);

        // Check if the folder to save the thumbnail doesn't exist
        if(!file_exists($path_to_thumbs_directory)){
            if(mkdir($path_to_thumbs_directory)){
                imagejpeg($nm, $path_to_thumbs_directory . $filename);
            } else{
                die("There was a problem");
            }
        } else{
            imagejpeg($nm, $path_to_thumbs_directory . $filename);
        }
    }

    // Get Url
    function strleft($s1, $s2) {
        return substr($s1, 0, strpos($s1, $s2));
    }
    function selfURL() {
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
        $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
        return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
    }

    // Timeago Function
    function timeago($date) {
       $timestamp = strtotime($date);

       $strTime = array("second", "minute", "hour", "day", "month", "year");
       $length = array("60","60","24","30","12","10");

       $currentTime = time();
       if($currentTime >= $timestamp) {
            $diff     = time()- $timestamp;
            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            if($diff ==1){
                return $diff . " " . $strTime[$i] . " ago ";
            }else{
                return $diff . " " . $strTime[$i] . "s ago ";
            }
       }
    }

    // Get Browser
    function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Trident/i',$u_agent))
        { // this condition is for IE11
            $bname = 'Internet Explorer';
            $ub = "rv";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        // Added "|:"
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
         ')[/|: ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }

    // Pagination Function
    function pagination($page, $pages, $pageURL){
        $firstPage=1;
        $next = $page + 1;
        $prev = $page - 1;

        // Previous Button
        $info = '<li class="' . ($page == 1 ? "inactiveLink" : "") . '"><a href="'.($pageURL).($prev).'" aria-label="Previous">&laquo;</a></li>';
        // First Page Button
        $info .= '<li><a href="'.($pageURL).($firstPage).'" aria-label="First">First</a></li>';
        $i = $page;
        if($page >=5){
            $page -= 4;
        }
        for($x=$page; $x <= $page+9; $x++){
            $info .= '<li id="' . ($i === $x ? "currentPage" : "") .'"><a href="'.($pageURL).($x).'">'.$x.'</a></li>';
            if($x == $pages) break;
        }
        // Last Page Button
        $info .= '<li><a href="'.($pageURL).($pages).'" aria-label="Last">Last</a></li>';
        // Next Page Button
        $info .= '<li class="' . ($i == $pages ? "inactiveLink" : "") . '"><a href="'.($pageURL).($next).'" aria-label="Next">&raquo;</a></li>';

        return $info;
    }

// Convert string to sentence case
function sentenceCase($string) {
    $sentences = preg_split('/([.?!]+)/', $string, -1,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
    $newString = '';
    foreach ($sentences as $key => $sentence) {
        $newString .= ($key & 1) == 0?
            ucfirst(strtolower(trim($sentence))) :
            $sentence.' ';
    }
    return trim($newString);
}

// Search Query String Slug
function searchQuery($string){
    $string = str_replace(" ","+", $string);
    return $string;
}

// For Unique ID Like Youtube
function alphaID($in, $to_num = false, $pad_up = false, $pass_key = null){
    $out   =   '';
    $index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $base  = strlen($index);

    if ($pass_key !== null) {
    // Although this function's purpose is to just make the
    // ID short - and not so much secure,
    // with this patch by Simon Franz (http://blog.snaky.org/)
    // you can optionally supply a password to make it harder
    // to calculate the corresponding numeric ID

    for ($n = 0; $n < strlen($index); $n++) {
      $i[] = substr($index, $n, 1);
    }

    $pass_hash = hash('sha256',$pass_key);
    $pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

    for ($n = 0; $n < strlen($index); $n++) {
      $p[] =  substr($pass_hash, $n, 1);
    }

    array_multisort($p, SORT_DESC, $i);
    $index = implode($i);
    }

    if ($to_num) {
    // Digital number  <<--  alphabet letter code
    $len = strlen($in) - 1;

    for ($t = $len; $t >= 0; $t--) {
      $bcp = bcpow($base, $len - $t);
      $out = $out + strpos($index, substr($in, $t, 1)) * $bcp;
    }

    if (is_numeric($pad_up)) {
      $pad_up--;

      if ($pad_up > 0) {
        $out -= pow($base, $pad_up);
      }
    }
    } else {
    // Digital number  -->>  alphabet letter code
    if (is_numeric($pad_up)) {
      $pad_up--;

      if ($pad_up > 0) {
        $in += pow($base, $pad_up);
      }
    }

    for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
      $bcp = bcpow($base, $t);
      $a   = floor($in / $bcp) % $base;
      $out = $out . substr($index, $a, 1);
      $in  = $in - ($a * $bcp);
    }
    }

    return $out;
}

// Calculate Tax
function tax($amount, $tax=5){
  return $tax / 100 * $amount;
}
?>
