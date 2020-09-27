<?php
App::uses('SqliteTestCase', 'Test');
App::uses('ClassRegistry', 'Utility');

/**
 * Class UserTest
 *
 * Run this test by using below command
 *
 * cd website/app
 * Console/cake test app Model/User
 *
 * @property User $User
 */
class UserTest extends SqliteTestCase
{

    /** @test */
    public function it_can_check_online()
    {
        $this->assertTrue(ClassRegistry::init('User')->getOnline());
    }

        /** @test */
        public function it_can_count_numbers_of_users()
        {
            $this->assertCount(2, ClassRegistry::init('User')->find('all'));
        }
}