<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="robots" content="noodp,noydir" />
<title>{$pageTitle}</title>
<base href='{$basePath}' />
<link href="assets/less/popstyle.css" rel="stylesheet" type="text/css" />
{literal}
<script language="javascript" src="js/common_functions.js"></script>
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/jquery-1.4.4.min.js"></script>
<script language="javascript" src="js/jquery-ui.js"></script>
<script language="javascript" src="js/jquery.validate.js"></script>
<script language="javascript" src="js/jquery.numeric.pack.js"></script>
{/literal}
</head>
<script type="text/javascript">
	var url = '{$redirectUrl}';
{literal}
	if (url && url != '') {
		window.opener.location = url;
		window.close();
	}
{/literal}
</script>
<body>

{if !$overrideDefaultForm}
<form name="frm" id="frm" method="post" action="" enctype="multipart/form-data">
<input type="hidden" id="hidEvent" name="hidEvent" value="">
<input type="hidden" id="hidArguments" name="hidArguments" value="">
<input type="hidden" id="sessionToken" name="sessionToken" value="{$sessionToken}">
{/if}
<div id="container">
	
	{include file=core/pop_header.tpl}
	
    <div id="main" style="width:100%;">
          <div id="text" style="width:80%;">
            {$Content}
          </div>
    </div>
    
    {include file=core/footer.tpl}

</div>
{if !$overrideDefaultForm}
</form>
{/if}
</body>
</html>