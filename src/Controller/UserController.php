<?php
/**
 * Created by PhpStorm.
 * UserModel: benoit
 * Date: 12/18/17
 * Time: 3:29 PM
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\SignUpType;
use App\Model\UserModel as UserModel;
use App\Handler\UserHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 *
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/signup", name="signup")
     */
    public function signUp(Request $request, UserHandler $userHandler)
    {
        $user = new UserModel;
        $form = $this->createForm(SignUpType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userHandler->save($user);
        }

        return $this->render('user/signUp.html.twig', [
            'signUpForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/all")
     * @IsGranted("ROLE_USER")
     */
    public function list(UserHandler $userHandler)
    {
        $users = $userHandler->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Cache(smaxage=5)
     */
    public function listBlock(UserHandler $userHandler)
    {
        $users = $userHandler->findAll();

        return $this->render('user/list-block.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/show/{user}")
     */
    public function showProfile(User $user)
    {
        $this->denyAccessUnlessGranted('show', $user);

        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
}
