<?php
if (!function_exists('stripslashes_deep')) {
    function stripslashes_deep($value)
    {
        $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
        return $value;
    }
}
require_once('includes/config.php');
require_once('includes/dynamicConfig.php');

require_once('includes/helperFunctions.php');

//Helpers
require_once('classes/helpers/HtmlUtils.class.php');
require_once('classes/helpers/Log.class.php');
require_once('classes/helpers/MailHelper.class.php');
require_once('classes/helpers/MessageHelper.class.php');
require_once('classes/helpers/Utils.class.php');

//Third party classes
require_once('classes/thirdparty/smarty/Smarty.class.php');
require_once('classes/thirdparty/phpmailer/class.phpmailer.php');
require_once('classes/thirdparty/lite.php');
require_once('classes/thirdparty/paginate.class.php');
require_once('classes/thirdparty/FileManager.class.php');
require_once('classes/thirdparty/HtmlSanitizer.class.php');
require_once('classes/thirdparty/ServicesJson.class.php');
require_once('classes/thirdparty/Slim/Slim.php');

//Core models
require_once('classes/models/Base.class.php');
require_once('classes/models/core/DBHandler/DB.class.php');
require_once('classes/models/core/DBHandler/Database.class.php');
require_once('classes/models/core/Paginateable.class.php');
require_once('classes/models/core/Config.class.php');
require_once('classes/models/core/UserRole.class.php');
require_once('classes/models/core/User.class.php');

//Core view
require_once('classes/views/View.class.php');
require_once('classes/views/core/CoreView.class.php');

//Core controllers
require_once('classes/controllers/Controller.class.php');
require_once('classes/controllers/core/CoreController.class.php');
require_once('classes/controllers/core/CoreConfigController.class.php');
require_once('classes/controllers/core/CoreErrorController.class.php');
require_once('classes/controllers/core/CoreFrigController.class.php');
require_once('classes/controllers/core/CoreHelpController.class.php');
require_once('classes/controllers/core/CoreConfigHelpController.class.php');
require_once('classes/controllers/core/CoreHomePageController.class.php');
require_once('classes/controllers/core/CoreLoginPageController.class.php');

//Site models
require_once('classes/models/site/Resource.class.php');

//Site controllers
require_once('classes/controllers/site/SiteHelpController.class.php');
require_once('classes/controllers/site/SiteResourceController.class.php');

//Svenska models
require_once('classes/models/svenska/Phrase.class.php');

//Svenska controllers
require_once('classes/controllers/svenska/SvenskaHelpController.class.php');
require_once('classes/controllers/svenska/SvenskaPhraseController.class.php');
