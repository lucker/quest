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

    #[ORM\OneToMany(targetEntity: QuestQuestionHint::class, mappedBy: 'questQuestion', orphanRemoval: true, cascade: ['persist'])]
    #[ORM\JoinTable(name: 'quest_question_hint')]
    private Collection $hints;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->hints = new ArrayCollection();
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
     * @param QuestQuestionAnswer $answer
     * @return void
     */
    public function addAnswer(QuestQuestionAnswer $answer): void
    {
        $answer->setQuestQuestion($this);

        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
        }
    }

    /**
     * @param QuestQuestionAnswer $answer
     * @return void
     */
    public function removeAnswer(QuestQuestionAnswer $answer): void
    {
        $this->answers->removeElement($answer);
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getHints(): ArrayCollection|Collection
    {
        return $this->hints;
    }

    /**
     * @param QuestQuestionHint $hint
     * @return void
     */
    public function addHint(QuestQuestionHint $hint): void
    {
        $hint->setQuestQuestion($this);

        if (!$this->hints->contains($hint)) {
            $this->hints->add($hint);
        }
    }

    /**
     * @param QuestQuestionAnswer $hint
     * @return void
     */
    public function removeHint(QuestQuestionAnswer $hint): void
    {
        $this->hints->removeElement($hint);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->quest. ' ' . $this->number;
    }
}