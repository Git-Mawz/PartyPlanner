<?php

namespace App\Command;

use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:Load-Db',
    description: 'load L2 jobs in database',
)]
class LoadDbCommand extends Command
{


    private $em;
    private $L2Classes;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->L2Classes = [
            'Gladiator',
            'Warlord',
            'Paladin',
            'DarkAvenger',
            'TreasureHunter',
            'Hawkeye',
            'Sorcerer',
            'Necromancer',
            'Warlock',
            'Bishop',
            'Prophet',
            'TempleKnight',
            'SwordSinger',
            'PlainsWalker',
            'SilverRanger',
            'SpellSinger',
            'ElementalSummoner',
            'ElvenElder',
            'ShillenKnight',
            'BladeDancer',
            'AbyssWalker',
            'PhantomRanger',
            'SpellHowler',
            'PhantomSummoner',
            'ShillenElder',
            'Destroyer',
            'Tyrant',
            'Overlord',
            'Warcryer',
            'BountyHunter',
            'Warsmith'
        ];

        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }


        // Load L2 Classes
        foreach ($this->L2Classes as $job) {
            $newJob = new Job();
            $newJob->setName($job);
            $this->em->persist($newJob);
            
        }

        $this->em->flush();


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
