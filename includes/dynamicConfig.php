<?php
	class DC {

		public static $urlPrefix;
		public static $basePath;
        public static $replyToEmail;
        public static $companySupportEmail;
        public static $siteEmailRecipients;
        public static $developerEmailRecipients;

		/*
		 * Sets some configuration options dynamically depending on
		 * the environment in which we are running.
		 */
		public static function setEnvironmentConfigItems() {
            // Check environment for some application wide email addresses .
            if (ENVIRONMENT == ENV_LIVE) {
                DC::$companySupportEmail = 'betheridge+support@gmail.com';
                DC::$replyToEmail = 'betheridge+reply@gmail.com';
                DC::$siteEmailRecipients =  array('betheridge@gmail.com');
                DC::$developerEmailRecipients =  array('betheridge+dev@gmail.com');
            } else {
                DC::$companySupportEmail = 'betheridge+support@gmail.com';
                DC::$replyToEmail = 'betheridge+reply@gmail.com';
                DC::$siteEmailRecipients =  array('betheridge@gmail.com');
                DC::$developerEmailRecipients =  array('betheridge+dev@gmail.com');
            }
		}

	}
    // Dynamic configuration settings
	DC::setEnvironmentConfigItems();
	DC::$urlPrefix = 'http://';
	DC::$basePath = dirname(__FILE__).'/../';

    // Page size, i.e. the number of records before pagination kicks in
    define('PAGE_LIMIT', 8);

    // Customised settings. User capabilities.
    define('USER_CAPABILITY', 1);
    define('ADMINISTRATOR_CAPABILITY', 2);