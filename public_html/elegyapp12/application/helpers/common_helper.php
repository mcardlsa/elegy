<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

 /**
* Function to particular hash tag string from description
*
* @param	description, character type
* @return	array
*/

function get_particular_tags($description,$type)
{
	$chunks = explode(" ",$description);
	foreach($chunks as $key=>$val)
	{
		if(!empty($val)){
			if(substr($val,0,1) == $type)
			{
				$result[] = substr($val,1);
			}
		}
	}
	return $result;
}

/**
* Function to get quality image width and height
*
* @param	image path variable, custom width 
* @return	array
*/
function get_image_size($imgpath,$defineWidth)
{
	$size = array();
	$new_size = array();
	
	$size = getimagesize($imgpath);	
	
	if($size[0]>$defineWidth || $size[1]>$defineWidth)
	{
		if($size[0]>$size[1])
		{
			$new_size[1] = ($defineWidth * $size[1])/$size[0];
			$new_size[0] = $defineWidth;
		}
		else
		{
			$new_size[0] = ($defineWidth * $size[0])/$size[1];
			$new_size[1] = $defineWidth;
		}
			
	}
	else
	{
		$new_size[0] = $size[0];
		$new_size[1] = $size[1];
	}
	
	return $new_size;
}

/**
* Function to generate random key
*
* @author	http://hawkee.com/snippet/10152/
* @param	variable,variable,boolean,boolean,array 
* @return	variable
*/
function randomToken($len = 64, $output = 5, $standardChars = true, $specialChars = true, $chars = array()) 
{
        $out = '';
        $len = intval($len);
        $outputMap = array(1 => 2, 2 => 8, 3 => 10, 4=> 16, 5 => 10);
        if (!is_array($chars)) { $chars = array_unique(str_split($chars)); }
        if ($standardChars) { $chars = array_merge($chars, range(48, 57),range(65, 90), range(97, 122)); }
        if ($specialChars) { $chars = array_merge($chars, range(33, 47),range(58, 64), range(91, 96), range(123, 126)); }
        array_walk($chars, function(&$val) { if (!is_int($val)) { $val = ord($val); } });
        if (is_int($len)) {
            while ($len) {
                $tmp = ord(openssl_random_pseudo_bytes(1));
                if (in_array($tmp, $chars)) {
                    if (!$output || !in_array($output, range(1,5)) || $output == 3 || $output == 5) { $out .= ($output == 3) ? $tmp : chr($tmp);  }
                    else { 
                        $based = base_convert($tmp, 10, $outputMap[$output]);
                        $out .= ((($output == 1) ? '00' : (($output == 4) ? '0x' : '')) . (($output == 2) ? sprintf('%03d', $based) : $based)); 
                    }
                    $len--;
                }
            }
        }
        return (empty($out)) ? false : $out;
}

/**
* Function to create thumb of a image
*
* @param	actual image path,output thumb path,custom image width
*/
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 
{
 
	$info = pathinfo($pathToImages);

    // continue only if this is a JPEG image
	if ( strtolower($info['extension']) == 'jpg' ||  strtolower($info['extension']) == 'jpeg') 
	{
		$img = imagecreatefromjpeg( "{$pathToImages}" );
		$width = imagesx( $img );
		$height = imagesy( $img );

		// calculate thumbnail size
		$new_width = $thumbWidth;
		$new_height = floor( $height * ( $thumbWidth / $width ) );

		// create a new temporary image
		$tmp_img = imagecreatetruecolor( $new_width, $new_height );

		// copy and resize old image into new image 
		imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	
		imagejpeg( $tmp_img, "{$pathToThumbs}" );
		  
	}else if(strtolower($info['extension']) == 'png'){
	
		$img = imagecreatefrompng( "{$pathToImages}" );
		$width = imagesx( $img );
		$height = imagesy( $img );

		// calculate thumbnail size
		$new_width = $thumbWidth;
		$new_height = floor( $height * ( $thumbWidth / $width ) );

		// create a new temporary image
		$tmp_img = imagecreatetruecolor( $new_width, $new_height );
		
		$black = imagecolorallocate($tmp_img, 0, 0, 0);
		imagecolortransparent($tmp_img, $black);
		// copy and resize old image into new image 
		imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	
		imagepng( $tmp_img, "{$pathToThumbs}" );
			
	}
	else if(strtolower($info['extension']) == 'gif'){
	
		$img = imagecreatefromgif( "{$pathToImages}" );
		$width = imagesx( $img );
		$height = imagesy( $img );

		// calculate thumbnail size
		$new_width = $thumbWidth;
		$new_height = floor( $height * ( $thumbWidth / $width ) );

		// create a new temporary image
		$tmp_img = imagecreatetruecolor( $new_width, $new_height );

		$background = imagecolorallocate($tmp_img, 255, 255, 255);
        // removing the black from the placeholder
        imagecolortransparent($tmp_img, $background);
		// copy and resize old image into new image 
		imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
	
		imagegif( $tmp_img, "{$pathToThumbs}" );
		  
	}
   
}


