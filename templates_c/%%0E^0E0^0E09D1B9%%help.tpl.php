<?php /* Smarty version 2.6.20, created on 2013-01-06 09:52:26
         compiled from core/help.tpl */ ?>
<?php echo '
'; ?>

<a name="top"><h2><?php echo $this->_tpl_vars['pageTitle']; ?>
</h2></a>
<p>
<strong>Help Topics</strong>
<ul>
  <?php if ($this->_tpl_vars['topics']): ?>
    <?php $_from = $this->_tpl_vars['topics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['topic']):
?>
      <li><a href="./help#topic<?php echo $this->_tpl_vars['topic']['topic_id']; ?>
"><?php echo $this->_tpl_vars['topic']['title']; ?>
</a></li>
    <?php endforeach; endif; unset($_from); ?>
  <?php else: ?>
    <li><a href="#">No data</a></li>
  <?php endif; ?>
</ul>
</p>
<?php if ($this->_tpl_vars['topics']): ?>
  <?php $_from = $this->_tpl_vars['topics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['topic']):
?>
    <p><a name="topic<?php echo $this->_tpl_vars['topic']['topic_id']; ?>
"><strong><?php echo $this->_tpl_vars['topic']['title']; ?>
</strong></a></p>
    <p style="margin-left:15px;"><?php if ($this->_tpl_vars['topic']['description']): ?><?php echo $this->_tpl_vars['topic']['description']; ?>
<?php else: ?>No additional information is available.<?php endif; ?></p>
    <div style="text-align:right;padding:5px;"><a href="./help#top">Top</a></div>
  <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>