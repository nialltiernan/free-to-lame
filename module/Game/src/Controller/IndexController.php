<?php
declare(strict_types=1);

namespace Game\Controller;

use Game\Service\IndexGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use User\Controller\Plugin\UserColorPlugin;

class IndexController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        return new ViewModel(['color' => $this->getColor()]);
    }

    public function indexJsonAction(): ViewModel
    {
        return (new JsonModel(['data' => IndexGamesRetriever::execute()]))->setTemplate('json/index.phtml');
    }

    private function getColor(): string
    {
        /** @var \User\Controller\Plugin\UserColorPlugin $colorPlugin */
        $colorPlugin = $this->plugin(UserColorPlugin::NAME);
        return $colorPlugin->getColor($this->plugin(Identity::class));
    }
}
