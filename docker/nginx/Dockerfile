FROM nginx:1.10-alpine

MAINTAINER Rafael Silveira <rsilveiracc@gmail.com>

ARG UID=1000
ARG GID=1000
ARG CODE_ENV

RUN addgroup -g ${GID:-1000} -S www-data \
 && adduser -u ${UID:-1000} -D -S -G www-data www-data

COPY nginx.conf /etc/nginx/
COPY symfony-$CODE_ENV.conf /etc/nginx/sites-available/symfony.conf

RUN mkdir /etc/nginx/sites-enabled/ \
  && ln -s /etc/nginx/sites-available/symfony.conf /etc/nginx/sites-enabled/symfony \
  && rm -f /etc/nginx/conf.d/default.conf \
  && echo "upstream php-upstream { server application:9000; }" > /etc/nginx/conf.d/upstream.conf

EXPOSE 80

CMD ["nginx"]