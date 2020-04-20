<?php
namespace App\Controller;
use IP2Location\IP2Location;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class IpController extends AbstractController
{
    /**
     * @Route("/home", name="ip", methods={"GET","POST"})
     */
    public function index(Request $request )
    {
        $query="91.160.91.66";
        $db = new \IP2Location\Database ('../src/Database/IP2LOCATION.BIN', \IP2Location\Database::FILE_IO);
            $records = $db->lookup($query, \IP2Location\Database::ALL);
           
        
        

        return $this->render('ip/index.html.twig', [
            'controller_name' => 'IpController',
            'records'=>$records
          
        ]);
    }
}
