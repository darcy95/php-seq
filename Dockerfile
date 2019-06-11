FROM alexcheng/apache2-php7

MAINTAINER Juhoon Kim <kimjuhoon@gmail.com>

WORKDIR /var/www

USER root
RUN apt-get update
RUN apt-get install -y -qq git
RUN rm -rf html
RUN git clone https://github.com/darcy95/php-seq.git html
