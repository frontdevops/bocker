# My Docker builds
My Docker files for develop with PHP, HHVM+XHP, Nodejs, JXCore, Spidermonkey, V8JS, Server Side React Render and other...

A simple Docker container for playing around with different developer tools. Based on the excellent Docker friendly phusion/baseimage for noobie.


## Usage

    cd docker/image_name/ # where is Dockerfile
    docker build -t alexmayorov/image-name .

**Run for debuging**

    sudo docker run --name=$tag --rm -it $image /sbin/my_init -- bash -l

**Run as daemon**

    sudo docker run -p 127.0.0.1:9009:9000 -v /www/sites:/www/sites --name=$tag -d $image /sbin/my_init


**Login to the container**

    ssh -i ~/.ssh/id_rsa root@$ip

**Running a command inside the container**

    ssh -i ~/.ssh/id_rsa root@$ip echo hello world



## License

        Free 4 all!

_WARNING!_ If you not trust me, don't do anything. You can manually create your Docker image or download docker image from https://hub.docker.com by other user. It's your choice.
