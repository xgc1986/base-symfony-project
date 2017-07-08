<?php
declare(strict_types=1);
namespace Xgc\CoreBundle\HttpFoundation;

use Xgc\UtilsBundle\Helper\JsonHelper;

class JsonResponse extends \Symfony\Component\HttpFoundation\JsonResponse
{
    public function __construct($data = [], $status = 200, array $headers = [], $json = false)
    {
        $ret = [];
        $ret['status'] = $status;

        foreach ($data as $key => $value) {
            if ($key !== "stack_trace") {
                JsonHelper::getInstance()->encode($value, $ret, $key);
            } else {
                $ret[$key] = $value;
            }
        }

        ksort($ret);
        parent::__construct($ret, $status, $headers, $json);
    }
}
