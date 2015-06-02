<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <link rel="shortcut icon" href="http://www.brianetheridge.com/favicon.ico" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>{$pageTitle}</title>
    <meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<meta name="viewport" content="width=device-width" />
    <base href='{$basePath}' />
	
	<link rel="stylesheet" type="text/css" href="assets/less/paginate.css">
  	<link rel="stylesheet" href="assets/less/style.css">

	<script src="assets/js/libs/modernizr-2.5.3.min.js"></script>

	<script type="text/javascript" src="assets/js/libs/jquery-1.8.2.js"></script>
  	<script type="text/javascript" src="assets/js/libs/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/js/libs/jquery-ui.css" media="all" />
    <script type="text/javascript" src="assets/js/libs/jquery.tooltip.js"></script>

    <script type="text/javascript" src="assets/js/libs/jquery.prettyPhoto.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/less/lightbox/prettyPhoto.css" media="screen" />

    <script type="text/javascript" src="assets/js/common_functions.js"></script>

    <script type="text/javascript" src="assets/js/libs/slides/slides.min.jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/less/slides/css/global.css">

    <script type="text/javascript" src="assets/js/libs/jquery.cookie.js"></script>
    <script type="text/javascript" src="assets/js/libs/jquery.cookiecuttr.js"></script>
    <link rel="stylesheet" href="assets/less/cookiecuttr.css">
    <script type="text/javascript">
        var basePath = "{$basePath}";
        {literal}
//        $(document).ready(function () {
//            var privacyPage = false;
//            if (window.location.pathname.indexOf('cookies')>=0){
//                privacyPage = true;
//            }
//            var message = '<p style="text-align:center;"><div style="text-align:left;">This website uses cookies for normal operations relating to session management.<br />' +
//                    "We do not use cookies to store other tracking data or personal information.<br />" +
//                    "If you continue without changing your settings, we'll assume that you are happy to receive all cookies on this website.<br />" +
//                    "You can <a href='cookies'>change your cookie settings</a> at any time.</div></p>"
//            $.cookieCuttr({
//                //cookieDiscreetLink: !privacyPage,
//                cookiePolicyPage: privacyPage,
//                cookieResetButton: privacyPage,
//                cookieDeclineButton: true,
//                cookieMessage: message,
//                cookieAnalyticsMessage: message  ,
//                cookieDiscreetPosition: "topleft",
//                cookiePolicyLink: basePath+"cookies",
//                cookieDomain: "brianetheridge.com"
//            });
//            if (jQuery.cookie('cc_cookie_decline') != "cc_cookie_decline") {
//                $.cookie("cc_cookie_decline", null, {
//                    path: '/'
//                });
//                $.cookie("cc_cookie_accept", "cc_cookie_accept", {
//                    expires: 365,
//                    path: '/'
//                });
//            }
//        });
        {/literal}
    </script>
</head>
<body>
{if !$overrideDefaultForm}
	<form name="frm" id="frm" method="post" action='' enctype="multipart/form-data">
		<input type="hidden" id="hidEvent" name="hidEvent" value="" />
		<input type="hidden" id="hidArguments" name="hidArguments" value="" />
		<input type="hidden" id="sessionToken" name="sessionToken" value="{$sessionToken}" />
{/if}
{if ($userLoggedIn)}
	<div id="loginBar"><span>Welcome, {$userName} {if $userRole}({$userRole}){/if}</span>&nbsp;&nbsp;<span id="declinedIndicator" style="display:none;">Cookies declined</span><a href="{$basePath}logout" class="logout">Log out</a></div>
{else}
    <div id="logoutBar">&nbsp;<span id="declinedIndicator" style="display:none;">Cookies declined</span></div>
{/if}

<!-- START WRAPPER -->
<div id="wrapper">
	<header>
		<h1>{$companyName}</h1>
			<nav id="staticNav">
                {include file="core/menu.tpl"}
			</nav>
			<div class="clear"></div>
	</header>

<!-- START MAIN CONTENT -->
	<div role="main" id="content">
		<!-- START MAIN CONTENT TABLE -->
		
				{$Content}
				
		<!-- END MAIN CONTENT TABLE -->
	</div>
<!-- END MAIN CONTENT -->
</div>
<!-- END WRAPPER -->
{if !$overrideDefaultForm}
	</form>
{/if}

{include file="core/footer.tpl"}

<script type="text/javascript">
    {literal}
    if (jQuery.cookie('cc_cookie_decline') != "cc_cookie_decline") {
        // Do cookie based apps such as Google Analytics
        $('#declinedIndicator').hide();
    } else {
        $('#declinedIndicator').show();
    }
    {/literal}
</script>
</body>
</html>