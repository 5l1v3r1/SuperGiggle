<?php

/**
 * Util class for SuperGiggle
 *
 * PHP Version 7.3
 *
 * @category  PHP
 * @package   GT8
 * @author    girorme <rodrigogirorme@gmail.com>
 * @copyright 2020 Roger Sei
 * @license   //github.com/roger-sei/SuperGiggle/blob/master/LICENSE MIT
 * @version   Release: GIT: 0.1.0
 * @link      //github.com/roger-sei/SuperGiggle
 */

namespace SuperGiggle;

class Util
{

    /**
     * Os util
     *
     * @var Os
     */
    private $os;


    /**
     * Parse args and return in a friendly format
     *
     * @return array
     */
    public function parseArgs(): array
    {
        $alloweds = [
            'commit::',
            'help',
            'all::',
            'verbose::',
            'diff::',
            'file::',
            'php::',
            'php-version::',
            'phpcs::',
            'repo::',
            'standard::',
            'warnings::',
        ];

        $opt = getopt('', $alloweds);
        array_walk($opt, function (&$value) {
            $value = ($value === false) ? true : $value;
        });

        return $opt;
    }


    /**
     * Print help information, in cli format
     *
     * @return void
     */
    public function printUsage(): void
    {
        echo "  Usage: \033[0;35msuper-giggle [--commit]\033[0m\n\n";
        $options = [
            'standard' => 'The name or path of the coding standard to use',
            'diff'     => 'Validate changes on the current repository, between commits or branches',
            'all'      => 'Performs a full check and not only the changed lines',
            'repo'     => 'Indicates the git working directory. Defaults to current cwd',
            'phpcs'    => 'Indicates the php binary. Defaults to ENV',
            'type'     => 'The type of check. Defaults to "show" changes of a given commit. ',
            'help'     => 'Print this help',
            'verbose'  => 'Prints additional information',
            'warnings' => 'Also displays warnings',
        ];
        foreach ($options as $name => $description) {
            echo str_pad("\033[1;31m  --$name ", 22, ' ', STR_PAD_RIGHT) .
                "\033[1;37m" . $description . "\033[0m" . PHP_EOL;
        }

        echo PHP_EOL;

        exit(0);
    }


    /**
     * Get phpcs binary
     *
     * @return string
     */
    public function getPhpCsBinary(): string
    {
        $path = __DIR__ . '/../vendor/bin/phpcs';

        if ($this->os->isWindows() === true) {
            $path = str_replace('\\', '/', __DIR__ . '/../vendor/bin/phpcs.bat');
        }

        return $path;
    }


    /**
     * Set current operating system.
     *
     * @param Os $os Os class.
     *
     * @return void
     */
    public function setOs(Os $os): void
    {
        $this->os = $os;
    }


}
