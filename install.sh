#!/bin/bash
echo -n "Checking OS version..."
if grep -Fxq "jessie/sid" /etc/debian_version
    then
        #Add PHP7 repository
        echo -e "\e[1;32mSUCCESS\e[0m"
        echo -n "Adding PHP7 repository... "
        apt-get -y install python-software-properties sqlite3 > /dev/null
        add-apt-repository -y ppa:ondrej/php > /dev/null
        apt-get -y update > /dev/null
        apt-get -y purge php5-fpm > /dev/null
        echo -e "\e[1;32mSUCCESS\e[0m"
        
        echo -n "Installing PHP... "
        apt-get --purge -y autoremove > /dev/null
        apt-get -y update > /dev/null
        apt-get -y install php7.0-fpm > /dev/null
        apt-get -y install php7.0 php7.0-common php7.0-json php7.0-pgsql php7.0-curl php7.0-mbstring php7.0-bcmath php7.0-zip php7.0-gmp php7.0-xml php7.0-sqlite3 > /dev/null
    elif grep -Fxq "stretch/sid" /etc/debian_version
    then
        echo -e "\e[1;32mSUCCESS\e[0m"
        echo -n "Installing PHP... "
        apt-get --purge -y autoremove > /dev/null
        apt-get -y update > /dev/null
        apt-get -y install php-fpm > /dev/null
        apt-get -y install php php-common php-json php-pgsql php-curl php-mbstring php-bcmath php-zip php-gmp php-xml php-sqlite3 > /dev/null
    else
        echo -e "\e[1;31mFAILED\e[0m"
        echo -e "\e[1;31mPlease reinstall Ubuntu 16.04 or 14.04!\e[0m"
fi

if [ -f /usr/bin/php ]
    then
        echo -e "\e[1;32mSUCCESS\e[0m"
    else
        echo -e "\e[1;31mFAILED\e[0m"
        echo -e "\e[1;31mFailed to install PHP!\e[0m"
        exit
fi

/usr/bin/php step_two.php