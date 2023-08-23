<?php

namespace App\Controller\Admin;

use App\Entity\QuestQuestionAnswer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class QuestAnswerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuestQuestionAnswer::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            CollectionField::new('questQuestionAnswerVariants')
                ->useEntryCrudForm(QuestQuestionAnswerVariantCrudController::class)
        ];
    }
}
