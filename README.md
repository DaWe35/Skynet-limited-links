# Skynet limited links
Limited downloads for  Sia Skynet

"App that creates unique links to a file. Lets you limit how many times a file can be downloaded from a unique link. This is for webshops selling digital goods to be sure a file isn’t just shared."

##### Limit by:

- Downloads

- Time

- Password

# Api

- POST  `/new`
**Required value:**
skylink *[skynet file hash]*
**Optional values:**
downloadable *[integer]*
expire_value *[integer]*
expire_unit *[minute, hour, day, week, month]*
password *[string]*
**Return:**
