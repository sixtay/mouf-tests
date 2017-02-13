<?php
namespace MoufTest\Controllers;

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
use \Twig_Environment;

/**
 * TODO: write controller comment
 */
class BrandController {

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
     * @URL("brand")

     * @Get
     */
    public function index() {
        // TODO: write content of action here
        // var_dump($this->template); die();

        $brandDao = \Mouf::getBrandDao();
        $brands = $brandDao->findAll();
        //an AJAX request.
        $isAjaxRequest = false;
         
        if(
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
        ){
            $isAjaxRequest = true;
        }        

        if ($isAjaxRequest) {
            return new JsonResponse([ "status"=>"ok", "data" => $brands]);
        }
  

        // Let's add the twig file to the template.


        $this->content->addHtmlElement(new TwigTemplate($this->twig, 'views/brand/index.twig', array("message"=>"world")));

        return new HtmlResponse($this->template);
    }
}
