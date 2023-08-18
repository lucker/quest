<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'quest_team_participant_answer')]
class QuestTeamParticipantAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: QuestTeamParticipant::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestTeamParticipant $questTeamParticipant;

    #[ORM\ManyToOne(targetEntity: QuestQuestion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestQuestion $questQuestion;

    #[ORM\OneToOne(targetEntity: QuestAnswer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestAnswer $questAnswer;

    #[ORM\Column(type: Types::STRING)]
    private string $answer;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $answerTime;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return QuestTeamParticipant
     */
    public function getQuestTeamParticipant(): QuestTeamParticipant
    {
        return $this->questTeamParticipant;
    }

    /**
     * @return QuestQuestion
     */
    public function getQuestQuestion(): QuestQuestion
    {
        return $this->questQuestion;
    }

    /**
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * @param QuestTeamParticipant $questTeamParticipant
     */
    public function setQuestTeamParticipant(QuestTeamParticipant $questTeamParticipant): void
    {
        $this->questTeamParticipant = $questTeamParticipant;
    }

    /**
     * @param QuestQuestion $questQuestion
     */
    public function setQuestQuestion(QuestQuestion $questQuestion): void
    {
        $this->questQuestion = $questQuestion;
    }

    /**
     * @return \DateTime
     */
    public function getAnswerTime(): \DateTime
    {
        return $this->answerTime;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    /**
     * @param \DateTime $answerTime
     */
    public function setAnswerTime(\DateTime $answerTime): void
    {
        $this->answerTime = $answerTime;
    }

    /**
     * @return QuestAnswer
     */
    public function getQuestAnswer(): QuestAnswer
    {
        return $this->questAnswer;
    }

    /**
     * @param QuestAnswer $questAnswer
     */
    public function setQuestAnswer(QuestAnswer $questAnswer): void
    {
        $this->questAnswer = $questAnswer;
    }
}
