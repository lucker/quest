<?php
namespace App\Controller;

use App\Entity\QuestTeamParticipant;
use App\Entity\QuestTeamParticipantAnswer;
use App\Repository\QuestAnswerRepository;
use App\Repository\QuestAnswerVariantRepository;
use App\Repository\QuestQuestionRepository;
use App\Repository\QuestRepository;
use App\Repository\QuestTeamParticipantAnswerRepository;
use App\Repository\QuestTeamParticipantRepository;
use App\Repository\QuestTeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

final class QuestController extends AbstractController
{
    #[Route('/test', name: 'quest_test')]
    public function test(): Response
    {
        return new JsonResponse([
            'message' => 'Done',
        ],
            Response::HTTP_OK
        );

    }

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
    public function index(
        string $hash,
        Request $request,
        QuestTeamParticipantRepository $questTeamParticipantRepository
    ): Response
    {
        $questTeamParticipant = $questTeamParticipantRepository->findOneBy([
            'hash' => $hash
        ]);
        $questQuestion = $questTeamParticipant->getQuestQuestion();

        if ($questQuestion == null) {
            return $this->render('quest/success.html.twig');
        }

        return $this->render('quest/index.html.twig', [
            'questTeamParticipant' => $questTeamParticipant,
            'questQuestion' => $questQuestion
        ]);
    }

    #[Route('/check-answer', name: 'quest_check_answer')]
    public function checkAnswer(
        EntityManagerInterface $entityManager,
        Request $request,
        QuestTeamParticipantRepository $questTeamParticipantRepository,
        QuestAnswerRepository $questAnswerRepository,
        QuestAnswerVariantRepository $questAnswerVariantRepository,
        QuestTeamParticipantAnswerRepository $questTeamParticipantAnswerRepository,
        QuestQuestionRepository $questQuestionRepository
    ): Response
    {
        $answer = $request->get("answer");
        $hash = $request->get("hash");
        $correct = false;
        $questTeamParticipant = $questTeamParticipantRepository->findOneBy([
            'hash' => $hash
        ]);
        $questQuestion = $questTeamParticipant->getQuestQuestion();

        $questAnswers = $questAnswerRepository->findBy([
            'questQuestion' => $questQuestion
        ]);

        foreach ($questAnswers as $questAnswer) {
            $questAnswerVariants = $questAnswerVariantRepository->findBy([
                'questQuestionAnswer' => $questAnswer
            ]);

            foreach ($questAnswerVariants as $questAnswerVariant) {
                if ($questAnswerVariant->getAnswer() == $answer) {
                    $correct = true;
                    $questTeamParticipantAnswer = $questTeamParticipantAnswerRepository->findOneBy([
                        'questAnswer' => $questAnswer
                    ]);
                    if ($questTeamParticipantAnswer == null) {
                        $questTeamParticipantAnswer = new QuestTeamParticipantAnswer();
                        $questTeamParticipantAnswer->setAnswer($answer);
                        $questTeamParticipantAnswer->setQuestTeamParticipant($questTeamParticipant);
                        $questTeamParticipantAnswer->setQuestQuestion($questQuestion);
                        $questTeamParticipantAnswer->setAnswerTime(new \DateTime());
                        $questTeamParticipantAnswer->setQuestAnswer($questAnswer);

                        $entityManager->persist($questTeamParticipantAnswer);
                        $entityManager->flush();
                    }
                }
            }
        }

        $questTeamParticipantAnswers = $questTeamParticipantAnswerRepository->findBy([
            'questQuestion' => $questQuestion
        ]);
        $reload = false;

        if (count($questTeamParticipantAnswers) == count($questAnswers)) {
            $nextQuestQuestion = $questQuestionRepository->findOneBy([
                'quest' => $questTeamParticipant->getQuest(),
                'number' => $questQuestion->getNumber() + 1
            ]);
            $questTeamParticipant->setQuestQuestion($nextQuestQuestion);

            $entityManager->persist($questTeamParticipant);
            $entityManager->flush();
            $reload = true;
        }


        return new JsonResponse([
            'answer' => $answer,
            'correct' => $correct,
            'reload' => $reload
        ],Response::HTTP_OK);
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