<?php

namespace App\Controller\Admin;

use App\Entity\QuestTeamParticipant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class QuestTeamParticipantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuestTeamParticipant::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('questTeam'),
            AssociationField::new('quest')
        ];
    }
}
