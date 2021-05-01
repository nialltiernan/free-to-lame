<?php
declare(strict_types=1);

namespace Game\Controller;

use Game\Service\IndexGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        return new ViewModel();
    }

    public function indexJsonAction(): ViewModel
    {
        return new JsonModel(['data' => IndexGamesRetriever::execute()]);
    }
}
