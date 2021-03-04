<?php
declare(strict_types=1);

namespace Game\Controller\Category;

use FreeToGame\Filters\SearchTerms\Anime;
use FreeToGame\Sort\PopularitySort;
use Game\Controller\CategoryController;
use Game\Service\CategoryGamesRetriever;
use Laminas\View\Model\ViewModel;

class AnimeController extends CategoryController
{
    public function indexAction(): ViewModel
    {
        $sortBy = $this->request->getPost('sort-by', 'popularity');

        $sort = $this->request->isPost() ? $this->getSort($sortBy) : new PopularitySort();

        $games = CategoryGamesRetriever::execute(new Anime(), $sort);

        return new ViewModel(['games' => $games, 'form' => $this->initSortByForm('anime', $sortBy)]);
    }
}
