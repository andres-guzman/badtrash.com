<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Badtrash - Random images ftw!</title>
        <meta name="description" content="Random image loader. Try it for fun x2.">        
        <link rel="stylesheet" href="css/badtrash.css">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="favicon.png">
    </head>

	<body>
        <header>
			<div id="header-wrapper">
				<h1><a id="logo" href="./">Badtrash</a></h1>
				<div id="about"><span class="glitch" data-text="Welcome">Welcome.</span> Badtrash is a simple image loader of over 5000 random, silly funny images. Click the image to load more...</div>
			 </div>
        </header>

        <div id="image-window">
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
				$separator = "</span>";
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
			<div id="stats">
                <?php echo $info; ?>
            </div>

            <a class="count" href="#random">
                <img id="random-image" src="<?php echo $path . $img ?>" />
            </a>
		</div>

        <footer>
			<span>©</span> <?php echo date("Y") ?> Some Rights Reserved. Only joking. This website was <a href="https://twitter.com/__oily">created by this person</a>.
			<div class="server-info">
				<?php
					$ip = $_SERVER['REMOTE_ADDR'];
					$browser = $_SERVER['HTTP_USER_AGENT'];
					$referrer = $_SERVER['HTTP_REFERER'];
						if ($referred == "") {
						  $referrer = "This page was accessed directly";
						}
					echo "Visitor IP address:" . $ip . "<br/>";
					echo "Browser (User Agent) Info:" . $browser . "<br/>";
					echo "Referrer:" . $referrer . "<br/>";
				?>
			</div>
        </footer>

		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
		<script src="js/trash.js"></script>
		<script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-92796003-1','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
	</body>
</html>