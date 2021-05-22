<?php
declare(strict_types=1);

namespace Search\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Search\Service\SearchResultGamesRetriever;

class SearchResultsController extends AbstractActionController
{
    /**
     * @return \Laminas\Http\Response|\Laminas\View\Model\JsonModel
     */
    public function indexJsonAction()
    {
        if ($this->getRequest()->isGet()) {
            return $this->redirect()->toRoute('home');
        }

        $terms = json_decode($this->getRequest()->getContent(), true);

        $data = SearchResultGamesRetriever::execute($terms);

        return new JsonModel(['data' => $data]);
    }
}
