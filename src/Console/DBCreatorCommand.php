<?php namespace CristianJaramillo\Basic\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Config;
use DB;

class DBCreatorCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'basic:db';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Crea la base de datos de la aplicación';

	/**
	 * Database drive connection name 
	 *
	 * @var string
	 */
	protected $driver;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->driver = Config::get("database.default");

		parent::__construct();
	}

	/**
	 * Create a new connection
	 *
	 * @return void
	 */
	protected function createConnectionByName($connectionName, $options)
	{

		if ($options['database'] === '' || $options['database'] === NULL)
    	{
    		$database = $this->ask('What is name database? ');
    	} else {
    		$database = $options['database'];
    		$options['database'] = '';
    	}


		if ($options['password'] === true)
    	{
    		$options['password'] = $this->secret('What is the password? ');
    	} else {
    		$options['password'] = '';
    	}

		Config::set('database.connections.' . $connectionName,  $options);

		$this->createDataBase($connectionName, $options, $database);

	}

	/**
	 * Create a new databse
	 *
	 */
	public function createDataBase($connectionName, $options, $database)
	{
		switch ($options['driver']) {
			case 'sqlite':
				$this->info('Create database ' . $database);
			break;

			case 'mysql':
				$this->info(dd(DB::connection($connectionName)->statement('CREATE DATABASE IF NOT EXISTS ' . $database . ' CHARACTER SET ' . $options['charset'] . " COLLATE " . $options['collation'])));
			break;

			default:
				$this->error('Driver not support!');
			break;
		}
	}


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$connectionName = $this->option('connectionName');

		$options = $this->{"getOptions" . $this->option('driver')}($this->option());

		$this->createConnectionByName($connectionName, $options);

		var_dump(Config::get('database.connections.' . $connectionName ));
	}

	/**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
    	$arguments = [];

        return $arguments;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
    	$options = [];

		$options[] = [
    		'driver', null, InputOption::VALUE_OPTIONAL, 'Name of connection', $this->driver
    	];    	

    	$options[] = [
    		'connectionName', null, InputOption::VALUE_OPTIONAL, 'Name of connection', $this->driver
    	];

    	$options[] = [
    		'host', null, InputOption::VALUE_OPTIONAL, 'Name of host', Config::get('database.connections.' . $this->driver . '.host')
    	];

    	$options[] = [
    		'database', null, InputOption::VALUE_OPTIONAL, 'Name of database', Config::get('database.connections.' . $this->driver . '.database')
    	];

    	$options[] = [
    		'username', null, InputOption::VALUE_OPTIONAL, 'Name of username', Config::get('database.connections.' . $this->driver . '.username')
    	];

    	$options[] = [
    		'password', null, InputOption::VALUE_NONE, 'Name of password',
    	];

    	$options[] = [
    		'charset', null, InputOption::VALUE_OPTIONAL, 'Name of charset', Config::get('database.connections.' . $this->driver . '.charset')
    	];

    	$options[] = [
    		'collation', null, InputOption::VALUE_OPTIONAL, 'Name of collation', Config::get('database.connections.' . $this->driver . '.collation')
    	];

    	$options[] = [
    		'prefix', null, InputOption::VALUE_OPTIONAL, 'Prefix of prefix', Config::get('database.connections.' . $this->driver . '.prefix')
    	];

    	$options[] = [
    		'schema', null, InputOption::VALUE_OPTIONAL, 'Prefix of schema', Config::get('database.connections.' . $this->driver . '.schema')
    	];

        return $options;
    }

    protected function getOptionsSqlite($options)
    {
    	return array_only($options, ['driver', 'database', 'prefix']);
    }

    protected function getOptionsMysql($options)
    {
    	return array_only($options, ['driver', 'host', 'database', 'username', 'password', 'charset', 'collation', 'prefix']);
    }

    protected function getOptionsPgsql($options)
    {
 		return array_only($options, ['driver', 'host', 'database', 'username', 'password', 'charset', 'prefix', 'schema']);
    }
    protected function getOptionsSqlsrv($options)
    {
    	return array_only($options, ['driver', 'host', 'database', 'username', 'password', 'prefix']);
    }

}
