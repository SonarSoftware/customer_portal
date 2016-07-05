<?php

use SonarSoftware\CustomerPortal\CustomerPortalInstaller;

require("vendor/autoload.php");
$installer = new CustomerPortalInstaller();
$installer->install();