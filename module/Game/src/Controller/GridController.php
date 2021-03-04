<?php
declare(strict_types=1);

namespace Game\Controller;

use ArrayObject;
use FreeToGame\Sort\AlphabeticalSort;
use FreeToGame\Sort\PopularitySort;
use FreeToGame\Sort\ReleaseDateSort;
use FreeToGame\Sort\RelevanceSort;
use FreeToGame\Sort\Sort;
use Laminas\Form\Element\Select;
use Laminas\Form\Form;
use Laminas\Mvc\Controller\AbstractActionController;

class GridController extends AbstractActionController
{
    protected function initSortByForm(string $action, string $sortBy): Form
    {
        $select = $this->getSortBySelect();

        $form = new Form('grid-sort-by');
        $form->setAttribute('action', $action);
        $form->add($select);

        $this->bindSortByForm($sortBy, $form);

        return $form;
    }

    private function getSortBySelect(): Select
    {
        $select = new Select('sort-by');

        $select->setLabel('Order by: ');

        $select->setValueOptions([
            'alphabetical' => 'Alphabetical',
            'popularity' => 'Popularity',
            'release-date' => 'ReleaseDate',
            'relevance' => 'Relevance',
        ]);

        $select->setAttribute('onchange', 'this.form.submit()');

        return $select;
    }

    private function bindSortByForm(string $sortBy, Form $form): void
    {
        $data = new ArrayObject();

        $data['sort-by'] = $sortBy;

        $form->bind($data);
    }

    protected function getSort(string $sortBy): Sort
    {
        if ($sortBy === 'alphabetical') {
            $sort = new AlphabeticalSort();
        } elseif ($sortBy === 'popularity') {
            $sort = new PopularitySort();
        } elseif ($sortBy === 'release-date') {
            $sort = new ReleaseDateSort();
        } else {
            $sort = new RelevanceSort();
        }
        return $sort;
    }
}
