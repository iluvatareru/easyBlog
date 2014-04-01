<?php

namespace Classes\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SymfonyCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('blog:generate');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $this->getHelperSet()->get('table');
        $table
            ->setHeaders(array('Description'))
            ->setRows(array(
                array('Enter an entry'),
                array('Enter the title'),
                array('Enter the headline'),
                array('Exit'),
            ))
        ;
        $table->render($output);

        $dialog = $this->getHelperSet()->get('dialog');

        $options = array('Enter an entry', 'Enter the title', 'Enter the headline', 'Exit');

        $selectedOption = $dialog->ask(
            $output,
            'Please writing what you want to do: ',
            'Enter an entry',
            $options
        );
    }
}