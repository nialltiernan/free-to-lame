<?php
declare(strict_types=1);

namespace User\Form;

use Laminas\Db\Adapter\AdapterInterface as DatabaseAdapter;
use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Laminas\InputFilter\Input;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\Db\NoRecordExists;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\StringLength;

class RegisterForm extends Form
{
    private InputFilterInterface $inputFilter;
    private DatabaseAdapter $db;

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->inputFilter = new InputFilter();
        $this->db = $options['db'];

        $this->addUsername();
        $this->addEmail();
        $this->addPassword();

        $this->setInputFilter($this->inputFilter);
    }

    private function addUsername()
    {
        $this->add(new Text('username'));

        $filter = new Input('username');

        $filter->getValidatorChain()->attach(new StringLength(2));

        $noRecordExists = new NoRecordExists(['table' => 'users', 'field' => 'username', 'adapter' => $this->db]);
        $noRecordExists->setMessage('Username already taken');
        $filter->getValidatorChain()->attach($noRecordExists);

        $this->inputFilter->add($filter);
    }

    private function addEmail()
    {
        $this->add(new Email('email'));

        $filter = new Input('email');

        $filter->getValidatorChain()->attach(new EmailAddress());

        $noRecordExists = new NoRecordExists(['table' => 'users', 'field' => 'email', 'adapter' => $this->db]);
        $noRecordExists->setMessage('Email address already taken');
        $filter->getValidatorChain()->attach($noRecordExists);

        $this->inputFilter->add($filter);
    }

    private function addPassword()
    {
        $this->add(new Password('password'));

        $filter = new Input('password');
        $filter->getValidatorChain()->attach(new StringLength(8));

        $this->inputFilter->add($filter);
    }
}
