<?php
declare(strict_types=1);

namespace Search\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use Search\Service\SearchResultGamesRetriever;
use User\Controller\Plugin\UserColorPlugin;

class SearchResultsController extends AbstractActionController
{
    /**
     * @return \Laminas\Http\Response | \Laminas\View\Model\ViewModel
     */
    public function indexAction()
    {
        if ($this->isRequestInvalid()) {
            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(['terms' => $this->getRequest()->getPost('search-terms'), 'color' => $this->getColor()]);
    }

    private function isRequestInvalid(): bool
    {
        $request = $this->getRequest();

        return !$request->isPost() || empty($request->getPost('search-terms'));
    }

    private function getColor(): string
    {
        /** @var \User\Controller\Plugin\UserColorPlugin $colorPlugin */
        $colorPlugin = $this->plugin(UserColorPlugin::NAME);
        return $colorPlugin->getColor($this->plugin(Identity::class));
    }

    public function indexJsonAction(): JsonModel
    {
        $terms = explode(',', $this->getRequest()->getContent());

        $data = SearchResultGamesRetriever::execute($terms);

        return new JsonModel(['data' => $data]);
    }
}
