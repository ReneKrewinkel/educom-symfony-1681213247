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
use App\Repository\PoppodiumRepository;


#[AsCommand(
    name: 'app:import-spreadsheet',
    description: 'Import excel spreadsheet',
)]
class ImportSpreadsheetCommand extends Command{

    private $poppodiumRepository;

    public function __construct(PoppodiumRepository $poppodiumRepository)
    {
        parent::__construct();

        $this->poppodiumRepository = $poppodiumRepository;
    }



    protected function configure()
    {
        $this
            ->setHelp('This command allows you to import a spreadsheet')
            ->addArgument('file', InputArgument::OPTIONAL, 'Spreadsheet')
        ;   
    }
    
    protected function execute(InputInterface $input,
                               OutputInterface $output,)
    {
        $io = new SymfonyStyle($input, $output);
        $io -> title('Spreadsheet Importer');

        $inputFileName = $input->getArgument('file') ?: $io->ask('Spreadsheet path');
        $spreadsheet = IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        
        $headers = array_shift($rows);
        $io->table($headers, $rows);

        foreach($rows as $row) {
            $podium = [
                "naam" => ($row[0]),
                "adres" => ($row[1]),
                "postcode" => ($row[2]),
                "woonplaats" => ($row[3]),
                "telefoonnummer" => ($row[4]),
                "email" => ($row[5]),
                "website" => ($row[6]),
                "logo_url" => ($row[7]),
                "afbeelding_url" => ($row[8])
               ];
            
            $this->poppodiumRepository->savePodium($podium);
        }

        

        return Command::SUCCESS;
    } 
}
