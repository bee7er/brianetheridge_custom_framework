<?php /* Smarty version 2.6.20, created on 2013-01-06 09:52:25
         compiled from core/config.tpl */ ?>
<script type="text/javascript">
<?php echo '	
	$(document).ready(function(){
    '; ?>

      <?php if (( $this->_tpl_vars['alerts'] != '' )): ?>
        // Generating alerts
        <?php $_from = $this->_tpl_vars['alerts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['alert']):
?>
            alert('<?php echo $this->_tpl_vars['alert']; ?>
');
        <?php endforeach; endif; unset($_from); ?>
      <?php endif; ?>   
    <?php echo ' 
	});
	
	function submitAdminDetails() {
		var errors = [];

		if (errors.length > 0) {
			var msg = \'\';
			var sep = \'\';
			for (var i=0; i<errors.length; i++) {
				msg += (sep + errors[i]);
				sep = "\\n";
			}
			alert(msg);
			return false;
		}		
		$("#frm").submit();
		return true;
	}	    
'; ?>

</script>

<h1>Manage Site Configuration</h1>

<table width="100%" cellspacing="0" cellpadding="0" border="0"> 
	<tbody>
	<?php if (( $this->_tpl_vars['appMsgs'] != '' )): ?>
		<?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appMsg']):
?>
  			<tr><td class="emphatic"><?php echo $this->_tpl_vars['appMsg']; ?>
</td></tr>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>	  
	<tr>
		<td>
			<?php if (! ( $this->_tpl_vars['administratorCapability'] & $this->_tpl_vars['userOptionsMask'] )): ?>
				<!-- User is not able to maintain config -->
        You are not authorised to this page
			<?php else: ?>
				<div class="tableHeaderRow">
					<a href="javascript:" onclick="openWindow('<?php echo $this->_tpl_vars['basePath']; ?>
help/config',600,640);" class="btnTurq" title="Help with configuring the system"><span class="helpBtn">Help with Config</span></a>
				</div>			      
        <table id="contentTable" class="formColours" width="100%" cellspacing="0" cellpadding="0" border="0">
          <thead></thead>
          <tbody>	
            <?php if (( $this->_tpl_vars['configEntries'] != '' )): ?>
              <?php $_from = $this->_tpl_vars['configEntries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['configEntry']):
?>
                  <tr>
                    <td class=""><?php echo $this->_tpl_vars['configEntry']['name']; ?>
</td>
                    <td class="">
                      <input type="hidden" id="config_id[]" name="config_id[]" value="<?php echo $this->_tpl_vars['configEntry']['config_id']; ?>
" />
                      <input type="hidden" id="config_name[]" name="config_name[]" value="<?php echo $this->_tpl_vars['configEntry']['name']; ?>
" />
                      <input type="text" id="config_value[]" name="config_value[]" value="<?php echo $this->_tpl_vars['configEntry']['value']; ?>
" size="<?php echo $this->_tpl_vars['configEntry']['length']; ?>
" />
                    </td>
                    <td class=""><?php echo $this->_tpl_vars['configEntry']['comment']; ?>
</td>
                  </tr>
              <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
              <tr><td class="emphatic">No configuration entries found</td></tr>
            <?php endif; ?>
          <tr><td colspan="3">&nbsp;</td></tr>
          <tr>
              <td colspan="3" style="text-align:right;">
              <input type="button" value="Submit" onclick="submitAdminDetails();" class="btnTurq" />
              </td>
          </tr>  			
          </tbody>
        </table>
      <?php endif; ?>
		</td>
	</tr>
	</tbody>
</table>
<?php echo '
<script type="text/javascript">	
	$("#txt_title").focus();
</script>
'; ?>