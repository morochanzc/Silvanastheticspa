<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Usuario;
use App\Entity\Rol;
use App\Entity\Menu;
use App\Entity\MenuRol;

class PanelController extends AbstractController
{
	private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    
    private function crearMenuAction()
    {
        //Se toma el usuario logueado para la construccion del Menu.
        $em = $this->getDoctrine()->getManager();
        $usuario = new Usuario();
        $rol = new Rol();
        $menu = new Menu();
        $menuRol = new MenuRol();
        
        $usuario = $this->getUser();
        $rol = $usuario->getRol();
             
        $consultaPadres = $em->createQuery('SELECT mr
                                            FROM App:MenuRol mr 
                                            JOIN mr.menu mn
                                            WHERE mn.padre is null and mr.rol ='.$rol->getId().'')
                                            ->getResult();
        $ItemsMenu = array();
        //Los registros relacionados se incluyen en el array del menu
        foreach($consultaPadres as $menuRol)
            {
                $menu = $menuRol->getMenu();
                
                $link = $menu->getRuta()==''?'#':$this->generateUrl($menu->getRuta());
                $item = array('id'=>$menu->getId(),
                	'link'=>$link,
                    'title'=>$menu->getNombre(),
                    'icon'=>$menu->getIcono(),
                    'submenus'=>$this->json_submenus($menu->getId())
                    );
                array_push($ItemsMenu,$item);
            }
            $menu = array('itemsMenu'=>$ItemsMenu);
            $json = json_encode($menu);
            
            return $json;
    }

    private function json_submenus($idPapa)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = new Usuario();
        $rol = new Rol();
        $menu = new Menu();
        $menuRol = new MenuRol();
        //Se toma el usuario logueado para la construccion del Menu.   
        $usuario = $this->getUser();
        $rol = $usuario->getRol();
              
        $consultaPadres = $em->createQuery('SELECT mr
                    FROM App:MenuRol mr 
                    JOIN mr.menu mn
                    WHERE mn.padre ='.$idPapa.' and mr.rol ='.$rol->getId().'')
                    ->getResult();
 
        $ItemsMenu = array();
            
        //Los registros relacionados se incluyen en el array del menu
        foreach($consultaPadres as $menuRol)
            {
                $menu = $menuRol->getMenu();
                $link = $menu->getRuta()==''?'#':$this->generateUrl($menu->getRuta());
                $item = array('id'=>$menu->getId(),
                	'link'=>$link,
                    'title'=>$menu->getNombre(),
                    'icon'=>$menu->getIcono(),
                    'submenus'=>$this->json_submenus($menu->getId())
                    );
                array_push($ItemsMenu,$item);
            }
                  
        $menu = array('submenu'=>$ItemsMenu);
        $json = json_encode($menu);
                 
        return $json;    
    }

    public function panel()
    {
    	$this->session->set('Menu', $this->crearMenuAction());
    	$Menu = $this->session->get('Menu');

        $rolId = $this->getUser()->getRol()->getId();
        switch ($rolId) {
            case '1':
                $ruta = 'panel_admin';
                break;
            case '2':
                $ruta = 'panel_director';
                break;
            case '3':
                $ruta = 'panel_usuario';
                break;
        }
        return $this->redirectToRoute($ruta);
    }

    public function admin()
    {
        return $this->render("panel/panel_admin.html.twig");
    }

    public function director()
    {
        return $this->render("panel/panel_director.html.twig");
    }

    public function usuario()
    {
        return $this->render("panel/panel_usuario.html.twig");
    }
}
