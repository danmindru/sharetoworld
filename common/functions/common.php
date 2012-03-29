<?php

require_once (DB_DIR . 'config.php');

/**
 * Redirect user to specified page
 * 
 * @param string $url
 */
function redirect ($url = '') {
	header("Location: " . URL . $url);
	die;
}


/**
 * Flash an information
 * 
 * @param string $message
 */
function flash_info ($message) {
	$_SESSION['_flash'] = true;
	$_SESSION['_flash_type'] = 'info';
	$_SESSION['_flash_message'] = $message; 
}

/**
 * Flash a success message
 * 
 * @param string $message
 */
function flash_success ($message) {
	$_SESSION['_flash'] = true;
	$_SESSION['_flash_type'] = 'success';
	$_SESSION['_flash_message'] = $message; 
}

/**
 * Flash an error message
 * 
 * @param $message
 */
function flash_error($message) {
	$_SESSION['_flash'] = true;
	$_SESSION['_flash_type'] = 'error';
	$_SESSION['_flash_message'] = $message; 
}

/**
 * Flash a warning
 * 
 * @param $message
 */
function flash_warning($message) {
	$_SESSION['_flash'] = true;
	$_SESSION['_flash_type'] = 'warning';
	$_SESSION['_flash_message'] = $message; 
}

/**
 * Returns boolean whether current request method is POST
 * 
 * @return bool
 */
function request_is_post() {
    return ('post' == strtolower($_SERVER['REQUEST_METHOD']));
}


/**
 * Get user ip address
 * 
 * @return string
 */
function get_user_ip () {
	//Exist if user use a proxy
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	
	//User Internet IP address
	return $_SERVER['REMOTE_ADDR'];
}

/**
 * Get internal page name
 * If is not internal page (from Netarena website) return ''
 * 
 * @param string $url 
 * @return string
 */
function get_internal_page ($url) {
	
	if (substr($url, 0, strlen(URL)) == URL) {
		$url = substr($url, strlen(URL));
		
		if (substr($url, 0, 7) != 'account') {
			return $url; 
		}
	}
	
	return '';
}

function getExtension($str) {
	$i = strrpos($str,".");
	
	if (!$i) { 
		return false; 
	}
	
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

function generate_string($length) {
	
	$small_letters 	= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
	$big_letters 	= array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
	$numbers		= array("0","1","2","3","4","5","6","7","8","9");
	$symbols		= array("!", "*");
	
	$string			= "";
	
	for($i = 0; $i < $length; $i++) {
		$random 	= rand(1,7);
		
		if($random == 1 || $random == 5) {
			$string .= $small_letters[rand(0, count($small_letters)-1)];
		} else if ($random == 2 || $random == 6) {
			$string .= $big_letters[rand(0, count($big_letters)-1)];
		} else if ($random == 3 || $random == 7) {
			$string .= $numbers[rand(0, count($numbers)-1)];
		} else if ($random == 4) {
			$string .= $symbols[rand(0, count($symbols)-1)];
		}
	}
	
	return $string;
}

function redimensionare_poza ($adresa_poza, $adresa_poza_prelucrata, $calitate, $latimea_maxima, $inaltimea_maxima, $proportional = true, $umplere = false, $culoare = array(255, 255, 255))  
{
	echo "redim";
	$detalii_poza_originala = pathinfo($adresa_poza);
	$detalii_poza_prelucrata = pathinfo($adresa_poza_prelucrata);
	
	switch ($detalii_poza_originala['extension']) { 
	case "gif": 
		$imagine_originala = imagecreatefromgif($adresa_poza);
		break; 
	case "jpg": 
		$imagine_originala = imagecreatefromjpeg($adresa_poza);
		break; 
	case "jpeg": 
		$imagine_originala = imagecreatefromjpeg($adresa_poza);
		break; 
	case "png": 
		$imagine_originala = imagecreatefrompng($adresa_poza);
		break; 
	default:
		print ("<b>Error:</b> Your file extension is not accepted.");
		die;
		break;
	}
	
	list ($latime_poza_originala, $inaltime_poza_originala) = getimagesize($adresa_poza);
		
	if ($proportional)
	{	
		$raport_original = $latime_poza_originala / $inaltime_poza_originala;
		$raport_maxim = $latimea_maxima / $inaltimea_maxima;

		if ($raport_maxim > $raport_original) 
		{
			$latime_poza = $inaltimea_maxima * $raport_original;
			$inaltime_poza = $inaltimea_maxima;
		}
		else
		{
			$latime_poza = $latimea_maxima;
			$inaltime_poza = $latimea_maxima / $raport_original;
		}
	} 
	else 
	{		
		$latime_poza = $latimea_maxima;
		$inaltime_poza = $inaltimea_maxima;
	}
	
	if ($umplere) 
	{
		$spatiu_sus = ceil (($inaltimea_maxima - ($inaltime_poza + 1)) / 2);
		$spatiu_stanga = ceil (($latimea_maxima - ($latime_poza + 1)) / 2);
		$latime_poza_returnata = $latimea_maxima; 
		$inaltime_poza_returnata = $inaltimea_maxima;
	} 
	else 
	{
		$spatiu_sus = 0;
		$spatiu_stanga = 0;
		$latime_poza_returnata = $latime_poza; 
		$inaltime_poza_returnata = $inaltime_poza;
	}
	
	$imagine_redimensionata = imagecreatetruecolor($latime_poza_returnata, $inaltime_poza_returnata);
	
	if ((is_array($culoare)) AND (count($culoare) == 3) AND ($culoare[0] <= 255) AND ($culoare[1] <= 255) AND ($culoare[2] <= 255))
	{
		$culoare_fundal = imagecolorallocate($imagine_redimensionata, $culoare[0], $culoare[1], $culoare[2]);		
	}
	else
	{
		$culoare_fundal = imagecolorallocate($imagine_redimensionata, 255, 255, 255);				
	}
	
	imagefill($imagine_redimensionata, 0, 0, $culoare_fundal);
	
	imagecopyresampled($imagine_redimensionata, $imagine_originala, $spatiu_stanga, $spatiu_sus, 0, 0, $latime_poza, $inaltime_poza, $latime_poza_originala, $inaltime_poza_originala);	
	
	switch ($detalii_poza_prelucrata['extension']) { 
	case "gif": 
		imagegif($imagine_redimensionata, $adresa_poza_prelucrata);
		break;
	case "jpeg": 
		imagejpeg($imagine_redimensionata, $adresa_poza_prelucrata, $calitate);
		break; 
	case "jpg": 
		imagejpeg($imagine_redimensionata, $adresa_poza_prelucrata, $calitate);
		break; 
	case "png": 
		$calitate = round ($calitate / 11.111);
		imagepng($imagine_redimensionata, $adresa_poza_prelucrata, $calitate);
		break; 
	default:
		print ("<b>Error:</b> Created file extension is not accepted.");
		die;
		break;
	}
	
	imagedestroy($imagine_redimensionata);
}


?>