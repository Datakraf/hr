<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Modules\\Wage\\Database\\Seeders\\WageDatabaseSeeder' => $baseDir . '/Database/Seeders/WageDatabaseSeeder.php',
    'Modules\\Wage\\Entities\\Bank' => $baseDir . '/Entities/Bank.php',
    'Modules\\Wage\\Entities\\Payslip' => $baseDir . '/Entities/Payslip.php',
    'Modules\\Wage\\Entities\\PayslipSummary' => $baseDir . '/Entities/PayslipSummary.php',
    'Modules\\Wage\\Entities\\Wage' => $baseDir . '/Entities/Wage.php',
    'Modules\\Wage\\Http\\Controllers\\PayslipsController' => $baseDir . '/Http/Controllers/PayslipsController.php',
    'Modules\\Wage\\Http\\Controllers\\WagesController' => $baseDir . '/Http/Controllers/WageController.php',
    'Modules\\Wage\\Listeners\\CreateUserWageOnUserCreation' => $baseDir . '/Listeners/CreateUserWageOnUserCreation.php',
    'Modules\\Wage\\Notifications\\PayslipGenerated' => $baseDir . '/Notifications/PayslipGenerated.php',
    'Modules\\Wage\\Providers\\EventServiceProvider' => $baseDir . '/Providers/EventServiceProvider.php',
    'Modules\\Wage\\Providers\\RouteServiceProvider' => $baseDir . '/Providers/RouteServiceProvider.php',
    'Modules\\Wage\\Providers\\WageServiceProvider' => $baseDir . '/Providers/WageServiceProvider.php',
    'Modules\\Wage\\Traits\\EpfRates' => $baseDir . '/Traits/EpfRates.php',
    'Modules\\Wage\\Traits\\HrdfRates' => $baseDir . '/Traits/HrdfRates.php',
    'Modules\\Wage\\Traits\\PayslipSummary' => $baseDir . '/Traits/PayslipSummary.php',
    'Modules\\Wage\\Traits\\SocsoRates' => $baseDir . '/Traits/SocsoRates.php',
    'Modules\\Wage\\Traits\\UnpaidLeaves' => $baseDir . '/Traits/UnpaidLeaves.php',
    'Modules\\Wage\\Traits\\WageCalculator' => $baseDir . '/Traits/WageCalculator.php',
);