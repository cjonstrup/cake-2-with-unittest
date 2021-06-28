<?php
App::uses('SqliteTestCase', 'Test');
App::uses('ClassRegistry', 'Utility');

/**
 * Class UserTest
 */
class UserTest extends SqliteTestCase
{
    /** @test */
    public function it_can_count_numbers_of_users()
    {
        $this->assertCount(2, ClassRegistry::init(User::class)->find('all'));
    }

    /** @test */
    public function it_can_get_customer_number()
    {
        $this->assertEquals('Unit1', ClassRegistry::init(User::class)->getCustomerNo(1));
        $this->assertEquals('Unit20', ClassRegistry::init(User::class)->getCustomerNo(10));
    }
}
