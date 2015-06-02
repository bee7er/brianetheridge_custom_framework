<?php /* Smarty version 2.6.20, created on 2013-01-06 09:52:21
         compiled from core/userList.tpl */ ?>
<script type="text/javascript">
    var searchPlaceholder = "<?php echo $this->_tpl_vars['searchPlaceholder']; ?>
";
    <?php echo '
    $(document).ready(function () {
        $("#txt_searchPattern").focus(function () {
            if (this.placeholder == searchPlaceholder) {
                this.placeholder = \'\';
            }
        });
        $("#txt_searchPattern").blur(function () {
            if (this.placeholder == \'\') {
                this.placeholder = searchPlaceholder;
            }
        });
    });

    function searchOnClick() {
        PostBack(\'searchOnClick\');
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
        if (e && e.keyCode == 13) {
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

    function editUserDetails(userId) {
        '; ?>

        window.location = '<?php echo $this->_tpl_vars['basePath']; ?>
users/edit/'+userId;
        <?php echo '
    }

    function userActivityStatus(userId, status) {
        if (status == \'inactive\') {
            if (confirm(\'Are you sure you want to make this user account inactive?\')) {
                '; ?>

                window.location = '<?php echo $this->_tpl_vars['basePath']; ?>
users/inactive/'+userId;
                <?php echo '
            }
        } else {
            '; ?>

            window.location = '<?php echo $this->_tpl_vars['basePath']; ?>
users/active/'+userId;
            <?php echo '
        }
    }
    '; ?>

</script>

<h1>Manage Users</h1>

<div id="filter">
    <div id="search" onkeypress="return checkSubmit(event);">
        <input type="text" class="searchInput" placeholder="<?php echo $this->_tpl_vars['searchPlaceholder']; ?>
" name="txt_searchPattern"
               id="txt_searchPattern" value="<?php echo $this->_tpl_vars['txt_searchPattern']; ?>
"/>
        <br/><br/>
        <span class="searchInputSubmit">User role:</span>
        <select name="sel_user_role_id" id="sel_user_role_id">
            <option value="" <?php if ($this->_tpl_vars['selUserRoleId'] == ''): ?>selected<?php endif; ?>>Any</option>
        <?php if (( $this->_tpl_vars['userRoles'] != '' )): ?>
            <?php $_from = $this->_tpl_vars['userRoles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userRoleEntry']):
?>
                <option value="<?php echo $this->_tpl_vars['userRoleEntry']['user_role_id']; ?>
"
                        <?php if ($this->_tpl_vars['userRoleEntry']['user_role_id'] == $this->_tpl_vars['selUserRoleId']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['userRoleEntry']['role_title']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
        </select>
        &nbsp;
        <span class="searchInputSubmit">User status:</span>
        <select name="sel_account_status" id="sel_account_status">
            <option value="" <?php if ($this->_tpl_vars['userAccountStatus'] == ''): ?>selected<?php endif; ?>>Any</option>
        <?php if (( $this->_tpl_vars['accountStatuses'] != '' )): ?>
            <?php $_from = $this->_tpl_vars['accountStatuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['accountStatus']):
?>
                <option value="<?php echo $this->_tpl_vars['accountStatus']; ?>
"
                        <?php if ($this->_tpl_vars['accountStatus'] == $this->_tpl_vars['selAccountStatus']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['accountStatus']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
        </select>
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
        <tr>
            <td class="emphatic"><?php echo $this->_tpl_vars['appMsg']; ?>
</td>
        </tr>
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
        <th>User name</th>
        <th>Role</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($this->_tpl_vars['users']): ?>
        <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['user']['first_name']; ?>
 <?php echo $this->_tpl_vars['user']['surname']; ?>
</td>
            <td><?php echo $this->_tpl_vars['user']['role_title']; ?>
</td>
            <td><?php echo $this->_tpl_vars['user']['account_status']; ?>
</td>
            <td>
                <input type="button" value="Edit" onclick="editUserDetails(<?php echo $this->_tpl_vars['user']['user_id']; ?>
);" class="btnTurq" />
                &nbsp;
                <?php if ($this->_tpl_vars['user']['account_status'] == 'active'): ?>
                    <input type="button" value="Make Inactive" onclick="userActivityStatus(<?php echo $this->_tpl_vars['user']['user_id']; ?>
, 'inactive');" class="btnTurq" />
                <?php else: ?>
                    <input type="button" value="Make Active" onclick="userActivityStatus(<?php echo $this->_tpl_vars['user']['user_id']; ?>
, 'active');" class="btnTurq" />
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
    <tr>
        <td colspan="99">No users, or none that match your selection criteria</td>
    </tr>
    <?php endif; ?>
    </tbody>
</table>

<?php echo '
<script type="text/javascript">

</script>
'; ?>
	