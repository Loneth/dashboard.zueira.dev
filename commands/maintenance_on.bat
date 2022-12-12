cd..
php artisan down --message="Upgrading Website" --allow=189.25.216.90 --allow=11.22.33.44 --allow=49.145.132.40 --allow=112.198.222.197 --retry=60
php artisan schedule:run
@pause