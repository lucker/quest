<?php

namespace App\Controller\Admin;

use App\Entity\QuestQuestion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class QuestQuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuestQuestion::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            //IdField::new('number'),
            TextEditorField::new('question'),
            AssociationField::new('quest'),
            CollectionField::new('answers')
                ->useEntryCrudForm(QuestAnswerCrudController::class),
            //TextEditorField::new('description'),
        ];
    }
}
