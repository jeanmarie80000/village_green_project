<?php

namespace App\Controller\Admin;

use App\Entity\Sousrubrique;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SousrubriqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sousrubrique::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
