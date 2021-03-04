<?php
declare(strict_types=1);

namespace Game\Form;

use ArrayObject;
use Laminas\Form\Element\Select;
use Laminas\Form\Form;

class SortByForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->setAttribute('action', $options['action']);

        $this->add([
            'type' => Select::class,
            'name' => 'sort-by',
            'options' => [
                'label' => 'Sort by: ',
                'value_options' => [
                    'alphabetical' => 'Alphabetical',
                    'popularity' => 'Popularity',
                    'release-date' => 'ReleaseDate',
                    'relevance' => 'Relevance',
                ]
            ],
            'attributes' => [
                'onchange' => 'this.form.submit()'
            ]
        ]);

        $data = new ArrayObject();
        $data['sort-by'] = $options['sort-by'];
        $this->bind($data);
    }
}
