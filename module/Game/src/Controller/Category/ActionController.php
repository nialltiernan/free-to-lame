<?php
declare(strict_types=1);

namespace Game\Controller\Category;

use ArrayObject;
use FreeToGame\Filters\SearchTerms\Action;
use FreeToGame\Sort\PopularitySort;
use Game\Factory\SelectFactory;
use Game\Factory\SortFactory;
use Game\Service\CategoryGamesRetriever;
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

        $games = CategoryGamesRetriever::execute(new Action(), $sort);

        return new ViewModel(['games' => $games, 'form' => $form]);
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
}
