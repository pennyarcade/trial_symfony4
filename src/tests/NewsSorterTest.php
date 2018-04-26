<?php
/**
 * Created by PhpStorm.
 * User: standard
 * Date: 4/26/18
 * Time: 4:32 PM
 */

namespace App\tests;

use App\Sorter\NewsSorter;
use App\Entity\News;
use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class NewsSorterTest extends TestCase
{

    /*
     * fixture
     */
    private $fixture;


    /**
     * @before
     */
    public function setup(){
        $data = [
            [
                'headline1',
                'A Body1',
                '2014-01-01 00:00:00',
                'Category 1'
            ],
            [
                'headline2',
                'H Body2 blah blah',
                '2016-01-01 00:00:00',
                'Category 2'
            ],
            [
                'headline3',
                'F Body2 blah blah noch länger',
                '2016-01-01 00:00:00',
                'Category 2'
            ]
        ];

        $this->fixture = array();

        foreach ($data=>$item) {
            $obj= new News();
            $obj->setHeadline($item[0]);
            $obj->setBody($item[1]);
            $obj->getDate(new \DateTime($item[2]));
            $cat= new Category();
            $cat->setName($item[3]);
            $obj->setCategory($cat);
            $this->fixture[] = $obj;
        }

    }

    /**
     * @after
     */
    public function teardown(){

    }

    /**
     * @beforeClass
     */
    public function beforeClass() {

    }

    /**
     * @afterClass
     */
    public function teardownClass() {

    }

    public function testCreate() {
        $SUT = new NewsSorter();

        self::assertInstanceOf('App\Sorter\NewsSorter', $SUT, "Not an instance of NewsSorter!");
    }


}