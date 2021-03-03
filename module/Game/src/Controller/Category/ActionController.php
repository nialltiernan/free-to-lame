<?php
declare(strict_types=1);

namespace Game\Controller\Category;

use ArrayObject;
use FreeToGame\Client as FreeToGame;
use FreeToGame\Filters\CategoryFilter;
use FreeToGame\Filters\FilterCollection;
use FreeToGame\Filters\PlatformFilter;
use FreeToGame\Filters\Platforms\Browser;
use FreeToGame\Filters\SearchTerms\Action;
use FreeToGame\Sort\PopularitySort;
use FreeToGame\Sort\Sort;
use Game\Factory\SelectFactory;
use Game\Factory\SortFactory;
use Laminas\Form\Form;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ActionController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        $request = $this->getRequest();

        $sortBy = $request->getPost('sort-by', 'popularity');

        $form = $this->initForm($sortBy);

        $sort = $request->isPost() ? SortFactory::getSort($sortBy) : new PopularitySort();

        return new ViewModel(['games' => $this->getGames($sort), 'form' => $form]);
    }

    private function initForm(string $sortBy): Form
    {
        $select = SelectFactory::getSortBySelect();

        $form = new Form('form-sort-by');
        $form->setAttribute('action', 'action');
        $form->add($select);

        $this->bindFormData($sortBy, $form);

        return $form;
    }

    private function bindFormData(string $sortBy, Form $form): void
    {
        $data = new ArrayObject();

        $data['sort-by'] = $sortBy;

        $form->bind($data);
    }

    /**
     * @param \FreeToGame\Sort\Sort $sort
     * @return array
     * @throws \FreeToGame\ApiException
     */
    private function getGames(Sort $sort): array
    {
        $filterCollection = new FilterCollection();

        $filterCollection->setCategoryFilter(new CategoryFilter(new Action()));

        $freeToGame = new FreeToGame();

        return $freeToGame->fetchList($filterCollection, $sort)->getData();
    }
}
