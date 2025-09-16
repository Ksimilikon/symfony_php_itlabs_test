<?php

namespace App\Controller\Admin;

use App\Entity\Table;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TableCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Table::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            NumberField::new('num', "Номер столика"),
            TextEditorField::new('description', "Описание"),
            NumberField::new('maxGuests', "Максимальная вместимость человек"),
            NumberField::new('guestsDef', "Гостей"),
            NumberField::new('guestsNow', "Присутсвует"),
        ];
    }

    public function congigureCrud(Crud $crud) : Crud
    {
        return $crud
            ->setEntityLabelInSingular('Table')
            ->setEntityLabelInPlural('Tables')
            ->setSearchFields(['id', 'num']);
    }
}
