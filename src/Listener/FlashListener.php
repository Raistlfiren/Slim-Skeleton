<?php


namespace App\Listener;

use Slim\Flash\Messages;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\FlashEvent;
use App\AppEvents;

class FlashListener implements EventSubscriberInterface
{
    private static $successMessages = [

    ];

    private static $errorFlashes = [

    ];

    /** @var Messages $flash */
    protected $flash;

    public function __construct(Messages $flash)
    {
        $this->flash = $flash;
    }

    public function addSuccessFlash(FlashEvent $event)
    {
        $this->flash->addMessage('success', $event->getMessage());
    }

    public function addErrorFlash(FlashEvent $event)
    {
        $this->flash->addMessage('alert', $event->getMessage());
    }

    public static function getSubscribedEvents()
    {
        return array_merge(self::$successMessages, self::$errorFlashes);
    }
}
