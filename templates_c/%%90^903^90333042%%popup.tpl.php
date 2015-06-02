<?php /* Smarty version 2.6.20, created on 2013-04-18 18:17:05
         compiled from core/popup.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="robots" content="noodp,noydir" />
<title><?php echo $this->_tpl_vars['pageTitle']; ?>
</title>
<base href='<?php echo $this->_tpl_vars['basePath']; ?>
' />
<link href="assets/less/popstyle.css" rel="stylesheet" type="text/css" />
<?php echo '
<script language="javascript" src="js/common_functions.js"></script>
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/jquery-1.4.4.min.js"></script>
<script language="javascript" src="js/jquery-ui.js"></script>
<script language="javascript" src="js/jquery.validate.js"></script>
<script language="javascript" src="js/jquery.numeric.pack.js"></script>
'; ?>

</head>
<script type="text/javascript">
	var url = '<?php echo $this->_tpl_vars['redirectUrl']; ?>
';
<?php echo '
	if (url && url != \'\') {
		window.opener.location = url;
		window.close();
	}
'; ?>

</script>
<body>

<?php if (! $this->_tpl_vars['overrideDefaultForm']): ?>
<form name="frm" id="frm" method="post" action="" enctype="multipart/form-data">
<input type="hidden" id="hidEvent" name="hidEvent" value="">
<input type="hidden" id="hidArguments" name="hidArguments" value="">
<input type="hidden" id="sessionToken" name="sessionToken" value="<?php echo $this->_tpl_vars['sessionToken']; ?>
">
<?php endif; ?>
<div id="container">
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "core/pop_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
    <div id="main" style="width:100%;">
          <div id="text" style="width:80%;">
            <?php echo $this->_tpl_vars['Content']; ?>

          </div>
    </div>
    
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "core/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>
<?php if (! $this->_tpl_vars['overrideDefaultForm']): ?>
</form>
<?php endif; ?>
</body>
</html>