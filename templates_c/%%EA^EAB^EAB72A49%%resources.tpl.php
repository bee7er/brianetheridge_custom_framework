<?php /* Smarty version 2.6.20, created on 2013-08-11 06:53:13
         compiled from site/resources.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', 'site/resources.tpl', 64, false),)), $this); ?>

<script type="text/javascript">
<?php echo '
    function deleteResource(resourceId) {
        if (confirm(\'Are you sure you want to delete this resource?\')) {
            '; ?>

            window.location = '<?php echo $this->_tpl_vars['basePath']; ?>
resource/delete/'+resourceId;
            <?php echo '
        }
    }

    function editResourceDetails(resourceId) {
        '; ?>

        window.location = '<?php echo $this->_tpl_vars['basePath']; ?>
resource/edit/'+resourceId;
        <?php echo '
    }

    function createResource() {
        '; ?>

        window.location = '<?php echo $this->_tpl_vars['basePath']; ?>
resource/create';
        <?php echo '
    }

    function gotoPageOnClick(page) {
        if (page) {
            PostBack(\'gotoPageOnClick\', page);
            return true;
        }
        return false;
    }
'; ?>

</script>

<br />
<nav id="staticNav">
    <ul>
        <li><input type="button" value="Add new resource" onclick="createResource();" class="btnTurq" /></li>
    </ul>
</nav>
<?php if ($this->_tpl_vars['appMsgs']): ?>
    <table cellspacing="3" cellpadding="3">
    <?php $_from = $this->_tpl_vars['appMsgs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appMsg']):
?>
        <tr><td class="emphatic"><?php echo $this->_tpl_vars['appMsg']; ?>
</td></tr>
    <?php endforeach; endif; unset($_from); ?> 
    </table>
<?php endif; ?>

<div class="tableHeaderRow">
    <?php if ($this->_tpl_vars['paginationStr']): ?>
        <?php echo $this->_tpl_vars['paginationStr']; ?>

    <?php endif; ?>
</div>

<div class="prompt-text" style="margin-left:40px;"> 
    <?php if ($this->_tpl_vars['resources']): ?>
        <table cellspacing="3" cellpadding="3">
            <tr><th>Resource id</th><th>Seq</th><th>Name</th><th>Description</th><th>Type</th><th>Status</th><th>Action</th></tr>
            <?php $_from = $this->_tpl_vars['resources']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['resource']):
?>
                 
                <tr class="<?php echo $this->_tpl_vars['rowClass']; ?>
">
                    <td><?php echo $this->_tpl_vars['resource']['id']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['resource']['seq']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['resource']['name']; ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['resource']['description'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 64) : substr($_tmp, 0, 64)); ?>
</td>
                    <td><?php echo $this->_tpl_vars['resource']['type']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['resource']['status']; ?>
</td>
                    <td>
                        <input type="button" value="Edit" onclick="editResourceDetails(<?php echo $this->_tpl_vars['resource']['id']; ?>
);" class="btnTurq" />
                        <input type="button" value="Delete" onclick="deleteResource(<?php echo $this->_tpl_vars['resource']['id']; ?>
);" class="btnTurq" />
                    </td>
                </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    <?php endif; ?>
</div>	