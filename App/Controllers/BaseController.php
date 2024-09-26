<?php

namespace App\Controllers;

use Phalcon\Http\Response;
use Phalcon\Mvc\Controller;

class BaseController extends Controller
{
    public function notFoundAction(): Response
    {
        return $this->setResponse(404, ['cause' => 'route not found.']);
    }

    protected function setResponse(int $status, mixed $data): Response
    {
        $this->response->setStatusCode($status);
        $this->response->setJsonContent($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $this->response->removeHeader('Status');
        return $this->response;
    }
}