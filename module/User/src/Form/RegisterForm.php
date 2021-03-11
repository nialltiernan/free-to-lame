<?php
declare(strict_types=1);

namespace User\Form;

use Laminas\Form\Element\Email;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Laminas\InputFilter\Input;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\Db\NoRecordExists;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\StringLength;

class RegisterForm extends Form
{
    /** @var \Laminas\InputFilter\InputFilterInterface */
    private $inputFilter;

    /** @var \Laminas\Db\Adapter\AdapterInterface */
    private $adapter;

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->inputFilter = new InputFilter();
        $this->adapter = $options['adapter'];

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
        $inputFilter = new Input('username');

        $inputFilter->getValidatorChain()->attach(new StringLength(2));

        $noRecordExists = new NoRecordExists(['table' => 'users', 'field' => 'username', 'adapter' => $this->adapter]);
        $noRecordExists->setMessage('Username already taken');
        $inputFilter->getValidatorChain()->attach($noRecordExists);

        $this->inputFilter->add($inputFilter);
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
        $inputFilter = new Input('email');

        $inputFilter->getValidatorChain()->attach(new EmailAddress());

        $noRecordExists = new NoRecordExists(['table' => 'users', 'field' => 'email', 'adapter' => $this->adapter]);
        $noRecordExists->setMessage('Email address already taken');
        $inputFilter->getValidatorChain()->attach($noRecordExists);

        $this->inputFilter->add($inputFilter);
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
