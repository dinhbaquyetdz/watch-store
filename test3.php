<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
  #header{
    position: absolute;
    z-index: 2000;
    width: 235px;
    top: 50px;
}
#header h1{
    font-size: 30px;
    font-weight: 400;
    text-transform: uppercase;
    color: rgba(255,255,255,0.9);
    text-shadow: 0px 1px 1px rgba(0,0,0,0.3);
    padding: 20px;
    background: #000;
}
#navigation {
    margin-top: 20px;
    width: 235px;
    display:block;
    list-style:none;
    z-index:3;
}
#navigation a{
    color: #444;
    display: block;
    background: #fff;
    background: rgba(255,255,255,0.9);
    line-height: 50px;
    padding: 0px 20px;
    text-transform: uppercase;
    margin-bottom: 6px;
    box-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    font-size: 14px;
}
#navigation a:hover {
    background: #ddd;
}
.panel{
    min-width: 100%;
    height: 98%;
    overflow-y: auto;
    overflow-x: hidden;
    margin-top: -150%;
    position: absolute;
    background: #000;
    box-shadow: 0px 4px 7px rgba(0,0,0,0.6);
    z-index: 2;
    -webkit-transition: all .8s ease-in-out;
    -moz-transition: all .8s ease-in-out;
    -o-transition: all .8s ease-in-out;
    transition: all .8s ease-in-out;
}
.panel:target{
    margin-top: 0%;
    background-color: #ffcb00;
}.content{
    right: 40px;
    left: 280px;
    top: 0px;
    position: absolute;
    padding-bottom: 30px;
}
.content h2{
    font-size: 110px;
    padding: 10px 0px 20px 0px;
    margin-top: 52px;
    color: #fff;
    color: rgba(255,255,255,0.9);
    text-shadow: 0px 1px 1px rgba(0,0,0,0.3);
}
.content p{
    font-size: 18px;
    padding: 10px;
    line-height: 24px;
    color: #fff;
    display: inline-block;
    background: black;
    padding: 10px;
    margin: 3px 0px;
}#home:target ~ #header #navigation #link-home,
#portfolio:target ~ #header #navigation #link-portfolio,
#about:target ~ #header #navigation #link-about,
#contact:target ~ #header #navigation #link-contact{
    background: #000;
    color: #fff;
}
</style>
<body>
<div id="home" class="content">
			<h2>Home</h2>
			<p>So you want a single page website, uh? Well, if you follow this tutorial you will be able to create a very nifty one-pager. Check out the rest of the sections on this page so you can see for yourself what am I talking about.</p>
			<p>This page consists of different panels that will slide or appear when clicking on the respective link.</p>
			<p>With the general sibling selector we can change the color of the "selected" panel link.</p>
		</div>
		
		
		
		<div id="portfolio" class="panel">
			<div class="content">
				<h2>Portfolio</h2>
				<p>Some really nice portfolio shots:</p>
				<ul id="works">
					<li><a href="#"><img src="http://web7b.com/files/assets/demo/portfolio_01.jpg" width="250"></a></li>
					<li><a href="#"><img src="http://web7b.com/files/assets/demo/portfolio_02.jpg" width="250"></a></li>
					<li><a href="#"><img src="http://web7b.com/files/assets/demo/portfolio_03.jpg" width="250"></a></li>
				</ul>
				<p class="footnote">Dribbble shots by <a href="http://dribbble.com/stuntman">Matt Kaufenberg</a>.</p>
			</div>
		</div>
		
		
		
		<div id="about" class="panel">
			<div class="content">
				<h2>About</h2>
				<p>It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
				<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
				<p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.</p>
				<p>She packed her seven versalia, put her initial into the belt and made herself on the way.</p>
			</div>
		</div>
		
		
		
		<div id="contact" class="panel">
			<div class="content">
				<h2>Contact</h2>
				<p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.</p>
				<p>Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy.</p>
				<form id="form">
					<p><label>Your Name</label><input type="text" /></p>
					<p><label>Your Email</label><input type="text" /></p>
					<p><label>Your Message</label><textarea></textarea></p>
				</form>
			</div>
		</div>
		
		
		
		<div id="header">
			<h1><a href="https://web7b.com/"><img src="https://web7b.com/files/assets/logo_thiet_ke_web_web7b.png" width="180px"></a></h1>
			<ul id="navigation">
				<li><a id="link-home" href="#home">Home</a></li>
				<li><a id="link-portfolio" href="#portfolio">Portfolio</a></li>
				<li><a id="link-about" href="#about">About Me</a></li>
				<li><a id="link-contact" href="#contact">Contact</a></li>
			</ul>
		</div>
</body>
</html>