/**
* Function to get date difference between two time
*
* @param	UNIX time1,UNIX time2,precision
* @return	string
*/
// Time format is UNIX timestamp or
// PHP strtotime compatible strings
function dateDiff($time1, $time2, $precision = 6) 
{
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
	
		// Create temp time from time1 and interval
		$ttime = strtotime('+1 ' . $interval, $time1);
		
		// Set initial values
		$add = 1;
		$looped = 0;
		
		// Loop until temp time is smaller than time2
		while ($time2 >= $ttime) {
		
			// Create new temp time from time1 and interval
			$add++;
			$ttime = strtotime("+" . $add . " " . $interval, $time1);
			$looped++;
			
		}
 
		$time1 = strtotime("+" . $looped . " " . $interval, $time1);
		$diffs[$interval] = $looped;
    }
 
    $count = 0;
    $times = array();
	
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
	
		// Break if we have needed precission
		if ($count >= $precision) {
			break;
		}
		
		// Add value and interval 
		// if value is bigger than 0
		if ($value > 0) {
		
			// Add s if value is not 1
			if ($value != 1) {
				$interval .= "s";
			}
			
			// Add value and interval to times array
			$times[] = $value . " " . $interval;
			$count++;
			
		}
    }
 
    // Return string with times
    return implode(", ", $times);
}

/**
* Function to get date difference between two time
*
* @param	date1,date2
* @return	array
*/
function dateDifference($date1, $date2) 
{ 
    $d1 = (is_string($date1) ? strtotime($date1) : $date1); 
    $d2 = (is_string($date2) ? strtotime($date2) : $date2); 

    $diff_secs = abs($d1 - $d2); 
    $base_year = min(date("Y", $d1), date("Y", $d2)); 

    $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year); 

    return array 
    ( 
        "years"                 => abs(substr(date('Ymd', $d1) - date('Ymd', $d2), 0, -4)), 
        "months_total"  => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1, 
        "months"                => date("n", $diff) - 1, 
        "days_total"    => floor($diff_secs / (3600 * 24)), 
        "days"                  => date("j", $diff) - 1, 
        "hours_total"   => floor($diff_secs / 3600), 
        "hours"                 => date("G", $diff), 
        "minutes_total" => floor($diff_secs / 60), 
        "minutes"               => (int) date("i", $diff), 
        "seconds_total" => $diff_secs, 
        "seconds"               => (int) date("s", $diff) 
    ); 
}

/**
* Function to get unix time to human readable format
*
* @param	unix timestamp,format
* @return	human readable date
*/
if ( ! function_exists('unix_timestamp_to_human'))
{
	function unix_timestamp_to_human ($timestamp = "", $format = 'Y-m-d')
	{
		if (empty($timestamp) || ! is_numeric($timestamp)) $timestamp = time();
		return ($timestamp) ? date($format, $timestamp) : date($format, $timestamp);
	}
}
  
/**
* Function to check mandatory fields used in api controllers
*
* @param	mandatory params,data array,missing_param
* @return	boolean
*/
if ( ! function_exists('mandatory_params_present'))
{
	function mandatory_params_present($params,$actual, &$missing_param)
    {
		if(empty($actual)){ $actual = array(); }
        foreach($params as $param)
        {
			if(array_key_exists($param,$actual)===false || $actual[$param]=='')
			{
				$missing_param = $param;
				return false;
			}
        }
        return true;
    }
}


