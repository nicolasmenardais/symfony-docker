<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use App\Repository\CategorieRepository;
use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Membre;
use App\Entity\Categorie;
use App\Entity\Video;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/{prenom}', name: 'app_home_bienvenue')]
    #[Route('/tra/lala/{prenom}', name: 'app_tra_lala')]
    public function index2($prenom): Response
    {
        return $this->render('home/bienvenue.html.twig', [
            'prenom' => $prenom,
        ]);
    }

    #[Route('/membres', name: 'app_membres')]
    public function liste_membres(MembreRepository $repo): Response
    {
        $liste = $repo->findMembresMalrauxTriParPseudo();

        return $this->render('home/pseudos.html.twig', [
            'les_membres' => $liste,
        ]);
    }
    #[Route('/membres/{id}', name: 'app_membres_detail')]
    public function detail_membre(Membre $membre): Response
    {
        

        return $this->render('home/membres_detail.html.twig', [
            'membre' => $membre,
        ]);
    }


    #[Route('/categories', name: 'app_categories')]
    public function liste_categories(CategorieRepository $repo): Response
    {
        $liste = $repo->findCategoriesTrieesParLibelle();
 
        return $this->render('home/categories.html.twig', [
            'les_categories' => $liste,
        ]);
    }
 
    #[Route('/categories/{id}', name: 'app_categorie_detail')]
    public function detail_categorie(Categorie $categorie): Response
    {
        return $this->render('home/categorie_detail.html.twig', [
            'categorie' => $categorie,
        ]);
    }
 
    #[Route('/videos', name: 'app_videos')]
    public function liste_videos(VideoRepository $repo): Response
    {
        $liste = $repo->findVideosTrieesParTitre();
 
        return $this->render('home/videos.html.twig', [
            'les_videos' => $liste,
        ]);
    }
 
    #[Route('/videos/{id}', name: 'app_video_detail')]
    public function detail_video(Video $video): Response
    {
        return $this->render('home/video_detail.html.twig', [
            'video' => $video,
        ]);
    }

    
}