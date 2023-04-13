<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:artist:create',
    description: 'Maak een artiest',
)]
class CreateArtistCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('naam', InputArgument::OPTIONAL, 'The username of the user.')
            ->addArgument('genre', InputArgument::OPTIONAL, 'the music genre of the artist')
            ->addArgument('omschrijving', InputArgument::OPTIONAL)
            ->addArgument('afbeelding_url', InputArgument::OPTIONAL)
            ->addArgument('website', InputArgument::OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Artist Creater');

        $naam = $input->getArgument('naam') ?: $io->ask('Naam: ');
        $genre = $input->getArgument('genre') ?: $io->ask('Genre: ');
        $omschrijving = $input->getArgument('omschrijving') ?: $io->ask('Omschrijving: ');
        $afbeelding_url = $input->getArgument('afbeelding_url') ?: $io->ask('Afbeelding URL: ');
        $website = $input->getArgument('website') ?: $io->ask('Website: ');


        $io->writeln('Naam: ' .$naam);
        $io->writeln('Genre: ' .$genre);
        $io->writeln('Omschrijving: ' .$omschrijving);
        $io->writeln('Afbeelding URL: ' .$afbeelding_url);
        $io->writeln('Website: ' .$website);

        return Command::SUCCESS;
    }
}
