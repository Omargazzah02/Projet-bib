<?php
namespace App\Controller;
use App\Repository\ReservRepository;

use App\Repository\EventRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Event;
use App\Entity\Reserv;

use App\Entity\Users;
use App\Form\UsersType;
use App\Form\EventType;
use  Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\JsonResponse;

class EventController extends AbstractController
{
  private $alert;

    #[Route('/zoneuser', name: 'zoneuser')]
    public function userzone(EventRepository $eventmod,UsersRepository $user,Request $request ): Response
    {







         //  gestion role fonction :  zone pour les utilisateur 
   $utilisateur= $user->findOneBy(['isconnect' =>1]);
   if (!isset($utilisateur)){
    return $this->redirectToRoute('seconnecter');  
   }
   //



        $events = $eventmod->findAll();
        //verifier si admin
$admin= $user->findOneBy(['isadmin' =>1,'isconnect'=>1]);
if($admin){
$bool=true;
} else 
{
    $bool=false;



}


if ($request->isMethod('POST'))
{
    $dateString = $request->request->get('date');
    $date = new \DateTime($dateString);

    $events=$eventmod->findBy(['date'=>$date]);
    return $this->render('usertemplates/zoneuser.html.twig', ['events' => $events,'admin'=>$bool]);

}
        return $this->render('usertemplates/zoneuser.html.twig', ['events' => $events,'admin'=>$bool]);
    }

    #[Route('/reservuser', name: 'reservuser')]
    public function reservzone(EventRepository $eventmod,UsersRepository $user,  ReservRepository  $reserv): Response
    {
        //  gestion role fonction :  zone pour les utilisateur 
   $utilisateur= $user->findOneBy(['isconnect' =>1]);
   if (!isset($utilisateur)){
    return $this->redirectToRoute('seconnecter');  
   }

   $reservations= $reserv->findBy(['iduser'=>$utilisateur->getId()]);
   //
//verifier si admin
$admin= $user->findOneBy(['isadmin' =>1,'isconnect'=>1]);
if($admin){
$bool=true;
} else 
{
    $bool=false;
}




//

        return $this->render('usertemplates/reservuser.html.twig',['admin'=>$bool,'reservations'=>$reservations]);
    }

    #[Route('/creerevent', name: 'creerevent', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $manager,UsersRepository $user): Response
    {

        $admin= $user->findOneBy(['isadmin' =>1,'isconnect'=>1]);

if ($admin){
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute('zoneadmin');
        }
    }
    else {
        return $this->redirectToRoute('seconnecter');

    }

        return $this->render('admintemplates/creeradmin.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/zoneadmin', name: 'zoneadmin')]
    public function zoneadmin(EventRepository $eventmod,UsersRepository $user,Request $request): Response
    {

//verifier si admin
$admin= $user->findOneBy(['isadmin' =>1,'isconnect'=>1]);

if ($admin){
        
        $events = $eventmod->findAll();
        if ($request->isMethod('POST'))
        {
            $dateString = $request->request->get('date');
            $date = new \DateTime($dateString);
        
            $events=$eventmod->findBy(['date'=>$date]);
        
        }


}
else {
    return $this->redirectToRoute('seconnecter');


}





        return $this->render('admintemplates/zoneadmin.html.twig', ['events' => $events]);
    }

    #[Route('/deleteevent/{id}', name: 'deleteevent')]
    public function deleteevent(Event $event, EntityManagerInterface $manager): Response
    {
        $manager->remove($event);
        $manager->flush();

        return $this->redirectToRoute('zoneadmin');
    }

    #[Route('/editevent/{id}', name: 'editevent')]
    public function editevent(Event $event, Request $request, EntityManagerInterface $manager,UsersRepository $user): Response
    {
                  //  gestion role fonction :  zone pour les utilisateur 
   $user= $user->findOneBy(['isconnect' =>1]);
   if (!isset($user)){
    return $this->redirectToRoute('seconnecter');  
   }
   //
        $form = $this->createForm(EventType::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute('zoneadmin');
        }

        return $this->render('admintemplates/creeradmin.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/inscrireuser', name: 'inscrireuser', methods: ['GET', 'POST'])]
    public function inscrireuser(Request $request, EntityManagerInterface $manager,UsersRepository $userrep): Response
    {
          
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email=$form->get('email')->getData();
            $isexiste=$userrep->findOneBy(['email'=> $email]);

            if(!isset($isexiste)) {

            
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('seconnecter');
            }
            else {
                return $this->render('usertemplates/inscrireuser.html.twig', ['err'=>" L'email que vous avez saisi existe déjà",'form' => $form->createView()]);

            }
        }

        return $this->render('usertemplates/inscrireuser.html.twig', ['form' => $form->createView()]);
    }




    #[Route('/', name: 'seconnecter')]

