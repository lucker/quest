<?php
namespace App\Controller;

use App\Entity\QuestTeamParticipant;
use App\Repository\QuestQuestionRepository;
use App\Repository\QuestRepository;
use App\Repository\QuestTeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

final class QuestController extends AbstractController
{
    #[Route('/quest/generate-user-link/{teamId}/{questId}', name: 'quest_generate-user-link')]
    public function generateUserLink(
        int $teamId,
        int $questId,
        QuestTeamRepository $questTeamRepository,
        QuestRepository $questRepository,
        QuestQuestionRepository $questQuestionRepository,
        EntityManagerInterface $entityManager
    )
    {
        $questTeam = $questTeamRepository->findOneBy([
            'id' => $teamId
        ]);

        $quest = $questRepository->findOneBy([
            'id' => $questId
        ]);

        $questQuestion = $questQuestionRepository->findOneBy([
            'quest' => $quest,
            'number'   => 0
        ]);

        $hash = $this->generateRandomString(15);
        $questTeamParticipant = new QuestTeamParticipant();
        $questTeamParticipant->setQuestTeam($questTeam);
        $questTeamParticipant->setHash($hash);
        $questTeamParticipant->setQuest($quest);
        $questTeamParticipant->setQuestQuestion($questQuestion);

        $entityManager->persist($questTeamParticipant);
        $entityManager->flush();

        return new JsonResponse([
                'message' => 'Done',
            ],
            Response::HTTP_OK
        );

    }

    #[Route('/quest/{hash}', name: 'quest_index')]
    public function index(string $hash, Request $request, QuestQuestionRepository $questQuestionRepository): Response
    {
        $questQuestion = $questQuestionRepository->findOneBy([
            'finished' => null
        ], [
            'number' => 'ASC'
        ]);

        return $this->render('quest/index.html.twig', [
            'question' => $questQuestion
        ]);
    }

    #[Route('/check-answer/{answer}', name: 'quest_check_answer')]
    public function checkAnswer(string $answer)
    {
        return new JsonResponse([
            'message' => 'There are no jobs in the database',
        ],
             Response::HTTP_OK
        );
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}