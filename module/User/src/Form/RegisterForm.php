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
use Laminas\Validator\EmailAddress;
use Laminas\Validator\StringLength;

class RegisterForm extends Form
{
    private $inputFilter;

    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->inputFilter = new InputFilter();

        $this->setAttribute('action', 'register');

        $this->addUsername();
        $this->addEmail();
        $this->addPassword();
        $this->addSubmit();

        $this->setInputFilter($this->inputFilter);
    }

    private function addUsername()
    {
        $username = new Text('username');
        $username->setLabel('Username');
        $username->setAttributes(['class' => 'form-control', 'id' => 'username', 'placeholder' => 'Username']);
        $username->setLabelAttributes(['class' => 'visually-hidden', 'for' => 'username']);
        $this->add($username);

        $username = new Input('username'); // TODO check if exists in DB
        $username->getValidatorChain()->attach(new StringLength(2));

        $this->inputFilter->add($username);
    }

    private function addEmail()
    {
        $email = new Email('email');
        $email->setLabel('Email');
        $email->setAttributes(['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']);
        $email->setLabelAttributes(['class' => 'visually-hidden', 'for' => 'email']);
        $this->add($email);

        $email = new Input('email'); // TODO check if exists in DB
        $email->getValidatorChain()->attach(new EmailAddress());

        $this->inputFilter->add($email);
    }

    private function addPassword()
    {
        $password = new Password('password');
        $password->setLabel('Password');
        $password->setAttributes(['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']);
        $password->setLabelAttributes(['class' => 'visually-hidden', 'for' => 'password']);
        $this->add($password);

        $password = new Input('password');
        $password->getValidatorChain()->attach(new StringLength(8));

        $this->inputFilter->add($password);
    }

    private function addSubmit()
    {
        $submit = new Submit('submit');
        $submit->setValue('Register');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($submit);
    }
}
