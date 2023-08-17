<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'quest_team_participant')]
class QuestTeamParticipant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\OneToOne(targetEntity: QuestTeam::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestTeam $questTeam;

    #[ORM\Column(type: Types::STRING)]
    private string $hash;

    #[ORM\OneToOne(targetEntity: Quest::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Quest $quest;

    #[ORM\OneToOne(targetEntity: QuestQuestion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestQuestion $questQuestion;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return QuestTeam
     */
    public function getQuestTeam(): QuestTeam
    {
        return $this->questTeam;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return Quest
     */
    public function getQuest(): Quest
    {
        return $this->quest;
    }

    /**
     * @return QuestQuestion
     */
    public function getQuestQuestion(): QuestQuestion
    {
        return $this->questQuestion;
    }

    /**
     * @param Quest $quest
     */
    public function setQuest(Quest $quest): void
    {
        $this->quest = $quest;
    }

    /**
     * @param string $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @param QuestQuestion $questQuestion
     */
    public function setQuestQuestion(QuestQuestion $questQuestion): void
    {
        $this->questQuestion = $questQuestion;
    }

    /**
     * @param QuestTeam $questTeam
     */
    public function setQuestTeam(QuestTeam $questTeam): void
    {
        $this->questTeam = $questTeam;
    }
}