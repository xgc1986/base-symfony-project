<?php
declare(strict_types = 1);
namespace Xgc\CoreBundle\Service;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CoreControllerService implements EventSubscriberInterface
{
    private $exceptionHandler;

    public function __construct(RequestService $request)
    {
        $this->exceptionHandler = $request->http;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [['onKernelRequest', 17]],
        ];
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelRequest(GetResponseForExceptionEvent $event): void
    {
        $this->exceptionHandler->handle($event->getException());
        if ($this->exceptionHandler->getResponse()) {
            $event->setResponse($this->exceptionHandler->getResponse());
        }
    }
}
