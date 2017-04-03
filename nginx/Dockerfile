FROM nginx:1.11.8-alpine

COPY nginx.conf /etc/nginx/nginx.conf
COPY default.conf /etc/nginx/conf.d/default.conf
COPY server.crt /usr/local/nginx/conf/server.crt
COPY server.key /usr/local/nginx/conf/server.key