<?php
App::uses('BaseTestCase', 'Test');

/**
 * Class BaseTestCase
 *
 * @property  DataSource dataSource
 */
abstract class SqliteTestCase extends BaseTestCase
{
    /**
     * @var array
     */
    public $fixtures = [
        'app.user',
        'app.user_account',
    ];

    /** @inheritdoc */
    public function setUp(): void
    {

        // when running in GitLab CI cache is not available
        Configure::write('Cache.disable', true);

        parent::setUp();
    }
}