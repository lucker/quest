<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'quest_question_answer_variant')]
class QuestQuestionAnswerVariant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: QuestQuestionAnswer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestQuestionAnswer $questQuestionAnswer;

    #[ORM\Column(type: Types::STRING)]
    private string $answer;

    /**
     * @param QuestQuestionAnswer $questQuestionAnswer
     */
    public function setQuestQuestionAnswer(QuestQuestionAnswer $questQuestionAnswer): void
    {
        $this->questQuestionAnswer = $questQuestionAnswer;
    }

    /**
     * @return QuestQuestionAnswer
     */
    public function getQuestQuestionAnswer(): QuestQuestionAnswer
    {
        return $this->questQuestionAnswer;
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

    public function __toString(): string
    {
        return $this->answer;
    }
}