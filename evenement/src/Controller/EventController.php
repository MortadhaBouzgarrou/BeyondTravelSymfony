<?php

namespace App\Controller;
use App\Entity\Evenement;
use App\Entity\Participation;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\ParticipationRespository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EventController extends AbstractController
{
    /**
     * @Route("/event", name="app_event")
     */
    public function index(ParticipationRespository $a): Response
    {
    /*    return $this->render('base.back.html.twig', [
            'controller_name' => 'EventController',
        ]);*/
        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $event=$rep->findAll();
        $check=$a->selectbyevent(12);//$this->getUser()->getId()
        $session=false;
        if($session==false){
            return $this->render('event/eventF.html.twig', [
                'event' =>$event,'check' => $check,
            ]);
        }else{
            return $this->render('event/eventF.html.twig', [
                'event' =>$event,
            ]);
        }

      

    }
     /**
     * @Route("/eventlist", name="lista")
     */
    public function liste(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Evenement::class);
        $event=$rep->findAll();
        return $this->render('event/eventList.html.twig', [
            'events' => $event,
        ]);
    }   
    
    /**
 * @Route("/addevent", name="addevent")
*/
public function addevent(Request $request): Response
{
    $evenement=new Evenement();
    $form=$this->createForm(EventType::class,$evenement);
    $form=$form->handleRequest($request);
    if ($form->isSubmitted())
    {
        $evenement=$form->getData();
        $em=$this->getDoctrine()->getManager();
        $em->persist($evenement);
        $em->flush();
        return $this->redirectToRoute('lista');

    }
    return $this->render('event/addevent.html.twig', [
        'f' => $form->createView(),

    ]);
}
    /**
     * @Route("/{id}", name="update")
     */
    public function update($id,Request $request): Response
    {
   
          $rep=$this->getDoctrine()->getRepository(Evenement::class);
        
           $event=$rep->find($id);
           $form=$this->createForm(EventType::class,$event);
           $form=$form->handleRequest($request);
           if ($form->isSubmitted())
           {
           $em=$this->getDoctrine()->getManager();
           $em->flush();
            return $this->redirectToRoute('lista');
            
           }
       
              return $this->render('event/addevent.html.twig', [
                  'f' => $form->createView(), 'ev' => $event,
              ]);
   
   
    
    }     
    /**
 * @Route("/delete/{id}", name="delete_events")
 */
public function deleteEvent($id): Response
{
    $rep = $this->getDoctrine()->getRepository(Evenement::class);
    $em = $this->getDoctrine()->getManager();
    $evenement = $rep->find($id);
    $em->remove($evenement);
    $em->flush();
    return $this->redirectToRoute('lista');
}
    
     /**
 * @Route("/participer/{id}", name="participer")
*/
public function participer($id,Request $request,EventRepository $a): Response
{
      $participation = new Participation();
      $participation->setIdevenement($id);
      //$this->getUser()->getId()
      $participation->setIduser(12);
      $em=$this->getDoctrine()->getManager();
      $em->persist($participation);
      $em->flush();
      $a->capaciteDOWNbyONE($id);
    return $this->redirectToRoute('app_event');
    


  
}   
     /**
 * @Route("/imparticiper/{id}", name="imparticiper")
*/
public function imparticiper($id,ParticipationRespository $b,EventRepository $a): Response
{
    //$this->getUser()->getId()
     $b->delete($id,12);
      $a->capaciteUPbyONE($id);
    return $this->redirectToRoute('app_event');
}




/**
 * @Route("/pdf")
 */
public function pdf()
{
    // Configure Dompdf according to your needs
    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont', 'Arial');

    // Instantiate Dompdf with our options
    $dompdf = new Dompdf($pdfOptions);
    //l'image est située au niveau du dossier public
    $png = file_get_contents("l.png");
    $pngbase64 = base64_encode($png);
    // Retrieve the HTML generated in our twig file
    $html = $this->renderView('default/mypdf.html.twig', [
         "img64"=>$pngbase64
    ]);

    // Load HTML to Dompdf
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser (force download)
    $dompdf->stream("mypdf.pdf", [
        "Attachment" => false
    ]);
}





/**
     * @Route("/trievent", name="trievent")
     */
    public function Tri(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'SELECT p FROM App\Entity\Evenement p
            ORDER BY p.prix '
        );

        $event = $query->getResult();



        return $this->render('eventList/addevent.html.twig',
            array('c' => $event));

    }
}

