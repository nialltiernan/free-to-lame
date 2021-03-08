<?php
declare(strict_types=1);

namespace Game\Controller\Category;

use FreeToGame\Filters\SearchTerms\Sports;
use FreeToGame\Sort\PopularitySort;
use Game\Factory\SortFactory;
use Game\Form\SortByForm;
use Game\Service\CategoryGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class SportsController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        $sortBy = $this->getRequest()->getPost('sort-by', 'popularity');

        $sort = $this->getRequest()->isPost() ? SortFactory::getSort($sortBy) : new PopularitySort();

        $games = CategoryGamesRetriever::execute(new Sports(), $sort);

        $form = new SortByForm('grid-sort-by', ['action' => 'sports', 'sort-by' => $sortBy]);

        return new ViewModel(['games' => $games, 'form' => $form]);
    }
}
