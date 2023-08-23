<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'quest_question_hint')]
class QuestQuestionHint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: QuestQuestion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestQuestion $questQuestion;

    #[ORM\Column(type: Types::STRING)]
    private string $hint;

    #[ORM\Column(type: Types::INTEGER)]
    private int $minutes;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return QuestQuestion
     */
    public function getQuestQuestion(): QuestQuestion
    {
        return $this->questQuestion;
    }

    /**
     * @param QuestQuestion $questQuestion
     */
    public function setQuestQuestion(QuestQuestion $questQuestion): void
    {
        $this->questQuestion = $questQuestion;
    }

    /**
     * @return string
     */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
     * @param string $hint
     */
    public function setHint(string $hint): void
    {
        $this->hint = $hint;
    }

    /**
     * @return int
     */
    public function getMinutes(): int
    {
        return $this->minutes;
    }

    /**
     * @param int $minutes
     */
    public function setMinutes(int $minutes): void
    {
        $this->minutes = $minutes;
    }
}