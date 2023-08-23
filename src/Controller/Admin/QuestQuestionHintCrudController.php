<?php

namespace App\Controller\Admin;

use App\Entity\QuestQuestionHint;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuestQuestionHintCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuestQuestionHint::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('hint'),
            IntegerField::new('minutes')
            //TextEditorField::new('description'),
        ];
    }
}
