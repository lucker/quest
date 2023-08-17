<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'quest_answer')]
class QuestAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\ManyToOne(targetEntity: QuestQuestion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private QuestQuestion $questQuestion;

    #[ORM\Column(type: Types::STRING)]
    private string $answer;
}