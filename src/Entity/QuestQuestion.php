<?php
namespace App\Entity;

use App\Repository\QuestQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: QuestQuestionRepository::class)]
#[ORM\Table(name: 'quest_question')]
class QuestQuestion
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

    #[ORM\OneToMany(targetEntity: QuestQuestionAnswer::class, mappedBy: 'questQuestion', orphanRemoval: true, cascade: ['persist'])]
    #[ORM\JoinTable(name: 'quest_question_answer')]
    private Collection $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

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
     * @return ArrayCollection|Collection
     */
    public function getAnswers(): ArrayCollection|Collection
    {
        return $this->answers;
    }

    /**
     * @param ArrayCollection|Collection $answers
     */
    public function setAnswers(ArrayCollection|Collection $answers): void
    {
        $this->answers = $answers;
    }

    /**
     * @param QuestQuestionAnswer $answers
     * @return void
     */
    public function addAnswers(QuestQuestionAnswer $answers): void
    {
        $answers->setQuestQuestion($this);

        if (!$this->answers->contains($answers)) {
            $this->answers->add($answers);
        }
    }



    public function __toString(): string
    {
        return $this->quest. ' ' . $this->number;
    }
}