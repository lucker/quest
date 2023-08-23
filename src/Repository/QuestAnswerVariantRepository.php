<?php
namespace App\Repository;

use App\Entity\QuestQuestionAnswerVariant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuestAnswerVariantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestQuestionAnswerVariant::class);
    }
}