/**
* Function to send the android push notification
*
* @param	registatoin_ids,message
* @return	array
*/
if ( ! function_exists('send_notification'))
{
   function send_notification($registatoin_ids, $message) {
        // include config
        //include_once './config.php';
 
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
 
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
 
        $headers = array(
			'Authorization: key=' . 'AIzaSyBopC17DPkAt_IKCAE4GFBeyRMBImX9yMc',
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            //die('Curl failed: ' . curl_error($ch));
			//echo 'Curl failed: ' . curl_error($ch);
        }
 
        // Close connection
        curl_close($ch);
		return $result;
        //echo $result;
    }
}

/**
* Function to send the ios push notification
*
* @param	token,type,message
* @return	none
*/
if ( ! function_exists('push_notification_alert'))
{
	function push_notification_alert($token,$type,$msg){
	$payload=array('aps'=>array('alert' => $msg ,'badge' => 1, 'sound' => 'default', 'type' =>$type));
	$payload=json_encode($payload);

	$apnsHost='gateway.push.apple.com';
	//$apnsHost='gateway.sandbox.push.apple.com';
	$apnsPort=2195;
	$apnsCert='application/helpers/VapCapitol_Production.pem';

	$streamContext=stream_context_create();
	stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
	$apns=stream_socket_client('ssl://'.$apnsHost.':'.$apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
	if (!$apns) {
		// print "Failed to connect $error $errorString";
		// exit;
	}
	else {
		//print "Notification send\n";
		
	}
	//var_dump($apns);
	$apnsMessage=chr(0).chr(0).chr(32).pack('H*' , str_replace(' ', '', $token)).chr(0).chr(strlen($payload)).$payload;
	//var_dump($apnsMessage);
	fwrite($apns, $apnsMessage);
	}
}

/**
* Function to print mixed variables values like variable, array etc.
*
* @param	mixed variable
* @return	array
*/
function pr($var) {		
	$template = php_sapi_name() !== 'cli' ? '<pre>%s</pre>' : "\n%s\n";
	printf($template, print_r($var, true));
}

/**
* Function to get extension of file
*
* @param	string
* @return	string
*/	
function getExtension($str) 
{

        $i = strrpos($str,".");
	if (!$i) { 
		return "";
	} 

    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}

/**
* Function to get time consume between current date and custom date
*
* @param	custom date
* @return	string
*/	
function getHours($timestamp) 
{
	$time1 = time();
	$time2 = $timestamp; // earlier today	
    return ($time1 - $time2) / 3600; // 3600 seconds in hour
}

function time_elapsed_string($date)
{
	 if(empty($date)) {
        return "No date provided";
    }
    
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
    
    $now             = time();
    $unix_date         = strtotime($date);
    
       // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
        
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
    
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= "s";
    }
    
    return "$difference $periods[$j] {$tense}";
}

/**
* Function to get time consume between current time and custom time
*
* @param	custom unix time
* @return	string
*/	
function time_passed($timestamp)
{
    //type cast, current time, difference in timestamps

    $timestamp      = (int) $timestamp;
    $current_time   = time();
    $diff           = $current_time - $timestamp;
    
    //intervals in seconds
    $intervals      = array (
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'twoday' => 172800, 'hour' => 3600, 'minute'=> 60
    );
    
    //now we just find the difference
    if ($diff == 0)
    {
        return 'just now';
    }    

    if ($diff < 60)
    {
        return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
    }        

    if ($diff >= 60 && $diff < $intervals['hour'])
    {
        $diff = floor($diff/$intervals['minute']);
        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
    }        

    if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
    {
        $diff = floor($diff/$intervals['hour']);
        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
    }    

	if ($diff >= $intervals['day'] && $diff < $intervals['twoday'])
    {
        $diff = floor($diff/$intervals['day']);
        return $diff = 'Yesterday';
    } 
	
	if ($diff >= $intervals['day'] && $diff > $intervals['twoday'])
    {
        $diff =  date("F j, Y h:i a",$timestamp);
        return $diff;
    } 
	
    if ($diff >= $intervals['day'] && $diff < $intervals['week'])
    {
        $diff = floor($diff/$intervals['day']);
        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
    }    

    if ($diff >= $intervals['week'] && $diff < $intervals['month'])
    {
        $diff = floor($diff/$intervals['week']);
        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
    }  
 if ($diff >= $intervals['month'] && $diff < $intervals['year'])
    {
        $diff = floor($diff/$intervals['month']);
        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
    }    

    if ($diff >= $intervals['year'])
    {
        $diff = floor($diff/$intervals['year']);
        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
    }
}

