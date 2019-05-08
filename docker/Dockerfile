FROM ubuntu:bionic

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get -y update \
    && apt-get upgrade -y \
    && apt-get install -y software-properties-common \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get -y update \
    && apt-get install -y php7.2 \
        php7.2-zip \
        php7.2-xml \
        php7.2-mbstring \
        vim \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=bin --filename=composer  \
    && php -r "unlink('composer-setup.php');"

WORKDIR src
