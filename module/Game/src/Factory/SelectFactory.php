<?php
declare(strict_types=1);

namespace Game\Factory;

use Laminas\Form\Element\Select;

class SelectFactory
{
    public static function getSortBySelect(): Select
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
}
