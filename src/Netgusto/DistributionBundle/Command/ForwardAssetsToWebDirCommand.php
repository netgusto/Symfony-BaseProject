<?php

namespace Netgusto\DistributionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class ForwardAssetsToWebDirCommand extends ContainerAwareCommand {
    
    protected function configure() {
        $this
            ->setName('ng:assets:forward')
            ->setDescription('Forward asset packages to web dir.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        
        $filesystem = $this->getContainer()->get('filesystem');

        $config = $this->getContainer()->getParameter('netgusto_distribution.assets_forwarding');
        $destDir = rtrim($config['dest_dir'], '/');
        
        if(!is_dir($destDir)) {
            # Before realpath, as realpath expects the folder to exist
            $filesystem->mkdir($destDir, 0777);
        }

        $destDir = realpath($destDir) . '/';

        if(!is_dir($destDir)) {
            die($destDir);
            $filesystem->mkdir($destDir, 0777);
            die($destDir);
        }

        if(count($config['packages']) === 0) {
            $output->writeln('<comment>No package to forward was defined.</comment>');
            return;
        }

        $output->writeln('<info>Forwarding assets</info>');
        foreach($config['packages'] as $packagename) {

            $originDir = realpath($config['src_dir']) . '/' . $packagename;
            if(!is_dir($originDir)) {
                $output->writeln('<error>Package "' . $packagename . '" was not found ("' . $originDir . '")</error>');
                return;
            }

            $targetDir = $destDir . $packagename;
            $filesystem->remove($targetDir);
            $filesystem->mkdir($targetDir, 0777);
            // We use a custom iterator to ignore VCS files
            $filesystem->mirror($originDir, $targetDir, Finder::create()->ignoreDotFiles(false)->in($originDir));

            $output->writeln('<info>Package "' . $packagename . '" assets have been forwarded to web dir.</info>');
        }
    }
}