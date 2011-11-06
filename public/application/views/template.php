<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="/blueprint/style.css" type="text/css" media="screen, projection">
  		<link rel="stylesheet" href="/blueprint/print.css" type="text/css" media="print"> 
  	</head>

<body>
	<div id="body" class="container">
		<div id="header" class="span-24">
			<div class"logo">
				<h1><span id="gradient"></span>Do<span id="vamp">vamp</span></h1>
				<p id="description" class="push-5">Help us make the web more functional, clean and pretty.
					<br />Submit and Adopt websites that need to be revamped!
					<br />
					<span class="small quiet" style="text-align:center; margin-left:20px">-We requiere GitHub login to submit or adopt a website in need-</span>
				</p>
			</div>
		</div>
		<div class="reset"></div>
    	<div id="contents"><?= $contents ?></div>
    	<div class="reset"></div>
    	<div id="footer" class="span-24">
    		<p class="span-3 prepend-8 first"><a href="/about" >About</a></p>
    		<p class="span-3"><a href="/about" >FAQ</a></p>
    		<p class="span-3 append-7 last"><a href="/about">GitHub</a></p>
    	</div>
    </div>
</body>
</html>