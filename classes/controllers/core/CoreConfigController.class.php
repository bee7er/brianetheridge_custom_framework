<?php
/*
 * This controller is for handling Admin requests
 */
class CoreConfigController extends CoreController
{
    const CONFIG_TYPE_ALPHABETIC = 'alphabetic';
    const CONFIG_TYPE_NUMERIC = 'numeric';

    private $action;
    private $Config;

    public function __construct($action = '')
    {
        parent::__construct();

        $this->action = $action;
        $this->Config = new Config();
    }

    public function perform()
    {
        parent::perform();

        $this->showCoreConfigPage();
        $this->_View->assign('pageTitle', 'Config');
    }

    public function showCoreConfigPage()
    {

        // Admin authority is needed for this function
        if (!$this->isAuthorised(ADMINISTRATOR_CAPABILITY)) {
            p(21);
            $this->redirect("home");
        }
        if ($_POST && $_POST['config_id']) {
            $atLeastOne = false;
            $len = count($_POST['config_id']);
            for ($i = 0; $i < $len; $i++) {
                $configId = $_POST['config_id'][$i];
                $configValue = $_POST['config_value'][$i];
                $configName = $_POST['config_name'][$i];
                // Check if the option has changed
                $currentConfig = $this->Config->getConfigById($configId);
                if ($currentConfig) {
                    if ($currentConfig['value'] != $configValue) {
                        $error = false;
                        // Check for any data manipulations
                        $configValue = $this->Config->applyDataOperation($currentConfig['operation'], $configValue);
                        // Validate value
                        if (strlen($configValue) > $currentConfig['length']) {
                            MessageHelper::addMessage("Configuration option '$configName' is too long");
                            $error = true;
                        }
                        if ($currentConfig['type'] == self::CONFIG_TYPE_NUMERIC && !is_numeric($configValue)) {
                            MessageHelper::addMessage("Configuration option '$configName' is the wrong type.  Should be '" . self::CONFIG_TYPE_NUMERIC . "'.");
                            $error = true;
                        }
                        if ($currentConfig['type'] == self::CONFIG_TYPE_ALPHABETIC && !Utils::is_alphabetic($configValue)) {
                            MessageHelper::addMessage("Configuration option '$configName' is the wrong type.  Should be '" . self::CONFIG_TYPE_ALPHABETIC . "'.");
                            $error = true;
                        }
                        if (!$error) {
                            // Update the configuration option
                            if ($this->Config->Update(array('value' => $configValue), array('config_id' => $configId))) {
                                MessageHelper::addMessage("Configuration option '$configName' updated");
                                // Check if we need to warn the user that special care needs to be taken
                                if ($currentConfig['alert_on_change']) {
                                    MessageHelper::addAlert($currentConfig['alert_on_change']);
                                }
                                $atLeastOne = true;
                            }
                        }
                    } else {
                        //MessageHelper::addMessage("Configuration option '".$configName."' was not changed");
                    }
                } else {
                    MessageHelper::addMessage("Error: Could not find configuration option '" . $configName . "'.");
                }
            }
            if (!$atLeastOne) {
                MessageHelper::addMessage("No changes.");
            }
            // Redirect so that we reload any dependent session vars
            // Therefore we must save any alerts to the session
            $this->redirect('config');
        }
        $configEntries = $this->Config->getConfigList();
        $this->_View->assign('configEntries', $configEntries);

        // Process any outstanding error messages
        $this->_View->assign('alerts', MessageHelper::getAlerts());
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('page', 'config');
        $this->_View->assign('Content', $this->_View->fetch('core/config.tpl'));
    }

}