<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Book;


class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('name', TextType::class, array('label' => 'Наименование'))
			->add('publishingYear', IntegerType::class, array('label' => 'Год издания'))
			->add('isbn', TextType::class, array('label' => 'ISBN'))
			->add('pageCount', TextType::class, array('label' => 'Количество страниц'))
			->add('authors', EntityType::class, array(
					'class' => 'AppBundle:Author',
					'choice_label' => 'getFullName',
					'multiple' => true,
					//'expanded' => true,
					'label' => 'Авторы',
					'required' => false,
				))			
			->add('cover', FileType::class, array('label' => 'Обложка (JPEG или PNG)', 'required' => false));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Book::class));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_book';
    }


}
