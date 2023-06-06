<?php
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_WARNING);
$lf_name = "counter.txt";
$monthly = 1;
$monthly_path = "oldfiles";
$type = 2;
$beforeTotalText = "Click counter: <span>";
$beforeUniqueText = "Unique visits this month: <span>";
$afterUniqueText = "</span>";
$display = 1;
$separator = "</span>  —  ";
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
					$info = $beforeTotalText . $totalHits . $separator . $beforeUniqueText . $uniqueHits . $afterUniqueText;
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
    // mt_srand( (double)microtime() * 1000000 );
    $num = array_rand($ar);
    return $ar[$num];
}
$imgList = getImagesFromDir($root . $path);
$img = getRandomFromArray($imgList);
?>
<!doctype html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Badtrash - Random images FTW</title>
		<meta name="description" content="Random image loader. Try it for fun x2.">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="site.webmanifest">
		<meta property="og:title" content="Badtrash">
		<meta property="og:type" content="Random image loader.">
		<meta property="og:url" content="http://www.badtrash.com/">
		<meta property="og:image" content="http://www.badtrash.com/badtrash.jpg">
		<link rel="apple-touch-icon" href="icon.png">
		<link rel="icon" type="image/png" href="favicon.png">
		<style>@font-face{font-family:Jet;src:url(css/fonts/jetbrains/JetBrainsMono-Regular.woff2) format('woff2'),url(css/fonts/jetbrains/JetBrainsMono-Regular.woff) format('woff');font-weight:400;font-style:normal;font-display:swap}::selection{background:#fe0f4d;color:#fff}::-moz-selection{background:#fe0f4d;color:#fff}@keyframes fadeOut{from{opacity:1}to{opacity:0}}.fade--out{animation-name:fadeOut;animation-duration:.45s;animation-fill-mode:forwards;animation-iteration-count:1;animation-timing-function:linear}html{height:100%}body{line-height:1;height:100vh;background-color:#1a1b1e;padding:45px;box-sizing:border-box;cursor:url(img/cursor_default.svg) 0 0,auto}body *,body ::after,body ::before{cursor:inherit}a{cursor:url(img/cursor_pointer.svg) 0 0,pointer}#container,main{display:grid;box-sizing:border-box}#container{grid-template-columns:1fr 2fr;max-width:100vw;height:100%;border:1px solid #444}main{justify-content:center;align-content:space-between;transition:all .65s ease 0s;padding:45px}#stats,body{margin:0}#stats,footer p,header p{color:#6a6a6a;font:12px/20px Jet,Arial,Helvetica,sans-serif}#logo,footer p,header,header p{transition:all .65s ease 0s}#logo{display:block;width:65%;margin:0 0 30px;outline:0}.badtrash_fill{fill:#fff;transition:fill .45s ease 0s}#logo:hover .badtrash_fill{fill:#fe0f4d}footer p,header p{margin:0 0 26px}header .p-white{color:#fff;margin-bottom:0}footer p{margin:0}#stats span,footer a{color:#fff}footer a:hover{color:#fe0f4d}#image-panel{display:flex;align-items:center;justify-content:center;background-color:#dedede;box-sizing:border-box;position:relative;overflow:hidden}#button{display:block;min-width:40px;min-height:40px;background-image:url(img/preloader.svg);background-position:center;background-repeat:no-repeat;outline:0}footer a{transition:all .35s ease 0s}#random-image{display:block;position:absolute;right:0;bottom:0;left:50%;min-height:60px;min-width:60px;max-height:100%;max-width:100%;top:50%;box-sizing:border-box;transform:translate(-50%,-50%);border:8px solid #dedede;box-shadow:0 0 15px rgba(166,166,166,.5);transition:border-color 360ms ease 0s}#random-image:hover{border-color:#fff}.is-visible{display:none}@media screen and (max-width:940px){body{height:auto}body,main{padding:15px}#logo{width:50vw;margin:0 auto 15px}header p{text-align:center;margin-bottom:15px}#stats-outer,footer{display:none}#container{grid-template-columns:none;grid-template-rows:1fr 3fr}#image-panel{overflow:visible;background-color:unset}#random-image{position:relative;right:unset;top:unset;left:unset;bottom:unset;transform:unset}.p-white{display:none}.is-visible{color:#fff;display:block}}</style>
    </head>

	<body>
		<div id="container">
			<main>
				<div id="stats-outer"><p id="stats"><?php echo $info; ?></p></div>

				<header>
					<a id="logo" href="./">				
						<svg version="1.1" id="badtrash_outer" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 402 49" style="enable-background:new 0 0 466.9 49;" xml:space="preserve">
							<g id="badtrash_version">
								<path class="badtrash_fill" d="M406.3,40.3h2.5v2.5h1.2v1.2h1.2v-1.2h1.2v-2.5h2.5v2.5h-1.2v1.2h-1.2v1.2h-1.2v1.2H410v-1.2h-1.2v-1.2h-1.2v-1.2h-1.2 L406.3,40.3L406.3,40.3z"/>
								<path class="badtrash_fill" d="M420,44.1h2.5v2.5H420V44.1z"/>
								<path class="badtrash_fill" d="M432.4,37.8v7.5h2.5v1.2h-7.5v-1.2h2.5v-5h-1.2v-1.2h1.2v-1.2L432.4,37.8L432.4,37.8z"/>
								<path class="badtrash_fill" d="M436.1,40.3h1.2v-1.2h1.2v-1.2h5v1.2h-3.7v1.2h-1.2v1.2h5v1.2h1.2v2.5h-1.2v1.2h-6.2v-1.2h-1.2L436.1,40.3L436.1,40.3z M438.6,42.8v2.5h3.7v-2.5H438.6z"/>
								<path class="badtrash_fill" d="M446.1,40.3h1.2v-1.2h1.2v-1.2h5v1.2h-3.7v1.2h-1.2v1.2h5v1.2h1.2v2.5h-1.2v1.2h-6.2v-1.2h-1.2L446.1,40.3L446.1,40.3z M448.6,42.8v2.5h3.7v-2.5H448.6z"/>
								<path class="badtrash_fill" d="M456.1,40.3h1.2v-1.2h1.2v-1.2h5v1.2h-3.7v1.2h-1.2v1.2h5v1.2h1.2v2.5h-1.2v1.2h-6.2v-1.2h-1.2L456.1,40.3L456.1,40.3z M458.6,42.8v2.5h3.7v-2.5H458.6z"/>
							</g>
							<g id="badtrash_logo">
								<path class="badtrash_fill" d="M2,2.3h12.7V15H40v6.3h6.3v19H40v6.3H2V2.3z M14.7,21.3v19h19v-19H14.7z"/>
								<path class="badtrash_fill" d="M52.6,21.3H59V15h38v31.6H59v-6.3h-6.3L52.6,21.3L52.6,21.3z M65.3,21.3v19h19v-19H65.3z"/>
								<path class="badtrash_fill" d="M103.3,21.3h6.3V15h25.3V2.3h12.7v44.3h-38v-6.3h-6.3V21.3z M115.9,21.3v19h19v-19H115.9z"/>
								<path class="badtrash_fill" d="M153.9,15h12.7V8.7h12.7V15h12.7v6.3h-12.7v19h6.3V34h12.7v6.3h-6.3v6.3h-19v-6.3h-6.3v-19h-12.7L153.9,15L153.9,15z"/>
								<path class="badtrash_fill" d="M204.5,15h38v6.3h6.3v6.3h-12.7v-6.3h-19v25.3h-12.7V15z"/>
								<path class="badtrash_fill" d="M255.1,21.3h6.3V15h38v31.6h-38v-6.3h-6.3L255.1,21.3L255.1,21.3z M267.8,21.3v19h19v-19H267.8z"/>
								<path class="badtrash_fill" d="M305.8,40.3h25.3V34h-19v-6.3h-6.3v-6.3h6.3V15h31.6v6.3h-19v6.3h19V34h6.3v6.3h-6.3v6.3h-38L305.8,40.3L305.8,40.3z"/>
								<path class="badtrash_fill" d="M356.4,2.3H369V15h25.3v6.3h6.3v25.3H388V21.3h-19v25.3h-12.7L356.4,2.3L356.4,2.3z"/>
							</g>
						</svg>
					</a>
					
					<p>This website randomly loads dumb & funny images to pass the time. Created in 2009, there are over 5.000 images and more are being added all the time.</p>
					<p class="p-white">Click the image to load more... →</p>
					<p class="is-visible">Tap the image to load more... ↓</p>
				</header>

				<footer>					
					<p>© <?php echo date("Y"); ?> Some Rights Reserved. Just kidding. This website was created by <a href="https://twitter.com/__mookid__">@__mookid__</a>, who also did <a href="http://www.randomImage.com/">The Simpsons.</a></p>
				</footer>
			</main>

			<div id="image-panel">
				<a id="button">
					<img id="random-image" alt="Totally random image" src="<?php echo $path . $img ?>" />
				</a>
			</div>
		</div>
        
		<script>
			button.addEventListener('click', function(e) {
				e.preventDefault();
				var randomImage = document.querySelector('#random-image');
				randomImage.classList.add('fade--out');

				randomImage.addEventListener("animationend", () => {
					var xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function () {
						if (xhr.readyState === 4 && xhr.status === 200) {
							var parser = new DOMParser();
							var htmlDoc = parser.parseFromString(xhr.responseText, 'text/html');
							var stats = htmlDoc.querySelector('#stats');
							var newRandomImage = htmlDoc.querySelector('#random-image');
							document.querySelector('#stats-outer').innerHTML = stats.outerHTML;
							document.querySelector('#button').innerHTML = newRandomImage.outerHTML;
						}
					};
					xhr.open('GET', 'loader.php', true);
					xhr.send();
				});
			});
		</script>

		<script async src="https://www.googletagmanager.com/gtag/js?id=G-LQ48H87T7P"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-LQ48H87T7P');
		</script>		
	</body>
</html>