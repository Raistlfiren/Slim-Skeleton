<?php


namespace App\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class FlashEvent extends Event
{

    protected $message;

    /** @var ConstraintViolationListInterface $errors */
    protected $errors;

    public function __construct($message = null, $errors = null)
    {
        $this->message = $message;
        $this->errors = $errors;
    }

    /**
     * @return null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param null $message
     * @return FlashEvent
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param ConstraintViolationListInterface $errors
     * @return FlashEvent
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }


}
