<?php
namespace MoufTest\Controllers;

use MoufTest\Model\Bean\CarBean;
use MoufTest\Model\Dao\Generated\DaoFactory;
use Mouf\Html\HtmlElement\HtmlBlock;
use Mouf\Html\Renderer\Twig\TwigTemplate;
use Mouf\Html\Template\TemplateInterface;
use Mouf\Mvc\Splash\Annotations\Delete;
use Mouf\Mvc\Splash\Annotations\Get;
use Mouf\Mvc\Splash\Annotations\Post;
use Mouf\Mvc\Splash\Annotations\Put;
use Mouf\Mvc\Splash\Annotations\URL;
use Mouf\Mvc\Splash\HtmlResponse;
use Psr\Log\LoggerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;
use \Twig_Environment;

/**
 * TODO: write controller comment
 */
class CarController {

    /**
     * The logger used by this controller.
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The template used by this controller.
     * @var TemplateInterface
     */
    private $template;

    /**
     * The main content block of the page.
     * @var HtmlBlock
     */
    private $content;

    /**
     * The DAO factory object.
     * @var DaoFactory
     */
    private $daoFactory;

    /**
     * The Twig environment (used to render Twig templates).
     * @var Twig_Environment
     */
    private $twig;


    /**
     * Controller's constructor.
     * @param LoggerInterface $logger The logger
     * @param TemplateInterface $template The template used by this controller
     * @param HtmlBlock $content The main content block of the page
     * @param DaoFactory $daoFactory The object in charge of retrieving DAOs
     * @param Twig_Environment $twig The Twig environment (used to render Twig templates)
     */
    public function __construct(LoggerInterface $logger, TemplateInterface $template, HtmlBlock $content, DaoFactory $daoFactory, Twig_Environment $twig) {
        $this->logger = $logger;
        $this->template = $template;
        $this->content = $content;
        $this->daoFactory = $daoFactory;
        $this->twig = $twig;
    }

    /**
     * @URL("cars")

     */
    public function index() {
        // TODO: write content of action here
        //By default, we assume that it is not
        $carDao = \Mouf::getCarDao();
        $cars = $carDao->findAll();
        //an AJAX request.
        $isAjaxRequest = false;
         
        if(
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
        ){
            $isAjaxRequest = true;
        }        

        if ($isAjaxRequest) {
            return new JsonResponse([ "status"=>"ok", "data" => $cars]);
        }
            // return new JsonResponse([ "status"=>"ok", "data" => json_decode(json_encode($cars))]);

        $this->content->addHtmlElement(new TwigTemplate($this->twig, 'views/car/index.twig', array("base_url" => $this->server_url())));

        return new HtmlResponse($this->template);
    }
    /**
     * @URL("cars/new")

     * @Get
     */
    public function create() {
        // TODO: write content of action here

        // Let's add the twig file to the template.
        $this->content->addHtmlElement(new TwigTemplate($this->twig, 'views/car/create.twig', array("message"=>"world")));

        return new HtmlResponse($this->template);
    }
    /**
     * @URL("cars/{id}/edit")

     * @Get
     * @param int $id
     */
    public function edit($id) {
        // TODO: write content of action here        
        // Let's add the twig file to the template.
        $this->content->addHtmlElement(new TwigTemplate($this->twig, 'views/car/edit.twig', array("message"=>"world")));

        return new HtmlResponse($this->template);
    }
    /**
     * @URL("cars/{id}")

     * @param int $id
     */
    public function show($id) {
        // TODO: write content of action here
        
        // $brandBean = \Mouf::getBrandDao()->findById($_)
        // Check if ajax call
        $this->content->addHtmlElement(new TwigTemplate($this->twig, 'views/car/show.twig', array("message"=>"world")));

        return new HtmlResponse($this->template);
    }
    /**
     * @URL("cars")

     * @Post
     */
    public function store() {
        // TODO: write content of action here
        $requestBody = json_decode(file_get_contents('php://input'));
        $brandBean = \Mouf::getBrandDao()->getById($requestBody->brand->id);
        $carBean = new CarBean($brandBean, $requestBody->name, $requestBody->maxSpeed);
        \Mouf::getCarDao()->save($carBean);


        return new RedirectResponse('cars');
    }
    /**
     * @URL("cars/{id}")

     * @Put
     * @param int $id
     */
    public function update($id) {
        $requestBody = json_decode(file_get_contents('php://input'));        
        // TODO: write content of action here
        $carBean = \Mouf::getCarDao()->getById($id);
        $carBean->setName($requestBody->name);
        $carBean->setMaxSpeed($requestBody->maxSpeed);
        \Mouf::getCarDao()->save($carBean);

        return new JsonResponse([ "status"=>"ok", "data" => $carBean]);
    }
    /**
     * @URL("cars/{id}/delete")

     * @param int $id
     */
    public function destroy($id) {
        // TODO: write content of action here
        $carBean = \Mouf::getCarDao()->getById($id);
        \Mouf::getCarDao()->delete($carBean);
        return new JsonResponse([ "status"=>"ok", "data" => $carBean]);
    }

    private function server_url()
    {
        $server_name = $_SERVER['SERVER_NAME'];

        if (!in_array($_SERVER['SERVER_PORT'], [80, 443])) {
            $port = ":$_SERVER[SERVER_PORT]";
        } else {
            $port = '';
        }

        if (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) {
            $scheme = 'https';
        } else {
            $scheme = 'http';
        }
        return $scheme.'://'.$server_name.$port;
    }
}
