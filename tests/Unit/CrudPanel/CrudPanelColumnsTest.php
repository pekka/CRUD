<?php

namespace Backpack\CRUD\Tests\Unit\CrudPanel;

use Backpack\CRUD\Tests\Unit\Models\Article;
use Backpack\CRUD\Tests\Unit\Models\User;

class CrudPanelColumnsTest extends BaseDBCrudPanelTest
{
    private $oneColumnArray = [
        'name'  => 'column1',
        'label' => 'Column1',
    ];

    private $expectedOneColumnArray = [
        'column1' => [
            'label'       => 'Column1',
            'name'        => 'column1',
            'key'         => 'column1',
            'type'        => 'text',
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
            'priority'    => 0,
        ],
    ];

    private $otherOneColumnArray = [
        'name'  => 'column4',
        'label' => 'Column4',
    ];

    private $twoColumnsArray = [
        [
            'name'  => 'column1',
            'label' => 'Column1',
        ],
        [
            'name'  => 'column2',
            'label' => 'Column2',
        ],
    ];

    private $expectedTwoColumnsArray = [
        'column1' => [
            'name'        => 'column1',
            'key'         => 'column1',
            'label'       => 'Column1',
            'type'        => 'text',
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
            'priority'    => 0,

        ],
        'column2' => [
            'name'        => 'column2',
            'key'         => 'column2',
            'label'       => 'Column2',
            'type'        => 'text',
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
            'priority'    => 1,
        ],
    ];

    private $threeColumnsArray = [
        [
            'name'  => 'column1',
            'label' => 'Column1',
        ],
        [
            'name'  => 'column2',
            'label' => 'Column2',
        ],
        [
            'name'  => 'column3',
            'label' => 'Column3',
        ],
    ];

    private $expectedThreeColumnsArray = [
        'column1' => [
            'name'        => 'column1',
            'key'         => 'column1',
            'label'       => 'Column1',
            'type'        => 'text',
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
            'priority'    => 0,
        ],
        'column2' => [
            'name'        => 'column2',
            'key'         => 'column2',
            'label'       => 'Column2',
            'type'        => 'text',
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
            'priority'    => 1,
        ],
        'column3' => [
            'name'        => 'column3',
            'key'         => 'column3',
            'label'       => 'Column3',
            'type'        => 'text',
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
            'priority'    => 2,
        ],
    ];

    private $expectedRelationColumnsArray = [
        'accountDetails' => [
            'name'        => 'accountDetails',
            'label'       => 'AccountDetails',
            'type'        => 'relationship',
            'key'         => 'accountDetails',
            'priority'    => 0,
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
            'entity'      => 'accountDetails',
            'model'       => 'Backpack\CRUD\Tests\Unit\Models\AccountDetails',
        ],
        'accountDetails__nickname' => [
            'name'        => 'accountDetails.nickname',
            'label'       => 'AccountDetails.nickname',
            'type'        => 'text',
            'key'         => 'accountDetails__nickname',
            'priority'    => 1,
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
        ],
        'accountDetails__user' => [
            'name'        => 'accountDetails.user',
            'label'       => 'AccountDetails.user',
            'type'        => 'text',
            'key'         => 'accountDetails__user',
            'priority'    => 2,
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
        ],
    ];

    private $relationColumnArray = [
        'name'      => 'nickname',
        'type'      => 'select',
        'entity'    => 'accountDetails',
        'attribute' => 'nickname',
    ];

    private $expectedRelationColumnArray = [
        'nickname' => [
            'name'        => 'nickname',
            'type'        => 'select',
            'entity'      => 'accountDetails',
            'attribute'   => 'nickname',
            'label'       => 'Nickname',
            'model'       => 'Backpack\CRUD\Tests\Unit\Models\AccountDetails',
            'key'         => 'nickname',
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
            'priority'    => 0,
        ],
    ];

    private $nestedRelationColumnArray = [
        'name'      => 'nickname',
        'type'      => 'select',
        'entity'    => 'user.accountDetails',
        'attribute' => 'nickname',
    ];

