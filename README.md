# Reservation system

This is very VERY simple reservation system. Every user can create a reservation - if choosen date is already in database, user will get few closest avaliable dates.
Admin can login and see todays and future reservations ordered by time. Website will not show past reservations.

## Read this

Script still does not have option to limit choosing dates between hours frame. I will probably work on that later.

## Install

Just upload `htdocs` on your server and import `reservation.sql` to your phpmyadmin


## Features

* Secure login system
* Basic css - so website looks great
* admin panel is secure
* session is used too!
* reservations only in flat hours (ex. 12.00; 13.00; 14.00)
* showing closest avaliable reservation times if choosen is already taken
* sorted dates for admins - to have a clear view


## Contributing

Feel free to copy this code. Make sure to leave a star if you like it and credit my github <3

## License
[MIT](https://choosealicense.com/licenses/mit/)