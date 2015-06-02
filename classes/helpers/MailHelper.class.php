<?php

/**
 * Helps with PHPMailer functions.
 */
class MailHelper {

    private $phpMailer = null;

    /**
     * Initializes a PHPMailer object ready for use.
     */
    public function __construct() {
        $this->phpMailer = new PHPMailer();
        //$this->phpMailer->Hostname = 'smtp.gmail.com';
        $this->phpMailer->Host = 'smtp.gmail.com';
        $this->phpMailer->Port = 465;
        $this->phpMailer->Username = 'betheridge@gmail.com';
        $this->phpMailer->Password = 'Beeter1955';
        $this->phpMailer->From = 'betheridge@gmail.com';
        $this->phpMailer->FromName = FROMNAME;
        $this->phpMailer->AddReplyTo(DC::$replyToEmail);
        $this->phpMailer->IsHTML(true);
        $this->phpMailer->IsSMTP();
        $this->phpMailer->SMTPAuth = true;
        // Use transport layer security
        //$this->phpMailer->SMTPSecure = 'tls';
        // For Gmail use SSL
        $this->phpMailer->SMTPSecure = 'ssl';
        // Switch debug off for normal operation
        // 0=off, 1=errors and messages, 2=messages
        $this->phpMailer->SMTPDebug = 0;

        return true;
    }

    /**
     * Adds an email addresses to the specified mailer object
     */
    public function addEmailAddresses($emailAddresses, $isBCC=false) {
        if (is_array($emailAddresses)) {
            foreach ($emailAddresses as $emailAddress) {
                self::addEmailAddress($emailAddress, $isBCC);
            }
        } else {
            self::addEmailAddress($emailAddresses, $isBCC);
        }
    }

    /**
     * Add an email address to a mailer object
     */
    public function addEmailAddress($emailAddress, $isBCC=false) {
        if ($isBCC) {
            $this->phpMailer->AddBCC($emailAddress);
        } else {
            $this->phpMailer->AddAddress($emailAddress);
        }
    }

    public function send() {

        /*
         * If the environment is not live, override all emails to Developers.
         */
        if (ENVIRONMENT != ENV_LIVE) {
            $this->phpMailer->ClearAddresses();
            $this->phpMailer->ClearCCs();
            $this->phpMailer->ClearBCCs();
            $this->addEmailAddresses(DC::$developerEmailRecipients, $isBCC=false);
        }
        if (!$this->phpMailer->Send()) {
            die('Error: '.$this->phpMailer->ErrorInfo);
        }
        return true;
    }

    public function setSubject($subject) {
        $this->phpMailer->Subject = $subject;
    }

    public function setBody($body) {
        $this->phpMailer->Body = $body;
    }
}