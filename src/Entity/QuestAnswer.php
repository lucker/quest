<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'quest_answer')]
class QuestAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: QuestQuestion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestQuestion $questQuestion;

    /**
     * @param QuestQuestion $questQuestion
     */
    public function setQuestQuestion(QuestQuestion $questQuestion): void
    {
        $this->questQuestion = $questQuestion;
    }

    /**
     * @return QuestQuestion
     */
    public function getQuestQuestion(): QuestQuestion
    {
        return $this->questQuestion;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}