alias php="docker compose exec php server-php-1"
alias phpunit="docker compose exec php php bin/phpunit --testdox " #  --bootstrap tests/bootstrap.php --testdox tests
alias composer="docker compose exec --user root php composer"
alias symfony="docker compose exec --user root php symfony"
alias phpstan=" docker run "$__prefixes" -v $PWD:/app ghcr.io/phpstan/phpstan:1-php8.1"


if [[ -z $1 ]]; then
  echo " "
  echo "Les alias suivants sont désormais utilisables :"
  echo "- php"
  echo "- phpunit"
  echo "- composer"
  echo "- symfony"
  echo "- redis"
  echo "- phpstan"
  echo " "
  echo "Utilise 'source .bash_aliases -q' pour ne pas afficher cette aide."
  echo " "
fi
