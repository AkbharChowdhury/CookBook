<?php


class Mail {

    // email properties
    private $firstname, $lastname, $subject, $from, $message, $currentPage = 'contact';
    private $authorID;
    // Hold the class instance.
    private static $instance = null;
    private const ADMIN_EMAIL = 'mc8852u@gre.ac.uk';

    public function setAuthorID($authorID){
        $this->authorID = $authorID;
        return $this;
    }

    public function setFirstName($firstname){
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastName($lastname){
        $this->lastname = $lastname;
        return $this;
    }

    public function setSubject($subject){
        $this->subject = $subject;
        return $this;
    }

    public function setFrom($from){
        $this->from = $from;
        return $this;
    }

    public function setMessage($message){
        $this->message = $message;
        return $this;
    }

	public function setCurrentPage($currentPage){
        $this->currentPage = $currentPage;
        return $this;
    }

    
    private function __construct(){}


    public static function getInstance() {
        return self::$instance === null ? self::$instance = new Mail() : self::$instance;
    }



    // init method provides default configuration values for mail
    private function init() {
        ini_set('SMTP', 'smtp.gre.ac.uk');
        ini_set('sendmail_from',  self::ADMIN_EMAIL);
    }


    // used for registration form to send a welcome email
    public function sendWelcomeMail() { 
        
        $this->init();
        $this->message = wordwrap($this->message, 70);

        $this->headers = 'From: ' . self::ADMIN_EMAIL . "\r\n";
        $mailContent = mail($this->from, $this->subject, $this->message, $this->headers);

        return $mailContent;
    }


    // send an email to the admin via contact form or for welcome email
    public function sendEmail() {
        
        $this->init();
        $this->message = wordwrap($this->message, 70);

        $this->headers = 'From: ' . $this->from . "\r\n";

        $this->message =  'You have received an email from ' . $this->firstname . ' ' . $this->lastname . "\n\n" . $this->message;
        $mailContent = mail(self::ADMIN_EMAIL, $this->subject, $this->message, $this->headers);

        return $mailContent;
    }

    /** ******************mass email authors - Admin **************** */

    public function sendMultiEmail() {
       $this->init();

        $author = Author::getInstance();
        $author->addData('author_id', $this->authorID);

        foreach ($author->showAuthor() as $row) {
			// specify the header e.g. sender
            $header = 'From: ' . self::ADMIN_EMAIL . "\r\n";

            mail($row['email'], $this->subject, $this->message, $header);
        }
        return true;
        
    }

    public function sendSingleEmail() {
        $this->init();
        $author = Author::getInstance();
        $author->addData('author_id', $this->authorID);
        // retrieve single author 		
        foreach ($author->getAuthorID() as $row) {
            $this->headers = 'From: ' . self::ADMIN_EMAIL . "\r\n";

            mail($row['email'], $this->subject, $this->message, $this->headers);
        }
        return true;
        
    }

}
