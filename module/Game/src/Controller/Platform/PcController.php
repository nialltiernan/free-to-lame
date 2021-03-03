<?php
declare(strict_types=1);

namespace Game\Controller\Platform;

use ArrayObject;
use FreeToGame\Client as FreeToGame;
use FreeToGame\Filters\FilterCollection;
use FreeToGame\Filters\PlatformFilter;
use FreeToGame\Filters\Platforms\PersonalComputer;
use FreeToGame\Sort\PopularitySort;
use FreeToGame\Sort\Sort;
use Game\Factory\SelectFactory;
use Game\Factory\SortFactory;
use Laminas\Form\Form;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PcController extends AbstractActionController
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
    private function getGames(Sort $sort): array
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
