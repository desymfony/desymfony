<?php

namespace Desymfony\DesymfonyBundle;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    public function onCoreRequest(GetResponseEvent $event)
    {
        $event->getRequest()->setFormat('ics', 'text/x-vCalendar');
    }
}