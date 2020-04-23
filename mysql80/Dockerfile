FROM mysql:8.0
EXPOSE 3306

ADD ./my.cnf /etc/mysql/conf.d/my.cnf
## /etc/mysql/my.cnf で，/etc/mysql/conf.d/* 内のファイルを読み込む
RUN chmod 644 /etc/mysql/my.cnf

CMD ["mysqld"]
