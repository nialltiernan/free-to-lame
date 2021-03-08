<?php
declare(strict_types=1);

namespace Search\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Search\Service\SearchResultGamesRetriever;

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

        $data = explode(',', $this->getRequest()->getPost('search-terms'));

        $games = SearchResultGamesRetriever::execute($data);

        return new ViewModel(['subtitle' => $this->getSubtitle($data), 'games' => $games]);
    }

    private function isRequestInvalid(): bool
    {
        $request = $this->getRequest();

        return !$request->isPost() || empty($request->getPost('search-terms'));
    }

    private function getSubtitle(array $terms): string
    {
        array_walk($terms, function(&$term) {
            $term = ucfirst($term);
        });

        return implode(', ', $terms);
    }
}
