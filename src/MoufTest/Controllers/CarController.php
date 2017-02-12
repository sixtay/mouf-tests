<?php
namespace MoufTest\Controllers;

use Mouf\Mvc\Splash\Annotations\Get;
use Mouf\Mvc\Splash\Annotations\Post;
use Mouf\Mvc\Splash\Annotations\Put;
use Mouf\Mvc\Splash\Annotations\Delete;
use Mouf\Mvc\Splash\Annotations\URL;
use Mouf\Html\Template\TemplateInterface;
use Mouf\Html\HtmlElement\HtmlBlock;
use Psr\Log\LoggerInterface;
use MoufTest\Model\Dao\Generated\DaoFactory;
use \Twig_Environment;
use Mouf\Html\Renderer\Twig\TwigTemplate;
use Zend\Diactoros\Response\RedirectResponse;
use Mouf\Mvc\Splash\HtmlResponse;

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

        // Let's add the twig file to the template.
        $this->content->addHtmlElement(new TwigTemplate($this->twig, 'views/car/index.twig', array("message"=>"Chuka")));

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

        // Let's add the twig file to the template.
        $this->content->addHtmlElement(new TwigTemplate($this->twig, 'views/car/show.twig', array("message"=>"world")));

        return new HtmlResponse($this->template);
    }
    /**
     * @URL("cars")

     * @Post
     */
    public function store() {
        // TODO: write content of action here


        return new RedirectResponse('cars');
    }
    /**
     * @URL("cars/{id}")

     * @Put
     * @param int $id
     */
    public function update($id) {
        // TODO: write content of action here


        return new RedirectResponse('cars');
    }
    /**
     * @URL("cars/{id}/delete")

     * @param int $id
     */
    public function destroy($id) {
        // TODO: write content of action here


        return new RedirectResponse('cars');
    }
}
