#!/bin/bash
echo -n "Checking OS version..."
if grep -Fxq "stretch/sid" /etc/debian_version
    then
        echo -e "\e[1;32mSUCCESS\e[0m"
        echo -n "Installing PHP... "
        apt-get --purge -y autoremove > /dev/null
        apt-get -y update > /dev/null
        apt-get -y install php-fpm > /dev/null
        apt-get -y install php php-common php-json php-pgsql php-curl php-mbstring php-bcmath php-zip php-gmp php-xml php-sqlite3 > /dev/null
    else
        echo -e "\e[1;31mFAILED\e[0m"
        echo -e "\e[1;31mPlease reinstall Ubuntu 16.04!\e[0m"
        exit 1;
fi

if [ -f /usr/bin/php ]
    then
        echo -e "\e[1;32mSUCCESS\e[0m"
    else
        echo -e "\e[1;31mFAILED\e[0m"
        echo -e "\e[1;31mFailed to install PHP!\e[0m"
        exit
fi

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
/usr/bin/php $DIR/step_two.php
