<?php

	// Set email to send messages to
	$emailTo = 'mo3roe6ka@gmail.com';

	// Do not edit anything from here unless you know what you are doing
	$contactErrors = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		if(trim($_POST['name']) === '')
		{
			$contactErrors['name'] = 'Your full name is required.';
		}
		else
		{
			$name = trim($_POST['name']);
		}
		
		if(trim($_POST['email']) === '')
		{
			$contactErrors['email'] = 'Your email address is required.';
		}
		else if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", trim($_POST['email'])))
		{
			$contactErrors['email'] = 'Your email address seems to be invalid.';
		}
		else
		{
			$email = trim($_POST['email']);
		}
		
		if(trim($_POST['message']) === '')
		{
			$contactErrors['message'] = 'Your message is required.';
		}
		else
		{
			if (function_exists('stripslashes'))
			{
				$message = stripslashes(trim($_POST['message']));
			}
			else
			{
				$message = trim($_POST['message']);
			}
		}
		
		if (empty($contactErrors) && trim($emailTo) !== '')
		{			
			$subject = '(Contact Form) From ' . $name;
			$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
			$headers = 'From: ' . $name . ' <' . $emailTo . '>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Rackhost Hosting & Business Theme</title>
		<meta charset="utf-8" />
		<!-- SEO Entries -->
                <meta content="gameserver, aow" name="keywords" />
                <meta content="AoW hosting for http://twitch.tv/c_a_k_e." name="description" />
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<!-- Stylesheets -->
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<!-- <link href="themes/blue/css/custom.css" rel="stylesheet" type="text/css" /> -->
		<!-- <link href="themes/blueHeader/css/custom.css" rel="stylesheet" type="text/css" /> -->
		<!-- Javascripts -->
		<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
		<script src="js/rackhost.js" type="text/javascript"></script>
	</head>
	<body>
		<!-- Site Wrapper Start -->
		<div class="siteWrapper">
			<!-- Site Header -->
			<div class="siteHeaderShadow">
			</div>
			<div class="siteHeader">
				<div class="center">
					<a class="logo" href="index.html"></a>
					<ul class="navigation">

					</ul>
				</div>
			</div>
			<!-- Content Header -->
			<div class="contentHeader">
				<div class="center">
					<h1>Contact <span>Us</span></h1>
					<ul>

					</ul>
				</div>
			</div>
			<!-- Content Wrapper -->
			<div class="contentWrapper">
				<div class="outerShadow">
				</div>
				<div class="innerShadow">
				</div>
				<div class="center clearfix">
					<!-- Additional clearfix necessary for non floated objects -->
					<div class="clearfix">
					</div>
					<!-- Content Starts - Header template should end here -->
					<!--Left layout column -->
					<div class="siteColumnLeft clearfix">
						<div class="column marginTop small">
							<iframe class="embed" width="268" height="180" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=new+york&amp;aq=&amp;sll=51.508101,-0.128059&amp;sspn=0.005669,0.016512&amp;ie=UTF8&amp;hq=&amp;hnear=New+York&amp;ll=40.714353,-74.005973&amp;spn=0.220933,0.528374&amp;t=m&amp;z=14&amp;output=embed&amp;iwloc=near"></iframe>
						</div>
						<div class="column marginTop small last">
							<iframe class="embed" width="268" height="180" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=london&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=58.206849,135.263672&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=London,+United+Kingdom&amp;ll=51.508155,-0.127974&amp;spn=0.010684,0.037336&amp;z=14&amp;iwloc=A&amp;output=embed&amp;iwloc=near"></iframe>
						</div>
						<!-- Clear necessary after every column row -->
						<div class="clear">
						</div>
						<?php if (isset($emailSent)): ?>
						<h2>Message <span>Sent</span></h2>
						<p class="text">Thank you, we have received your message and will reply as soon as possible.</p>
						<?php else: ?>
						<h2>Email <span>Contact</span></h2>
						<p class="text">If you would like to be contacted by a staff member of the Rackhost team, please fill out the form below.</p>
						<form id="contactForm" action="contact.php" method="post">
							<div class="column">
								<label for="name"><?php if (isset($contactErrors['name'])) { echo $contactErrors['name']; } else { echo 'Full Name'; } ?></label>
								<input id="name" name="name" type="text"<?php if(isset($name)) echo ' value="' . $name . '"'; ?> />
							</div>
							<div class="column">
								<label for="email"><?php if (isset($contactErrors['email'])) { echo $contactErrors['email']; } else { echo 'Email Address'; } ?></label>
								<input id="email" name="email" type="text"<?php if(isset($email)) echo ' value="' . $email . '"'; ?> />
							</div>
							<div class="column">
								<label for="message"><?php if (isset($contactErrors['message'])) { echo $contactErrors['message']; } else { echo 'Message'; } ?></label>
								<textarea id="message" name="message" cols="10" rows="8"><?php if(isset($message)) echo $message; ?></textarea>
							</div>
							<button type="submit" class="colorButton">Send Message</button>
						</form>
						<?php endif; ?>
					</div>
					<!-- Right layout column -->
					<div class="siteColumnRight">
						<div class="column">
							<h2>Rackhost <span>New York (HQ)</span></h2>
							<p class="text">
								765 Doe Boulevard,<br />Rochester, NY 14621
							</p>
							<h2>Rackhost <span>London</span></h2>
							<ul class="list tick">
								39 Doe Lane,<br />London, E1 6QL
							</ul>
							<h5>Additional <span>Information</span></h5>
							<ul class="columnNavigation">
								<li><a href="terms.html"><strong>Site</strong> Map</a></li>
								<li><a href="terms.html"><strong>Terms</strong> of Service</a></li>
								<li><a href="terms.html"><strong>Privacy</strong> Policy</a></li>
								<li><a href="terms.html"><strong>DMCA</strong> Policy</a></li>
							</ul>
							<h5>Customer <span>Review</span></h5>
							<div class="testimonialBox">
							<p>&ldquo;Rackhost utilizes the fasted and most reliable network I've ever hosted with.&rdquo;</p>
							<div class="author">
								<strong>John Doe</strong>, CEO Example.com
							</div>
						</div>
						</div>
					</div>
					<!-- Content Ends - Footer template should start here -->
				</div>
			</div>
			<!-- Twitter Widget -->
			<div class="twitterWidget">
				<div class="center">
					<!-- Simply change the href to your username -->
					<a class="profileLink" href="http://twitter.com/envatowebdesign"></a><p>Loading<span>Retrieving latest tweet...</span></p>
				</div>
			</div>
			<!-- Site Footer -->
			<div class="siteFooter">
				<div class="center clearfix">
					<div class="column tiny">
						<h5>Main <span>Navigation</span></h5>
						<ul class="columnNavigation">
							<li><a href="shared.html"><strong>Shared</strong> Hosting</a></li>
							<li><a href="virtual.html"><strong>Virtual</strong> Servers</a></li>
							<li><a href="dedicated.html"><strong>Dedicated</strong> Servers</a></li>
							<li><a href="about.html"><strong>About</strong> Rackhost</a></li>
							<li><a href="contact.html"><strong>Contact</strong> Us</a></li>
						</ul>
					</div>
					<div class="column tiny">
						<h5>Additional <span>Information</span></h5>
						<ul class="columnNavigation">
							<li><a href="terms.html"><strong>Site</strong> Map</a></li>
							<li><a href="terms.html"><strong>Terms</strong> of Service</a></li>
							<li><a href="terms.html"><strong>Privacy</strong> Policy</a></li>
							<li><a href="terms.html"><strong>DMCA</strong> Policy</a></li>
						</ul>
					</div>
					<div class="column tiny">
						<h5>Support <span>Center</span></h5>
						<ul class="columnNavigation">
							<li><a class="iconSmallPhone" href="contact.html"><strong>USA</strong> 123.456.7891</a></li>
							<li><a class="iconSmallChat" href="contact.html"><strong>Live</strong> Chat</a></li>
							<li><a class="iconSmallEmail" href="contact.html"><strong>Email</strong> Support</a></li>
							<li><a class="iconSmallClient" href="login.html"><strong>Client</strong> Login</a></li>
						</ul>
					</div>
					<div class="column tiny last">
						<h5>About <span>Rackhost</span></h5>
						<p class="text">Rackhost provides enterprise hosting and server services at an amazing price. Don't see something that suits your needs? <a href="contact.html">Get a free custom quote</a> from one of our hosting experts.</p>
					</div>
				</div>
			</div>
			<!-- Site Footer Bar -->
			<div class="siteFooterBar">
				<div class="center">
					<a class="backToTop" href="#">Back to Top</a><p>Follow us on <a href="#">Twitter</a>, <a href="#">Facebook</a> or <a href="#">LinkedIn</a> to receive updates regarding network issues, discounts and more.<br />2012 &copy; Rackhost. All rights reserved. Design by <a href="http://serifly.com">Serifly</a>
				</div>
			</div>
		</div>
		<!-- Site Wrapper Ends -->
	</body>
</html>