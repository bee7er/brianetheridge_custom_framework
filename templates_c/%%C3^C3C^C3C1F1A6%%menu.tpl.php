<?php /* Smarty version 2.6.20, created on 2013-08-11 06:53:09
         compiled from core/menu.tpl */ ?>
<ul>
    <li><a class="btnTurq" href="<?php echo $this->_tpl_vars['basePath']; ?>
home"><span class="homeBtn">Home</span></a></li>
    <?php if (( ! $this->_tpl_vars['siteIsOffline'] )): ?>
        <?php if (( $this->_tpl_vars['page'] != 'svenskaList' )): ?>
            <li><a class="btnTurq" href="<?php echo $this->_tpl_vars['basePath']; ?>
svenska"><span class="svenskaBtn">Learning Swedish</span></a></li>
        <?php endif; ?>
    <?php endif; ?>
<?php if (( ! $this->_tpl_vars['userLoggedIn'] )): ?>
    <?php if (( $this->_tpl_vars['page'] != 'login' )): ?>
        <li><a class="btnTurq" href="<?php echo $this->_tpl_vars['basePath']; ?>
login"><span class="loginBtn">Login</span></a></li>
    <?php endif; ?>
<?php endif; ?>
    <li><a class="btnTurq" href="javascript:" onclick="openWindow('<?php echo $this->_tpl_vars['basePath']; ?>
help<?php echo $this->_tpl_vars['help']; ?>
',600,640);"><span class="helpBtn">Help</span></a></li>
</ul>
<br />
<ul>
    <?php if (( $this->_tpl_vars['userLoggedIn'] )): ?>
        <?php if (( $this->_tpl_vars['administratorCapability'] & $this->_tpl_vars['userOptionsMask'] )): ?>
            <li><a class="btnTurq" href="<?php echo $this->_tpl_vars['basePath']; ?>
users"><span class="userBtn">Users</span></a></li>
            <li><a class="btnTurq" href="<?php echo $this->_tpl_vars['basePath']; ?>
resource"><span class="resourceBtn">Resources</span></a></li>
            <li><a class="btnTurq" href="<?php echo $this->_tpl_vars['basePath']; ?>
test"><span class="checkBtn">API Test</span></a></li>
            <li><a class="btnTurq" href="<?php echo $this->_tpl_vars['basePath']; ?>
config"><span class="toolBtn">Config</span></a></li>
        <?php endif; ?>
        <?php if (( $this->_tpl_vars['siteIsOffline'] )): ?>
            <li>&nbsp;&nbsp;<span class="emphatic">Site Offline<?php if (( $this->_tpl_vars['administratorCapability'] & $this->_tpl_vars['userOptionsMask'] )): ?> - Admin<?php endif; ?></span></li>
        <?php endif; ?>
    <?php endif; ?>
</ul>