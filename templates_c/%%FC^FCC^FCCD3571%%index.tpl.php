<?php /* Smarty version 2.6.20, created on 2013-04-12 23:24:49
         compiled from core/index.tpl */ ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <link rel="shortcut icon" href="http://www.brianetheridge.com/favicon.ico" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo $this->_tpl_vars['pageTitle']; ?>
</title>
    <meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<meta name="viewport" content="width=device-width" />
    <base href='<?php echo $this->_tpl_vars['basePath']; ?>
' />
	
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
        var basePath = "<?php echo $this->_tpl_vars['basePath']; ?>
";
        <?php echo '
//        $(document).ready(function () {
//            var privacyPage = false;
//            if (window.location.pathname.indexOf(\'cookies\')>=0){
//                privacyPage = true;
//            }
//            var message = \'<p style="text-align:center;"><div style="text-align:left;">This website uses cookies for normal operations relating to session management.<br />\' +
//                    "We do not use cookies to store other tracking data or personal information.<br />" +
//                    "If you continue without changing your settings, we\'ll assume that you are happy to receive all cookies on this website.<br />" +
//                    "You can <a href=\'cookies\'>change your cookie settings</a> at any time.</div></p>"
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
//            if (jQuery.cookie(\'cc_cookie_decline\') != "cc_cookie_decline") {
//                $.cookie("cc_cookie_decline", null, {
//                    path: \'/\'
//                });
//                $.cookie("cc_cookie_accept", "cc_cookie_accept", {
//                    expires: 365,
//                    path: \'/\'
//                });
//            }
//        });
        '; ?>

    </script>
</head>
<body>
<?php if (! $this->_tpl_vars['overrideDefaultForm']): ?>
	<form name="frm" id="frm" method="post" action='' enctype="multipart/form-data">
		<input type="hidden" id="hidEvent" name="hidEvent" value="" />
		<input type="hidden" id="hidArguments" name="hidArguments" value="" />
		<input type="hidden" id="sessionToken" name="sessionToken" value="<?php echo $this->_tpl_vars['sessionToken']; ?>
" />
<?php endif; ?>
<?php if (( $this->_tpl_vars['userLoggedIn'] )): ?>
	<div id="loginBar"><span>Welcome, <?php echo $this->_tpl_vars['userName']; ?>
 <?php if ($this->_tpl_vars['userRole']): ?>(<?php echo $this->_tpl_vars['userRole']; ?>
)<?php endif; ?></span>&nbsp;&nbsp;<span id="declinedIndicator" style="display:none;">Cookies declined</span><a href="<?php echo $this->_tpl_vars['basePath']; ?>
logout" class="logout">Log out</a></div>
<?php else: ?>
    <div id="logoutBar">&nbsp;<span id="declinedIndicator" style="display:none;">Cookies declined</span></div>
<?php endif; ?>

<!-- START WRAPPER -->
<div id="wrapper">
	<header>
		<h1><?php echo $this->_tpl_vars['companyName']; ?>
</h1>
			<nav id="staticNav">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "core/menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</nav>
			<div class="clear"></div>
	</header>

<!-- START MAIN CONTENT -->
	<div role="main" id="content">
		<!-- START MAIN CONTENT TABLE -->
		
				<?php echo $this->_tpl_vars['Content']; ?>

				
		<!-- END MAIN CONTENT TABLE -->
	</div>
<!-- END MAIN CONTENT -->
</div>
<!-- END WRAPPER -->
<?php if (! $this->_tpl_vars['overrideDefaultForm']): ?>
	</form>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "core/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
    <?php echo '
    if (jQuery.cookie(\'cc_cookie_decline\') != "cc_cookie_decline") {
        // Do cookie based apps such as Google Analytics
        $(\'#declinedIndicator\').hide();
    } else {
        $(\'#declinedIndicator\').show();
    }
    '; ?>

</script>
</body>
</html>