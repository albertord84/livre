#!/bin/sh

date=$(date +%Y%m%d)

now=$(date +"%T")


curl -k https://localhost/livre/index.php/welcome/robot_checking_contracts >> /opt/lampp/htdocs/livre/log/contracts-${date}.log
