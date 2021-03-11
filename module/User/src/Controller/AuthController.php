<?php
declare(strict_types=1);

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Form\RegisterForm;
use User\Repository\UserWriteRepositoryInterface;

class AuthController extends AbstractActionController
{

    /** @var \User\Repository\UserWriteRepositoryInterface */
    private $userWriteRepository;

    /** @var \User\Form\RegisterForm */
    private $registerForm;

    public function __construct(UserWriteRepositoryInterface $userWriteRepository, RegisterForm $registerForm)
    {
        $this->userWriteRepository = $userWriteRepository;
        $this->registerForm = $registerForm;
    }

    /**
     * @return \Laminas\Http\Response | \Laminas\View\Model\ViewModel
     */
    public function registerAction()
    {
        $form = $this->registerForm;

        if ($this->getRequest()->isGet()) {
            return new ViewModel(['form' => $form]);
        }

        $params = $this->getRequest()->getPost();

        $form->setData($params);

        if (!$form->isValid()) {
            return new ViewModel(['form' => $form]);
        }

        $data = $params->toArray();
        unset($data['submit']);

        $this->userWriteRepository->create($data);

        return $this->redirect()->toRoute('home');
    }

}
