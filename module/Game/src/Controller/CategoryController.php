<?php
declare(strict_types=1);

namespace Game\Controller;

use FreeToGame\Helpers\SearchTermFactory;
use Game\Factory\SortFactory;
use Game\Service\CategoryGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class CategoryController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        return new ViewModel([
            'category' => $this->params()->fromRoute('category'),
            'color' => $this->getLoadingColor()
        ]);
    }

    public function indexJsonAction(): JsonModel
    {
        $sortBy = $this->getRequest()->getQuery('sort-by', 'popularity');

        $sort = SortFactory::getSort($sortBy);

        $searchTerm = SearchTermFactory::getSearchTerm($this->params()->fromRoute('category'));

        $games = is_null($searchTerm) ? [] : CategoryGamesRetriever::execute($searchTerm, $sort);

        return (new JsonModel(['data' => $games]))->setTemplate('json/index.phtml');
    }

    public function listAction(): ViewModel
    {
        return new ViewModel();
    }

    private function getLoadingColor(): string
    {
        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);

        if ($identity->getAuthenticationService()->hasIdentity()){
            /** @var \User\Model\User $user */
            $user = $identity->getAuthenticationService()->getIdentity();
            return $user->getColor();
        }

        return 'blue';
    }
}
