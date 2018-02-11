<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 * @UniqueEntity(fields = {"name", "publishingYear"}, message="Книга с таким названием и годом издания уже существует.")
 * @UniqueEntity(fields = {"isbn"}, message="Книга с таким ISBN уже существует.")
 */
 
class Book {
	/**
	 * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
     * @ORM\Column(type="string", length=200)
     */
	private $name;
	
	/**
     * @ORM\Column(type="integer")
     */
	private $publishingYear;
	
	/**
	 * @ORM\Column(type="string", length=20)
     * @Assert\Isbn(
     *     type = {"isbn10","isbn13"},
     *     bothIsbnMessage = "ISBN не соответствует стандартам ISBN-10, ISBN-13"
     * )
     */ 
	private $isbn;
	
	/**
     * @ORM\Column(type="integer")
     */
	private $pageCount;
	
	/**
     * @ORM\Column(type="string", length=100, nullable=true)
	 * @Assert\File(mimeTypes={ "image/jpeg",  "image/png"}, mimeTypesMessage="Тип файла должен быть JPEG или PNG.")
     */
	private $cover;
	
	/**
     * Many Books have Many Authors.
     * @ORM\ManyToMany(targetEntity="Author", inversedBy="books")
     * @ORM\JoinTable(name="book_author",
			joinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="author_id", referencedColumnName="id")}
     *      )
     */
	private $authors;
	
	public function __construct() {
        $this->authors = new ArrayCollection();
    }
	

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Book
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set publishingYear
     *
     * @param integer $publishingYear
     *
     * @return Book
     */
    public function setPublishingYear($publishingYear)
    {
        $this->publishingYear = $publishingYear;

        return $this;
    }

    /**
     * Get publishingYear
     *
     * @return integer
     */
    public function getPublishingYear()
    {
        return $this->publishingYear;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set pageCount
     *
     * @param integer $pageCount
     *
     * @return Book
     */
    public function setPageCount($pageCount)
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    /**
     * Get pageCount
     *
     * @return integer
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * Set cover
     *
     * @param string $cover
     *
     * @return Book
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Add author
     *
     * @param \AppBundle\Entity\Author $author
     *
     * @return Book
     */
    public function addAuthor(\AppBundle\Entity\Author $author)
    {
        $this->authors[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \AppBundle\Entity\Author $author
     */
    public function removeAuthor(\AppBundle\Entity\Author $author)
    {
        $this->authors->removeElement($author);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthors()
    {
        return $this->authors;
    }
}
