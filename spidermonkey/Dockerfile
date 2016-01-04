FROM phusion/baseimage:latest
MAINTAINER Alexander Mayorov <alexander@majorov.su>

RUN export DEBIAN_FRONTEND="noninteractive" && \
    apt-get upgrade && \
    apt-get update && \
    apt-get -y install libmozjs-24-dev git php5-dev php5-fpm && \
    apt-get clean

RUN git clone https://github.com/christopherobin/php-spidermonkey.git /usr/local/src/php-spidermonkey

RUN cd /usr/local/src/php-spidermonkey && \
	phpize && \
	./configure && \
	make && \
	make install && \
	make clean

RUN echo extension=spidermonkey.so >> /etc/php5/cli/conf.d/spidermonkey.ini && \
    echo extension=spidermonkey.so >> /etc/php5/fpm/conf.d/spidermonkey.ini

# Clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 9008
WORKDIR /www/sites

# Use baseimage-docker's init system
CMD ["/sbin/my_init"]

#EOF#
