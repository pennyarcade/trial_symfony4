<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class News
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $headline;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="news")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $category;


    public function getId()
    {
        return $this->id;
    }

    public function getHeadline(): ?string
    {
        return $this->headline;
    }

    public function setHeadline(string $headline): self
    {
        $this->headline = $headline;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @param News $news
     * @param $criterion
     * @param $direction
     *
     * @return boolean
     */
    public function lt(News $news, $criterion, $direction) : bool
    {
        switch ($criterion){
            case "date":
                if ($direction == "ASC")
                    return $this->date < $news->getDate();
                elseif ($direction == "DESC")
                    return !($this->date < $news->getDate());
                else {
                    throw new InvalidArgumentException("Invalid direction");
                }
                break;
            case "wordcount":
                if ($direction == "ASC")
                    return str_word_count($this->body) < str_word_count($news->getBody());
                elseif ($direction == "DESC")
                    return !(str_word_count($this->body) < str_word_count($news->getBody()));
                else {
                    throw new InvalidArgumentException("Invalid direction");
                }
                break;
            case "category":
                if ($direction == "ASC")
                    return strcmp($this->category->getName(), $news->getCategory()->getName()) < 0;
                elseif ($direction == "DESC")
                    return !(strcmp($this->category->getName(), $news->getCategory()->getName()) < 0);
                else {
                    throw new InvalidArgumentException("Invalid direction");
                }
                break;
            default:
                throw new InvalidArgumentException("Invalid criterion for sorting");
        }
    }

    /**
     * @param News $news
     * @param $criterion
     * @param $direction
     *
     * @return boolean
     */
    public function gt(News $news, $criterion, $direction) : bool
    {
        switch ($criterion){
            case "date":
                if ($direction == "ASC")
                    return $this->date > $news->getDate();
                elseif ($direction == "DESC")
                    return !($this->date > $news->getDate());
                else {
                    throw new InvalidArgumentException("Invalid direction");
                }
                break;
            case "wordcount":
                if ($direction == "ASC")
                    return str_word_count($this->body) > str_word_count($news->getBody());
                elseif ($direction == "DESC")
                    return !(str_word_count($this->body) > str_word_count($news->getBody()));
                else {
                    throw new InvalidArgumentException("Invalid direction");
                }
                break;
            case "category":
                if ($direction == "ASC")
                    return strcmp($this->category->getName(), $news->getCategory()->getName()) > 0;
                elseif ($direction == "DESC")
                    return !(strcmp($this->category->getName(), $news->getCategory()->getName()) > 0);
                else {
                    throw new InvalidArgumentException("Invalid direction");
                }
                break;
            default:
                throw new InvalidArgumentException("Invalid criterion for sorting");
        }
    }

    /**
     * @param News $news
     * @param $criterion
     * @param $direction
     *
     * @return boolean
     */
    public function gte(News $news, $criterion, $direction) : bool
    {
        switch ($criterion){
            case "date":
                if ($direction == "ASC")
                    return $this->date >= $news->getDate();
                elseif ($direction == "DESC")
                    return !($this->date >= $news->getDate());
                else {
                    throw new InvalidArgumentException("Invalid direction");
                }
                break;
            case "wordcount":
                if ($direction == "ASC")
                    return str_word_count($this->body) >= str_word_count($news->getBody());
                elseif ($direction =="DESC")
                    return !(str_word_count($this->body) >= str_word_count($news->getBody()));
                else {
                    throw new InvalidArgumentException("Invalid direction");
                }
                break;
            case "category":
                if ($direction == "ASC")
                    return strcmp($this->category->getName(), $news->getCategory()->getName()) >= 0;
                elseif ($direction == "DESC")
                    return !(strcmp($this->category->getName(), $news->getCategory()->getName()) >= 0);
                else {
                    throw new InvalidArgumentException("Invalid direction");
                }
                break;
            default:
                throw new InvalidArgumentException("Invalid criterion for sorting");
        }
    }
}
