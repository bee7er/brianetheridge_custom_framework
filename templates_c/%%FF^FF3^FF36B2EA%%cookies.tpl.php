<?php /* Smarty version 2.6.20, created on 2013-04-12 23:25:53
         compiled from core/cookies.tpl */ ?>

<?php echo '  
<script type="text/JavaScript">
	$(document).ready(function(){

	});
</script>
'; ?>

<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="top" class="gradientbg" style="padding-left:20px;">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td><h3>Cookies</h3></td>
				</tr>
				<tr>
					<td class="contentpadding">
						<table width="100%" cellspacing="0" cellpadding="0">					
							<?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['message']):
?>
								<tr><td class="contenttxt emphatic"><?php echo $this->_tpl_vars['message']; ?>
</td></tr>			
							<?php endforeach; endif; unset($_from); ?>	
						</table>
					</td>
					<tr><td>&nbsp;</td></tr>		
				</tr>
				<tr>
					<td class="contenttxt">
                        I use cookies on this website to track sessions only, and not to do anything sinister.
					</td>
				</tr>
            </table>
		</td>
	</tr>
</table>