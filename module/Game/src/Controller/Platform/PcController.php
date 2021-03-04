<?php
declare(strict_types=1);

namespace Game\Controller\Platform;

use ArrayObject;
use FreeToGame\Filters\Platforms\PersonalComputer;
use FreeToGame\Sort\PopularitySort;
use Game\Factory\SelectFactory;
use Game\Factory\SortFactory;
use Game\Service\PlatformGamesRetriever;
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

        $games = PlatformGamesRetriever::execute(new PersonalComputer(), $sort);

        return new ViewModel(['games' => $games, 'form' => $form]);
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

    private function bindFormData(string $sortBy, Form $form): void
    {
        $data = new ArrayObject();

        $data['sort-by'] = $sortBy;

        $form->bind($data);
    }
}
