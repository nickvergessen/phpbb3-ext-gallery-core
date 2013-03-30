<?php
/**
*
* @package phpBB Gallery Testing
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
require_once dirname(__FILE__) . '/../vendor/phpBB3/phpBB/includes/db/db_tools.php';

abstract class phpbb_ext_gallery_database_test_case extends phpbb_database_test_case
{
	protected $db;

	public function setUp()
	{
		parent::setUp();

		$this->db = $this->new_dbal();

		global $phpbb_root_path, $phpEx;

		$config = new phpbb_config(array());
		$db_tools = new phpbb_db_tools($this->db);
		$table_prefix = 'phpbb_';

		$migrator = new phpbb_db_migrator($config, $this->db, $db_tools, 'phpbb_migrations', $phpbb_root_path, $phpEx, $table_prefix, array());

		$phpbb_extension_manager =  new phpbb_extension_manager(new phpbb_mock_container_builder(), $this->db, $config, $migrator, 'phpbb_ext', dirname(__FILE__) . '/', '.' . $phpEx, null);
		$phpbb_extension_manager->enable('gallery/core');
	}

	protected function create_connection_manager($config)
	{
		return new phpbb_ext_gallery_database_test_connection_manager($config);
	}

	public function get_database_config()
	{
		$config = phpbb_ext_gallery_test_case_helpers::get_test_config();

		if (!isset($config['dbms']))
		{
			$this->markTestSkipped('Missing test_config.php: See first error.');
		}

		return $config;
	}

	public function get_test_case_helpers()
	{
		if (!$this->test_case_helpers)
		{
			$this->test_case_helpers = new phpbb_ext_gallery_test_case_helpers($this);
		}

		return $this->test_case_helpers;
	}
}
