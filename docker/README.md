# Prepare proper env

```bash
cp .env.example .env
```

.env.example.dev has dependencies not necessary for application to run, only useful for development and running tests.

# Vhost

By default is set to `simple-blog-api.test`. Change content of `nginx/sites/simple-blog-api.conf` if needed.

# Bring containers up

 ```bash
docker-compose up -d nginx mysql redis horizon
 ```

# Setup mysql and redis hosts

In application's .env set:

```dotenv
DB_HOST=mysql
REDIS_HOST=redis
```

# Laravel Horizon

In order to run horizon container and use the default configuration you need to create a new `laravel-horizon.conf` from
the supplied `laravel-horizon.conf.example` file:

```bash
cp docker/horizon/supervisord.d/laravel-horizon.conf docker/horizon/supervisord.d/laravel-horizon.conf
```

# Enter workspace container

 ```bash
docker-compose exec --user="laradock" workspace bash
 ```

Laravel horizon has been moved to a separate container `horizon`. It shouldn't be run from inside the workspace
container anymore
