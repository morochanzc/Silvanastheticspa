<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
  public function menu(Request $request)
  {
  	$menu = $request->get('menu');
    $menu_array = json_decode($menu);
    $mi_menu = array();

    foreach($menu_array->itemsMenu as $array1)
    {
      $array = (array)$array1;
      $submenu = json_decode($array['submenus']);
      $mi_item = array('id'=>$array['id'],
     		'link'=>$array['link'],
         	'title'=>$array['title'],
         	'icon'=>$array['icon'],
         	'submenus'=>$submenu->submenu,
      );
     array_push($mi_menu,$mi_item);
    }
    return $this->render('menu/index.html.twig', [
      'itemsMenu' => $mi_menu,
    ]);
  }
}
