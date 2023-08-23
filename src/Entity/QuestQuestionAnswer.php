<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'quest_question_answer')]
class QuestQuestionAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: QuestQuestion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestQuestion $questQuestion;

    #[ORM\OneToMany(targetEntity: QuestQuestionAnswerVariant::class, mappedBy: 'questQuestionAnswer', orphanRemoval: true, cascade: ['persist'])]
    #[ORM\JoinTable(name: 'quest_question_answer')]
    private Collection $questQuestionAnswerVariants;

    public function __construct()
    {
        $this->questQuestionAnswerVariants = new ArrayCollection();
    }

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

    /**
     * @return Collection
     */
    public function getQuestQuestionAnswerVariants(): Collection
    {
        return $this->questQuestionAnswerVariants;
    }

    /**
     * @param Collection $questQuestionAnswerVariants
     */
    public function setQuestQuestionAnswerVariants(Collection $questQuestionAnswerVariants): void
    {
        $this->questQuestionAnswerVariants = $questQuestionAnswerVariants;
    }

    /**
     * @param QuestQuestionAnswerVariant $questQuestionAnswerVariant
     * @return void
     */
    public function addQuestQuestionAnswerVariant(QuestQuestionAnswerVariant $questQuestionAnswerVariant): void
    {
        $questQuestionAnswerVariant->setQuestQuestionAnswer($this);

        if (!$this->questQuestionAnswerVariants->contains($questQuestionAnswerVariant)) {
            $this->questQuestionAnswerVariants->add($questQuestionAnswerVariant);
        }
    }

    /**
     * @param QuestQuestionAnswerVariant $questQuestionAnswerVariant
     * @return void
     */
    public function removeQuestQuestionAnswerVariant(QuestQuestionAnswerVariant $questQuestionAnswerVariant): void
    {
        $this->questQuestionAnswerVariants->removeElement($questQuestionAnswerVariant);
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}