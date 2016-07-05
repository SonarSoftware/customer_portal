<?php

namespace SonarSoftware\CustomerPortal;

use Exception;
use League\CLImate\CLImate;
use RuntimeException;

class CustomerPortalInstaller
{
    private $logFile;
    private $fileDirectory;
    private $climate;

    /**
     * CustomerPortalInstaller constructor.
     */
    public function __construct()
    {
        $this->fileDirectory = "'" . dirname(__FILE__) . "/..'";
        $this->logFile = tempnam($this->fileDirectory,"error_log");
        $this->climate = new CLImate;
    }

    /**
     * Install the customer portal.
     */
    public function install()
    {
        $user = trim(shell_exec("whoami"));
        if ($user != "root")
        {
            $this->climate->shout("Please run this script as root");
            return;
        }

        $this->climate->bold()->info("Installing Sonar customer portal.");

        try
        {
            $this->installAndConfigureApache();
            $this->installRedis();
            $this->setupLaravel();
        }
        catch (RuntimeException $e)
        {
            $this->climate->shout("FAILED!");
            $this->climate->shout("See {$this->logFile} for failure details.");
            return;
        }

        $this->climate->bold()->info("Installation complete.");

    }

    /**
     * Execute a command or return the output failures.
     * @param $command
     */
    public function executeCommand($command)
    {
        exec($command . " 1> /dev/null 2> {$this->logFile}", $output, $returnVar);
        if ($returnVar !== 0)
        {
            throw new RuntimeException(implode(",",$output));
        }
    }

    /**
     * Install Apache and configure the necessary modules.
     */
    private function installAndConfigureApache()
    {
        $this->climate->info()->inline("Installing Apache... ");
        $this->executeCommand("apt-get -y install apache2 libapache2-mod-fastcgi");
        $this->climate->info("Success!");
        $this->climate->info()->inline("Configuring Apache... ");

        try
        {
            $this->executeCommand("/usr/sbin/a2enmod rewrite");
            $this->executeCommand("/usr/sbin/a2enmod ssl");
            $this->executeCommand("/usr/sbin/a2enmod headers");
            $this->executeCommand("/usr/sbin/a2enmod actions fastcgi");
            $this->executeCommand("/usr/sbin/a2dismod mpm_prefork php5");
        }
        catch (RuntimeException $e)
        {
            //Some of these may already be enabled or disabled.
        }

        $this->executeCommand("/bin/rm -rf /etc/apache2/conf-enabled/php7-fpm.conf");
        $this->executeCommand("/bin/cp {$this->fileDirectory}/conf/php7-fpm.conf /etc/apache2/conf-available/");
        $this->executeCommand("/usr/sbin/a2enconf php7-fpm");
        $this->executeCommand("/bin/rm -rf /etc/apache2/sites-available/000-default.conf");
        $this->executeCommand("/bin/cp {$this->fileDirectory}/conf/000-default.conf /etc/apache2/sites-available/");
        $this->executeCommand("/bin/rm -rf /etc/apache2/apache2.conf");
        $this->executeCommand("/bin/cp {$this->fileDirectory}/conf/apache2.conf /etc/apache2/");
        $this->executeCommand("/bin/cp {$this->fileDirectory}/conf/security /etc/apache2/conf-available/");

        $this->executeCommand("/bin/rm -rf /etc/apache2/ssl");
        $this->executeCommand("/bin/mkdir /etc/apache2/ssl");
        $this->executeCommand("/bin/cp {$this->fileDirectory}/conf/ssl/* /etc/apache2/ssl/");

        $this->executeCommand("/bin/chgrp www-data /etc/apache2/sites-enabled");
        $this->executeCommand("/bin/chmod 774 /etc/apache2/sites-enabled");
        $this->executeCommand("/usr/sbin/service apache2 restart");

        $this->climate->info("Success!");
    }

    /**
     * Install Redis as a session store/cache
     */
    private function installRedis()
    {
        $this->climate->info()->inline("Installing redis... ");
        $this->executeCommand("apt-get -y install redis-server");
        $this->climate->info("Success!");
    }

    /**
     * Perform initial Laravel setup
     */
    private function setupLaravel()
    {
        $this->climate->info()->inline("Configuring customer portal... ");
        if (!file_exists("/usr/share/portal"))
        {
            $this->executeCommand("/bin/mkdir /usr/share/portal");
        }
        else
        {
            throw new RuntimeException("/usr/share/portal already exists - please remove it manually before installing (rm -rf /usr/share/portal)");
        }
        $this->executeCommand("/bin/cp -R {$this->fileDirectory}/portal/. /usr/share/portal/");
        #Setup permissions
        $this->executeCommand("/bin/chown -R www-data:www-data /usr/share/portal");
        $this->executeCommand("/bin/touch /usr/share/portal/storage/logs/laravel.log");
        $this->executeCommand("/bin/chown www-data:www-data /usr/share/portal/storage/logs/laravel.log");
        $this->executeCommand("/bin/chmod 777 /usr/share/portal/storage/logs/laravel.log");
        #Run Laravel basic setup
        $this->executeCommand("/usr/bin/touch /usr/share/portal/storage/database.sqlite");
        $this->executeCommand("/bin/mv /usr/share/portal/.env.example /usr/share/portal/.env");
        $this->executeCommand("/usr/bin/php /usr/share/portal/artisan key:generate");
        $this->executeCommand("/usr/bin/php /usr/share/portal/artisan migrate --force");
        $this->executeCommand("/usr/bin/php /usr/share/portal/artisan route:cache");
        #Add the scheduler
        $this->executeCommand("/bin/cp {$this->fileDirectory}/sonar_scheduler /etc/cron.d/");
        $this->executeCommand("/bin/chmod 644 /etc/cron.d/sonar_scheduler");
        $this->executeCommand("/usr/sbin/service cron restart");
        $this->climate->info("Success!");
    }
}