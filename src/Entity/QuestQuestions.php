<?php
namespace App\Entity;

use App\Repository\QuestQuestionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: QuestQuestionsRepository::class)]
#[ORM\Table(name: 'quest_questions')]
class QuestQuestions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Quest::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Quest $quest;

    #[ORM\Column(type: Types::INTEGER)]
    private int $number;

    #[ORM\Column(type: Types::STRING)]
    private string $question;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTime $finished;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return Quest
     */
    public function getQuest(): Quest
    {
        return $this->quest;
    }

    /**
     * @return \DateTime
     */
    public function getFinished(): \DateTime
    {
        return $this->finished;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @param string $question
     */
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * @param Quest $quest
     */
    public function setQuest(Quest $quest): void
    {
        $this->quest = $quest;
    }

    /**
     * @param \DateTime $finished
     */
    public function setFinished(\DateTime $finished): void
    {
        $this->finished = $finished;
    }
}