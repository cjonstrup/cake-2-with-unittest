<?php
App::uses('SqliteTestCase', 'Test');
App::uses('ClassRegistry', 'Utility');

/**
 * Class UserAccountTest
 */
class UserAccountTest extends SqliteTestCase
{
    /** @test */
    public function it_can_count_numbers_of_users()
    {
        $this->assertEquals(2, ClassRegistry::init('UserAccount')->find('count'));
    }
}