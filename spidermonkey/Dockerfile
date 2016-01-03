FROM phusion/baseimage:latest
MAINTAINER Alexander Mayorov <alexander@majorov.su>

RUN apt-get upgrade && \
  apt-get update && \
	apt-get -y install libmozjs-24-dev git php5-dev && \
	apt-get clean

RUN git clone https://github.com/christopherobin/php-spidermonkey.git /usr/local/src/php-spidermonkey

RUN cd /usr/local/src/php-spidermonkey && \
	phpize && \
	./configure && \
	make && \
	make install

RUN echo extension=spidermonkey.so >> /etc/php5/cli/conf.d/spidermonkey.ini

CMD php5 -a
