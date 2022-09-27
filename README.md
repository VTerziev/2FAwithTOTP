# 2FAwithTOTP

The application is developed with XAMPP. The initialization for the database is in "database_init.txt".

The page "index.php" simulates a service, that supports 2FA. At first (upon registration) it is disabled and can be activated from the "2FA" tab. When doing so, you are given a key, which should be added to the application, storing the 2FA keys.

The page "mobile_device/index.php" is a service, which stores the 2FA keys and gives you the TOTP passwords. 
