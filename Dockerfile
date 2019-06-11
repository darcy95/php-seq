FROM alexcheng/apache2-php7

MAINTAINER Juhoon Kim <kimjuhoon@gmail.com>

WORKDIR /var/www

USER root
RUN apt-get update
RUN apt-get install -y git
RUN rm -rf html
ADD index.html /var/www/html/
ADD class /var/www/html/class
ADD example /var/www/html/example
