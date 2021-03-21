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

        $this->setAttribute('action', 'register');
        $this->addUsername();
        $this->addEmail();
        $this->addPassword();
        $this->addSubmit();

        $this->setInputFilter($this->inputFilter);
    }

    private function addUsername()
    {
        $this->addUsernameInput();
        $this->addUsernameInputFilter();
    }

    private function addUsernameInput(): void
    {
        $input = new Text('username');

        $input->setLabel('Username');
        $input->setAttributes(['class' => 'form-control', 'id' => 'username', 'placeholder' => 'Username']);
        $input->setLabelAttributes(['class' => 'visually-hidden', 'for' => 'username']);

        $this->add($input);
    }

    private function addUsernameInputFilter(): void
    {
        $filter = new Input('username');

        $filter->getValidatorChain()->attach(new StringLength(2));

        $noRecordExists = new NoRecordExists(['table' => 'users', 'field' => 'username', 'adapter' => $this->db]);
        $noRecordExists->setMessage('Username already taken');
        $filter->getValidatorChain()->attach($noRecordExists);

        $this->inputFilter->add($filter);
    }

    private function addEmail()
    {
        $this->addEmailInput();
        $this->addEmailInputFilter();
    }

    private function addEmailInput(): void
    {
        $input = new Email('email');

        $input->setLabel('Email');
        $input->setAttributes(['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']);
        $input->setLabelAttributes(['class' => 'visually-hidden', 'for' => 'email']);

        $this->add($input);
    }

    private function addEmailInputFilter(): void
    {
        $filter = new Input('email');

        $filter->getValidatorChain()->attach(new EmailAddress());

        $noRecordExists = new NoRecordExists(['table' => 'users', 'field' => 'email', 'adapter' => $this->db]);
        $noRecordExists->setMessage('Email address already taken');
        $filter->getValidatorChain()->attach($noRecordExists);

        $this->inputFilter->add($filter);
    }

    private function addPassword()
    {
        $this->addPasswordInput();
        $this->addPasswordInputFilter();
    }

    private function addPasswordInput(): void
    {
        $input = new Password('password');

        $input->setLabel('Password');
        $input->setAttributes(['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']);
        $input->setLabelAttributes(['class' => 'visually-hidden', 'for' => 'password']);

        $this->add($input);
    }

    private function addPasswordInputFilter(): void
    {
        $inputFilter = new Input('password');
        $inputFilter->getValidatorChain()->attach(new StringLength(8));

        $this->inputFilter->add($inputFilter);
    }

    private function addSubmit()
    {
        $submit = new Submit('submit');

        $submit->setValue('Register');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($submit);
    }
}
