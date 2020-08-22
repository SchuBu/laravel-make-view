<?php

namespace SchuBu\MakeView\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeModelCommand extends ModelMakeCommand
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }

    public function handle()
    {
        parent::handle();

        if ($this->option('blade')) {
            $this->call('make:blade', [
                'name' => strtolower($this->argument('name')),
                '--force' => $this->option('force')
            ]);
        }
    }

    protected function getOptions()
    {
        $opt = parent::getOptions();
        array_push($opt, ['blade', 'b', InputOption::VALUE_NONE, 'Create resourceful blade-files']);
        array_push($opt, ['template', 't', InputOption::VALUE_OPTIONAL, 'Select a different template (e.q. frontend, backend, etc.)']);
        return $opt;
    }
}
