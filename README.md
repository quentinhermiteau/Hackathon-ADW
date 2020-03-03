# hackathon-adw

## Requirements

- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- [GNU/Make](https://www.gnu.org/software/make/)

## Installation

```console
$ git clone git@github.com:quentinhermiteau/Hackathon-ADW.git
$ cd Hackathon-ADW
```

## Commands

Command | Description
---|---
`make init` | Installation the PHP dependencies & configure Laravel environment.
`make build` | Build the Dockerfile
`make start` | Start the NGINX Web server at http://localhost.
`make stop` | Stop the NGINX Web server.
`make start` | Alias for `make stop start`.
`make clean` | Removes the artifacts left from Docker.
`make mrproper` | Removes the artifacts from Docker, the PHP Depedencies & the environment configuration.
`make migrations` | Run the Laravel migrations.
