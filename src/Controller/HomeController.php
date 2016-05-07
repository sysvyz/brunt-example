<?php
namespace Svz\Controller;

use Svz\Model\SomeService;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    private $service;

    public function __construct(Request $request, SomeService $service)
    {
        parent::__construct($request);
        $this->service = $service;
    }

    public function execute()
    {

        echo 'exec ' . $this->request->server->get('SCRIPT_NAME') . ' ' . PHP_EOL;
        echo $this->service->runSomeTask() . ' ' . PHP_EOL;
    }

    public static function _DI_PROVIDERS()
    {
        return [
            SomeService::class
        ];
    }
}