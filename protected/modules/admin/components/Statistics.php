<?php

class Statistics
{
	public $companiesRegistered;
	public $lettersSent;
	public $lettersConfirmed;
	public $lettersAutomaticConfirmed;
	public $emailsNotConfirmed;
	public $lastLetterSent;

    public function __construct()
    {
        $this->companiesRegistered = $this->getCompaniesRegistered();
        $this->lettersSent = $this->getLettersSent();
        $this->lettersConfirmed = $this->getLettersConfirmed();
        $this->lettersAutomaticConfirmed = $this->getLettersAutomaticConfirmed();
        $this->emailsNotConfirmed = $this->getEmailsNotConfirmed();
        $this->lastLetterSent = $this->getLastLetterSent();
    }

    public function getCompaniesRegistered()
    {
        return Company::model()->count();
    }


    public function getLettersSent()
    {
        $criteria = new CDbCriteria;
        $criteria->addInCondition('status', array(Conversation::STATUS_SENT,  Conversation::STATUS_CONFIRM,  Conversation::STATUS_INVALID));
        return Conversation::model()->count($criteria);
    }

    public function getLettersConfirmed()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('delivery IS NOT NULL');
        $criteria->addInCondition('status', array(Conversation::STATUS_SENT,  Conversation::STATUS_CONFIRM), 'AND');
        return Conversation::model()->count($criteria);
    }

    public function getLettersAutomaticConfirmed()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('delivery IS NOT NULL');
        $criteria->addCondition('status = :status', 'AND');
        $criteria->params = array(':status' => Conversation::STATUS_SENT);
        return Conversation::model()->count($criteria);
    }

    public function getEmailsNotConfirmed()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('delivery IS NULL');
        $criteria->addCondition('status = :status', 'AND');
        $criteria->params = array(':status' => Conversation::STATUS_SENT);
        return Conversation::model()->count($criteria);
    }

    public function getLastLetterSent()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('status = :status');
        $criteria->params = array(':status' => Conversation::STATUS_SENT);
        $criteria->order = 'created_at_db DESC';
        $conversation = Conversation::model()->find($criteria);
        if (!is_null($conversation)) {
            $message = "Name: {$conversation->personCompany->person->first_name} {$conversation->personCompany->person->last_name}, ";
            $message .= "Email: {$conversation->email}, ";
            $message .= "Date: {$conversation->created_at_db}";
            return $message;
        }
    }
}
