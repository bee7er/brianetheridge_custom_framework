<?php

/**
 * Message Utility functions.
 */
class MessageHelper {

	const MESSAGE_TYPE_ALL = 'all';
	const MESSAGE_TYPE_COMPLETION = 'completion';
	const MESSAGE_TYPE_WARNING = 'warning';
	const MESSAGE_TYPE_ERROR = 'error';
	
	/**
	 * Saves a message or array of messages in a container for use later
	 */
	public static function addMessage($message, $messageType=self::MESSAGE_TYPE_ERROR)
	{
		if ($messageType == self::MESSAGE_TYPE_ALL) {
			die('Message type all not allowed in this context');
		}
		if (is_array($message)) {
			if ($message) {
				foreach ($message as $messageEntry) {
					$_SESSION['application_messages'][$messageType][] = $messageEntry;
				}
			}
		} else {
			if (!isset($_SESSION['application_messages'][$messageType])) {
				$_SESSION['application_messages'][$messageType] = array();
			}
			$_SESSION['application_messages'][$messageType][] = $message;
		}
	}
	
	/**
	 * Any messages?
	 */
	public static function hasMessages($messageType=self::MESSAGE_TYPE_ERROR)
	{
		if ($messageType == self::MESSAGE_TYPE_ALL) {
			return (($_SESSION['application_messages'][self::MESSAGE_TYPE_ERROR] && count($_SESSION['application_messages'][self::MESSAGE_TYPE_ERROR])>0)
				 || ($_SESSION['application_messages'][self::MESSAGE_TYPE_WARNING] && count($_SESSION['application_messages'][self::MESSAGE_TYPE_WARNING])>0)
				 || ($_SESSION['application_messages'][self::MESSAGE_TYPE_COMPLETION] && count($_SESSION['application_messages'][self::MESSAGE_TYPE_COMPLETION])>0));
		}
		return ($_SESSION['application_messages'][$messageType] && count($_SESSION['application_messages'][$messageType])>0);
	}
	
	/**
	 * Returns messages accumulated since the last time messages were returned.
	 * Reinitializes the container
	 */
	public static function getMessages($messageType=self::MESSAGE_TYPE_ALL)
	{
		$messageArray = array();
		if (isset($_SESSION['application_messages'])) {
			if ($messageType == self::MESSAGE_TYPE_ALL) {
				$messageArray = array();
				if (isset($_SESSION['application_messages'][self::MESSAGE_TYPE_ERROR])) {			
					$messageArray = array_merge($messageArray, $_SESSION['application_messages'][self::MESSAGE_TYPE_ERROR]);
				}
				if (isset($_SESSION['application_messages'][self::MESSAGE_TYPE_WARNING])) {			
					$messageArray = array_merge($messageArray, $_SESSION['application_messages'][self::MESSAGE_TYPE_WARNING]);
				}				
				if (isset($_SESSION['application_messages'][self::MESSAGE_TYPE_COMPLETION])) {			
					$messageArray = array_merge($messageArray, $_SESSION['application_messages'][self::MESSAGE_TYPE_COMPLETION]);
				}
			} else {
				$messageArray = $_SESSION['application_messages'][$messageType];
			}
			self::clearMessages($messageType);
		}
		
		return $messageArray;
	}
	
	/**
	 * Reinitializes the message container
	 */
	public static function clearMessages($messageType=self::MESSAGE_TYPE_ALL)
	{
		if ($messageType == self::MESSAGE_TYPE_ALL) {
			// Initialize the entire messages container
			$_SESSION['application_messages'] = array();
		} else {
			$_SESSION['application_messages'][$messageType] = array();
		}
	}
  
	/**
	 * Alert handling
	 */
	public static function addAlert($alert)
	{
    if (!isset($_SESSION['application_alerts'])) {
      $_SESSION['application_alerts'] = array();
    }
    $_SESSION['application_alerts'][] = $alert;
	}
	public static function clearAlerts()
	{
		$_SESSION['application_alerts'] = array();
	} 
  public static function getAlerts()
	{
		$alertArray = array();
		if (isset($_SESSION['application_alerts'])) {
			$alertArray = $_SESSION['application_alerts'];
			self::clearAlerts();
		}
		return $alertArray;
	}  
}	