    private $expectedNestedRelationColumnArray = [
        'nickname' => [
            'name'        => 'nickname',
            'type'        => 'select',
            'entity'      => 'user.accountDetails',
            'attribute'   => 'nickname',
            'label'       => 'Nickname',
            'model'       => 'Backpack\CRUD\Tests\Unit\Models\AccountDetails',
            'key'         => 'nickname',
            'tableColumn' => false,
            'orderable'   => false,
            'searchLogic' => false,
            'priority'    => 0,
        ],
    ];

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->crudPanel->setOperation('list');
    }

    public function testAddColumnByName()
    {
        $this->crudPanel->addColumn('column1');

        $this->assertEquals($this->expectedOneColumnArray, $this->crudPanel->columns());
    }

    public function testAddColumnsByName()
    {
        $this->crudPanel->addColumns(['column1', 'column2']);

        $this->assertEquals(2, count($this->crudPanel->columns()));
        $this->assertEquals($this->expectedTwoColumnsArray, $this->crudPanel->columns());
    }

    public function testAddColumnAsArray()
    {
        $this->crudPanel->addColumn($this->oneColumnArray);

        $this->assertEquals($this->expectedOneColumnArray, $this->crudPanel->columns());
    }

    public function testAddColumnsAsArray()
    {
        $this->crudPanel->addColumns($this->twoColumnsArray);

        $this->assertEquals(2, count($this->crudPanel->columns()));
        $this->assertEquals($this->expectedTwoColumnsArray, $this->crudPanel->columns());
    }

    public function testAddColumnNotArray()
    {
        $this->expectException(\ErrorException::class);

        $this->crudPanel->addColumns('column1');
    }

    public function testAddRelationsByName()
    {
        $this->crudPanel->setModel(User::class);
        $this->crudPanel->addColumn('accountDetails');
        $this->crudPanel->addColumn('accountDetails.nickname');
        $this->crudPanel->addColumn('accountDetails.user');

        $this->assertEquals($this->expectedRelationColumnsArray, $this->crudPanel->columns());
    }

    public function testAddRelationColumn()
    {
        $this->crudPanel->setModel(User::class);
        $this->crudPanel->addColumn($this->relationColumnArray);

        $this->assertEquals($this->expectedRelationColumnArray, $this->crudPanel->columns());
    }

    public function testAddNestedRelationColumn()
    {
        $this->crudPanel->setModel(Article::class);
        $this->crudPanel->addColumn($this->nestedRelationColumnArray);

        $this->assertEquals($this->expectedNestedRelationColumnArray, $this->crudPanel->columns());
    }

    public function testMoveColumnBefore()
    {
        $this->crudPanel->addColumns($this->twoColumnsArray);

        $this->crudPanel->beforeColumn('column1');

        $keys = array_keys($this->crudPanel->columns());
        $this->assertEquals($this->expectedTwoColumnsArray['column2'], $this->crudPanel->columns()[$keys[0]]);
        $this->assertEquals(['column2', 'column1'], $keys);
    }

    public function testMoveColumnBeforeUnknownColumnName()
    {
        $this->crudPanel->addColumns($this->twoColumnsArray);

        $this->crudPanel->beforeColumn('column3');

        $this->assertEquals(array_keys($this->expectedTwoColumnsArray), array_keys($this->crudPanel->columns()));
    }

    public function testMoveColumnAfter()
    {
        $this->crudPanel->addColumns($this->threeColumnsArray);

        $this->crudPanel->afterColumn('column1');

        $keys = array_keys($this->crudPanel->columns());
        $this->assertEquals($this->expectedThreeColumnsArray['column3'], $this->crudPanel->columns()[$keys[1]]);
        $this->assertEquals(['column1', 'column3', 'column2'], $keys);
    }

    public function testMoveColumnAfterUnknownColumnName()
    {
        $this->crudPanel->addColumns($this->twoColumnsArray);

        $this->crudPanel->afterColumn('column3');

        $this->assertEquals(array_keys($this->expectedTwoColumnsArray), array_keys($this->crudPanel->columns()));
    }

    public function testRemoveColumnByName()
    {
        $this->crudPanel->addColumns(['column1', 'column2', 'column3']);

        $this->crudPanel->removeColumn('column1');

        $this->assertEquals(2, count($this->crudPanel->columns()));
        $this->assertEquals(['column2', 'column3'], array_keys($this->crudPanel->columns()));
        $this->assertNotContains($this->oneColumnArray, $this->crudPanel->columns());
    }

    public function testRemoveUnknownColumnName()
    {
        $unknownColumnName = 'column4';
        $this->crudPanel->addColumns(['column1', 'column2', 'column3']);

        $this->crudPanel->removeColumn($unknownColumnName);

        $this->assertEquals(3, count($this->crudPanel->columns()));
        $this->assertEquals(['column1', 'column2', 'column3'], array_keys($this->crudPanel->columns()));
        $this->assertNotContains($this->otherOneColumnArray, $this->crudPanel->columns());
    }

    public function testRemoveColumnsByName()
    {
        $this->crudPanel->addColumns(['column1', 'column2', 'column3']);

        $this->crudPanel->removeColumns($this->twoColumnsArray);

        $this->assertEquals(1, count($this->crudPanel->columns()));
        $this->assertEquals(['column3'], array_keys($this->crudPanel->columns()));
        $this->assertNotEquals($this->expectedThreeColumnsArray, $this->crudPanel->columns());
    }

    public function testRemoveUnknownColumnsByName()
    {
        $unknownColumnNames = ['column4', 'column5'];
        $this->crudPanel->addColumns(['column1', 'column2', 'column3']);

        $this->crudPanel->removeColumns($unknownColumnNames);

        $this->assertEquals(3, count($this->crudPanel->columns()));
        $this->assertEquals(['column1', 'column2', 'column3'], array_keys($this->crudPanel->columns()));
        $this->assertNotContains($this->otherOneColumnArray, $this->crudPanel->columns());
    }

    public function testSetColumnDetails()
    {
        $this->markTestIncomplete('Not correctly implemented');

        // TODO: refactor crud panel sync method
    }

    public function testSetColumnsDetails()
    {
        $this->markTestIncomplete('Not correctly implemented');

        // TODO: refactor crud panel sync method
    }

    public function testOrderColumns()
    {
        $this->crudPanel->addColumns($this->threeColumnsArray);

        $this->crudPanel->orderColumns(['column2', 'column1', 'column3']);

        $this->assertEquals(['column2', 'column1', 'column3'], array_keys($this->crudPanel->columns()));
    }

    public function testOrderColumnsIncompleteList()
    {
        $this->crudPanel->addColumns($this->threeColumnsArray);

        $this->crudPanel->orderColumns(['column2', 'column3']);

        $this->assertEquals(['column2', 'column3', 'column1'], array_keys($this->crudPanel->columns()));
    }

    public function testOrderColumnsEmptyList()
    {
        $this->crudPanel->addColumns($this->threeColumnsArray);

        $this->crudPanel->orderColumns([]);

        $this->assertEquals($this->expectedThreeColumnsArray, $this->crudPanel->columns());
    }

    public function testOrderColumnsUnknownList()
    {
        $this->crudPanel->addColumns($this->threeColumnsArray);

        $this->crudPanel->orderColumns(['column4', 'column5', 'column6']);

        $this->assertEquals($this->expectedThreeColumnsArray, $this->crudPanel->columns());
    }

    public function testOrderColumnsMixedList()
    {
        $this->crudPanel->addColumns($this->threeColumnsArray);

        $this->crudPanel->orderColumns(['column2', 'column5', 'column6']);

        $this->assertEquals(['column2', 'column1', 'column3'], array_keys($this->crudPanel->columns()));
    }
}
