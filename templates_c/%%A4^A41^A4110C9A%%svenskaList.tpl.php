<?php /* Smarty version 2.6.20, created on 2012-12-30 05:32:04
         compiled from svenska/svenskaList.tpl */ ?>
<script type="text/javascript">
	var searchPlaceholder = "<?php echo $this->_tpl_vars['searchPlaceholder']; ?>
";
    var basePath = "<?php echo $this->_tpl_vars['basePath']; ?>
";
<?php echo '
    $(document).ready(function(){
        $("#txt_searchPattern").focus(function(){
            if (this.placeholder==searchPlaceholder) {
                this.placeholder=\'\';
            }
        });
        $("#txt_searchPattern").blur(function(){
            if (this.placeholder==\'\') {
                this.placeholder=searchPlaceholder;
            }
        });
        $(function() {
            // Set up all elements to use the enhanced tooltip
            $(\'*\').tooltip({
                track: true,
                delay: 0,
                showURL: false,
                opacity: 1,
                fixPNG: true,
                showBody: " - ",
                fade: 250,
                extraClass: "tooltip",
                top: 8,
                left: 5
            });
        });
    });
    
	function searchOnClick() {
        PostForm(basePath+\'svenska\', \'searchOnClick\');
        return true;
	}
    
	function gotoPageOnClick(page) {
        if (page) {
            PostBack(\'gotoPageOnClick\', page);
            return true;
        }
        return false;
	}
    
	function checkSubmit(e) {
        if(e && e.keyCode == 13) {
          PostBack(\'searchOnClick\');
          return true;
        }
	} 
    
	function checkForSearch() {
        if ($(\'#txt_searchPattern\').val() == \'\' || $(\'#txt_searchPattern\').val() == searchPlaceholder) {
          alert(\'Please enter your search pattern\');
          return false;
        }
        PostBack(\'searchOnClick\');
        return true;
	}     
'; ?>
	
</script>
	
    <h1>Swedish Words and Phrases</h1>
    <p>
        I have had a long term passion for all things Swedish. However, trying to learn a language without ever speaking it is difficult.
        This page is intended to help me learn some vocabulary and pronunciation.
    </p>

	<div id="filter">
		<div id="search" onkeypress="return checkSubmit(event);">
				<input type="text" class="searchInput" title="<?php echo $this->_tpl_vars['specialChars']; ?>
" placeholder="<?php echo $this->_tpl_vars['searchPlaceholder']; ?>
" name="txt_searchPattern" id="txt_searchPattern" value="<?php echo $this->_tpl_vars['txt_searchPattern']; ?>
" />
        &nbsp;
				<a href="javascript:searchOnClick();" class="btnTurqRI">Search</a>
		</div>
	</div>
            
	<?php if (( $this->_tpl_vars['appMsgs'] != '' )): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<thead></thead>
			<tbody>    
				<?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appMsg']):
?>
		  			<tr><td class="emphatic"><?php echo $this->_tpl_vars['appMsg']; ?>
</td></tr>
				<?php endforeach; endif; unset($_from); ?>
			</tbody>
		</table>	
	<?php endif; ?>
  
	<div class="tableHeaderRow">
		<?php if ($this->_tpl_vars['paginationStr']): ?>
            <?php echo $this->_tpl_vars['paginationStr']; ?>

		<?php endif; ?>
	</div>  

  <table cellpadding="0" cellspacing="0" border="0" id="contentTable" width="100%">
    <thead>
      <tr>
        <th>Swedish Word/Phrase</th>
        <th>Pronunciation</th>
        <th>English Equivalent</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($this->_tpl_vars['phrases']): ?>
        <?php $_from = $this->_tpl_vars['phrases']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['phrase']):
?>
          <tr>
            <td><?php echo $this->_tpl_vars['phrase']['fphrase']; ?>
</td>
            <td><?php echo $this->_tpl_vars['phrase']['pronunciation']; ?>
</td>
            <td><?php echo $this->_tpl_vars['phrase']['ephrase']; ?>
</td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
      <?php else: ?>
          <tr><td colspan="99">No phrases found</td></tr>
      <?php endif; ?>
    </tbody>
  </table>	
	
<?php echo '
<script type="text/javascript">	
	
</script>
'; ?>
	