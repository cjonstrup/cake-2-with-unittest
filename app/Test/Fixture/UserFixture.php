<?php

class UserFixture extends CakeTestFixture
{
    public $name = 'users';

    public $fields = array(
        'id'                        => array('type' => 'integer', 'key' => 'primary'),
        'name'                      => array('type' => 'string', 'length' => 255, 'null' => false)
    );

    public $records = array(
        array('id' => '1', 'name' => 'Carste Jonstrup'),
        array('id' => '2', 'name' => 'Ida Jonstrup'),
    );
}