### Table of Contents
- [DiceCRM](#dicecrm)
- [Features of DiceCRM](#features-of-dicecrm)
- [Requirements](#requirements)
- [Installation](#installation)


### DiceCRM 
DiceCRM is an open source CRM tool to manage projects, clients, leads, appointments, and users. DiceCRM is a free, open-source, and self-hosted platform based on Laravel Framework 8.


_Current Version: 0.0.5_

<img src="/DiceCRM.png" alt="DiceCRM"/>

### Features of DiceCRM
It includes several advanced features as follows:

- Client Management
- Project Management
- Task Management
- Leads Management
- Track Appointments in Calendar
- Manage Industries, Departments, and Status
- User Alerts and Notifications
- User Management
- Multi-tenancy Architecture
- Dashboard Summary

### Requirements
- PHP >= 7.4
- Composer >= 1.0
- Laravel >= 8.0
- MySQL

### Installation
To install DiceCRM in your server, follow the below steps:
1. Clone the repository with **git clone** / Download and extract the files from the repository **DiceCRM**
2. Copy **.env.example** file to **.env**
3. Edit **.env** file with the details such as app url, app name, database credentials, mail, and other credentials wherever needed.
4. Run **composer install** or **php composer.phar install**
5. Remove the specific packages from **composer.json** if any error occurs
6. Go to **config** folder and open **database.php**. Rewrite charset to '**utf8**' and collation to '**utf8_unicode_ci**'
7. Run **php artisan key:generate**
8. Run **php artisan migrate --seed** <br/>
_**Note:** **Seed is mandatory as it will create the first admin user.**_
9. For file or image attachments, run **php artisan storage:link** command
10. Start php server with command **php artisan serve**
11. Launch the main **URL**.
12. To log in to adminpanel, go to **/login** URL and log in with credentials <br/>
_Username: admin@admin.com <br/>
Password: password_ <br/>
13. For other users, email address is user's email and password is user's password

### Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.



### License
This project is licensed under an [MIT license](https://github.com/RaamAnalyst/DiceCRM/blob/main/LICENSE).