/**
* Function to find out user lat lng accoridng to given address
*
* @param	address string
* @return	array
*/
function getLatLongByAddress($address) 
{
		$latlong = array();	
		$geometry_detail = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address));
		$geometry_detail = json_decode($geometry_detail);	
		if(isset($geometry_detail->status) && ($geometry_detail->status=="OK") && isset($geometry_detail->results[0])) {
		$latlong['userLatitude'] = $geometry_detail->results[0]->geometry->location->lat;
		$latlong['userLongitude'] = $geometry_detail->results[0]->geometry->location->lng;
		}	
	return $latlong;
}

/**
* Function to append link in url
*
* @param	url string
* @return	string
*/
function makeLinks($str) 
{
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/\www\.[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	$urls = array();
	$urlsToReplace = array();
	if(preg_match_all($reg_exUrl, $str, $urls)) {
		$numOfMatches = count($urls[0]);
		$numOfUrlsToReplace = 0;
		for($i=0; $i<$numOfMatches; $i++) {
			$alreadyAdded = false;
			$numOfUrlsToReplace = count($urlsToReplace);
			for($j=0; $j<$numOfUrlsToReplace; $j++) {
				if($urlsToReplace[$j] == $urls[0][$i]) {
					$alreadyAdded = true;
				}
			}
			if(!$alreadyAdded) {
				array_push($urlsToReplace, $urls[0][$i]);
			}
		}
		$numOfUrlsToReplace = count($urlsToReplace);
		for($i=0; $i<$numOfUrlsToReplace; $i++) {
			$str = str_replace($urlsToReplace[$i], "<a href=\"".$urlsToReplace[$i]."\" style='color:#0000FF'>".$urlsToReplace[$i]."</a>", $str);
		}
		return $str;
	} else {
		return $str;
	}
}

/**
* Function to calculate distance between two lat long
*
* @param	lat1,lon1,lat2,lon2
* @return	miles
*/
function distance($lat1, $lon1, $lat2, $lon2) 
{
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  return $miles;
}

// function to send the ios push notification for create Alert
/**
* Function to calculate distance between two lat long
*
* @param	lat1,lon1,lat2,lon2
* @return	miles
*/
if ( ! function_exists('push_notification_ios'))
{
	function push_notification_ios($param)
	{
		$passphrase = '8888';
		
		$paramload=array('aps'=>array('type' =>$param['notificationType'] ,'alert' => $param['message'] ,'sound' => 'default', 'funeralId' =>$param['funeralId']));
		$paramload=json_encode($paramload);

		//$apnsHost='gateway.push.apple.com';
		$apnsHost='gateway.sandbox.push.apple.com';
		$apnsPort=2195;
		$apnsCert='application/helpers/Elegy.pem';
        //$apnsCert='application/helpers/ck.pem';
		$streamContext=stream_context_create();
		stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
		stream_context_set_option($streamContext, 'ssl', 'passphrase', $passphrase);
		$apns=stream_socket_client('ssl://'.$apnsHost.':'.$apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
		if (!$apns) {
			// print "Failed to connect $error $errorString";
			// exit;
		}
		else {
			//print "Notification send\n";			
		}
		//var_dump($apns);
		$apnsMessage=chr(0).chr(0).chr(32).pack('H*' , str_replace(' ', '', $param['deviceToken'])).chr(0).chr(strlen($paramload)).$paramload;
		//var_dump($apnsMessage);
		fwrite($apns, $apnsMessage);
	}
}

function getQualityWH($filepath,$defineWidth,$defaultImagePath) 
{

	$new_size = array();
	$flag = check_image(stripslashes($filepath));
	if($flag == true)
	{
		$data['image'] = stripslashes($filepath);
		$new_size = get_image_size($data['image'],$defineWidth);
		if($new_size[0] > $defineWidth){
			$data['new_width'] = $defineWidth;
		}else{
			$data['new_width'] = $new_size[0];
		}
		
		if($new_size[1] > $defineWidth){
			$data['new_height'] = $defineWidth;
		}else{
			$data['new_height'] = $new_size[1];
		}
	}
	else
	{
		$data['image'] = $defaultImagePath;
		$data['new_width'] = $defineWidth;
		$data['new_height'] = $defineWidth;
	}
    return $data;
}

 
function check_image($filepath) 
{

    if (file_exists($filepath)) {
    
        return true;
    }
    else {
    
        return false;
    }
    
}
