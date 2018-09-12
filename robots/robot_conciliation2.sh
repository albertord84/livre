#!/bin/sh

date=$(date +%Y%m%d)

now=$(date +"%T")

curl -k https://localhost/livre/index.php/welcome/robot_conciliation2 >> /opt/lampp/htdocs/livre/log/conciliation-${date}.log

