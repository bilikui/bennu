#!/bin/bash

BASE_DIR=$(pwd)
ENV_DIR=$BASE_DIR/docker
project_name=$(basename $(pwd))
project_name=${project_name/[\.|-]/}
project_name="TourGuru"

cd "$ENV_DIR"

case $1 in
"up" | "start")
  echo "Starting development environment..."
  echo "================================================"

  shift
  DETACH_FLAG="-d"
  RECREATE=""
  for opt in "$@"; do
    case $opt in
    "--no-detach")
      DETACH_FLAG=""
      ;;
    esac
    case $opt in
    "--force")
      RECREATE="--force-recreate"
     echo "FORCED"
     ;;
    esac
   case $opt in
    "--build")
      RECREATE="--force-recreate --build"
     echo "FORCED"
     ;;
    esac
  done

  echo "Starting containers"
  echo "go to http://localhost/"
  echo "------------------------------------------------"
  docker-compose up $DETACH_FLAG $RECREATE
  ;;

"down" | "stop")
  echo "Stopping development environment..."
  echo "================================================"
  docker-compose stop
  docker-compose rm -f
  ;;

"login")
  test $2 || {
    echo "You must specify a container." >&2
    exit 1
  }
  docker exec -ti ${project_name}_${2} /bin/bash
  ;;

"mysql")
  test $2 || {
    echo "You must specify a container." >&2
    exit 1
  }
  docker exec -ti ${project_name}_${2} mysql mysql -uroot -proot
  ;;

"logs")
  test $2 || {
    echo "You must specify a container (php)." >&2
    exit 1
  }
  case $2 in
  "php")
    docker exec -t ${project_name}_${2} bash -c "tail -f /var/log/nginx/*.log"
    ;;
  esac
  ;;

"status")
  show_status
  ;;

*)
  echo "Help: $0 <command>"
  echo ""
  echo "Commands:"
  echo "up|start [--no-detach|--force|--build]   - Start docker containers."
  echo "stop                                     - Stop and remove docker containers"
  echo "status                                   - Show status of the most important services"
  echo "login <container>                        - Login to a container (php)"
  echo "logs <container>                         - Do a 'tail -f' of the log files (php)"
  ;;
esac
