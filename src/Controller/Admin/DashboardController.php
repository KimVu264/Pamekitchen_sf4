<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * Définition de préfixes de routes (préfixes d'URL et de nom):
 * @Route("/admin", name ="admin_")
*/

class DashboardController extends AbstractController
{
   /**
     * URL: /admin
     * nom: admin_dashboard
     * @Route("", name="dashboard")
     */
    
    public function index(): Response
    {
        return $this->render('/admin/dashboard/index.html.twig');
        
    }
}
