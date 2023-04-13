<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

#[AsCommand(
    name: 'app:import-spreadsheet',
    description: 'Import excel spreadsheet',
)]
class ImportSpreadsheetCommand extends Command
{
    protected function configure()
    {
        $this
            ->setHelp('This command allows you to import a spreadsheet')
            ->addArgument('file', InputArgument::OPTIONAL, 'Spreadsheet')
        ;   
    }
    
    protected function execute(InputInterface $input,
                               OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io -> title('Spreadsheet Importer');

        $inputFileName = $input->getArgument('file') ?: $io->ask('Spreadsheet: ');
        $spreadsheet = IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $headers = array_shift($rows);
        $io->table($headers, $rows);

        return Command::SUCCESS;
    } 
}
