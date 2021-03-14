<?php
declare(strict_types=1);

namespace User\Form;

use Laminas\Form\Element\Password;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Laminas\InputFilter\Input;
use Laminas\InputFilter\InputFilter;

class LoginForm extends Form
{
    /** @var \Laminas\InputFilter\InputFilterInterface */
    private $inputFilter;

    /** @var \Laminas\Db\Adapter\AdapterInterface */
    private $db;

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->inputFilter = new InputFilter();
        $this->db = $options['db'];

        $this->setAttribute('action', 'login');
        $this->addUsername();
        $this->addPassword();
        $this->addSubmit();

        $this->setInputFilter($this->inputFilter);
    }

    private function addUsername()
    {
        $this->addUsernameInput();

        $this->inputFilter->add(new Input('username'));
    }

    private function addUsernameInput(): void
    {
        $input = new Text('username');

        $input->setLabel('Username');
        $input->setAttributes(['class' => 'form-control', 'id' => 'username', 'placeholder' => 'Username']);
        $input->setLabelAttributes(['class' => 'visually-hidden', 'for' => 'username']);

        $this->add($input);
    }

    private function addPassword()
    {
        $this->addPasswordInput();

        $this->inputFilter->add(new Input('password'));
    }

    private function addPasswordInput(): void
    {
        $input = new Password('password');

        $input->setLabel('Password');
        $input->setAttributes(['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']);
        $input->setLabelAttributes(['class' => 'visually-hidden', 'for' => 'password']);

        $this->add($input);
    }

    private function addSubmit()
    {
        $submit = new Submit('submit');

        $submit->setValue('Register');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($submit);
    }
}
