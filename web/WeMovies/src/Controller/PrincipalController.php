<?php

namespace App\Controller;

use App\Service\MovieApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function indexAction(Request $request, MovieApiService $movieApiService): Response
    {
        $genres = $movieApiService->getAllGenreMovie();
        $params['genres'] = $genres;

        $form = $this->createFormBuilder();

        foreach ($genres as $genre) {
            $form = $form->add(
                str_replace(' ', '-', strtolower($genre->getName())),
                CheckboxType::class,
                [
                    'value' => $genre->getId(),
                    'attr' => ['class' => 'form-check-input checkbox-genre'],
                    'row_attr' => ['class' => 'mb-0'],
                ]
            );
        };

        $form = $form->add('listGenre', HiddenType::class, ['mapped' => true]);
        $form = $form->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $params['movies'] = $movieApiService->getMoviesList($data['listGenre']);
            $params['genreChecked'] = explode(',', $data['listGenre']);
        }

        if (!array_key_exists('movies', $params)) {
            $params['movies'] = $movieApiService->getMoviesList();
        }

        $params['form'] = $form->createView();
        return $this->render('principal/index.html.twig', $params);
    }
}
