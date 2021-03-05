<?php
declare(strict_types=1);

namespace Game\Controller\Category;

use FreeToGame\Filters\SearchTerms\TopDown;
use FreeToGame\Sort\PopularitySort;
use Game\Factory\SortFactory;
use Game\Form\SortByForm;
use Game\Service\CategoryGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class TopDownController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        $sortBy = $this->request->getPost('sort-by', 'popularity');

        $sort = $this->request->isPost() ? SortFactory::getSort($sortBy) : new PopularitySort();

        $games = CategoryGamesRetriever::execute(new TopDown(), $sort);

        $form = new SortByForm('grid-sort-by', ['action' => 'top-down', 'sort-by' => $sortBy]);

        return new ViewModel(['games' => $games, 'form' => $form]);
    }
}
