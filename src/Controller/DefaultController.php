<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    /*public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }*/

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        if($this->isGranted('ROLE_ADMIN')){
            $texto = "Esse usuário é um administrador.";
        }else{
            $texto = "Esse usuário não é adminstrador.";
        }

        return $this->render('default/index.html.twig', [
            "texto" => $texto
        ]);
    }

    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        return $this->render('default/dashboard.html.twig');
    }

    /**
     * @Route("/admin/relatorios", name="relatorios")
     */
    public function relatorios()
    {
        return $this->render('default/relatorios.html.twig');
    }

    /**
     * @Route("/admin/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $auth)
    {
        $error = $auth->getLastAuthenticationError();
        $lastUsername = $auth->getLastUsername();
        
        return $this->render('default/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    /**
     * @param Request $request
     * @Route("/insert")
     */
    public function insert(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        // User
        $user = new User();
        $user->setUsername("leandromarchon");
        $user->setEmail("leandromarchon@hotmail.com");
        $user->setRoles("ROLE_USER");

        $encoder = $this->get("security.password_encoder");
        $pass = $encoder->encodePassword($user, "123");
        $user->setPassword($pass);
        $entityManager->persist($user);

        // User Admin
        $user = new User();
        $user->setUsername("administrador");
        $user->setEmail("administrador@hotmail.com");
        $user->setRoles("ROLE_ADMIN");

        $encoder = $this->get("security.password_encoder");
        $pass = $encoder->encodePassword($user, "123");
        $user->setPassword($pass);
        $entityManager->persist($user);

        $entityManager->flush();

        return new Response("<html><body><h1>Registro inserido com sucesso!</h1></body></html>");
    }
}
