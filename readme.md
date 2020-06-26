## Private Event Site built with SilverStripe

- Homepage is a prompt to enter a secret code that is mailed out by event host

- Once a correct code is entered, user is brough to the homepage with more info on the event and an form to RSVP



#### Deploy:
- Host server, move code to server
- Add recaptcha keys to config directory, see example in `/code/app/_config/recaptcha.yml.example`
- Configure .env, see example in `/code/.env.example`
- Run `sudo docker-compose up -d --build`
- Import DB if needed
- Configure domain as needed

### Export/import DB:

#### Export DB:
`sudo docker exec CONTAINER /usr/bin/mysqldump -u root --password=root DATABASE > backup.sql`

#### Import DB:
`cat backup.sql | sudo docker exec -i CONTAINER /usr/bin/mysql -u root --password=root DATABASE`