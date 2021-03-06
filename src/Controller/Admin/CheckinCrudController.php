<?php

namespace App\Controller\Admin;

use App\Entity\Checkin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class CheckinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Checkin::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('trainee', 'checkin.trainee'),
            AssociationField::new('training'),
            DateTimeField::new('date')->setFormat('short')->onlyOnIndex(),
        ];
    }
}
