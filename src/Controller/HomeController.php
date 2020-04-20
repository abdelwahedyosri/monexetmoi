<?php

namespace App\Controller;


use IP2Location\IP2Location;
use App\Repository\ListeDesPaysRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ListeDesPaysRepository $listeDesPaysRepository)
    {
       
        $query="91.160.91.66";
        $db = new \IP2Location\Database ('../src/Database/IP2LOCATION.BIN', \IP2Location\Database::FILE_IO);
            $records = $db->lookup($query, \IP2Location\Database::ALL);
          
      $country_code=$records['countryCode'];
      $country_name=$records['countryName'];
       
       $numéro_vert_object=$listeDesPaysRepository->findOneBy(array('Nom' => $country_name,'Code'=>  $country_code));
       $numéro_vert=$numéro_vert_object->getNumVert();
      
        return $this->render('home/index.html.twig',['numéro_vert'=>$numéro_vert]);
    }
}
