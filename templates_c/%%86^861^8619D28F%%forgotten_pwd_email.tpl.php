<?php /* Smarty version 2.6.20, created on 2013-07-28 22:00:51
         compiled from emails/forgotten_pwd_email.tpl */ ?>
  <h1>Forgotten Password Instructions</h1>
  <p>Your password reset request has been logged with <?php echo $this->_tpl_vars['companyName']; ?>
.</p>
  <p>
      Please follow this link to reset your password: <?php echo $this->_tpl_vars['resetPwdLink']; ?>

  </p>
  <p>
      If there are any problems, or you need to speak with us, contact us either by telephone on <?php echo $this->_tpl_vars['companyTelephone']; ?>

      or by email at <?php echo $this->_tpl_vars['companySupportEmail']; ?>
.
  </p>
  <p>
      <strong>Our mailing address is:</strong>
      <br />
      <?php echo $this->_tpl_vars['companyName']; ?>
 <?php echo $this->_tpl_vars['companyAddress']; ?>

  </p>