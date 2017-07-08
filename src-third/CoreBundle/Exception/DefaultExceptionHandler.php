<?php
declare(strict_types=1);
namespace Xgc\CoreBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class DefaultExceptionHandler extends ExceptionHandler
{
    public function getResponse(): ?Response
    {
        return null;
    }
}
