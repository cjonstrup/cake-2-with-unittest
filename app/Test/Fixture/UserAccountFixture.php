<?php

class UserAccountFixture extends CakeTestFixture
{
    public $name = 'user_accounts';

    public $fields = array(
        'id'                        => array('type' => 'integer', 'key' => 'primary'),
        'name'                      => array('type' => 'string', 'length' => 255, 'null' => false)
    );

    public $records = array(
        array('id' => '1', 'name' => 'Carste Jonstrup'),
        array('id' => '2', 'name' => 'Ida Jonstrup'),
    );
}