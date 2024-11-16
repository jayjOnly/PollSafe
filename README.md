
# PollSafe

Participate in elections from anywhere, anytime, with complete confidence in the security and integrity of your vote.



## Features
- **Secure**: State-of-the-art encryption and blockchain technology ensure the integrity of every vote.
- **Accessible**: Vote from any device, anywhere in the world. No more long queues or travel hassles.
- **Transparent**: Real-time results and comprehensive audit trails for complete transparency.

## Installation
### Requirement
- PHP version ^8.3
- Apache ^2.4.62
- MySQL ^8.0
- Composer installed
- Patch installed in PATH (optional)

1. Clone the project using git clone.
```bash
git clone https://github.com/jayjOnly/PollSafe.git
```
2. Run composer install to install the the package required.

```bash
composer install
```
3. Copy the .env.example into .env
```bash
cp .env.example .env
```
Or
```bash
copy .env.example .env
```
4. Generate app key
```bash
php artisan key:generate
```
5. Migrate the database and seed
```bash
php artisan migrate:fresh --seed
```
6. Running the application
```bash
php artisan serve
```


## Environment Variables
**Production**

For production deployment, you need to set the following variable in .env file:

```.env
APP_ENV=production #set the env to production
APP_KEY=... #use php artisan key:generate to automatically generate the key
APP_DEBUG=false #disabling debug mode
LOG_LEVEL=error #only log error

# The database credentials is depends on your setup
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=PollSafe
DB_USERNAME=root
DB_PASSWORD=
```

**Local**

The .env in local should not different with current example but remember to change the database configuration

## Patch installation (Windows)
This Patch installation is **optional** if you encounter error with some vendor package while running the application
1. Make sure you install git
2. Add `C:\Program Files\Git\usr\bin` to your PATH variable. (The bin location depends on your git installation)


# Authors
- [@jayjOnly](https://github.com/jayjOnly) (Andrew)
- [@UdinPatens](https://github.com/UdinPatens) (Jacky)
- [@Ren9x](https://github.com/Ren9x) (Udin)
- [@sethyrical](https://github.com/sethyrical) (Anjori)
- [@SaegusaMayumi1234](https://github.com/SaegusaMayumi1234) (Julian)