FROM alexmayorov/baseimage:latest
MAINTAINER Alexander Mayorov <alexander@majorov.su>

# Set correct environment variables.
ENV HOME /root

# install hhvm
RUN wget -O - http://dl.hhvm.com/conf/hhvm.gpg.key | sudo apt-key add -
RUN echo 'deb http://dl.hhvm.com/debian jessie main' > /etc/apt/sources.list.d/hhvm.list
RUN export DEBIAN_FRONTEND="noninteractive" && \
    apt-get update && \
    apt-get -y install hhvm && \
    apt-get clean

RUN /usr/share/hhvm/install_fastcgi.sh

COPY php.ini /etc/hhvm/php.ini
COPY server.ini /etc/hhvm/server.ini

RUN mkdir /etc/service/hhvm
ADD hhvm.sh /etc/service/hhvm/run
RUN chmod 700 /etc/service/hhvm/run

RUN mkdir -p /www/sites
ADD index.hh /www/sites/index.hh
ADD .hhconfig /www/sites/.hhconfig

# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 9000
WORKDIR /www/sites
#VOLUME ["/www/sites"]

# Use baseimage-docker's init system.
CMD ["/sbin/my_init"]
