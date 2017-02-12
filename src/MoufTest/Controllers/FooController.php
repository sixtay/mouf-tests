<?php
namespace MoufTest\Controllers;

use Mouf\Mvc\Splash\Annotations\Get;
use Mouf\Mvc\Splash\Annotations\Post;
use Mouf\Mvc\Splash\Annotations\Put;
use Mouf\Mvc\Splash\Annotations\Delete;
use Mouf\Mvc\Splash\Annotations\URL;
use Psr\Log\LoggerInterface;
use MoufTest\Model\Dao\Generated\DaoFactory;

/**
 * TODO: write controller comment
 */
class FooController {

    /**
     * The logger used by this controller.
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The DAO factory object.
     * @var DaoFactory
     */
    private $daoFactory;


    /**
     * Controller's constructor.
     * @param LoggerInterface $logger The logger
     * @param DaoFactory $daoFactory The object in charge of retrieving DAOs
     */
    public function __construct(LoggerInterface $logger, DaoFactory $daoFactory) {
        $this->logger = $logger;
        $this->daoFactory = $daoFactory;
    }

    /**
     * @URL("foo")

     * @Get
     */
    public function index() {
        // TODO: write content of action here

    }
}
