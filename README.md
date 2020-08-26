# camagru
Camagru - Snapchat like web-app on clear PHP (No Backend-Frameworks) - 21School Project
Functionality: 
* Registration-Authorization(with Mail Token)
* Notifications on User Mail
* Snapshots with cool filters
* Admin Analytics and Rights
* Adaptive Mobile Version
* Likes, Comments, Sharing on Social Media
* Catching GeoPosition when Creating New Post

![camagruvid720.gif](https://github.com/noreederek/camagru/blob/master/camagruvid720.gif)

# Install

Before setup on your system should be installed mySQL and PHP-mysql-PDO Driver

* setup

```
php setup.php
```
* run

```
php -S localhost:8000
```

# Docker-compose

In camagrudocker folder we have a Docker-compose config (but mailing functions not working without sendmail SMTP confs (in Dockerfile))

* Go to camagrudocker

```
docker-compose up
```
Credentials to login if you don't have SMTP settings - admin@admin.ru:admin
