<!doctype html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Badtrash - Random images FTW</title>
		<meta name="description" content="Random image loader. Try it for fun x2.">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="site.webmanifest"> 
		<link rel="apple-touch-icon" href="icon.png">
		<link rel="icon" type="image/png" href="favicon.png">
        <link rel="stylesheet" href="css/badtrash.css">
    </head>

	<body>		
		<header>
			<a id="logo" href="./">				
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 870 625" style="enable-background:new 0 0 870 625;" xml:space="preserve">
					<g id="Layer_1_1_">
						<g>
							<circle cx="435" cy="224" r="223.5"/>
							<path class="logo-thunder" d="M403.1,443.1l14.1-113.2c0.3-2.3-1.5-4.4-3.9-4.4h-31.6c-2.3,0-4.1-2-3.9-4.3l16-149.2c0.2-2,1.9-3.5,3.9-3.5
									h90.5c2.6,0,4.5,2.6,3.7,5.1l-30.5,98.2c-0.8,2.5,1.1,5.1,3.7,5.1H510c3.1,0,5,3.4,3.3,6l-103,162.8
									C408.1,449.2,402.6,447.3,403.1,443.1z"/>
							</g>
							<g>
								<path class="logo-text" d="M5.4,604.6v-96h54.4c19.2,0,28.1,12.4,28.1,24.5c0,12-7.3,20-16.4,22c10.2,1.6,18.3,11.4,18.3,23.5
									c0,14-9.4,26.1-28.2,26.1L5.4,604.6L5.4,604.6z M62.7,537.7c0-4.6-3.5-7.5-8.5-7.5h-24v15h24C59.3,545.2,62.7,542.4,62.7,537.7z
									M64.6,574.8c0-4.8-3.5-8.1-9.5-8.1H30.2V583h24.9C61,583,64.6,580,64.6,574.8z"/>
								<path class="logo-text" d="M183,604.6l-4.8-13.8h-37.9l-4.8,13.8h-28.1l36.1-96h31.2l36.1,96H183z M159.3,533.1l-12.2,36.1h24.3
									L159.3,533.1z"/>
								<path class="logo-text" d="M232.5,604.6v-96h40.3c30.2,0,52,18.1,52,48c0,29.8-21.7,48.1-51.8,48.1L232.5,604.6L232.5,604.6z
									M299.5,556.5c0-14.8-8.9-26.4-26.5-26.4h-15.7V583h15.6C289.7,583,299.5,570.8,299.5,556.5z"/>
								<path class="logo-text" d="M369.9,604.6v-74.4H343v-21.6h78.5v21.6h-26.8v74.4H369.9z"/>
								<path class="logo-text" d="M501.2,604.6l-16.1-32.3h-12.7v32.3h-24.8v-96h48.1c21.3,0,33.4,14.1,33.4,32c0,16.7-10.1,25.6-19.2,28.8
									l19.6,35.3L501.2,604.6L501.2,604.6z M503.9,540.4c0-6.6-5.3-10.2-12-10.2h-19.6v20.6H492C498.6,550.8,503.9,547.2,503.9,540.4z"
									/>
								<path class="logo-text" d="M622.4,604.6l-4.8-13.8h-37.9l-4.8,13.8H547l36.1-96h31.2l36.1,96H622.4z M598.8,533.1l-12.2,36.1h24.3
									L598.8,533.1z"/>
								<path class="logo-text" d="M664.5,591.1l13.1-19.3c6.9,6.9,17.6,12.7,30.8,12.7c8.4,0,13.5-2.9,13.5-7.6c0-12.7-54.3-2.2-54.3-39.2
									c0-16.1,13.5-30.5,38.2-30.5c15.4,0,28.8,4.6,39,13.4l-13.5,18.6c-8.1-6.8-18.6-10.1-28.1-10.1c-7.2,0-10.4,2.4-10.4,6.6
									c0,11.8,54.3,2.9,54.3,38.6c0,19.3-14.3,32.1-40,32.1C687.7,606.4,674.1,600.2,664.5,591.1z"/>
								<path class="logo-text" d="M837.7,604.6V566h-39.9v38.6H773v-96h24.8v35.9h39.9v-35.9h24.8v96H837.7z"/>
							</g>
						</g>
					</svg>
				</a>

			<h1>Badtrash is a simple image loader of over 5000 very stupid images.<br><span class="is-visible">Click</span><span class="is-hidden">Tap</span> the image to load more...</h1>
		</header>

        <main>
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
		</main>

        <footer>
			<div class="copy">© <?php echo date("Y") ?> Some Rights Reserved. Only joking. This website was <a href="https://twitter.com/__oily">created by this guy</a>.</div>
			<div class="server-info">
				<?php
					$ip = $_SERVER['REMOTE_ADDR'];
					$browser = $_SERVER['HTTP_USER_AGENT'];
					$referrer = $_SERVER['HTTP_REFERER'];
						if ($referred == "") {
						  $referrer = "This page was accessed directly";
						}
					echo "Visitor IP address: " . $ip . "<br/>";
					echo "Browser (User Agent) Info: " . $browser . "<br/>";
					echo "Referrer: " . $referrer . "<br/>";
				?>
			</div>
        </footer>

		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
		<script src="js/trash.js"></script>
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-92796003-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-92796003-1');
			</script>
	</body>
</html>