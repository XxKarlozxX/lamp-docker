# Clone this project
- Execute in your terminal.
 ```
$ git clone https://github.com/XxKarlozxX/lamp-docker.git
    or
$ git clone git@github.com:XxKarlozxX/lamp-docker.git
 ```

# Change the config to your environmet
## Config nginx 
- Open and edit the myapp.conf file (config > nginx > myapp.conf)
- Changes the name server_name.
    - By default "myapp.local"
    ``` 
    server_name newapp.local
    ```
- Changes the logs name files. 
    - By default: 
        - error.log
        - access.log
    ```
    error_log /var/log/nginx/newappp_error.log;
    access_log /var/log/nginx/newapp_access.log;
    ```
- Change the route of root.
    - By default: /var/www/html/myapp;
    ```
    root /var/www/html/mynewapp;
    ```
## Config Docker compose 
- Open the docker-compose.yml, into the docker directory.
- Edit the docker-compose.yml

### Config php container
- In the line 3 start the config to php container .
- In the line 4, set the container name in this case "php7".
- In the line 5, docker image to php is called from php directory.
    - In the php file is an image that specified the image features.
- In the line 6, set the volumes for our config and code php.
- In the line 7 - 8, indicates the routes to map for our custom php configuration and the directory where is our code php.
    - In this case our directorys by default are:
    ```
    /path/to/your/config/php:/usr/local/etc/php
    /path/to/your/code/myapp:/var/www/html/myapp
    ```
    - We need to change to somethig like this:
    ```
    /home/name-user/proyect/lamp-docker/config/php:/usr/local/etc/php
    /home/name-user/proyect/lamp-docker/code/myapp:/var/www/html/myapp
    ```
    - where name-user is your user and proyect is the directory where you clone this repo.
    - In my case is something like this:
    ```
    /home/karloz/proyectos/lamp-docker/config/php:/usr/local/etc/php
    /home/karloz/proyectos/lamp-docker/code/myapp:/var/www/html/myapp
    ```
    - If you don't know what is the route, you can type the comand: 
    ``` 
    $ pwd 
    # that retrieve something like this:
    /home/karloz/proyectos/lamp-docker/config/php
    ```
    - Copy that route behind the ":/usr/local/etc/php"
    - In the line 9, we set the dependency with the database container called "mysql".

## We repited this for nginx container
- In the line 15, we set the ports for our local envirenmt ":" and the port in the docker container.
    - In this case "8080" port for our machine and "80" port for docker container.
- In the line 17 - 20, indicates the routes to map for our custom nginx configuration and the directory where is our code php and where to find the log files.
    - In this case our directorys by default are:
    ```
    - /path/to/your/config/nginx:/etc/nginx/conf.d
    - /path/to/your/code/myapp:/var/www/html/myapp
    - /path/to/your/logs:/var/log/nginx
    ```
    - We need to change to somethig like this:
    ```
    /home/karloz/proyectos/lamp-docker/config/nginx:/etc/nginx/conf.d
    /home/karloz/proyectos/lamp-docker/code/sociallog:/var/www/html/sociallog
    /home/karloz/proyectos/lamp-docker/logs:/var/log/nginx
    ```
    - In the line 20, we set the log files.
    - In the line 21 - 22, we set the dependency with php7 container.

## Config MySQL container
- In the line 27, we set the ports for our local environment ":" and the port in the docker container.
    - In this case "3306" port for our machine and "3306" port for docker container.
- In the lines 29 - 30, indicates the routes to map for our custom MySQL configuration.
- In the lines 31 - 33, we set the mysql root password and the name of database to create it. 
- Something like this:
```
volumes:
      - /home/karloz/proyectos/lamp-docker/mysql/data:/var/lib/mysql
environment:
      - MYSQL_ROOT_PASSWORD=password
      - MYSQL_DATABASE=database
```

## Create the logs files
Into the logs directory create the corresponding files.
Example:
- Create the newapp_error.log
- Create the newapp_access.log

The name of this files must match with the name set in the file .conf of nginx server.

# Set the host

- In the hosts list set a new host with the same name that is in .conf file of nginx.
    - In my case:
    ```
    127.0.0.1   myapp.local # your host name
    ``` 

# Run
Into the docker directory type the next command:
```
$ docker-compose up -d
```
Finally enter in your browser and type the name of your host with the port 8080,
```
http://myapp.local:8080
```
if all is fine, you are ready for work with docker and php.