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
    private QuestQuestionAnswer $questAnswer;

    #[ORM\Column(type: Types::STRING)]
    private string $answer;

    /**
     * @param QuestQuestionAnswer $questAnswer
     */
    public function setQuestAnswer(QuestQuestionAnswer $questAnswer): void
    {
        $this->questAnswer = $questAnswer;
    }

    /**
     * @return QuestQuestionAnswer
     */
    public function getQuestAnswer(): QuestQuestionAnswer
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