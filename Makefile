docker-up: perm
	sudo docker-compose up --build -d

perm:
	sudo chown ${USER}:${USER} ./api/docker -R