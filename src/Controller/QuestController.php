<?php
namespace App\Controller;

use App\Repository\QuestQuestionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

final class QuestController extends AbstractController
{
    #[Route('/quest', name: 'quest_index')]
    public function index(Request $request, QuestQuestionsRepository $questQuestionsRepository): Response
    {
        $questQuestion = $questQuestionsRepository->findOneBy([
            'finished' => null
        ], [
            'number' => 'ASC'
        ]);


        //print_r($questQuestions);

        //foreach ($questQuestions as $questQuestion) {
            //echo $questQuestion->getId();
            //echo ' ';
            //echo $questQuestion->getNumber();
            //$quest = $questQuestion->getQuest();
            //echo $quest->getName() . ' ' .$quest->getId(); echo ' ';
        //}


        return $this->render('quest/index.html.twig', [
            'question' => $questQuestion
        ]);
    }
}