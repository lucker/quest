<?php
namespace App\Repository;

use App\Entity\QuestTeamAnswer;
use App\Entity\QuestTeamParticipantAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuestTeamParticipantAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestTeamParticipantAnswer::class);
    }
}