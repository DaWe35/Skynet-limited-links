# Skynet limited links
Limited downloads for  Sia Skynet

Demo video: https://siasky.net/_AW9GZLZMf4Ba6U3gC8MpMps51yIiRLkZkxIVkCM4NEMhQ

"App that creates unique links to a file. Lets you limit how many times a file can be downloaded from a unique link. This is for webshops selling digital goods to be sure a file isn’t just shared."

##### Limit by:

- Downloads

- Time

- Password

# Api

## POST  `/new`

### Required value:

skylink *[skynet file hash]*

### Optional values:

downloadable *[integer]*

expire_value *[integer]*

expire_unit *[minute, hour, day, week, month]*

password *[string]*

### Return:

`{"error": "Human readable description"}`

or

`{"id": "23r4lw02m2i9", "url": "http://skylimit.local/get/23r4lw02m2i9"}`

# Install

- Insall Apache/Nginx with PHP & MySQL

- git clone into the website directory

- Create database `sia_links` and import `sia_links.sql` file

- setup mysql user for database

- `cp config_default.php config.php`, and edit config.php database credentials & site URL