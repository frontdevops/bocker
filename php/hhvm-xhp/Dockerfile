FROM alexmayorov/base-ubuntu:latest
MAINTAINER Alexander Mayorov <alexander@majorov.su>

# Set correct environment variables.
ENV HOME /root

ENV HHVM_VERSION 3.11.0~trusty

# install hhvm
RUN wget -O - http://dl.hhvm.com/conf/hhvm.gpg.key | sudo apt-key add - && \
    echo 'deb http://dl.hhvm.com/ubuntu trusty main' | tee /etc/apt/sources.list.d/hhvm.list
RUN export DEBIAN_FRONTEND="noninteractive" && \
    apt-get update && \
    apt-get install -y --no-install-recommends hhvm=$HHVM_VERSION && \
    apt-get clean

#RUN /usr/share/hhvm/install_fastcgi.sh
#RUN mkdir /etc/service/hhvm
#ADD hhvm.sh /etc/service/hhvm/run
#RUN chmod 700 /etc/service/hhvm/run

COPY php.ini /etc/hhvm/php.ini
COPY server.ini /etc/hhvm/server.ini

# forward request and error logs to docker log collector
RUN ln -sf /dev/stderr /var/log/hhvm/error.log

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
