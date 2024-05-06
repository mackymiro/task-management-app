I deployed the app in my live server
you can test directly in this link. I cant provide the credential access since this is my server.
https://projects.cebucodesolutions.com/task-management-app/


Steps
1. Clone the repository
2. Setup in your localhost machine
3. Migrate the database
4. npm run dev for VITE build
5. php artisan serve

Run this for the storage link in files
<br>
php artisan storage:link 

For the automatically remove in 30 days. I just create a commands purgesoftdeletes.php file manually. I did not use CRON jobs for this
run this script 
php artisan purge:softdeletes
e.g.
![image](https://github.com/mackymiro/task-management-app/assets/16445177/71c979b0-338b-42bc-b81a-75a8fb990ed5)


