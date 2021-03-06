<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [ 
            //IdField::new('id'),
            TextField::new('name'),
            TextField::new('slug'),
            TextEditorField::new('content'),
            AssociationField::new('category', 'Category')
        ];
    }
    
}
