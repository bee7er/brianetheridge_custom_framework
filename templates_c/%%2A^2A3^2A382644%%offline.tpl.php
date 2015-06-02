<?php /* Smarty version 2.6.20, created on 2013-01-05 05:46:27
         compiled from core/offline.tpl */ ?>
<script type="text/javascript">
<?php echo '	
	$(document).ready(function(){
	});
'; ?>
	
</script>

<h4>Welcome to the <strong>Healthcare-Learning Company</strong> Clinician application.</h4>

<table width="100%" cellspacing="0" cellpadding="0" border="0"> 
	<tr>
		<td id="pageTitle"><h1>Site Offline</h1></td>
	</tr>
	<?php if (( $this->_tpl_vars['appMsgs'] != '' )): ?>
		<?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appMsg']):
?>
  			<tr><td class="emphatic"><?php echo $this->_tpl_vars['appMsg']; ?>
</td></tr>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>	
	<tr><td>&nbsp;</td></tr>
	<tr><td>We are carrying out an essential upgrade to the website.</td></tr>
	<tr><td>Upgrades normally do not last more than 30 minutes, so please check back later.</td></tr>
	<tr><td class="offline">Click here to <a href="<?php echo $this->_tpl_vars['basePath']; ?>
">check if the site is available once more</a>.</td></tr>
	<tr><td>&nbsp;</td></tr>	
  <?php if (( ! $this->_tpl_vars['userLoggedIn'] )): ?>
    <tr><td class="offline">Click here to <a href="<?php echo $this->_tpl_vars['basePath']; ?>
login">access the login page</a>.</td></tr>
  <?php endif; ?>    
</table>
<?php echo '
<script type="text/javascript">	
	$("#txt_title").focus();
</script>
'; ?>