<?php
App::uses('CakeFixtureManager', 'TestSuite/Fixture');
App::uses('CakeTestFixture', 'TestSuite/Fixture');

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;

/**
 * Class CakeTestCase
 */
abstract class CakeTestCase extends TestCase
{
}

/**
 * Class AppTestCase
 */
class AppTestCase extends CakeTestCase
{
    /**
     * The is class responsible for managing the creation, loading and removing of fixtures
     *
     * @var CakeFixtureManager
     */
    public $fixtureManager = null;

    /**
     * By default, all fixtures attached to this class will be truncated and reloaded after each test.
     * Set this to false to handle manually
     *
     * @var array
     */
    public $autoFixtures = true;

    /**
     * Control table create/drops on each test method.
     *
     * Set this to false to avoid tables to be dropped if they already exist
     * between each test method. Tables will still be dropped at the
     * end of each test runner execution.
     *
     * @var bool
     */
    public $dropTables = true;

    /**
     * Configure values to restore at end of test.
     *
     * @var array
     */
    protected $_configure = array();

    /**
     * Path settings to restore at the end of the test.
     *
     * @var array
     */
    protected $_pathRestore = array();

    /**
     * @inheritdoc
     */
    public function run(TestResult $result = null): TestResult
    {
        $this->setUpFixtureManagerForPhpunitCommand();

        $level = ob_get_level();

        if (!empty($this->fixtureManager)) {
            $this->fixtureManager->load($this);
        }
        $result = parent::run($result);

        if (!empty($this->fixtureManager)) {
            $this->fixtureManager->unload($this);
            unset($this->fixtureManager, $this->db);
        }

        for ($i = ob_get_level(); $i < $level; ++$i) {
            ob_start();
        }

        return $result;
    }

    /**
     * When executed from the phpunit command, since FixtureManager is not prepared, it can be prepared with TestCase::run()
     */
    private function setUpFixtureManagerForPhpunitCommand()
    {
        if (is_null($this->fixtureManager)) {
            App::uses('CakeFixtureManager', 'TestSuite/Fixture');

            $this->fixtureManager = new CakeFixtureManager();
            $this->fixtureManager->fixturize($this);
        }
    }

    /**
     * @inheritdoc
     */
    public function setUp() :void
    {
        parent::setUp();

        if (empty($this->_configure)) {
            $this->_configure = Configure::read();
        }

        if (empty($this->_pathRestore)) {
            $this->_pathRestore = App::paths();
        }

        if (class_exists('Router', false)) {
            Router::reload();
        }
    }

    /**
     * @inheritdoc
     */
    public function tearDown()  :void
    {
        parent::tearDown();

        App::build($this->_pathRestore, App::RESET);

        if (class_exists('ClassRegistry', false)) {
            ClassRegistry::flush();
        }

        if (!empty($this->_configure)) {
            Configure::clear();
            Configure::write($this->_configure);
        }

        if (isset($_GET['debug']) && $_GET['debug']) {
            ob_flush();
        }
        unset($this->_configure, $this->_pathRestore);
    }

    /**
     * Load fixtures
     *
     * @throws Exception
     */
    public function loadFixtures()
    {
        if (empty($this->fixtureManager)) {
            throw new Exception(__d('cake_dev', 'No fixture manager to load the test fixture'));
        }
        $args = func_get_args();

        foreach ($args as $class) {
            $this->fixtureManager->loadSingle($class, null, $this->dropTables);
        }
    }
}
