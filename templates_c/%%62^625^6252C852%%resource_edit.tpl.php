<?php /* Smarty version 2.6.20, created on 2013-08-11 06:53:17
         compiled from site/resource_edit.tpl */ ?>
<script language='javascript'>
    var PAGE_TYPE = '<?php echo $this->_tpl_vars['PAGE_TYPE']; ?>
';
<?php echo '
    $(document).ready( function(){
        checkType();
    });

	function validate(){
		var fv = new formValidator();
		var rName = $(\'#name\').get(0);
        var description = $(\'#description\').get(0);
        var type = $(\'#type\').get(0);
        var url = $(\'#url\').get(0);
                
		rName.value = trim(rName.value);
        if (rName.value == \'\') {
            fv.raiseError("Please enter the name of the resource.", rName);
        }
        else if (rName.value.length > 32) {
            fv.raiseError("The name cannot be longer than 32 characters.", rName);
        }
            
        description.value = trim(description.value);
            
		url.value = trim(url.value);
        if (url.value == \'\' && type.value!=PAGE_TYPE) {
            fv.raiseError("Please enter the url of the resource.", url);
        }
        else if (url.value.length > 255) {
            fv.raiseError("The url cannot be longer than 255 characters.", url);
        }            

		if (fv.isError()) {
			fv.displayErrors();
			fv.setFocusToFirstError();
			return false;
		}
		else{
			document.frm.submit();
		}
		return true;
	}

    function checkType() {
        var type = $("#type").val();
        if (type==PAGE_TYPE) {
            $("#urlInput").hide();
            $("#pageTextInput").show();
        } else {
            $("#urlInput").show();
            $("#pageTextInput").hide();
        }
    }
'; ?>

</script>

<input type="hidden" id="update" name="update" value="1">
<div class="prompt-text" style="margin-left:40px;"> 
            <table>
            <tr><td class="label">Id:</td><td><?php echo $this->_tpl_vars['resource']['id']; ?>
</td></tr>
            <tr><td class="label">Seq:</td><td><input type="text" id="seq" name="seq" value="<?php echo $this->_tpl_vars['resource']['seq']; ?>
" /></td></tr>
            <tr><td class="label">Name:</td><td><input type="text" id="name" name="name" value="<?php echo $this->_tpl_vars['resource']['name']; ?>
" /></td></tr>
            <tr><td class="label">Description:</td><td><textarea id="description" name="description" rows="2" cols="48"><?php echo $this->_tpl_vars['resource']['description']; ?>
</textarea></td></tr>
            <tr>
                <td class="label">Type:</td>
                <td>
                    <select id="type" name="type" onchange="checkType();">
                    <?php $_from = $this->_tpl_vars['typeList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['typeItem']):
?>
                        <option value="<?php echo $this->_tpl_vars['typeItem']; ?>
" <?php if ($this->_tpl_vars['resource']['type'] == $this->_tpl_vars['typeItem']): ?>selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['typeItem']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>                                            
                    </select>
                </td>
            </tr>
            <tr id="urlInput" style="display:none;"><td class="label">Url:</td><td><input type="text" id="url" name="url" value="<?php echo $this->_tpl_vars['resource']['url']; ?>
" size="72" /></td></tr>
            <tr id="pageTextInput" style="display:none;"><td class="label">Page text:</td><td><textarea id="page_text" name="page_text" rows="8" cols="48"><?php echo $this->_tpl_vars['resource']['page_text']; ?>
</textarea></td></tr>
            <tr><td class="label">Thumb:</td>
                <td>
                    <input type="file" name="thumb_file" id="thumb_file" value="" size="32" />&nbsp;<a id="show-panel" href="assets/content/images/<?php echo $this->_tpl_vars['resource']['thumb']; ?>
" rel="prettyPhoto[iframe]"><?php echo $this->_tpl_vars['resource']['thumb']; ?>
</a>
                    &nbsp;
                    <span class="help">Should be width:55 x height:41</span>
                </td>
            </tr>
            <tr>
                <td class="label">Carousel Image:</td>
                <td>
                    <input type="file" name="image_file" id="image_file" value="" size="32" />&nbsp;<a id="show-panel" href="assets/content/images/<?php echo $this->_tpl_vars['resource']['image']; ?>
" rel="prettyPhoto[iframe]"><?php echo $this->_tpl_vars['resource']['image']; ?>
</a>
                    &nbsp;
                    <span class="help">Should be width:366 x height:266</span>
                </td>
            </tr>
            <tr>
                <td class="label">Status:</td>
                <td>
                    <select id="status" name="status">
                    <?php $_from = $this->_tpl_vars['statusList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['statusItem']):
?>
                        <option value="<?php echo $this->_tpl_vars['statusItem']; ?>
" <?php if ($this->_tpl_vars['resource']['status'] == $this->_tpl_vars['statusItem']): ?>selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['statusItem']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>                                            
                    </select>
                </td>
            </tr>
            <tr><td class="label">Created:</td><td><?php echo $this->_tpl_vars['resource']['created_on']; ?>
</td></tr>
            <tr><td class="label">Updated:</td><td><?php echo $this->_tpl_vars['resource']['updated_on']; ?>
</td></tr>
            <tr>
                <td colspan="2">
                    <input type="submit" id="sbm" name="sbm" value="Submit" onclick="return validate();" />
                    &nbsp;
                    <input type="button" value="Cancel" onclick="window.location='resources'" />
                </td>
            </tr>
        </table>
    </div>	