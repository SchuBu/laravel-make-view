<?php

namespace SchuBu\MakeView\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeViewCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new resourceful blade view files';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Blade';
    protected $templateFile = 'app';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $publishedStubs = app_path('Vendor'. DIRECTORY_SEPARATOR .'SchuBu'. DIRECTORY_SEPARATOR .'make-view'. DIRECTORY_SEPARATOR .'stubs'. DIRECTORY_SEPARATOR .$this->templateFile . '.stub');
        $nonPublishedStubs = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $this->templateFile . '.stub';
        return file_exists($publishedStubs) ? $publishedStubs : $nonPublishedStubs;
    }

    /**
     * Build the files with the given name.
     *
     * @param string $name
     * @param string $file
     * @return string
     */
    protected function buildFile($name,$file)
    {

        return str_replace(
            [
                '##TITLE##',
            ],
            [
                basename($file),
            ],
            parent::buildClass($name)
        );
    }

    protected function checkForTemplateFile()
    {
        $template = $this->option('template') ?? 'app';

        if($this->files->exists($this->getStub())) {
            return $this->templateFile = $template;
        } else {
            $this->error('Template "'.$this->option('template').'" does not exist!');
            return false;
        }
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return array
     */
    protected function getPath($name)
    {
        $name = str_replace(
            ['\\', '/', '.'], DIRECTORY_SEPARATOR, strtolower($this->argument('name'))
        );

        $base = $this->laravel->resourcePath() . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $name;

        return [
            $base . DIRECTORY_SEPARATOR . "index.blade.php",
            $base . DIRECTORY_SEPARATOR . "show.blade.php",
            $base . DIRECTORY_SEPARATOR . "create.blade.php",
            $base . DIRECTORY_SEPARATOR . "edit.blade.php",
        ];
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if(!$this->checkForTemplateFile()) return false;

        $name = $this->qualifyClass($this->getNameInput());

        $files = $this->getPath($name);

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
//        if ((!$this->hasOption('force') || !$this->option('force')) && $this->alreadyExists($files[0])) {
//            $this->error($this->type . ' already exists!');
//            return false;
//        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($files[0]);


        foreach ($files as $file) {
            if ((!$this->hasOption('force') || !$this->option('force')) && $this->files->exists($file)) {
                $this->error(basename($file) . ' already exists!');
            } else {
                $this->files->put($file, $this->buildFile($name,$file));
                $this->info(basename($file)  . ' created successfully.');
            }
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the views even if they are already existing'],
            ['template', 't', InputOption::VALUE_OPTIONAL, 'Select a different template (e.q. frontend, backend, etc.)'],
        ];
    }
}
