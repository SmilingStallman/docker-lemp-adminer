# docker-lemp-adminer


This is a basic Docker LEMP (Linux, nginx, MySQL, PHP) stack with Adminer included for Database interaction.

This stack was built with docker-compose, with each container defined in a Dockerfile.

The basic configuration is:

```
---adminer
     Dockerfile

---mariadb
     Dockerfile
     ---init
        demo.sql   #builds demo db, assigns user privileges, and populates
        sm-demo.sql   #builds second demo db, on separate container, assigns user privileges, and populates

---nginx
   Dockerfile
   ---conf.d
      default.conf    #sets upstream
   ---sites
      default.conf    #server config
   nginx.conf   #nginx config

---php-fpm
   Dockerfile

---src
   #source files here

docker-compse.yml
README.md
```


# Setup

Clone the repo

```
git clone https://github.com/
```

Run #1

```
docker-compose build
```
Run #2

Build services
```
docker-compose up -d
```
Run #3

SSH login to php container

```
docker exec -t -i lemp_php /bin/bash
```
Run #4

SSH login to mysql container

```
docker exec -t -i lemp_mysql /bin/bash
```
