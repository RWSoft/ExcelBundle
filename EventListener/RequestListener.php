<?php

namespace RWSoft\ExcelBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $request->setFormat('csv', 'text/csv');
        $request->setFormat('pdf', 'application/pdf');
        $request->setFormat('xls', 'application/vnd.ms-excel');
        $request->setFormat('xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }
}
