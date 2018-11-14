<?php
$root = '';
$path = 'images/';
function getImagesFromDir($path) {
    $images = array();
    if ( $img_dir = @opendir($path) ) {
        while ( false !== ($img_file = readdir($img_dir)) ) {
            if ( preg_match("/(\.gif|\.jpg|\.png|\.bmp|\.jpeg|\.JPEG|\.JPG|\.BMP|\.PNG|\.GIF)$/", $img_file) ) {
                $images[] = $img_file;
            }
        }
        closedir($img_dir);
    }
    return $images;
}
function getRandomFromArray($ar) {
    mt_srand( (double)microtime() * 10 );
    $num = array_rand($ar);
    return $ar[$num];
}
$imgList = getImagesFromDir($root . $path);
$img = getRandomFromArray($imgList);
?>

<?php
$lf_name = "counter.txt";
$monthly = 1;
$monthly_path = "oldfiles";
$type = 2;
$beforeTotalText = "<span>Click counter: ";
$beforeUniqueText = "Unique visits this month: ";
$display = 1;
$separator = "</span>  /  ";
$log_file = dirname(__FILE__) . '/' . $lf_name;

if ($_GET['display'] == "true") {
	die("<pre>&#60;? include(\"" . dirname(__FILE__) . '/' . basename(__FILE__) . "\"); ?&#62;</pre>");

} else {
	$uIP = $_SERVER['REMOTE_ADDR'];

	if (file_exists($log_file)) {
		$log = file_get_contents($log_file);

		if ($monthly) {
			$prev_name = $monthly_path . '/' . date("n-Y", strtotime("-1 month")) . '.txt';
			if (date('j') == 1 && !file_exists($prev_name)) {
				if (!file_exists($monthly_path)) {
					mkdir($monthly_path);
				}

				copy($log_file, $prev_name);

				if ($type == 0) {

					$toWrite = "1";
					$info = $beforeTotalText . "1";
				} else if ($type == 1) {

					$toWrite = "1;" . $uIP . ",";
					$info = $beforeUniqueText . "1";
				} else if ($type == 2) {

					$toWrite = "1;1;" . $uIP . ",";
					$info = $beforeTotalText . "1" . $separator . $beforeUniqueText . "1";
				}
				write_logfile($toWrite, $info);

			} else {
				if ($type == 0) {
					$toWrite = intval($log) + 1;
					$info = $beforeTotalText . $toWrite;

				} else if ($type == 1) {
					$hits = reset(explode(";", $log));
					$IPs = end(explode(";", $log));
					$IPArray = explode(",", $IPs);

					if (array_search($uIP, $IPArray, true) === false) {
						$hits = intval($hits) + 1;
						$toWrite = $hits . ";" . $IPs . $uIP . ",";
					} else {
						$toWrite = $log;
					}
					$info = $beforeUniqueText . $hits;

				} else if ($type == 2) {
					$pieces = explode(";", $log);
					$totalHits = $pieces[0];
					$uniqueHits = $pieces[1];
					$IPs = $pieces[2];
					$IPArray = explode(",", $IPs);
					$totalHits = intval($totalHits) + 1;
					if (array_search($uIP, $IPArray, true) === false) {
						$uniqueHits = intval($uniqueHits) + 1;
						$toWrite = $totalHits . ";" . $uniqueHits . ";" . $IPs . $uIP . ",";
					} else {

						$toWrite = $totalHits . ";" . $uniqueHits . ";" . $IPs;
					}
					$info = $beforeTotalText . $totalHits . $separator . $beforeUniqueText . $uniqueHits;
				}
				write_logfile($toWrite, $info);
			}
		} else {
			if ($type == 0) {
				$toWrite = intval($log) + 1;
				$info = $beforeTotalText . $toWrite;

			} else if ($type == 1) {
				$hits = reset(explode(";", $log));
				$IPs = end(explode(";", $log));
				$IPArray = explode(",", $IPs);
				if (array_search($uIP, $IPArray, true) === false) {
					$hits = intval($hits) + 1;
					$toWrite = $hits . ";" . $IPs . $uIP . ",";
				} else {
					$toWrite = $log;
				}

				$info = $beforeUniqueText . $hits;

			} else if ($type == 2) {
				$pieces = explode(";", $log);
				$totalHits = $pieces[0];
				$uniqueHits = $pieces[1];
				$IPs = $pieces[2];
				$IPArray = explode(",", $IPs);
				$totalHits = intval($totalHits) + 1;
				if (array_search($uIP, $IPArray, true) === false) {
					$uniqueHits = intval($uniqueHits) + 1;
					$toWrite = $totalHits . ";" . $uniqueHits . ";" . $IPs . $uIP . ",";
				} else {

					$toWrite = $totalHits . ";" . $uniqueHits . ";" . $IPs;
				}
				$info = $beforeTotalText . $totalHits . $separator . $beforeUniqueText . $uniqueHits;
			}
			write_logfile($toWrite, $info);
		}
	} else {
		$fp = fopen($log_file, "w");
		fclose($fp);
		if ($type == 0) {
			$toWrite = "1";
			$info = $beforeTotxalText . "1";
		} else if ($type == 1) {
			$toWrite = "1;" . $uIP . ",";
			$info = $beforeUniqueText . "1";
		} else if ($type == 2) {
			$toWrite = "1;1;" . $uIP . ",";
			$info = $beforeTotalText . "1" . $separator . $beforeUniqueText . "1";
		}
		write_logfile($toWrite, $info);
	}
}

function write_logfile($data, $output) {
	global $log_file;
	file_put_contents($log_file, $data);
	if ($display == 1) {
		echo $output;
	}
}
?>            
            <a class="count" href="javascript:;">
                <img id="random-image" alt="Random!" src="<?php echo $path . $img ?>" />
			</a>
			
			<div id="stats">
				<div id="stats-innard">
					<?php echo $info; ?>
				</div>
            </div>