public function login(Request $request,UsersRepository $user,EventRepository $eventmod,EntityManagerInterface $manager)
{
//  gestion role 
$utilisateur= $user->findOneBy(['isconnect' =>1]);

if ($utilisateur){
    return $this->redirectToRoute('zoneuser');  
}
//
    $events = $eventmod->findAll();

    if ($request->isMethod('POST')) {


    $email = $request->request->get('email');
    $motDePasse = $request->request->get('mot_de_passe');

    // Vérifier si l'email existe dans la base de données
    $emailexist = $user->findOneBy(['email' => $email]);
    $passwordexist = $user->findOneBy(['password' =>  $motDePasse]);


    if ($passwordexist &&  $emailexist){
        $emailexist->setIsconnect(1);
       $manager->flush();
       return $this->redirectToRoute('zoneuser');

       

    }


    else{
        return $this->render('acceuil.html.twig', ['events' => $events,'err'=>' Mot de passe ou email incorrect ']);
 
    }

}

    return $this->render('acceuil.html.twig', ['events' => $events]);
}

// ...
#[Route('/deconnecter', name: 'deconnecter')]
public function deconnecter(UsersRepository $user,EntityManagerInterface $manager): Response
{
   //  gestion role 
$user= $user->findOneBy(['isconnect' =>1]);


    $user->setIsconnect(0);
    $manager->flush();
    return $this->redirectToRoute('seconnecter');  

//
}



//#[Route('/deleteevent/{id}', name: 'deleteevent')]
#[Route('/reserver/{id}', name: 'reserver')]
public function reserver( Event $event,  UsersRepository $user,  EntityManagerInterface $manager, ReservRepository $reserv ): Response{
 //var_dump($event);
   //  gestion role 
$user= $user->findOneBy(['isconnect' =>1]);
$test=$reserv->findOneBy(['idevent' =>$event->getId(), 'iduser'=>$user->getId()]); 

if ($event->getNbPersones() >=$event->getMaxNbPersones()){
    return $this->redirectToRoute('zoneuser'); 


}


else if (!isset($test)){
$reserv=new Reserv();
$event->setNbPersones($event->getNbPersones()+1);
$reserv->setIduser($user->getId());
$reserv->setIdevent($event->getId());
$reserv->setName($event->getName());
$reserv->setPhoto($event->getPhoto());
$reserv->setNbPersones($event->getNbPersones());

$reserv->setMaxNbPersones($event->getMaxNbPersones());

$reserv->setDate($event->getDate());
$manager->persist($reserv);
$manager->flush();

} 





//return new JsonResponse();
    return $this->redirectToRoute('zoneuser'); 

//

}









#[Route('/annulerreserv/{id}', name: 'annulerreserv')]
public function annulerreserv(Reserv $reserv, EntityManagerInterface $manager,EventRepository $event): Response
{ 
    $event=$event->findOneBy(['id'=>$reserv->getIdevent()]);
    $event->setNbPersones($event->getNbPersones()-1);
    $manager->remove($reserv);
    $manager->flush();
    return $this->redirectToRoute('reservuser');
}















}



