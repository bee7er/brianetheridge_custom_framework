<?php /* Smarty version 2.6.20, created on 2015-01-28 14:13:50
         compiled from core/footer.tpl */ ?>

    <div style="text-align:center;margin-top:40px;">
        <?php $this->assign('sep', ''); ?>
        <?php if ($this->_tpl_vars['page'] != 'cookies' && ! $this->_tpl_vars['siteIsOffline']): ?>
            <a href="<?php echo $this->_tpl_vars['basePath']; ?>
cookies">Cookies</a>&nbsp;&nbsp;
            <?php $this->assign('sep', '|&nbsp;&nbsp;'); ?>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['page'] != 'contact' && ! $this->_tpl_vars['siteIsOffline']): ?>
            <?php echo $this->_tpl_vars['sep']; ?>
<a href="<?php echo $this->_tpl_vars['basePath']; ?>
contact">Contact</a>&nbsp;&nbsp;
        <?php endif; ?>
    </div>
<footer>&copy; 2015 <?php echo $this->_tpl_vars['companyName']; ?>
</footer>