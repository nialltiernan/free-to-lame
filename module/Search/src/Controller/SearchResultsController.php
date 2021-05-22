<?php
declare(strict_types=1);

namespace Search\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Search\Service\SearchResultGamesRetriever;

class SearchResultsController extends AbstractActionController
{
    public function indexJsonAction(): JsonModel
    {
        $terms = json_decode($this->getRequest()->getContent(), true);

        $data = SearchResultGamesRetriever::execute($terms);

        return new JsonModel(['data' => $data]);
    }
}
