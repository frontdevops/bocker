FROM phusion/baseimage:0.9.18
MAINTAINER Alexander Mayorov <alexander@majorov.su>

# Install default deps
RUN export DEBIAN_FRONTEND="noninteractive" && \
    apt-get update && \
    apt-get -yq upgrade && \
    apt-get -y install git make g++ python curl chrpath php5-dev php5-fpm && \
    apt-get clean

# v8
## Depot tools
RUN git clone https://chromium.googlesource.com/chromium/tools/depot_tools.git /usr/local/depot_tools
ENV PATH $PATH:/usr/local/depot_tools

## Download v8
RUN cd /usr/local/src && fetch v8 && \
    cd /usr/local/src/v8 && make native library=shared snapshot=off -j4 && \
    mkdir -p /usr/local/lib && \
    cp /usr/local/src/v8/out/native/lib.target/lib*.so /usr/local/lib

RUN echo "create /usr/local/lib/libv8_libplatform.a\naddlib /usr/local/src/v8/out/native/obj.target/tools/gyp/libv8_libplatform.a\nsave\nend" | ar -M

RUN cp -R /usr/local/src/v8/include /usr/local && \
    chrpath -r '$ORIGIN' /usr/local/lib/libv8.so

## Get v8js, compile and install
RUN git clone https://github.com/preillyme/v8js.git /usr/local/src/v8js && \
    cd /usr/local/src/v8js && phpize && ./configure --with-v8js=/usr/local

ENV NO_INTERACTION 1
RUN cd /usr/local/src/v8js && make all test install

ENV NO_INTERACTION 1
RUN cd /usr/local/src/v8js && make all test install && make clean


# Autoload v8js.so
RUN echo extension=v8js.so > /etc/php5/cli/conf.d/v8js.ini && \
    echo extension=v8js.so > /etc/php5/fpm/conf.d/v8js.ini

# Clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 9009
WORKDIR /www/sites

# Use baseimage-docker's init system
CMD ["/sbin/my_init"]

#EOF#
