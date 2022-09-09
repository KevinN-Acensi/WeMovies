FROM nginx:1.23.1-alpine

# Replace default config by ours
RUN rm -rf /etc/nginx/conf.d/*
COPY ./conf.d /etc/nginx/conf.d