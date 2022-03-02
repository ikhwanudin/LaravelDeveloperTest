# Laravel Developer Test

get 20 records random user every 1 minute from api, parallel job, caching data n calculate mean & median.

## command

running queue worker

```
php artisan queue:work database --tries=3 --queue=get_rand_user_queue,get_rand_user_queue_1,get_rand_user_queue_2
```

running task scheduling

```bash
php artisan schedule:work
```
