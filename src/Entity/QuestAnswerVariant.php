<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'quest_answer_variant')]
class QuestAnswerVariant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: QuestAnswer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestAnswer $questAnswer;

    #[ORM\Column(type: Types::STRING)]
    private string $answer;

    /**
     * @param QuestAnswer $questAnswer
     */
    public function setQuestAnswer(QuestAnswer $questAnswer): void
    {
        $this->questAnswer = $questAnswer;
    }

    /**
     * @return QuestAnswer
     */
    public function getQuestAnswer(): QuestAnswer
    {
        return $this->questAnswer;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }
}