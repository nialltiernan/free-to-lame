<?php
declare(strict_types=1);

namespace Game\Controller;

use ArrayObject;
use FreeToGame\Client as FreeToGame;
use FreeToGame\Filters\FilterCollection;
use FreeToGame\Filters\PlatformFilter;
use FreeToGame\Filters\Platforms\Browser;
use FreeToGame\Filters\Platforms\PersonalComputer;
use FreeToGame\Sort\PopularitySort;
use FreeToGame\Sort\Sort;
use Game\Factory\SelectFactory;
use Game\Factory\SortFactory;
use Laminas\Form\Form;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PlatformController extends AbstractActionController
{

    public function browserAction(): ViewModel
    {
        $request = $this->getRequest();

        $sortBy = $request->getPost('sort-by', 'popularity');

        $form = $this->initBrowserForm($sortBy);

        $sort = $request->isPost() ? SortFactory::getSort($sortBy) : new PopularitySort();

        return new ViewModel(['games' => $this->getBrowserGames($sort), 'form' => $form]);
    }

    private function initBrowserForm(string $sortBy): Form
    {
        $select = SelectFactory::getSortBySelect();

        $form = new Form('form-sort-by');
        $form->setAttribute('action', 'browser');
        $form->add($select);

        $this->bindFormData($sortBy, $form);

        return $form;
    }

    /**
     * @param \FreeToGame\Sort\Sort $sort
     * @return array
     * @throws \FreeToGame\ApiException
     */
    private function getBrowserGames(Sort $sort): array
    {
        $filterCollection = new FilterCollection();

        $filterCollection->setPlatformFilter(new PlatformFilter(new Browser()));

        $freeToGame = new FreeToGame();

        return $freeToGame->fetchList($filterCollection, $sort)->getData();
    }

    public function pcAction(): ViewModel
    {
        $request = $this->getRequest();

        $sortBy = $request->getPost('sort-by', 'popularity');

        $form = $this->initPc($sortBy);

        $sort = $request->isPost() ? SortFactory::getSort($sortBy) : new PopularitySort();

        return new ViewModel(['games' => $this->getPcGames($sort), 'form' => $form]);
    }

    private function initPc(string $sortBy): Form
    {
        $select = SelectFactory::getSortBySelect();

        $form = new Form('form-sort-by');
        $form->setAttribute('action', 'pc');
        $form->add($select);

        $this->bindFormData($sortBy, $form);

        return $form;
    }


    /**
     * @param \FreeToGame\Sort\Sort $sort
     * @return array
     * @throws \FreeToGame\ApiException
     */
    private function getPcGames(Sort $sort): array
    {
        $filterCollection = new FilterCollection();

        $filterCollection->setPlatformFilter(new PlatformFilter(new PersonalComputer()));

        $freeToGame = new FreeToGame();

        return $freeToGame->fetchList($filterCollection, $sort)->getData();
    }

    private function bindFormData(string $sortBy, Form $form): void
    {
        $data = new ArrayObject();

        $data['sort-by'] = $sortBy;

        $form->bind($data);
    }
}
