<?php
    namespace Config\Command;

    use Symfony\Component\Console\Command\Command;
    use Symfony\Component\Console\Input\InputInterface;
    use Symfony\Component\Console\Output\OutputInterface;
    use Symfony\Component\Console\Input\InputArgument;
    use Illuminate\Support\Str;
    
    class GenerateMigrationCommand extends Command
    {
        // the name of the command (the part after "bin/console")
        protected static $defaultName = 'g:migration';

        public function __construct()
        {
            $this->migrationPath = dirname(dirname(__DIR__)) . "/app/database/migrations/";
            parent::__construct();
        }
    
        protected function configure()
        {
            $this 
                ->setDescription("A command used to create migration")
                ->setHelp("This command is used to create migration files")
                ->addArgument('migration', InputArgument::REQUIRED, 'migration file name');
        }
    
        protected function execute(InputInterface $input, OutputInterface $output)
        {
            $filename = Str::snake("Create".$input->getArgument("migration"));
            $actualFileName = date("Y_m_d_His").'_'.$filename.'.php';
            $file = $this->migrationPath.$actualFileName;
            // create the migration file
            touch($file);

            $className = Str::studly("Create".$input->getArgument("migration"));

            // get content of the migration stub
            $fileContent = \file_get_contents(__DIR__ . '/stubs/migration.stub');

            // replace all ClassName with className variable
            $fileContent = str_replace("ClassName", $className, $fileContent);
            
            // update the migration file
            file_put_contents($file, $fileContent);

            $output->writeln($actualFileName . ' generated successfully');
        }
    }