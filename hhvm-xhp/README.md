# HHVM with XHP

A simple Docker container for playing around with Facebook's HHVM and Hacklang. Based on the excellent Docker friendly [phusion/baseimage](https://github.com/phusion/baseimage-docker) for noobie.

The container doesn't have a HTTP server and database server configured. Only HHVM daemon.

## Usage

First, verify it works:

    # docker build -t hhvm .
    # docker run --name=hhvm -p 127.0.0.1:9007:9000 -v /www/docker/files:/www/sites --rm -it hhvm /sbin/my_init -- bash -l

This will expose port 9007 from localhost to 9000 within the container.
This container mounting a host directory as a container volume, allowing you to run files from the host machine through the HHVM FastCGI instance within the container.
HHVM is pointed to `/www/sites` which is by default set up to serve the example index.hh file located within the repository.
For production you can run container as daemon:

    # docker run --name=hhvm -p 127.0.0.1:9007:9000 -v /www/docker/files:/www/sites -dit hhvm /sbin/my_init

Now simply put your `.php` or `.hh` files to `/www/docker/files` on the host machine and enjoy Hacking! :)
You should run `docker ps` to check the port equivalent on the host machine and go to http://localhost:{EXPOSED_PORT} to confirm you get the proverbial "Hello, world!" message.
