<?php
namespace Svz\Controller;


use Symfony\Component\HttpFoundation\Request;

class AbstractController
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


}