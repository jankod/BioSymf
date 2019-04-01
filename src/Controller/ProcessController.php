<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/process")
 */
class ProcessController extends AbstractController
{

    private $client;
    private $url;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->url = 'http://localhost:4567/';
    }

    /**
     * @Route("/p1")
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function callHello()
    {

        $response = $this->client->request('GET', $this->url);
        dump($response);
        return new Response("Result " . $response->getBody());
    }

}