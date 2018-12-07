
# Setup CapitalsObi database
#!/bin/bash

ok() { echo -e '\e[32m'$1'\e[m'; } # Green

REPO_DB='benevs_db'
REPO_US='benev'
REPO_PW='benev'

EXPECTED_ARGS=3
E_BADARGS=65
MYSQL=`which mysql`

Q1="CREATE DATABASE IF NOT EXISTS $1;"
Q2="GRANT ALL ON *.* TO '$2'@'localhost' IDENTIFIED BY '$3';"
Q3="FLUSH PRIVILEGES;"
SQL="${Q1}${Q2}${Q3}"

if [ $# -ne $EXPECTED_ARGS ];
then
  echo "###########################################################"
  echo "Usage: $0 dbname dbuser dbpass."
  echo "For this repo 'dbname' 'dbuser' 'dbpass' =  ${REPO_DB}  ${REPO_US}  ${REPO_PW}."
  echo "###########################################################"
  exit $E_BADARGS
fi

$MYSQL -ubenev -p -e "$SQL"

ok "Database $1 and user $2 created with a password $3"


exit
