# docker-lemp-adminer


This is a basic Docker LEMP (Linux, nginx, MySQL, PHP) stack with with pdo_mysql mysqli installed and Adminer included for Database interaction.

This stack was built with docker-compose, with each container defined in a Dockerfile.

The basic configuration is:

```
---adminer
     Dockerfile

---mariadb
     Dockerfile
     ---init
        demo.sql      #builds demo db, assigns user privileges, and populates
        sm-demo.sql   #builds second demo db, on separate container, assigns user privileges, and populates

---nginx
   Dockerfile
   ---conf.d
      default.conf    #sets upstream
   ---sites
      default.conf    #server config
   nginx.conf         #nginx config

---php-fpm
   Dockerfile

---src
   #source files here

docker-compse.yml
README.md
```


# Configuration

1) Clone the repo

```
git clone https://github.com/SmilingStallman/docker-lemp-adminer.git
```

2) If you will not use PDO or MySQLi for PHP DB interaction, remove these from the ```RUN``` statement in:
```
./php-fpm/Dockerfile.
```

3) For nginx, server setup is
```
nginx---sites---default.conf.
```
This includes default settings of interest:
```
listen 80 default_server;
listen [::]:80 default_server ipv6only=on;

server_name localhost;

root /var/www/;
```
Config these, and other server settings as desired, or leave as default.

4) This stack shows how to run multiple databases on a site and includes two DB containers. These DB are created, assigned demo users with privileges, and populated via files:
```
   ---mariadb---init--demo.sql
   ---mariadb---init---demo.sql
```
These files are set to run during mariadb init in docker-compose.yml on lines:
```
database-demo:
   volumes:
      - ./mariadb/init/demo.sql:/docker-entrypoint-initdb.d/demo.sql

another-database:
   volumes:
     - ./mariadb/init/sm-demo.sql:/docker-entrypoint-initdb.d/sm-demo.sql
```
Use these .sql files as examples how to create your own databases, users, privileges, and populate tables.

If you wish to build with and empty DB or no initial DB, remove these volumes from docker-compose.yml, or optionally replace with environment variables, to create an empty DB, with no data population, such as:
```
database-demo:
   environment
     -MYSQL_ROOT_PASSWORD=changeme
     -MYSQL_DATABASE=dummy
     -MYSQL_USER=dummy
     -MYSQL_PASSWORD=dummy
```
It is also suggested to change the root password for the two existing databases before building by modifying the docker-compose.yml database container lines:
```
- MYSQL_ROOT_PASSWORD=changeme
```

# Build and Run
1) Build via:
```
docker-compose build
````
2) Run via:
```
docker-compose run
# or to run in background
docker-compose run
````

# Use
As this build uses mounted volumes, changes in the src folder will be reflected immediately within the containers. Delete the demo src files and replace with your own project source files.

The demo can be accessed on:
```
localhost:80
````

To interact with DB, use:
```
localhost:8080
```
With login info:
```
System: MySQL
Server: hostname (db container service name)
Username: username created in init .sql file
Password: username created in init .sql file
Database: DB created in init .sql
````
For example, on the another-database container and DB built in this demo, through ---init---sm-demo.sql:
```
System: MySQL
Server: another-database
Username: lain
Password: unsecurepassword
Database: publications
````
