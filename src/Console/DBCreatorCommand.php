<?php namesapce CristianJaramillo\Basic\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

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
	protected $description = 'Crea la base de datos del sistema junto con sus migraciones.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->info($this->argument('databaseName'));
	}

	/**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['databaseName', InputArgument::OPTIONAL, 'El nombre de la base de datos es requerido.', 'seminuevos']
        ];
    }

}
