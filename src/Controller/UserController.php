<?php
namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class UserController extends AbstractFOSRestController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[View(
        statusCode: null,
        serializerGroups: ['user'],
        serializerEnableMaxDepthChecks: false
    )]    
   #[Post("/api/users",methods:['POST'])]
    public function getUsers()
    {
        $users = $this->userRepository->findAll();

        return $this->view($users,200);
    }
}
