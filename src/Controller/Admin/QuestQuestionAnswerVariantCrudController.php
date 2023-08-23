<?php

namespace App\Controller\Admin;

use App\Entity\QuestQuestionAnswerVariant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class QuestQuestionAnswerVariantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuestQuestionAnswerVariant::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            //AssociationField::new('questQuestionAnswer'),
            TextField::new('answer'),
        ];
    }
}
